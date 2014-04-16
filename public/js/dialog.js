
/**
 * jQuery的Dialog插件。
 *
 * @param object content
 * @param object options 选项。
 * @return 
 */
function Dialog(content, options)
{
    var defaults = { // 默认值。 
        title:'标题',       // 标题文本，若不想显示title请通过CSS设置其display为none 
        showTitle:true,     // 是否显示标题栏。
        closeText:'[关闭]', // 关闭按钮文字，若不想显示关闭按钮请通过CSS设置其display为none 
        draggable:true,     // 是否移动 
        modal:true,         // 是否是模态对话框 
        center:true,        // 是否居中。 
        fixed:true,         // 是否跟随页面滚动。
        time:0,             // 自动关闭时间，为0表示不会自动关闭。 
        id:false            // 对话框的id，若为false，则由系统自动产生一个唯一id。 
    };
    var options = $.extend(defaults, options);
    options.id = options.id ? options.id : 'dialog-' + Dialog.__count; // 唯一ID
    var overlayId = options.id + '-overlay'; // 遮罩层ID
    var timeId = null;  // 自动关闭计时器 
    var isShow = false;
    var isIe = $.browser.msie;
    var isIe6 = $.browser.msie && ('6.0' == $.browser.version);

    /* 对话框的布局及标题内容。*/
    var barHtml = !options.showTitle ? '' :
        '<div class="bar"><span class="title">' + options.title + '</span><a class="close">' + options.closeText + '</a></div>';
    var dialog = $('<div id="' + options.id + '" class="dialog">'+barHtml+'<div class="content"></div></div>').hide();
    $('body').append(dialog);


    /**
     * 重置对话框的位置。
     *
     * 主要是在需要居中的时候，每次加载完内容，都要重新定位
     *
     * @return void
     */
    var resetPos = function()
    {
        /* 是否需要居中定位，必需在已经知道了dialog元素大小的情况下，才能正确居中，也就是要先设置dialog的内容。 */
        if(options.center)
        {
            var left = ($(window).width() - dialog.width()) / 2;
            var top = ($(window).height() - dialog.height()) / 2;
            if(!isIe6 && options.fixed)
            {   dialog.css({top:top,left:left});   }
            else
            {   dialog.css({top:top+$(document).scrollTop(),left:left+$(document).scrollLeft()});   }
        }
    }

    /**
     * 初始化位置及一些事件函数。
     *
     * 其中的this表示Dialog对象而不是init函数。
     */
    var init = function()
    {
        /* 是否需要初始化背景遮罩层 */
        if(options.modal)
        {
            $('body').append('<div id="' + overlayId + '" class="dialog-overlay"></div>');
            $('#' + overlayId).css({'left':0, 'top':0,
                    /*'width':$(document).width(),*/
                    'width':'100%',
                    /*'height':'100%',*/
                    'height':$(document).height(),
                    'z-index':++Dialog.__zindex,
                    'position':'absolute'})
                .hide();
        }

        dialog.css({'z-index':++Dialog.__zindex, 'position':options.fixed ? 'fixed' : 'absolute'});

		/*  IE6 兼容fixed代码 */
        if(isIe6 && options.fixed)
        {
            dialog.css('position','absolute');
            resetPos();
            var top = parseInt(dialog.css('top')) - $(document).scrollTop();
            var left = parseInt(dialog.css('left')) - $(document).scrollLeft();
            $(window).scroll(function(){
                dialog.css({'top':$(document).scrollTop() + top,'left':$(document).scrollLeft() + left});
            });
        }

        /* 以下代码处理框体是否可以移动 */
        var mouse={x:0,y:0};
        function moveDialog(event)
        {
            var e = window.event || event;
            var top = parseInt(dialog.css('top')) + (e.clientY - mouse.y);
            var left = parseInt(dialog.css('left')) + (e.clientX - mouse.x);
            dialog.css({top:top,left:left});
            mouse.x = e.clientX;
            mouse.y = e.clientY;
        };
        dialog.find('.bar').mousedown(function(event){
            if(!options.draggable){  return; }

            var e = window.event || event;
            mouse.x = e.clientX;
            mouse.y = e.clientY;
            $(document).bind('mousemove',moveDialog);
        });
        $(document).mouseup(function(event){
            $(document).unbind('mousemove', moveDialog);
        });

        /* 绑定一些相关事件。 */
        dialog.find('.close').bind('click', this.close);
        dialog.bind('mousedown', function(){  dialog.css('z-index', ++Dialog.__zindex); });

        // 自动关闭 
        if(0 != options.time){  timeId = setTimeout(this.close, options.time);    }
    }


    /**
     * 设置对话框的内容。 
     *
     * @param string c 可以是HTML文本。
     * @return void
     */
    this.setContent = function(c)
    {
        var div = dialog.find('.content');
        if('object' == typeof(c))
        {
            switch(c.type.toLowerCase())
            {
            case 'id': // 将ID的内容复制过来，原来的还在。
                div.html($('#' + c.value).html());
                break;
            case 'img':
                div.html('加载中...');
                $('<img alt="" />').load(function(){div.empty().append($(this));resetPos();})
                    .attr('src',c.value);
                break;
            case 'url':
                div.html('加载中...');
                $.ajax({url:c.value,
                        success:function(html){div.html(html);resetPos();},
                        error:function(xml,textStatus,error){div.html('出错啦')}
                });
                break;
            case 'iframe':
                div.append($('<iframe src="' + c.value + '" />'));
                break;
            case 'text':
            default:
                div.html(c.value);
                break;
            }
        }
        else
        {   div.html(c); }
    }

    /**
     * 显示对话框
     */
    this.show = function()
    {
        if(undefined != options.beforeShow && !options.beforeShow())
        {   return;  }

        /**
         * 获得某一元素的透明度。IE从滤境中获得。
         *
         * @return float
         */
        var getOpacity = function(id)
        {
            if(!isIe)
            {   return $('#' + id).css('opacity');    }

            var el = document.getElementById(id);
            return (undefined != el
                    && undefined != el.filters
                    && undefined != el.filters.alpha
                    && undefined != el.filters.alpha.opacity)
                ? el.filters.alpha.opacity / 100 : 1;
        }
        /* 是否显示背景遮罩层 */
        if(options.modal)
        {   $('#' + overlayId).fadeTo(30, getOpacity(overlayId));   }
        dialog.fadeTo(30, getOpacity(options.id), function(){
            if(undefined != options.afterShow){   options.afterShow(); }
            isShow = true;
        });
        // 自动关闭 
        if(0 != options.time){  timeId = setTimeout(this.close, options.time);    }

        resetPos();
    }


    /**
     * 隐藏对话框。但并不取消窗口内容。
     */
    this.hide = function()
    {
        if(!isShow){ return; }

        if(undefined != options.beforeHide && !options.beforeHide())
        {   return;  }

        dialog.fadeOut(30,function(){
            if(undefined != options.afterHide){   options.afterHide(); }
        });
        if(options.modal)
        {   $('#' + overlayId).fadeOut(30);   }

        isShow = false;
    }

    /**
     * 关闭对话框 
     *
     * @return void
     */
    this.close = function()
    {
        if(undefined != options.beforeClose && !options.beforeClose())
        {   return;  }

        dialog.fadeOut(30, function(){
            $(this).remove();
            isShow = false;
            if(undefined != options.afterClose){   options.afterClose(); }
        });
        if(options.modal)
        {   $('#'+overlayId).fadeOut(30, function(){$(this).remove();}); }
        clearTimeout(timeId);
    }

    

    init.call(this);
    this.setContent(content);
    
    Dialog.__count++;
    Dialog.__zindex++;
}
Dialog.__zindex = 500;
Dialog.__count = 1;
Dialog.version = '1.0 beta';

