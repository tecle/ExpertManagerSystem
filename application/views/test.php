
<!DOCTYPE html>
<!--[if IE 7 ]>   <html lang="en" class="ie7 lte8"> <![endif]--> 
<!--[if IE 8 ]>   <html lang="en" class="ie8 lte8"> <![endif]--> 
<!--[if IE 9 ]>   <html lang="en" class="ie9"> <![endif]--> 
<!--[if gt IE 9]> <html lang="en"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<head>
<meta charset="utf-8"/>
<!--[if lte IE 9 ]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
<!-- iPad Settings -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" /> 
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, width=device-width"/>

<title>项目主页</title>



<style type = "text/css">
	.border_set1{
		border:solid; 
		border-width:1px; 
		border-color:#333399;
		overflow:scroll;
        overflow-x:auto;
		overflow-y:hidden;
		}
	.div-s{
		height:150px
		}
	.ta-e{
		width:950px;
		}
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
<link rel="stylesheet" media="screen" href="/CIFramework/public/templete/css/reset.css" />
<link rel="stylesheet" media="screen" href="/CIFramework/public/templete/css/grids.css" />
<link rel="stylesheet" media="screen" href="/CIFramework/public/templete/css/style.css" />
<link rel="stylesheet" media="screen" href="/CIFramework/public/templete/css/jquery.uniform.css" />
<link rel="stylesheet" media="screen" href="/CIFramework/public/templete/css/forms.css" />
<link rel="stylesheet" media="screen" href="/CIFramework/public/templete/css/themes/lightblue/style.css" />
<link rel="stylesheet" media="screen" href="/CIFramework/public/templete/lib/datatables/css/cleanslate.css" />
<link rel="stylesheet" media="screen" href="/CIFramework/public/templete/css/themes/lightblue/style.css" />
<link rel="stylesheet" media="screen" href="/CIFramework/public/bootstrap/css/bootstrap.min.css"/>
<script type="text/javascript"  src="/CIFramework/public/js/jquery.js"></script>
<script type="text/javascript" src="/CIFramework/public/templete/js/jquery.tools.min.js"></script>
<script type="text/javascript" src="/CIFramework/public/templete/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="/CIFramework/public/templete/lib/datatables/js/jquery.dataTables.js"></script> 
<script type="text/javascript" src="/CIFramework/public/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript"  src="/CIFramework/public/js/ajaxfileupload.js"></script>
<script type='text/javascript' src='/CIFramework/public/js/proSelect.js'></script>
<script type='text/javascript' src='/CIFramework/public/js/dateSelect.js'></script>
<script type='text/javascript' src='/CIFramework/public/js/addrSelect.js'></script>
<script type="text/javascript" src="/CIFramework/public/templete/js/global.js"></script>

    <!-- MAIN JAVASCRIPTS END -->
</head>
<body style="overflow: hidden;">
<script>
$(document).ready(function(){
    $('#span2').hide();
    $('#span3').hide();
    $('#span4').hide();
    $('#stext').hide();
    config_lc.sDom=' <<t>ip>';
	config_lc.bFilter=true;
	oTable = $('#tb1').dataTable(config_lc);
    lobj = document.getElementById("province");
	cobj = document.getElementById("city");
    addrInit(lobj, cobj);
	lobj.onchange = function(){
		select(lobj, cobj); 
        province=$(this).select().val();
        city="";
        if(province=="请选择省份名"){
            province="";
            city="";
        }
            
            
		}
	cobj.onchange = function(){
		city=$(this).select().val();
		}
    listPro(document.getElementById("profession"),document.getElementById("subprofession"));
	document.getElementById("profession").onchange = function(){
		selectPro(document.getElementById("profession"),document.getElementById("subprofession")); 
        pro=$(this).select().val();
        if(pro=="请选择行业"){
            pro="";
            subpro="";
        }
        subpro="";
		//setEprofession(); 
		//setEsubprofession();
		}
	document.getElementById("subprofession").onchange = function(){
	   subpro=$(this).select().val();
	//setEsubprofession();
	}

    
});
</script>
    <div id="wrapper">
        <header>
            <h1><a>项目信息</a></h1>
            <nav>
				<ul id="main-navigation" class="clearfix"> 
					<li> 
						<a href="/CIFramework/index.php/welcome/showMain">Home</a> 
					</li> 
					<li class="dropdown"> 
						<a href="/CIFramework/index.php/expert/welcome">Consultant</a> 
                        <ul> 
                            <li> 
								<a href="/CIFramework/index.php/expert/welcome">Home</a> 
							</li> 
							<li> 
								<a href="/CIFramework/index.php/expert/welcome/addExpert">Add</a> 
							</li> 
							<li> 
								<a href="/CIFramework/index.php/expert/welcome/search">Search</a> 
							</li> 
						</ul>
					</li> 
					<li class="dropdown"> 
						<a href="/CIFramework/index.php/project/welcome">Project</a> 
                        <ul> 
                            <li> 
								<a href="/CIFramework/index.php/project/welcome">Home</a> 
							</li> 
							<li> 
								<a href="/CIFramework/index.php/project/welcome/addProject">Add</a> 
							</li> 
							<li> 
								<a href="/CIFramework/index.php/project/welcome/search">Search</a> 
							</li> 
						</ul>
					</li> 
					<li class="dropdown"> 
                        <a href="/CIFramework/index.php/guest/welcome">Client</a> 
                        <ul> 
                            <li> 
								<a href="/CIFramework/index.php/guest/welcome">Home</a> 
							</li> 
							<li> 
								<a href="/CIFramework/index.php/guest/welcome/addGuest">Add</a> 
							</li> 
							<li> 
								<a href="/CIFramework/index.php/guest/welcome/search">Search</a> 
							</li> 
						</ul>
					</li>	
                    <li> 
                        <a>Email</a> 
					</li>
                    <li class="fr dropdown"> 
                        <a href="#" class="with-profile-image"><span><img src="/CIFramework/public/templete/images/profile-image.png" /></span>管理员</a> 
                        <ul>
                                                    <li><a>管理员</a></li> 
                            <li><a href="/CIFramework/index.php/admin/welcome">进入管理员界面</a></li> 
                                                <li><a  href="/CIFramework/index.php/welcome/logOut">登出</a></li>        
                        </ul>
                    </li> 
				</ul> 
            </nav>
        </header>
