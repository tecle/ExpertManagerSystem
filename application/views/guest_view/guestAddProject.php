<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	if(!isset($_COOKIE['uid'])){
		echo '<script type="text/javascript">';
		echo 'alert("请先登录"); ';
		echo 'top.location = "../index.php";';
		echo '</script>';
	}
	
	if(!isset($_GET['cid'])){
		echo '<script type="text/javascript">';
		echo 'top.location = "clientMain.php";';
		echo '</script>';
	}
	
	$cid=$_GET['cid'];
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../js/tablecloth.js"></script>
<title>添加合作项目</title>

<script src="../js/jquery.js"></script>
<script src="../js/myajax.js"></script>
<script src="../js/proSelect.js"></script>
<link rel="stylesheet" href="../css/maincss.css" type="text/css" />
<link rel="stylesheet" href="../css/tablecloth.css" type="text/css" />
<style type="text/css">

</style>
</head>

<body>
<?php
require_once '../php/search.php';
if(!isset($_GET['searchType']))
	$st='0';//全部搜索
else
	$st=$_GET['searchType'];

if(!isset($_GET['orderType']))
	$ot=0;
else
	$ot=$_GET['orderType'];

$pageSize=20;

if(!isset($_GET['pageNow']))
	$pageNow=1;
else
	$pageNow=$_GET['pageNow'];
	

?>
<div class="zhong">
  
  <div class="banner"><img src="../images/img_2.gif" /></div>
  <div class="menu">
    <div class="menusel" style="width:95px;">
      <h2><a href="../main.php">首页</a></h2>
    </div>
    <div class="menusel" style="width:95px;">
      <h2><a href="../expert/expertMain.php">行业顾问信息</a></h2>
    </div>
    <div class="menusel" style="width:95px;">
      <h2><a href="../project/projectMain.php">项目信息</a></h2>
    </div>
	<div class="menusel" style="width:95px;">
      <h2><a href="../client/clientMain.php">客户信息</a></h2>
	  </div>
    <div class="menusel" style="width:95px;">
      <h2><a href="../logout.php">退出登录</a></h2>
    </div>
  </div>
  <div class="meun_2">
  <?php
		echo "欢迎您";
		echo $_COOKIE["uname"];
		echo "！您的身份是【";
		if($_COOKIE["urole"] == 'u') echo "普通用户】";
		else echo "管理员】";
  ?>
  </div>
  <div class="main">
    <div class="left">
      <div class="box_1">
        <div class="left_title">项目</div>
        <div class="left_news">
          <ul>
           <li><a href="clientMain.php">客户信息首页</a></li>
		   <li><a href="clientSearch.php">客户信息搜索</a></li>
            <li><a href="clientAdd.php" >添加客户</a></li>
            <li><a>客户详细信息</a></li>
			<li><a class="hover">添加合作项目</a></li>
          </ul>
        </div>
      </div>
	  

	  
      <div class="box_1">
        <div class="left_title"><input type="checkbox" name="select1" id="select1" onclick="search()" /> 普通搜索</h5></div>
        <div class="left_news" id="normal_search" style="display:none">
          <form id="form1" name="form1" method="get" action="clientAddProject.php">
      <div><label for="keyword">关键字</label>
      <input type="text" name="keyword" id="keyword" />
	<input type="text" name="cid" id="cid" value="<?=$cid?>" style="display:none" />
	<input type="text" name="searchType" id="searchType" value="1" style="display:none" />
	</div>
      <input type="submit" name="search" id="search2" style="float:right" value="提交" />
    </form>
        </div>
		
      </div>
	  <script type="text/javascript">
		function search(){
				if (document.getElementById("select1").checked) 
					document.getElementById("normal_search").style.display = "inline";
				else 
					document.getElementById("normal_search").style.display = "none";
			}
		function hsearch(){
				if (document.getElementById("select2").checked) document.getElementById("complex_search").style.display = "inline";
				else document.getElementById("complex_search").style.display = "none";
			}
		</script>
      <div class="box_1">
        <div class="left_title"><input type="checkbox" name="select2" id="select2" onclick="hsearch()" />高级搜索</div>
        <div class="left_news" id="complex_search" style="display:none">
          <form id="form2" name="form2" method="get" action="clientAddProject.php">
      		<input type="text" name="cid" id="cid" value="<?=$cid?>" style="display:none" />
			<input type="text" name="searchType" id="searchType" value="2" style="display:none" />
				<div><label for="name">项目名称</label>
        <input type="text" name="name" id="name" /></div>
      <div>  <label for="client">客户名称</label>
        <input type="text" name="client" id="client" />
        </div>
      <div>  <label for="code">项目代码</label></div>
        <input type="text" name="code" id="code" />
       <div> <label for="section">项目经理</label>
        <input type="text" name="em" id="em" /></div>
		<div><label for="pdissuer">项目发出人</label>
  	    <input type="text" name="pdissuer" id="pdissuer" />
  	    </div>
       <div> <label for="pia">咨询顾问</label>
  	    <input type="text" name="pia" id="pia" />
  	    </div>
		 <div>  <label for="pediscribe">行业顾问需要</label>
  	    <input type="text" name="pediscribe" id="pediscribe"  />
  	    </div>
        <input type="submit" name="search" id="search2" style="float:right" value="提交" />
		</div>
      </p>
  </form>
        
      </div>
      
      
    </div>
    <div class="right">
      <div class="right_title"><b>添加合作项目</b>
        <div>首页 >客户信息 > <span>添加合作项目</span></div>
      </div>
      <div class="right_content">
  
 
 	<div><h2>项目列表</h2></div>
    <form id="form3" name="form3" method="get" action="">
  <div id="projects" class="mainlist">
  		<table id="projectlist">
         <tr><th width="15%">项目名称</th><th width="15%">项目代码</th><th width="15%">项目经理</th><th width="15%">发布时间</th><th width="15%">项目发出人</th><th width="15%">咨询顾问</th><th width="10%">功能</th></tr>
 <?php
		
