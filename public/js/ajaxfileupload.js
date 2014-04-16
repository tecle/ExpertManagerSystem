var fu=new Array();
var eids=new Array();
var emails=new Array();
var province="",city="";
var pro="",subpro="";
var pageNow=1;
var pageSize=20;
var curPageSize=0;
var ec=new Array();
var posturl="/CIFramework/index.php/email/welcome/f_upload_ajax";
var cancelurl="/CIFramework/index.php/email/welcome/f_cancel_ajax";
var sendurl="/CIFramework/index.php/email/welcome/send_email_ajax";
var experturl="/CIFramework/index.php/email/welcome/json";
var oTable,tb2,tb3;
var sended = new Array(),sendf=new Array();
var image_url='../images/';
var config_lc={
	"bAutoWidth": false, 
	"bSort": false, 
	"bLengthChange": false,
	"iDisplayLength":pageSize,
	"bFilter": false,
	};
function uf() {
    var fileObj = document.getElementById("file").files[0]; // 获取文件对象
    var FileController = posturl;                    // 接收上传文件的后台地址 
    var form = new FormData();
    form.append("filenum", fu.length);                        // 可以增加表单数据
    form.append("file", fileObj);                           // 文件对象
    var xhr = new XMLHttpRequest();
    xhr.open("post", FileController, true);
    xhr.onload = function () {

        if (this.status == 200) {
            var data=eval("("+this.responseText+")");
            if(data.error != '')
				{
					alert(data.error);
				}else
				{
					var flag=0;
					for(var i=0;i<fu.length;i++){
						if(fu[i]==data.fname){
							flag=1;
							break;
						}
					}
					if(flag==0){
						fu[fu.length]=data.fname;
						var str="<li id='li_"+(fu.length-1)+"'>"+data.fname+"<button onclick='detelef("+(fu.length-1)+")'>取消</button></li>";
						$('#f-u').append(str);
					}
				
				}

		}
    };
    xhr.send(form);
}
function switch2span(tag){
    if(tag==1){
        $('#span2').hide();
        $('#span3').hide();
        $('#span4').hide();
        $('#span1').show();
        
    }else if(tag==2){
        $('#span1').hide();
        $('#span3').hide();
        $('#span4').hide();
        $('#span2').show();
        f_s();
    }else if(tag==3){
        $('#span1').hide();
        $('#span2').hide();
        $('#span4').hide();
        $('#span3').show();
    }else if(tag==4){
        $('#span1').hide();
        $('#span2').hide();
        $('#span3').hide();
        $('#span4').show();
        showSpan4();
    }
}
function detelef(fid){
		if(fu[fid]=="")
			return;
		//alert(fu[fid]);
		$.ajax({
			url:cancelurl,
			dataType:"text",
			data:{fname:fu[fid]},
			success:function(data0,status){
			     var data=eval("("+data0+")");
				//alert(data.result);
			},
			error:function(data,statu,e){
				alert(e);
			}
		});
		fu[fid]="";
		$('#li_'+fid).hide();
	}
function sendmail(){
    var allFile="";
    for(var i=0;i<fu.length;i++){
        if(fu[i]!="")
            allFile+=fu[i]+",";
    }
    var title=$.trim($('#i-title').val());
    var content=$('#tac').val();//回车符号是\n
    if(title=="" || $.trim(content)==""){
        alert("Title or content is empty!");
        return;
    }
    var ids="";
    var emlstr="";
    for(key in ec){
        if(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(emails[key]))
        {
            ids+=(key+",");
            emlstr=emlstr+emails[key]+",";
        }
    }
    if(emlstr==""){
        alert("You have't choose an expert to email!");
        return;
    }
    var send_data={
        title:title,
        content:content,
        files:allFile,
        eids:ids,
        allemail:emlstr
    }
    $('#sbt').hide();
    $('#stext').show();
    $.ajax({
			url:sendurl,
            type:"post",
			dataType:"text",
			data:send_data,
			success:function(data){//返回的是发送成功和发送失败的用户
                //alert(data);
                $('#sbt').show();
                $('#stext').hide();
                data0=eval("("+data+")");
                if($.trim(data0[0])=="y"){
                    alert("Send success!");
                    for(var key in fu){
                        if(fu[key]!=""){
                            fu[key]="";
                            $('#li_'+key).hide();
                        }     
                    }
                }
                else
                    alert("Error:"+data0[1]);
                
                //switch2span(4);
			},
			error:function(data,statu,e){
				alert(e);
                $('#sbt').show();
                $('#stext').hide();
			}
		});
}

