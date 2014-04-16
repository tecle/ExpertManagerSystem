<?php
//前面应该加上验证信息，且禁止非法访问

//只验证一个参数就行，若没有该参数，非法访问，否则，可以访问
//更为严格的数据保护方式应该是验证所有必填项是否为空，为空则给出提示，并且不能写入数据库
if(!isset($_GET['ename'])){
	echo "非法访问";
	exit;
}
require "../php/clientDatabase.php";
	require_once '../php/savelog.php';
	if(isset($_COOKIE["uname"])){
				$name0=urldecode($_COOKIE["uname"]);
	}else{
			echo '<script type="text/javascript">';
			echo 'alert("请先登录"); ';
			echo 'top.location = "../index.php";';
			echo '</script>';
	}
$v['cname']=$_GET['ename'];
$v['csex']=$_GET['csex'];
$v['ccompany']=$_GET['ccompany'];
$v['cposition']=$_GET['cposition'];
$v['clandline']=$_GET['clandphone'];
$v['cmobile']=$_GET['ccellphone'];
$v['cemail']=$_GET['cemail'];
$v['cremark']=$_GET['cnote'];
$v['cbirthday']="";
if(!empty($_GET['cyear'])){//生日年份为空，则说明用户没有输入生日年份，否则视为输入了生日
	if(empty($_GET['cmonth']))//若月份为空，则说明用户未输入月份，采用默认值1月
		$v['cbirthday']=$_GET['cyear']."-1";
	else
		$v['cbirthday']=$_GET['cyear']."-".$_GET['cmonth'];
	
	if(empty($_GET['cmonth']))//若日期为空，则说明用户未输入日期，采用默认值1日
		$v['cbirthday']=$v['cbirthday']."-1";
	else
		$v['cbirthday']=$v['cbirthday']."-".$_GET['cmonth'];

}

//调用数据库操作函数来存储信息，返回值为存入的客户的id

$cid=addClient($v);
if(!$cid){//保存失败
	echo "<script language='javascript' type='text/javascript'>";
	echo 'alert("添加失败，请检查输入是否正确！");';
	echo 'window.location.href="clientAdd.php";';
	echo '</script>';

}else{//保存成功，跳转页面到客户信息页
	saveLog($name0,13,$cid);
	echo "<script language='javascript' type='text/javascript'>";
	echo 'alert("添加成功，转入客户详细信息！");';
	echo 'window.location.href="clientInfo.php?cid='.$cid.'";';
	echo '</script>';
}



?>