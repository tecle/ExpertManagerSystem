<?php
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
if(!isset($_GET['piid'])){
	echo "<script language='javascript' type='text/javascript'>";
	echo 'window.location.href="clientMain.php";';
	echo "</script>";	

}else{
	
	$piid=$_GET['piid'];
}
if(!isset($_GET['cid'])){
	echo "<script language='javascript' type='text/javascript'>";
	echo 'window.location.href="clientMain.php";';
	echo "</script>";	
}else{

	$cid=$_GET['cid'];
}
$re=addProjectForClient($piid,$cid);//成功返回0，失败返回1，存在信息返回2
if($re){
	saveLog($name0,32,$cid,$piid);
	echo "<script language='javascript' type='text/javascript'>";
	echo 'alert("添加项目成功!");';
	echo 'window.location.href="clientInfo.php?cid='.$cid.'";';
	echo "</script>";	
}else{
	echo "<script language='javascript' type='text/javascript'>";
	echo 'alert("添加项目失败,请重试!或者该项目已经被添加了！");';
	echo 'window.location.href="clientAddProject.php?cid='.$cid.'";';
	echo "</script>";	
}
?>