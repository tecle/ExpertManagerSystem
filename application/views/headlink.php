<!DOCTYPE html>
<!--[if IE 7 ]>   <html lang="en" class="ie7 lte8"> <![endif]--> 
<!--[if IE 8 ]>   <html lang="en" class="ie8 lte8"> <![endif]--> 
<!--[if IE 9 ]>   <html lang="en" class="ie9"> <![endif]--> 
<!--[if gt IE 9]> <html lang="en"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<head>
<meta charset="utf-8">
<!--[if lte IE 9 ]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
<?php

foreach ($css_js_url as $k => $v)
    echo $v;
?>
<!-- iPad Settings -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" /> 
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, width=device-width">
<!-- iPad End -->
<!-- DATATABLES CSS -->
<link rel="stylesheet" media="screen" href="/CIFramework/public/templete/lib/datatables/css/cleanslate.css" />
<script type="text/javascript" src="/CIFramework/public/templete/lib/datatables/js/jquery.dataTables.js"></script> 
<!-- DATATABLES CSS END -->
<!-- datepicker-->
<script type="text/javascript" src="/CIFramework/public/My97DatePicker/WdatePicker.js"></script> 
<!-- datepicker-->
<title><?= $head_title ?></title>

<link rel="shortcut icon" href="favicon.html">

<!-- iOS ICONS -->
<link rel="apple-touch-icon" href="touch-icon-iphone.html" />
<link rel="apple-touch-icon" sizes="72x72" href="touch-icon-ipad.html" />
<link rel="apple-touch-icon" sizes="114x114" href="touch-icon-iphone4.html" />
<link rel="apple-touch-startup-image" href="touch-startup-image.html">
<!-- iOS ICONS END -->

<!-- STYLESHEETS -->

<link rel="stylesheet" media="screen" href="/CIFramework/public/templete/css/reset.css" />
<link rel="stylesheet" media="screen" href="/CIFramework/public/templete/css/grids.css" />
<link rel="stylesheet" media="screen" href="/CIFramework/public/templete/css/style.css" />
<link rel="stylesheet" media="screen" href="/CIFramework/public/templete/css/jquery.uniform.css" />
<link rel="stylesheet" media="screen" href="/CIFramework/public/templete/css/forms.css" />
<link rel="stylesheet" media="screen" href="/CIFramework/public/templete/css/themes/lightblue/style.css" />

<style type = "text/css">
    a{cursor: pointer;}
    #loading-container {position: absolute; top:50%; left:50%;}
    #loading-content {width:800px; text-align:center; margin-left: -400px; height:50px; margin-top:-25px; line-height: 50px;}
    #loading-content {font-family: "Helvetica", "Arial", sans-serif; font-size: 18px; color: black; text-shadow: 0px 1px 0px white; }
    #loading-graphic {margin-right: 0.2em; margin-bottom:-2px;}
    #loading {background-color: #eeeeee; height:100%; width:100%; overflow:hidden; position: absolute; left: 0; top: 0; z-index: 99999;}
</style>

<!-- STYLESHEETS END -->

<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<script type="text/javascript" src="js/selectivizr.js"></script>
<![endif]-->
<!-- MAIN JAVASCRIPTS -->
    <script src="/CIFramework/public/js/jquery.js"></script>
    <script>window.jQuery || document.write("<script src='/CIFramework/public/templete/js/jquery.min.js'>\x3C/script>")</script>
    <script type="text/javascript" src="/CIFramework/public/templete/js/jquery.tools.min.js"></script>
    <script type="text/javascript" src="/CIFramework/public/templete/js/jquery.uniform.min.js"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="js/PIE.js"></script>
    <script type="text/javascript" src="js/ie.js"></script>
    <![endif]-->

    <script type="text/javascript" src="/CIFramework/public/templete/js/global.js"></script>
    <!-- MAIN JAVASCRIPTS END -->
</head>