if($st=='0'){
	$result=getProjectBacicInfo($pageNow,$pageSize);
	if(!$result){
		if($pageNow>1){
				echo "<script language='javascript' type='text/javascript'>";
				echo 'alert("已到达页尾！");';
				echo 'window.location.href="clientAddProject.php?cid='.$cid.'&pageNow='.($pageNow-1).'";';
				echo "</script>";
			}else{
				echo "<script language='javascript' type='text/javascript'>";
				echo 'alert("没有结果！");';
				echo 'window.location.href="clientAddProject.php?cid='.$cid.'";';
				echo "</script>";		
			}
	
	}else{
		for($i=0;$i<$result->num_rows;$i++){
			$row=$result->fetch_assoc();
			
			echo "<tr><td><a target='_black' href='../project/projectInfo.php?piid=".$row['piid']."'>".$row['pname']."</a></td><td>".$row['pcode']."</td><td>".$row['pem']."</td><td>".$row['createtime']."</td>";
			echo "<td>".$row['dissuer']."</td><td>".$row['ia']."</td>";
			echo "<td><a href='dealClientAndProject.php?piid=".$row['piid']."&cid=".$cid."'>点击添加该项目</a></td></tr>";
		  }
		}

}else if($st=='1')//简单搜索
{
	
	$kw=$_GET['keyword'];
	if(!empty($kw)){//如果kw非空
		$result=getProjectByKeyword($kw,$pageNow,$pageSize);
		$pm='&searchType='.$st.'&keyword='.$kw.'&orderType='.$ot;
		if(!$result){//先用js提示没有结果了，使用js跳转到前一个界面
			if($pageNow>1){
				echo "<script language='javascript' type='text/javascript'>";
				echo 'alert("已到达页尾！");';
				echo 'window.location.href="clientAddProject.php?cid='.$cid.'&pageNow='.($pageNow-1).$pm.'";';
				echo "</script>";
			}else{
				echo "<script language='javascript' type='text/javascript'>";
				echo 'alert("没有结果！");';
				echo 'window.location.href="clientAddProject.php?cid='.$cid.'";';
				echo "</script>";		
			}

		}
		else{
			$rn=$result->num_rows;
			for($i=0;$i<$rn;$i++){
				$row=$result->fetch_assoc();			
					echo "<tr><td><a target='_black' href='../project/projectInfo.php?piid=".$row['piid']."'>".$row['pname']."</a></td><td>".$row['pcode']."</td><td>".$row['pem']."</td><td>".$row['createtime']."</td>";
					echo "<td>".$row['dissuer']."</td><td>".$row['ia']."</td>";
					echo "<td><a href='dealClientAndProject.php?piid=".$row['piid']."&cid=".$cid."'>点击添加该项目</a></td></tr>";
					}
		}
	}else
	{
		echo "<script language='javascript' type='text/javascript'>";
		echo 'alert("空的关键字！");';
		echo 'window.location.href="clientAddProject.php?cid='.$cid.'";';
		echo "</script>";
		exit;
	}
	
}else if($st=='2') {//复杂搜索
	//获取搜索参数
	$k['name']=$_GET['name'];
	$k['client']=$_GET['client'];
	$k['code']=$_GET['code'];
	$k['em']=$_GET['em'];
	$k['pdissuer']=$_GET['pdissuer'];
	$k['pia']=$_GET['pia'];
	$k['pediscribe']=$_GET['pediscribe'];
	
	$pm='&searchType='.$st.'&orderType='.$ot;
	foreach($k as $key => $value){
		$pm=$pm."&".$key."=".$value;
	}
	
	$isEmptyKW=true;
	foreach($k as $k1 => $v1){
		if(!empty($v1)){
			$isEmptyKW=false;
			break;
		}
	}
	
	if(!$isEmptyKW){
		$result=searchProjectWithMK($k,$pageNow,$pageSize);
		if(!$result){//先用js提示没有结果了，使用js跳转到前一个界面
			if($pageNow>1){
				echo "<script language='javascript' type='text/javascript'>";
				echo 'alert("已到达页尾！");';
				echo 'window.location.href="clientAddProject.php?cid='.$cid."&pageNow=".($pageNow-1).$pm.'";';
				echo "</script>";
			}else{
				echo "<script language='javascript' type='text/javascript'>";
				echo 'alert("没有结果！");';
				echo 'window.location.href="clientAddProject.php?cid='.$cid.'";';
				echo "</script>";		
			}

		}
		else{
			$rn=$result->num_rows;
			for($i=0;$i<$rn;$i++){
				$row=$result->fetch_assoc();			
					echo "<tr><td><a target='_black' href='../project/projectInfo.php?piid=".$row['piid']."'>".$row['pname']."</a></td><td>".$row['pcode']."</td><td>".$row['pem']."</td><td>".$row['createtime']."</td>";
					echo "<td>".$row['dissuer']."</td><td>".$row['ia']."</td>";
					echo "<td><a href='dealClientAndProject.php?piid=".$row['piid']."&cid=".$cid."'>点击添加该项目</a></td></tr>";
					}
		}
	}else{
		echo "<script language='javascript' type='text/javascript'>";
		echo 'alert("空的关键字！");';
		echo 'window.location.href="clientAddProject.php?cid='.$cid.'";';
		echo "</script>";
		exit;
	}
	
}else{
	echo "<script language='javascript' type='text/javascript'>";
		echo 'alert("非法访问！");';
		echo 'window.location.href="clientMain.php";';
		echo "</script>";
		exit;

}     		
        	
		
?>
		
		
        </table>
        <br />
		<hr/>
		<div class="pageInation">
<?php
if($st=='1' || $st=='2'){
	echo '<a href="clientAddProject.php?pageNow=1&cid='.$cid.$pm.'">首页</a>';
	if($pageNow>1)
		echo '<a href="clientAddProject.php?pageNow='.($pageNow-1).'&cid='.$cid.$pm.'">上一页</a>';
	echo '<a href="clientAddProject.php?pageNow='.($pageNow+1).'&cid='.$cid.$pm.'">下一页</a>';
	//echo '<a href="projectMain.php?pageNow='.($pageNow+1).$pm.'">下一页</a>';
}else if($st=='0'){
	echo '<a href="clientAddProject.php?pageNow=1&cid='.$cid.'">首页</a>';
	if($pageNow>1)
		echo '<a href="clientAddProject.php?cid='.$cid.'&pageNow='.($pageNow-1).'">上一页</a>';
	echo '<a href="clientAddProject.php?cid='.$cid.'&pageNow='.($pageNow+1).'">下一页</a>';
}
?>		
  </div>
  </form>
   
    <div class="clear"></div>
    
<div class="clear"></div>
</div>
</div>
</div>
</div>
 
</div>

</body>

</html>