function dialog(content, options)
{
	var dlg = new Dialog(content, options);
	dlg.show();
	return dlg;
}

/*
调用流程，先判断有没有用户评论什么的，没有直接主面板，输出结果
close()函数
new Dialog(
'close()回调函数',
{afterClose:function(){alert('after close');},beforeClose:function(){}}).show();
另外的解决方法：先调用用户评论，当用户关闭时调用关闭函数，关闭函数里调用主面板
*/
//生成主要信息的GUI框架，也就是一些文本信息
function mainGui(type){
    //获取需要的数据
    var expertName=$('#sename').text();
    var isHaveExp=$('#isHaveWorkExp').attr('value');
    var remark=$('#curRemark').text();
    //获取工作经历，1代表有，0代表没有
    if(isHaveExp==1){
        var position=$('#curAgency').attr('value')+','+$('#curPosition').attr('value');
        var company=$('#curCompany').attr('value');
        var background=$('#curDuty').attr('value');
        var area=$('#curArea').attr('value');
    }else{
        var position='No data!';
        var company='No data!';
        var background='No data!';
        var area='No data!';
    }
    
	var output='<div>Consultant Name:&nbsp;'+expertName;
    if(type==2){
        output=output+'<br />Contact No.: <br />'+'Interview time: ';
    }
    output=output+' <br/>Position: '+position+'<br/>';
	output=output+'Company: '+company+
        '<br/>Background: '+background+'<br/>Quotes: <br/>';
	var project_problem='';
	var	expert_comment='';
	for(var i=0;i<p_c.length;i++){
		//读取该索引的项目问题和顾问评论
		project_problem=$('#projectproblem'+p_c[i]).text();
        expert_comment=$('#expertcomment'+p_c[i]).text();
		output=output+(i+1)+'.&nbsp&nbspP:'+project_problem+'<br/>'+'&nbsp&nbsp&nbsp&nbspC:'+expert_comment+'<br />';
	}
	output=output+'Expertise:&nbsp;'+area;
    output=output+'<br />Notes:&nbsp;'+remark;
    if(type==1)
        output=output+'<br />Available time:&nbsp;';
	new Dialog(output,{
                        closeText:'完成',
                        title:'生成的信息'}).show();
}

