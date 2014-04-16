<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	if(!isset($_COOKIE['uid'])){
		echo '<script type="text/javascript">';
		echo 'alert("请先登录"); ';
		echo 'top.location = "../index.php";';
		echo '</script>';
	}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <script src="../js/tablecloth.js"></script>
<title>客户信息搜索结果</title>

 
<link rel="stylesheet" href="../css/maincss.css" type="text/css" />
<link rel="stylesheet" href="../css/tablecloth.css" type="text/css" />
<style type="text/css">



</style>
</head>

<body>
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
      <h2><a onclick="deleteCookie()" href="../logout.php">退出登录</a></h2>
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
        <div class="left_title">客户信息</div>
        <div class="left_news">
          <ul>
            <li><a href="clientMain.php" class="hover">客户信息首页</a></li>
			<li><a href="clientSearch.php">客户信息搜索</a></li>
            <li><a href="clientAdd.php" >添加客户</a></li>
            <li><a>客户详细信息</a></li>
			<li><a>添加合作项目</a></li>
          </ul>
        </div>
      </div>
     
</div>
      
      
    
    <div class="right">
      <div class="right_title"><b>客户信息搜索结果</b>
        <div>首页 >客户信息 > <span>客户信息搜索结果</span></div>
      </div>
      <div class="right_content">
  
 
 	
  <div id="clients">
  <?php
	//客户信息搜索结果,2 or 3
	//获取当前第几页面
	
	if(!isset($_GET['pageNow']))
		$pageNow=1;
	else
		$pageNow=$_GET['pageNow'];
		
	if(!isset($_GET['searchType']))
	{
		echo '<script type="text/javascript">';
		echo 'top.location = "clientMain.php";';
		echo '</script>';
	}
	else
		$st=$_GET['searchType'];

	require "../php/clientDatabase.php";
	echo '<table id="clientlist" style="width: 100%">';
      echo '<tr><th style="width:20%">客户姓名</th><th  width="20%">性别</th><th style="width: 20%">生日</th><th style="width: 20%">公司</th><th style="width: 20%">职位</th></tr>';

	
	$pageSize=20;

	
	//判断搜索方式
	if($st=='2'){
		//获取keyword
		$kw=$_GET['keyword'];
		//获取搜索结果，保存在$r中
		$pm="&searchType=2&keyword=".$kw;
		$r=simpleSearch($kw,$pageNow,$pageSize);
	}
	else{
		//获取搜索参数
		$v['cname']=$_GET['cname'];
		$v['csex']=$_GET['csex'];
		$v['ccompany']=$_GET['ccompany'];
		$v['cposition']=$_GET['cposition'];
		
		$pm="&searchType=2&keyword=".$kw;
		foreach($v as $key => $value){
			$pm=$pm."&".$key."=".$value;
		}
		//获取搜索结果，保存在$r中
		$r=highLevelSearch($v,$pageNow,$pageSize);
	}
	
	if(!$r){
		//已经到页尾
		if($pageNow>1){
			echo '<script type="text/javascript">';
			echo 'alert("已经到页尾了"); ';
			echo 'top.location = "clientMain.php?pageNow='.($pageNow-1).$pm.'";';
			echo '</script>';
		}
		else{
			echo '<script type="text/javascript">';
			echo 'alert("没有信息!"); ';
			echo 'top.location = "clientMain.php";';
			echo '</script>';
		
		}
	}
	else{//输出客户信息
		for($i=0;$i<$r->num_rows;$i++){
			$row=$r->fetch_assoc();
			foreach($row as $k1 => $k2){
				if($k2!="")
					$rows[$k1]=$k2;
				else
					$rows[$k1]="NULL";
			}
			echo "<tr><td><a href='clientInfo.php?cid=".$rows['cid']."'>".$rows['cname']."</a></td>";
			if($rows['csex']=='M')
				echo "<td>"."男"."</td><td>".$rows['cbirthday']."</td><td>".$rows['ccompany']."</td><td>".$rows['cposition']."</td></tr>";
			else
				echo "<td>"."女"."</td><td>".$rows['cbirthday']."</td><td>".$rows['ccompany']."</td><td>".$rows['cposition']."</td></tr>";
		}
	}
	echo "<br /></table><hr />";
	//构造下一页和首页的链接
	echo "<a href='clientMain.php?pageNow=1".$pm."'>首页</a>";
	if($pageNow>1)
		echo "<a href='clientMain.php?pageNow=".($pageNow-1).$pm."'>上一页</a>";
	echo "<a href='clientMain.php?pageNow=".($pageNow+1).$pm."'>下一页</a>";
		
?>
        </div>
        </div>
  </div>
    <div class="clear"></div>
    
    <div class="clear"></div>
  </div>
  <div class="bottom">  </div>
</div>

</body>

</html>