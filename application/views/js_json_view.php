<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="/CIFramework/public/js/jquery.js"></script>
<script src="/CIFramework/public/js/dialog.js"></script>
<link rel="stylesheet" media="screen" href="/CIFramework/public/css/dialog.css" />

</head>
<body>
<div>
    <input type='button' value="All" onclick="f(1)"/><br />
    <input type='text' value="" id="ipt1" /><button onclick="f(2)">ST</button>
    <br />
    <button onclick="p(-1)">上一页</button><button onclick="p(1)">下一页</button>
    <br />
    <textarea id="ta1" cols="45" rows="8" readonly="readonly"></textarea>
    <br />
    <button onclick="f_s()">Show experts choosed!</button>
</div>
<script>
//流程：点击【添加顾问】->弹出【搜索面板】，面板内容：显示全部用户，普通搜索，高级搜索
//->用户点击任何一个按钮，弹出【结果面板】->用户选择专家，点确定返回【搜索面板】，点上/下一页刷新内容
//定义全局变量，包括当前页面，搜索类型，页面大小，用户选择的eid
var pageNow=1;
var srtyp=1;
var pageSize=0;
var ec=new Array();
var mydlg;
//处理翻页的函数
function p(page){
    
    
    if(page==-1){
        pageNow--;
        if(pageNow<=0)
        {
            pageNow=1;//代表当前页面就是第一页，再往前也没用
        }else{
            $('#dlg4rst').remove();
            f(srtyp);//如果是新的页面，则要更新，否则不更新
        }
        
    }else if(page==1){
        if(pageNow<pageSize || pageSize==0){//如果没有超过最大页数，则允许继续查询，否则不做更改
            pageNow++;
            $('#dlg4rst').remove();
            f(srtyp);
        }else{
            alert('Already the last page!');
        }
        
    }
    
}
//处理获取用户信息的ajax函数，返回的数据类型为json
function f(st){
    var str_gui='<table id="tb1"></table><br /><a href="#" onclick="p(-1)">Pre</a>';
    str_gui+='&nbsp;&nbsp;&nbsp;<a href="#" onclick="p(1)">Next</a>';
    mydlg=new Dialog(str_gui,{title:'搜索结果',
                            closeText:'确定',
                            id:'dlg4rst'
    						}).show();
    //修改对话框的css属性
    $('#dlg4rst').css('width',700);
    $('#dlg4rst').css('left',300);
    $('#dlg4rst').css('top',200);
    srtyp=st;
    var string='searchType='+st+'&pageNow='+pageNow;
    if(st==2){
        kw=$('#ipt1').attr('value');
        string+='&keyword='+kw;
    }
    $.ajax({
                type: 'post',
                url: '/CIFramework/index.php/test/welcome/json',
                data: string,
                dataType: 'json',
                //服务器返回的数据类型 可选XML ,Json jsonp script html text等
                success: function(data) {
                    if(data==null){
                        alert('NoData');
                        //记录下一共有多少页
                        pageSize=pageNow-1;
                        p(-1);
                        $('#dlg4rst').remove();
                        $('#dlg4rst-overlay').remove();
                        return;
                    }
                    var str='';
                        for(var i=0;i<data.length;i++){
                            str='<tr id="li'+data[i][0]+'">';
                            str+='<td><input type=checkbox id=cb'+data[i][0]+' onclick="g('+data[i][0]+')"';
                            if(typeof(ec[''+data[i][0]])!='undefined')
                                str+='checked ';
                            str+='/></td>';
                            for(var j=1;j<data[i].length;j++){
                                str+='<td id="td'+data[i][0]+'_'+j+'">'+data[i][j]+'</td>';
                            }
                            str+='</tr>';
                            $('#tb1').append(str);
                        }
                        },
                error: function() {
                        alert("处理异常，请重试!");
                }
        });
    
}
//处理用户点击对应的标签的事件
function g(id){
    //先判断用户是选定该项还是未选定该项
    if($('#cb'+id).attr('checked')){
        //获取用户点击的顾问的信息
        //使用关联数组的方式保存客户姓名和ID,ID是一个索引
        ec[''+id]=$('#td'+id+'_1').text();
    }else{
        //从选择表中删除该用户
        delete ec[''+id];
    }
    
    
}
//显示所有已经选取的专家
function f_s(){
    $('#ta1').text('');
    for(key in ec){
        $('#ta1').append(ec[key]+'\r\n');
    }
}
</script>
</body>
</html>