//定义用户选择的问题编号
var p_c=Array();
var pc_count=0;
//先读取所有的问题信息
//然后生成问题代码
//将代码放入弹出框中
//调用弹出框
function f(type){
	//清空历史
	p_c=[];
	pc_count=0;
	var p=new Array();
	var c=new Array();
	var item=0;
	//获取第一条顾问评论，如果没有就不要显示了亲，这个是其实是第二个模块调用
	var problem=$('#projectproblem'+item).text();
	var comment=$('#expertcomment'+item).text();
	while(typeof(problem)!='undefined' && problem!=''){
		p[item]=problem;
		c[item]=comment;
		item++;
		problem=$('#projectproblem'+item).text();
		comment=$('#expertcomment'+item).text();
	}
	var html_code='<div name="new_div_1" id="new_div_1">';
	for(var i=0;i<p.length;i++)
		html_code=html_code+'<pre id=p_order_'+i+' class="prettyprint lang-js" onclick="g('+i+')">项目问题:'+p[i]+'<br/>'
		+'顾问评论:'+c[i]+'<br/></pre>';
	html_code=html_code+'</div>';
    

    	new Dialog(html_code,{title:'选择项目问题和顾问评论',
                            closeText:'下一步',
    						afterClose:function(){mainGui(type);},
    						beforeClose:function(){return true;}
    						}).show();


}
//当用户点击了某个问题后，保存该选择并且隐藏该项目
function g(id){
	//record the items user choosed
	p_c[pc_count]=id;
	pc_count++;
	//把选择的项目隐藏
	$('#p_order_'+id).hide();
}
//导出新入库专家界面
// |-----------------------------------|
// |开始日期：|---------------------|  |
// |结束日期：|---------------------|  |
// |  |-确定-|               |-取消-|  |
// |-----------------------------------|
function expertExcelGui(){
    var str_gui='';
    //'<table><tr><td>开始日期:</td><td><input type="text" id="log_start_y" size="2" /></td><td>年</td>';
    str_gui+='<div align="center"><table >';
    str_gui+='<form id="form" name="form" method="post" action="/CIFramework/index.php/expert/welcome/expertInfoExcel/">'
    str_gui+='<tr><td>开始日期:</td><td><input type="text" id="sdate" name="sdate" onclick="WdatePicker({dateFmt:'+"'yyyy-MM-dd 00:00:00'" +'})"/></td></tr>';
    str_gui+='<tr><td>结束日期:</td><td><input type="text" id="edate" name="edate" onclick="WdatePicker({dateFmt:'+"'yyyy-MM-dd 23:59:59'" +'})" /></td></tr>';
    str_gui+='</table>';
    str_gui+='<input type="submit" value="开始导出"  />';
    str_gui+='</form>';
    str_gui+='</div>';
    new Dialog(str_gui,{title:'导出指定日期的专家信息',
                            closeText:'取消',
    						}).show();
}
function exportExpert(){
    var time=new Array();
    time[0]=$('#syear').attr('value');
    time[1]=$('#smonth').attr('value');
    time[2]=$('#sday').attr('value');
    time[3]=$('#eyear').attr('value');
    time[4]=$('#emonth').attr('value');
    time[5]=$('#eday').attr('value');
    for(var i=0;i<=5;i++){
        if(time[i]==''){
            alert('请输入完整日期！');
            return;
        }
        //alert(time[i]);
        if(isNaN(time[i])){
            alert('日期输入有误！');
            return;
        }
        
    }
    var s_time=time[0]+'-'+time[1]+'-'+time[2];
    var e_time=time[3]+'-'+time[4]+'-'+time[5];
    if(!isDate(s_time)){
        alert('开始日期有误！');
        return;
        }
    if(!isDate(e_time)){
        alert('结束日期有误！');
        return;
        }
    form.submit();
   // s_time+=' 00:00:00';
   // e_time+=' 23:59:59';

}
//导出访谈信息界面
// |-----------------------------------|
// |开始日期：|---------------------|  |
// |结束日期：|---------------------|  |
// |  |-确定-|               |-取消-|  |
// |-----------------------------------|
function interviewExcelGui(){
    var str_gui='';
    //'<table><tr><td>开始日期:</td><td><input type="text" id="log_start_y" size="2" /></td><td>年</td>';
    str_gui+='<div align="center"><table >';
    str_gui+='<form id="formi" name="formi" method="post" action="/CIFramework/index.php/expert/welcome/interviewExcel/">'
    str_gui+='<tr><td>开始日期:</td><td><input type="text" id="isdate" name="isdate" onclick="WdatePicker({dateFmt:'+"'yyyy-MM-dd 00:00:00'" +'})"/></td></tr>';
    str_gui+='<tr><td>结束日期:</td><td><input type="text" id="iedate" name="iedate" onclick="WdatePicker({dateFmt:'+"'yyyy-MM-dd 23:59:59'" +'})" /></td></tr>';
    str_gui+='<tr><td>客户:</td><td cols="3"><input type="text" size="20" id="iguest" name="iguest"/></td></tr>';
    str_gui+='<tr><td>项目代码:</td><td cols="3"><input type="text" size="20" id="ipcode" name="ipcode"/></td></tr>';
    str_gui+='</table>';
    str_gui+='<input type="submit" value="开始导出"/>';
    str_gui+='</form>';
    str_gui+='</div>';
    new Dialog(str_gui,{title:'导出指定日期的访谈信息',
                            closeText:'取消',
    						}).show();
}
function exportInterview(){
    var time=new Array();
    time[0]=$('#isyear').attr('value');
    time[1]=$('#ismonth').attr('value');
    time[2]=$('#isday').attr('value');
    time[3]=$('#ieyear').attr('value');
    time[4]=$('#iemonth').attr('value');
    time[5]=$('#ieday').attr('value');
    for(var i=0;i<=5;i++){
        if(time[i]==''){
            alert('请输入完整日期！');
            return;
        }
        //alert(time[i]);
        if(isNaN(time[i])){
            alert('日期输入有误！');
            return;
        }
        
    }
    var s_time=time[0]+'-'+time[1]+'-'+time[2];
    var e_time=time[3]+'-'+time[4]+'-'+time[5];
    if(!isDate(s_time)){
        alert('开始日期有误！');
        return;
        }
    if(!isDate(e_time)){
        alert('结束日期有误！');
        return;
        }
    formi.submit();
   // s_time+=' 00:00:00';
   // e_time+=' 23:59:59';

}
//删除日志的界面
// |-----------------------------------|
// |开始日期：|---------------------|  |
// |结束日期：|---------------------|  |
// |  |-确定-|               |-取消-|  |
// |-----------------------------------|
function delLogGui(){
    var str_gui='';
    //'<table><tr><td>开始日期:</td><td><input type="text" id="log_start_y" size="2" /></td><td>年</td>';
    str_gui+='<div align="center"><table >';
    str_gui+='<tr><td>开始日期:</td><td><input type="text" id="log_start_y" size="2" maxlength="4"/></td><td>年</td>';
    str_gui+='<td><input type="text" id="log_start_m" size="1" maxlength="2"/></td><td>月</td>';
    str_gui+='<td><input type="text" id="log_start_d" size="1" maxlength="2"/></td><td>日</td></tr>';
    str_gui+='<tr><td>结束日期:</td><td><input type="text" id="log_end_y" size="2" maxlength="4" /></td><td>年</td>';
    str_gui+='<td><input type="text" id="log_end_m" size="1" maxlength="2"/></td><td>月</td>';
    str_gui+='<td><input type="text" id="log_end_d" size="1" maxlength="2"/></td><td>日</td></tr>';
    str_gui+='</table>';
    str_gui+='<input type="button" value="确认删除"  onclick="delLog()" />';
    str_gui+='</div>';
    new Dialog(str_gui,{title:'删除指定日期的日志',
                            closeText:'取消',
    						}).show();
}
function delLog(){
    var time=new Array();
    time[0]=$('#log_start_y').attr('value');
    time[1]=$('#log_start_m').attr('value');
    time[2]=$('#log_start_d').attr('value');
    time[3]=$('#log_end_y').attr('value');
    time[4]=$('#log_end_m').attr('value');
    time[5]=$('#log_end_d').attr('value');
    for(var i=0;i<=5;i++){
        if(time[i]==''){
            alert('请输入完整日期！');
            return;
        }
        //alert(time[i]);
        if(isNaN(time[i])){
            alert('日期输入有误！');
            return;
        }
        
    }
    var s_time=time[0]+'-'+time[1]+'-'+time[2];
    var e_time=time[3]+'-'+time[4]+'-'+time[5];
    if(!isDate(s_time)){
        alert('开始日期有误！');
        return;
        }
    if(!isDate(e_time)){
        alert('结束日期有误！');
        return;
        }
    s_time+=' 00:00:00';
    e_time+=' 23:59:59';
    var string='opKind=5'+'&logstime='+s_time+'&logetime='+e_time;
    $.ajax({
                type: 'post',
                //可选get
                url: '/CIFramework/index.php/admin/welcome/userAjax',
                //这里是接收数据的PHP程序
                data: string,
                //传给PHP的数据，多个参数用&连接
                dataType: 'text',
                //服务器返回的数据类型 可选XML ,Json jsonp script html text等
                success: function(msg) {

                        if ($.trim(msg) == "y") {
                                alert("删除日志成功!");
                                window.location.href = "/CIFramework/index.php/admin/welcome/showLogs/";
                        } else {
                                alert("删除日志失败!");
                        }
                        
                        //这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
                },
                error: function() {
                        alert("处理异常，请重试!");
                }
        });
    
}
function isDate(str){ 
    var r = str.match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2})$/);
    if(r==null)return false;
    var d= new Date(r[1], r[3]-1, r[4]);
    return (d.getFullYear()==r[1]&&(d.getMonth()+1)==r[3]&&d.getDate()==r[4]);
} 
//搜索的界面
function searchGui(){
    var str_gui='';
    //'<table><tr><td>开始日期:</td><td><input type="text" id="log_start_y" size="2" /></td><td>年</td>';		
    
    str_gui+='<div align="center"><table >';
    str_gui+='<form id="form1" name="form1" method="post" action="<?= $url[';
    str_gui+="'project'";
    str_gui+=']?>/addExpert/<?= $pid?>/" >';
    
    str_gui+='<tr><td>Key word:</td><td><input type="text" name="keyword" id="keyword" /></td></tr>';
    str_gui+='<input type="text" name="searchType" id="searchType" value="2" style="display:none" />';
    str_gui+='<input type="text" name="piid" id="piid" style="display:none" value="<?=$pid?>"/>';
    str_gui+='<tr><td><input type="submit" name="search" id="search2" style="float:right;" value="提交" /></td></tr>';
    str_gui+='</table>';
    str_gui+='</form>';
    new Dialog(str_gui,{title:'普通搜索',
                            closeText:'取消',
    						}).show();
}


