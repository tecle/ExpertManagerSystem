<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= $head_title ?></title>
<?php

foreach ($css_js_url as $k => $v)
    echo $v;
?>


</head>
<body>
<div class="zhong">
    <div class="banner"><img src="/CIFramework/public/image/img_2.gif" /></div>
  <div class="menu">
    <div class="menusel" style="width:95px;">
      <h2><a href="<?= $url['main'] ?>">首页</a></h2>
    </div>
    <div class="menusel" style="width:95px;">
      <h2><a href="<?= $url['expert'] ?>">行业顾问信息</a></h2>
    </div>
    <div class="menusel" style="width:95px;">
      <h2><a href="<?= $url['project'] ?>">项目信息</a></h2>
    </div>
	<div class="menusel" style="width:95px;">
      <h2><a href="<?= $url['guest'] ?>">客户信息</a></h2>
    </div>
	<div class="menusel" style="width:95px;">
      <h2><a href="/CIFramework/index.php/test/welcome/testD">发送邮件</a></h2>
    </div>
    <div class="menusel" style="width:95px;">
      <h2><a href="<?= $url['logout'] ?>">退出登录</a></h2>
    </div>
  </div>
  <div class="meun_2">
  <?php
  
    echo "欢迎您 ";
		echo urldecode($_COOKIE["uname"]);
		echo "！您的身份是【";
		if($_COOKIE["urole"] != 'a') echo "普通用户】";
		else echo "管理员】<a href='".$url['admin']."'>进入管理员页面</a>";
?>
  </div>
  <div class="main">