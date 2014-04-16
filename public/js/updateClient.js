function callAjaxForClient(string){
			$.ajax({type:'post',//可选get
					url:'/CIFramework/index.php/guest/welcome/alterGuestAjax',//这里是接收数据的PHP程序
					data:string,//传给PHP的数据，多个参数用&连接
					//dataType:'text',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
					success:function(msg){
							if($.trim(msg)=="y"){
									alert("修改成功!");
									window.top.location.reload();
								}
							else{
								alert("修改失败!");
							}
						//这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
						},error:function(){
								alert("处理异常，请重试!");
					}})
}

function updateBasicInfo(){
	var cname=$('#ename').attr('value');
	var csex=$('#csex').attr('value');
	var ccompany=$('#ccompany').attr('value');
	var cposition=$('#cposition').attr('value');
	var cmobile=$('#ccellphone').attr('value');
	var clandline=$('#clandphone').attr('value');
	var cemail=$('#cemail').attr('value');
	var y=$('#cyear').attr('value');
	var m=$('#cmonth').attr('value');
	var d=$('#cday').attr('value');
	var cid=$('#cid').attr('value');
	if(y==''||m==''||d=='')
		var cbirthday="";
	else{
		var cbirthday=y+"-"+m+"-"+d;
	}
	
	if(csex=='3')
		csex=''; 
		
	var str="cname="+cname+"&csex="+csex+"&cmobile="+cmobile+"&clandline="+clandline+"&cemail="+cemail+"&cid="+cid+"&cbirthday="+cbirthday;
	str=str+"&ccompany="+ccompany+"&cposition="+cposition;
	
	callAjaxForClient(str);
}