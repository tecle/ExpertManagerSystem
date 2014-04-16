function addAccount(){
	wname=$('#uname').attr('value');
	uaccount=$('#uaccount').attr('value');
	upassword=$('#upassword').attr('value');
	urole=$('#urole').attr('value');
	uinfo=$('#uinfo').attr('value'); 
	str="opKind=1&wname="+wname+"&waccount="+uaccount+"&wpassword="+upassword+"&wrole="+urole+"&winfo="+uinfo;

    $.ajax({type:'post',//可选get
		    url:'/CIFramework/index.php/admin/welcome/userAjax',//这里是接收数据的PHP程序
			data:str,//传给PHP的数据，多个参数用&连接
			//dataType:'text',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
			success:function(msg){
                
				if($.trim(msg)=="y"){
						alert("成功增加用户!");
						window.location.href="/CIFramework/index.php/admin/";
					}
				else if($.trim(msg)=="n"){
					alert("用户增加失败!");
					window.top.location.reload();
				}else{
					alert("用户登陆账户已存在！");
				}
			//这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
			},error:function(XMLHttpRequest, textStatus, errorThrown){
					alert("处理异常，请重试!");
			}});


}
function alterPassword(wid,upassword,urole,uinfo){
	str="opKind=4&wpassword="+upassword+"&wid="+wid+"&wrole="+urole+"&winfo="+uinfo;
	$.ajax({type:'post',//可选get
		    url:'/CIFramework/index.php/admin/welcome/userAjax',//这里是接收数据的PHP程序
			data:str,//传给PHP的数据，多个参数用&连接
			dataType:'text',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
			success:function(msg){
				if($.trim(msg)=="y"){
						alert("密码修改成功!");
						window.top.location.reload();
					}
				else if($.trim(msg)=="n"){
					alert("密码修改失败!");
					
				}
			//这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
			},error:function(){
					alert("处理异常，请重试!");
			}})
}

function deleteUser(wid){
	str="opKind=3&wid="+wid;
	$.ajax({type:'post',//可选get
		    url:'/CIFramework/index.php/admin/welcome/userAjax',//这里是接收数据的PHP程序
			data:str,//传给PHP的数据，多个参数用&连接
			dataType:'text',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
			success:function(msg){
				if($.trim(msg)=="y"){
						alert("删除成功!");
						window.top.location.reload();
					}
				else if($.trim(msg)=="n"){
					alert("删除失败!");
					
				}
			//这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
			},error:function(){
					alert("处理异常，请重试!");
			}})
}

function alterAccount(wid,account,wrole,winfo){
	str="opKind=2&wid="+wid+"&waccount="+account+"&wrole="+wrole+"&winfo="+winfo;
	$.ajax({type:'post',//可选get
		    url:'/CIFramework/index.php/admin/welcome/userAjax',//这里是接收数据的PHP程序
			data:str,//传给PHP的数据，多个参数用&连接
			dataType:'text',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
			success:function(msg){
				if($.trim(msg)=="y"){
						alert("账号修改成功!");
						window.location.href="";
					}
				else if($.trim(msg)=="n"){
					alert("账号修改失败!");
					window.top.location.reload();
				}else{
					alert("用户登陆账户已存在！账号修改失败！");
				}
			//这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
			},error:function(){
					alert("处理异常，请重试!");
			}})
}