function getExpert(){
    var sex=$('#sex').val();
    var iscoo=$('#isCop').val();
    var name=$('#name').val();
    if(pro=="" && subpro=="" && province=="" && city=="" && sex=="0" && iscoo=="0" && name=="")
        st=1;
    else
        st=2;
    var sdata={
        trade:$.trim(pro),
        subtrade:$.trim(subpro),
        province:province,
        city:city,
        sex:sex,
        iscoo:iscoo,
        name:name,
        pageNow:pageNow,
        searchType:st,
        pageSize:pageSize
    };
    //alert(sdata.pageSize);
    //var d1 = new Date();
    $.ajax({
			url:experturl,
			dataType:"json",
            type:"post",
			data:sdata,
			success:function(data){
			   // var d2 = new Date();
                //alert("Concatenation with plus: " + (d2.getTime() - d1.getTime()) + " milliseconds");
                if(data==null){
                        alert('No Result');
                        //记录下一共有多少页
                        curPageSize==0?curPageSize=1:pageNow-1;
                        pageNow==1?pageNow=1:pageNow--;
                        $('#show-page').html(pageNow+"");
                        //pageCtrl(-1);
                        //oTable.fnClearTable();
                        return;
                    }
                var eData=new Array();
                var str='';
                for(var i=0;i<data.length;i++){
                    eData[i]=new Array();
                    var tempv=new Array();
                    tempv[0]='<input type=checkbox class="selects" id=cb';
                    tempv[1]=data[i][0];
                    tempv[2]=' onclick="g(';
                    tempv[3]=data[i][0];
                    tempv[4]=')"';
                    if(typeof(ec[''+data[i][0]])!='undefined'){
                        tempv[5]='checked ';
                        tempv[6]='/>';
                    }else{
                        tempv[5]='/>';
                    }
                    eData[i][0]=tempv.join("");
                    tempv=new Array();//empty it
                    tempv[0]="<span id='td";
                    tempv[1]=data[i][0];
                    tempv[2]="_1'>";
                    tempv[3]=data[i][1];
                    tempv[4]="</span>";
                    eData[i][1]=tempv.join("");
                    //全部搜索时又要返回email
                    for(var j=2;j<data[i].length-3;j++){
                        eData[i][j]=data[i][j];
                    }
                    emails[''+data[i][0]]=data[i][data[i].length-1];
                }
                oTable.fnClearTable();
                oTable.fnAddData(eData);
			},
			error:function(data,statu,e){
				alert(e);
			}
		});
}
function startSearch(){
    pageNow=1;
    curPageSize=0;
    $('#show-page').html(pageNow+"");
    getExpert();
}
//处理翻页的函数
function pageCtrl(page){
    //alert(page);
    if(page==-1){
        pageNow--;
        if(pageNow<=0)
        {
            pageNow=1;//代表当前页面就是第一页，再往前也没用
        }else{
            getExpert();
            isSelectAll=true;
            $('#show-page').html(pageNow+"");
            //f(srtyp);//如果是新的页面，则要更新，否则不更新
        }
        
    }else if(page==1){
        if(pageNow<curPageSize || curPageSize==0){//如果没有超过最大页数，则允许继续查询，否则不做更改
            pageNow++;
            getExpert();
            isSelectAll=true;
            $('#show-page').html(pageNow+"");
            //f(srtyp);
        }else{
            alert('Already the last page!');
            $('#show-page').html(pageNow+"");
        }
        
    }
    //alert(pageNow+','+pageSize);
    
}
var isSelectAll=true;
function selectAll(){
    $('#tb1 tr').each(function(){
       $(this).find("td").each(function(index){
            if(index==0){
                $(this).find('input').each(function(){
                   id=$(this).attr("id").replace(/\D/g, ""); 
                   
                   $('#cb'+id).attr("checked",isSelectAll);
                   if(isSelectAll)
                        ec[''+id]=$('#td'+id+'_1').html();
                   else
                        delete ec[''+id];
                });
            }
       }) ;
    });
    isSelectAll=!isSelectAll;
}
//处理用户点击对应的标签的事件
function g(id){
    //先判断用户是选定该项还是未选定该项
    if($('#cb'+id).attr('checked')){
        //获取用户点击的顾问的信息
        //使用关联数组的方式保存客户姓名和ID,ID是一个索引
        ec[''+id]=$('#td'+id+'_1').html();
    }else{
        //从选择表中删除该用户
        delete ec[''+id];
    }
}
//显示所有已经选取的专家
function f_s(){
    var tr=new Array();
    var count=0;
    for(key in ec){
        tr[count]=new Array();
        tr[count][0]=ec[key];
        tr[count][1]=emails[key];
        if(!/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(emails[key]))
        {
            tr[count][2]="<span style='color:red'>NO</span>";
        }else
            tr[count][2]="<span style='color:black'>YES</span>";
        count++;
    }
    if(typeof(tb2)=='undefined'){
        var con=config_lc;
        con.iDisplayLength=20;
        con.sPaginationType="full_numbers";
        tb2=$('#tb2').dataTable(con);
    }
    tb2.fnClearTable();
    tb2.fnAddData(tr);
}
function showSpan4(){
    var tr=new Array();
    var count=0;
    for(key in sended){
        tr[count]=new Array();
        tr[count][0]=ec[sended[key]+""];
        tr[count][1]=emails[sended[key]+""];
        tr[count][2]="<span style='color:green'>Success</span>";
        count++;
    }
    for(key in sendf){
        tr[count]=new Array();
        tr[count][0]=ec[sendf[key]+""];
        tr[count][1]=emails[sendf[key]+""];
        tr[count][2]="<span style='color:red'>Failed</span>";
        count++;
    }
    if(typeof(tb3)=='undefined'){
        var con=config_lc;
        con.iDisplayLength=20;
        con.sPaginationType="full_numbers";
        tb3=$('#tb3').dataTable(con);
    }
    tb3.fnClearTable();
    tb3.fnAddData(tr);
}