<section> 
	<aside>
    	<nav>
          <ul>
            <li class='current'><a href="/CIFramework/index.php/project/welcome" >Projects List</a></li>
            <li  ><a href="/CIFramework/index.php/project/welcome/search">Search</a></li>
            <li ><a href="/CIFramework/index.php/project/welcome/addProject" >Add</a></li>
            <li ><a>Detailed Information</a></li>
            <li ><a>Consultant Required</a></li>
            <li ><a>Add Consultant Required</a></li>
          </ul>
    	</nav>
	</aside> 
	<section id="send-email" >
    	<header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>Send Email</h1>
                    </div>
        </header>
        
      <section class="container_12 clearfix">
        <div id="span1">
            <div class="container-fluid">
                <span style="color: black;"><strong>Select Expert</strong></span>>>
                <span style="color: grey;">Confirm Expert Selected</span>>>
                <span style="color: grey;">Edit Email Content</span>
            </div><br />
            <button onclick="switch2span(2)">Next Step</button>
            <div class="container-fluid border_set1 div-s" >
                <strong>搜索条件:</strong><br />
                <span>行业:</span>
                <select id="profession">
                  
                </select>
                <span>子行业:</span>
                <select id="subprofession">
                    
                </select>
                <span>
                是否合作过:
                </span>
                <select id="isCop">
                    <option value="0">不限</option>
                    <option value="1">是</option>
                    <option value="2">否</option>
                </select><br />
                <span>省份:</span>
                <select id="province">
                    
                </select>
                <span>城市:</span>
                <select id="city">
                    
                </select><br />
                <span>性别:</span>
                <select id="sex">
                    <option value="0">不限</option>
                    <option value="F">女</option>
                    <option value="M">男</option>
                </select>
                <span>&nbsp;&nbsp;&nbsp;姓名:</span>
                <input id='name' />
                <br />
                <button onclick="startSearch()">搜索</button>
            </div><br/>
            <div class="container-fluid border_set1">
                <strong>搜索结果</strong>
                <table id="tb1" class="display text-center">
                  <thead>
                      <tr>
                          <th ><span onclick="selectAll()">Select All</span></th>
                          <th >Name</th>
                          <th >Statu</th>
                          <th >Company</th>
                          <th >Department</th>
                          <th >Position</th>
                      </tr>
                  </thead>
                <tbody>
                </tbody>
              </table>
                
            </div>
            <div>
                    <button onclick="pageCtrl(-1)">Pre</button>&nbsp;<span id="show-page">1</span>&nbsp;<button onclick="pageCtrl(1)">Next</button>
            </div>
            
        </div>
        <div id="span2">
            <div class="container-fluid">
                <span style="color: black;"><strong>Select Expert</strong></span>>>
                <span style="color: black;"><strong>Confirm Expert Selected</strong></span>>>
                <span style="color: grey;">Edit Email Content</span>
            </div><br />
            <button onclick="switch2span(1)">Previous Step</button>
            <button onclick="switch2span(3)">Next Step</button>
            <br />
            <div id="ta1">
                <table id="tb2" class="display text-left">
                  <thead>
                      <tr>
                          <th >Name</th>
                          <th >Email</th>
                          <th >Send Email?</th>
                      </tr>
                  </thead>
                <tbody>
                </tbody>
              </table>
            </div>
        </div>
        <div id="span3">
            <div class="container-fluid">
                <span style="color: black;"><strong>Select Expert</strong></span>>>
                <span style="color: black;"><strong>Confirm Expert Selected</strong></span>>>
                <span style="color: black;"><strong>Edit Email Content</strong></span>
            </div><br />
            <button onclick="switch2span(2)">Previous Step</button>
            <div class="container-fluid border_set1">
                <strong>邮件内容</strong><br/>
            	<span>邮件标题:</span><input id="i-title" class="input_1"/>
                <br/>
                <span>邮件正文:</span><br/>
                <textarea id="tac" class="form-textarea ta-e" rows="10"></textarea>
            </div><br/>
            <div class="container-fluid border_set1">
                <strong>附件</strong><br/>
            	<span>选择文件:</span>
                	<div>
                        <ul id="f-u">
                            
                        </ul>
                    </div> 
                   
                        <input id="file" type="file" size="45" name="file" class="input"/>
                        <button class="button" id="buttonUpload" onclick="uf()">Upload</button>
 	
            </div>
            <div class="container-fluid" >
                <div id="sbt">
                    <button style="float: left;" onclick="sendmail()">Send</button>
                </div>
                <span id="stext">Sending...Please Wait!</span>
            </div>
      </div>
      <div id="span4">
            <div class="container-fluid">
                <button onclick="switch2span(3)">Previous Step</button>
            </div>
            <table id="tb3" class="display text-left">
                  <thead>
                      <tr>
                          <th >Name</th>
                          <th >Email</th>
                          <th >Send Statu</th>
                      </tr>
                  </thead>
                <tbody>
                </tbody>
              </table>
      </div>
      </section>
    </section>
 </section>
 </div>

</body>
</html>