function hsearchGui(){
    var str_gui='';
    //'<table><tr><td>开始日期:</td><td><input type="text" id="log_start_y" size="2" /></td><td>年</td>';		
    str_gui+='<form id="form2" name="form2" method="post" action="<?= $url[';
    str_gui+="'project'";
    str_gui+=']?>/addExpert/<?= $pid?>/" >';
    str_gui+='<input type="text" name="searchType" id="searchType" value="3" style="display:none" />';
    str_gui+='<div style="display:none"><input type="text" name="ep" id="ep" /><input type="text" name="ec" id="ec" />';
    str_gui+='<input type="text" name="eprofession" id="eprofession" /><input type="text" name="esubprofession" id="esubprofession" /></div>';
    str_gui+='<script type="text/javascript">';
    str_gui+='function setEprovince(){document.getElementById("ep").value = document.getElementById("province").value;}';
    str_gui+='function setEcity(){document.getElementById("ec").value = document.getElementById("city").value;}';
    str_gui+='function setEprofession(){document.getElementById("eprofession").value = document.getElementById("profession").value;}';
    str_gui+='function setEsubprofession(){document.getElementById("esubprofession").value = document.getElementById("subprofession").value;}';
    str_gui+='</script>';
    str_gui+='<div align="center"><table >';
    str_gui+='<tr><td>Consultant Name:</td><td><input type="text" name="ename" id="ename" /></td></tr>';
    str_gui+='<tr><td>Gender:</td><td><select name="esex" id="esex"><option value="0">请选择</option><option value="M">男</option><option value="F">女</option></select></td></tr>';
    str_gui+='<tr><td>Province:</td><td><input type="text" name="ep" id="ep" /></td></tr>';
    str_gui+='<tr><td>City:</td><td><input type="text" name="ec" id="ec" /></select></td></tr>';
  //  str_gui+='<script type="text/javascript">';
//    str_gui+='lobj = document.getElementById("province");cobj = document.getElementById("city");addrInit(lobj, cobj);';
//    str_gui+='lobj.onchange = function(){select(lobj, cobj); setEprovince();}	cobj.onchange = function(){setEcity();}</script>';
    str_gui+='<tr><td>Industry:</td><td><input type="text" name="eprofession" id="eprofession" /></td></tr>';
    str_gui+='<tr><td>Sub-industry:</td><td><input type="text" name="esubprofession" id="esubprofession" /></td></tr>';
   // str_gui+='<script type="text/javascript">';
//    str_gui+='listPro(document.getElementById("profession"),document.getElementById("subprofession"));';
//    str_gui+='document.getElementById("profession").onchange = function(){selectPro(document.getElementById("profession"),document.getElementById("subprofession")); setEprofession(); setEsubprofession();}';
//    str_gui+='document.getElementById("subprofession").onchange = function(){setEsubprofession();}</script>';
    str_gui+='<tr><td> Company:</td><td><input type="text" name="ecompany" id="company" /></td></tr>';
    str_gui+='<tr><td>Department:</td><td><input type="text" name="esection" id="esection" /></td></tr>';
    str_gui+='<tr><td>Position:</td><td><input type="text" name="eposition" id="eposition" /></td></tr>';
    str_gui+='<tr><td>Responsibility:</td><td><input type="text" name="responbilities" id="responbilities"/></td></tr>';
    str_gui+='<tr><td>Expertise:</td><td><input type="text" name="experisearea" id="experisearea" /></td></tr>';
    str_gui+='<input type="text" name="searchType" id="searchType" value="3" style="display:none" />';
    str_gui+='<input type="text" name="piid" id="piid" style="display:none" value="<?=$pid?>"/>';
    str_gui+='<tr><td><input type="submit" name="search" id="search2" style="float:right;" value="提交" /></td></tr>';
    str_gui+='</table>';
    str_gui+='</form>';
  	    
    new Dialog(str_gui,{title:'高级搜索',
                            closeText:'取消',
    						}).show();
}

