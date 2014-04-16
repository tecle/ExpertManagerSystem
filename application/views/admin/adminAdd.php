            <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>添加用户</h1>
                    </div>
                </header>
                <section class="container_12 clearfix">
                    <div class="portlet grid_12">
                        <header>
                            <h2>用户信息</h2>
                        </header>
                        <section>
                            <form class="form has-validation">

                                <div class="clearfix">

                                    <label for="uname" class="form-label">用户姓名 <em>*</em><small>登陆后显示的名称</small></label>

                                    <div class="form-input"><input type="text" id="uname" name="uname" required="required" /></div>

                                </div>

                                <div class="clearfix">

                                    <label for="uaccount" class="form-label">用户账号 <em>*</em><small>登陆账号</small></label>

                                    <div class="form-input"><input type="text" id="uaccount" name="uaccount" required="required" /></div>

                                </div>


                                <div class="clearfix">

                                    <label for="upassword" class="form-label">Password<em>*</em><small></small></label>

                                    <div class="form-input"><input type="password" id="upassword" name="upassword" /></div>

                                </div>

                                <div class="clearfix">

                                    <label for="upassword1" class="form-label">Password check<small>Re-enter your password</small></label>

                                    <div class="form-input"><input type="password" id="upassword1" name="upassword1" data-equals="password" /></div>

                                </div>
                                
                                <div class="clearfix">

                                    <label for="urole" class="form-label">用户身份<em>*</em><small id="rolenote"></small></label>

                                    <div class="form-input"><select id="urole" name="urole">
                                    <option value="ud">D类权限</option>
                                    <option value="uc">C类权限</option>
                                    <option value="ub">B类权限</option>
                                    <option value="ua">A类权限</option>
                          	        <option value="a">管理员</option>
                                    </select></div>

                                </div>


                                <div class="clearfix">

                                    <label for="uinfo" class="form-label">About  <small>Describe</small></label>

                                    <div class="form-input form-textarea"><textarea id="uinfo" name="uinfo"  rows="5"></textarea></div>

                                </div>
                                

                                <div class="form-action clearfix">

                                    <button class="button" type="submit" onclick="validate()" data-icon-primary="ui-icon-circle-check">OK</button>

                                    <button class="button" type="reset">Reset</button>

                                </div>

                            </form>
                        </section>
                    </div>
                </section>
            </section>

           
    
    


<script type="text/javascript">
    function roleChange(){
        var role = document.getElementById("rolenote").value;
        var noteobj = document.getElementById("rolenote");
        if(role == "a") noteobj.innerHTML = "任何权限";
        else if(role == "ua") noteobj.innerHTML = "除了管理账户、查看日志以外的任何权限";
        else if(role == "ub") noteobj.innerHTML = "查询、查看、添加、编辑专家信息;查询、查看、添加、编辑项目信息;查询、查看、添加、编辑客户信息";
        else if(role == "uc") noteobj.innerHTML = "查询、查看、添加、编辑专家信息；查询、查看项目信息";
        else if(role == "ud") noteobj.innerHTML = "添加、编辑专家信息（只能编辑该用户添加的专家）";
        
    }
 	function validate(){
 			if(isEmpty(document.getElementById("uname").value)){ 
				alert("用户姓名不能为空"); 
				document.getElementById("uname").focus(); 
				return;
			}
			if(!(isProjectName(document.getElementById("uname").value))) {alert("用户姓名只能由英文、中文或数字组成"); document.getElementById("ename").focus(); return;}
			if(isEmpty(document.getElementById("uaccount").value)){ alert("用户账号不能为空"); document.getElementById("uaccount").focus(); return;}
			if(!(isAccountName(document.getElementById("uaccount").value))) {alert("账号由英文，数字，_,-构成"); document.getElementById("uaccount").focus(); return;}
			if(isEmpty(document.getElementById("upassword").value)){ alert("密码不能为空"); document.getElementById("upassword").focus(); return;}
			if(document.getElementById("upassword").value != document.getElementById("upassword1").value){alert("两次密码不相同"); document.getElementById("upassword").focus(); return; }
		
 			addAccount();
	}
	
 </script> 
 