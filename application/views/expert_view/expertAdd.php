 <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>Add Consultant</h1>
                    </div>
                </header>
                <section class="container_12 clearfix">
                    <div class="portlet grid_12">
                        <header>
                            <h2>Consultant Information</h2>
                        </header>
                        <section>
                            <form class="form has-validation" id="form1" name="form1" method="POST" action="<?=$url['expert']?>/addAnExpert" enctype="multipart/form-data">
                            
                            <div class="clearfix">

                                    <label for="estatus" class="form-label">Status<em>*</em><small id="rolenote"></small></label>

                                    <div class="form-input"><select id="estatus" name="estatus" onchange="statusChange()">
                                    <option value="1">获得联系方式</option>
                              	    <option value="2">聘用</option>
                            	    <option value="3">已合作</option>
                                    </select></div>

                            </div>
                            
                            <script type="text/javascript">
                        	function statusChange(){
                        	   
                        		if(document.getElementById("estatus").value == "1"){
                        			document.getElementById("status1").style.display = "inline";
                        			document.getElementById("status2").style.display = "none";
                        		}
                        		else{
                        		document.getElementById("status1").style.display = "none";
                        		document.getElementById("status2").style.display = "inline";
                        		}
                        	}
                        	</script>
                            
                            
                            <div id="status1">
                                <div class="clearfix">

                                    <label for="ename1" class="form-label">Consultant Name <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="ename1" name="ename1" required="required" /></div>

                                </div>
                                
                                <div class="clearfix">

                                    <label for="ecompany" class="form-label">Company <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="ecompany" name="ecompany" required="required" /></div>

                                </div>
                                
                                <div class="clearfix">

                                    <label for="esection" class="form-label">Department <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="esection" name="esection" required="required" /></div>

                                </div>
                                
                                <div class="clearfix">

                                    <label for="eposition" class="form-label">Position <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="eposition" name="eposition" required="required" /></div>

                                </div>
                                
                                <div class="clearfix">

                                    <label for="ecellphone1" class="form-label">Mobile <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="ecellphone1" name="ecellphone1" required="required" /></div>

                                </div>
                                
                                <div class="clearfix">

                                    <label for="elandphone1" class="form-label">Landline <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="elandphone1" name="elandphone1"  /></div>

                                </div>
                                
                        		<div class="form-action clearfix">

                                    <button class="button"  onclick="validate1()" data-icon-primary="ui-icon-circle-check">OK</button>

                                    <button class="button" type="reset">Reset</button>

                                </div>
                       		</div>
                        		<script type="text/javascript">
                             	function validate1(){
                            			if(isEmpty(document.getElementById("ename1").value)){ alert("行业顾问名不能为空"); document.getElementById("ename1").focus(); return;}
                            			if(isEmpty(document.getElementById("ecompany").value)){ alert("公司名不能为空"); document.getElementById("ecompany").focus(); return;}
                            	//		if(!(isProjectName(document.getElementById("ecompany").value))) {alert("公司名只能为英文或中文或数字"); document.getElementById("ecompany").focus(); return;}
                            			if(isEmpty(document.getElementById("esection").value)){ alert("部门不能为空"); document.getElementById("esection").focus(); return;}
                            	//		if(!(isName(document.getElementById("esection").value))) {alert("部门只能为英文或中文"); document.getElementById("esection").focus(); return;}
                            			if(isEmpty(document.getElementById("eposition").value)){ alert("职位名不能为空"); document.getElementById("eposition").focus(); return;}
                            	//		if(!(isName(document.getElementById("eposition").value))) {alert("职位名只能为英文或中文"); document.getElementById("eposition").focus(); return;}
                            			if(!isEmpty(document.getElementById("ecellphone1").value)) {if(!isMobile(document.getElementById("ecellphone1").value)){alert("请输入正确的手机号"); document.getElementById("ecellphone1").focus(); return; }}
                            			if(!isEmpty(document.getElementById("elandphone1").value)) {if(!isPhone(document.getElementById("elandphone1").value)){alert("请输入正确的座机号"); document.getElementById("elandphone1").focus(); return; }}
                            			if(isEmpty(document.getElementById("ecellphone1").value)){alert("mobile不能为空"); document.getElementById("ecellphone1").focus(); return;}
                            			document.form1.submit();
                            	}                            	
                                </script>   
                               
                               
                             <div id = "status2" style="display:none">
                                  <div id="basis">
                                    <div> <h2>Basic Information</h2></div>
                                  	<div>
                                  	  <div style="display: none">
                                      	
                                            <input type="text" name="eprovince" id="eprovince" />
                                            <input type="text" name="ecity" id="ecity" />
                                			<input type="text" name="eprofession" id="eprofession" />
                                			<input type="text" name="esubprofession" id="esubprofession" />
                                            <script type="text/javascript">
                                				function setEprovince(){
                                					document.getElementById("eprovince").value = document.getElementById("province").value;
                                				//	alert(document.getElementById("eprovince").value);
                                				}
                                				
                                				function setEcity(){
                                					document.getElementById("ecity").value = document.getElementById("city").value;
                                				//	alert(document.getElementById("ecity").value);
                                				}
                                				
                                				function setEprofession(){
                                					document.getElementById("eprofession").value = document.getElementById("profession").value;
                                				//	alert(document.getElementById("eprofession").value);
                                				}
                                				
                                				function setEsubprofession(){
                                					document.getElementById("esubprofession").value = document.getElementById("subprofession").value;
                                				//	alert(document.getElementById("esubprofession").value);
                                				}
                                            </script>
                                      </div>
                           	 <div class="clearfix">

                                    <label for="ename" class="form-label">Consultant Name <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="ename" name="ename" required="required" /></div>

                                </div>
                                
                                <div class="clearfix">

                                    <label for="ebirthday" class="form-label">Birthday<em></em><small id="rolenote"></small></label>
                                    <div class="form-input"><input type="text" id="ebirthday" name="ebirthday"  onclick="WdatePicker()" /></div>
                                 </div>	    
                              	 <div class="clearfix">

                                    <label for="esex" class="form-label">Gender<em>*</em><small></small></label>

                                    <div class="form-input"><select id="esex" name="esex">
                                    <option value="">------Choose Gender------</option>
            						<option value="M">Male</option>
            						<option value="F">Female</option>
                                    </select></div>

                                </div>
                                
                                <div class="clearfix">

                                    <label for="province" class="form-label">Province<em></em><small></small></label>

                                    <div class="form-input"><select id="province" name="province">
                                    </select></div>

                                </div>
                                
                                <div class="clearfix">

                                    <label for="city" class="form-label">City<em></em><small></small></label>

                                    <div class="form-input"><select id="city" name="city">
                                    </select></div>

                                </div> 
                                  	    <script type="text/javascript">
                                			lobj = document.getElementById("province");
                                			cobj = document.getElementById("city");
                                            addrInit(lobj, cobj);
                                			lobj.onchange = function(){select(lobj, cobj); setEprovince();}
                                			cobj.onchange = function(){setEcity();}
                                	    </script>
                                  	 
                                 <div class="clearfix">

                                    <label for="ecellphone" class="form-label">Mobile <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="ecellphone" name="ecellphone" required="required" /></div>

                                </div>
                                
                                <div class="clearfix">

                                    <label for="elandphone" class="form-label">Landline <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="elandphone" name="elandphone"  /></div>

                                </div> 
                                
                                <div class="clearfix">

                                    <label for="email" class="form-label no-description">Email <em>*</em><small></small></label>

                                    <div class="form-input"><input type="email" name="email" id="email" required="required" /></div>

                                </div> 
                                
                                <div class="clearfix">

                                    <label for="msn" class="form-label">MSN <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="msn" name="msn" /></div>

                                </div>    
                                
                                <div class="clearfix">

                                    <label for="eqq" class="form-label">QQ <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="eqq" name="eqq" /></div>

                                </div>    
                                
                                <div class="clearfix">

                                    <label for="profession" class="form-label">Industry<em>*</em><small></small></label>

                                    <div class="form-input"><select id="profession" name="profession">
                                    </select></div>

                                </div>
                                
                                <div class="clearfix">

                                    <label for="subprofession" class="form-label">Sub-industry<em>*</em><small></small></label>

                                    <div class="form-input"><select id="subprofession" name="subprofession">
                                    </select></div>

                                </div>
                                <script type="text/javascript">
                                			listPro(document.getElementById("profession"),document.getElementById("subprofession"));
                                			document.getElementById("profession").onchange = function(){selectPro(document.getElementById("profession"),document.getElementById("subprofession")); setEprofession(); setEsubprofession();}
                                			document.getElementById("subprofession").onchange = function(){setEsubprofession();}
                           	    </script>
                                
                                <div class="clearfix">

                                    <label for="ecomefrom" class="form-label">Consultant Source <em>*</em><small></small></label>

                                    <div class="form-input"><select id="ecomefrom" name="ecomefrom" >
                                    <option value="">------Choose Source------</option>
            						<option value="Data base">Data base</option>
            						<option value="Cold call">Cold call</option>
                                    <option value="CV pool">CV pool</option>
            						<option value="Contact list">Contact list</option>
                                    <option value="SNS">SNS</option>
            						<option value="Reference">Reference</option>
                                    <option value="Vendor">Vendor</option>
                                    <option value="Expert excel">Expert excel</option>
            						<option value="Call center">Call center</option>
                                    </select></div>

                                </div>
                                
                                <div class="clearfix">

                                    <label for="userfile" class="form-label no-description">Photo<small> jpeg/png format</small></label>

                                    <div class="form-input"><input type="file" name="userfile" id="userfile" onchange="picChange()" /></div>

                                </div>
                                
                                <div class="clearfix">

                                    <label for="eremark" class="form-label">Remark/Comments <em></em><small></small></label>

                                    <div class="form-input form-textarea"><textarea id="eremark" name="eremark" rows="5"></textarea></div>

                                </div>
                                        
                                <script type="text/javascript">
                                		 function picChange(){
                                			// alert(document.getElementById("userfile").value);
                                			if(!checkPicExt(document.getElementById("userfile"))){alert("请上传.jpg或.gif格式的图片"); document.getElementById("userfile").outerHTML = document.getElementById("userfile").outerHTML; return;};
                                			if(!checkPicSize(document.getElementById("userfile"))){alert("请上传小于512K的图片"); document.getElementById("userfile").outerHTML = document.getElementById("userfile").outerHTML; return;};
                                			document.getElementById("picdis").src = document.getElementById("userfile").value;
                                		}
                                </script>

                                  </div>
                                  </div>
                                    
                                  <div id="charge">
                                    <div class="clearfix">
                                    <h2>Account Information</h2>
                                    <label for="select1" class="form-label"><small></small></label>

                                    <div class="form-input"><input type="checkbox" name="select1" id="select1" onclick="select1Set()"  /></div>

                                    </div>
                                      <script type="text/javascript">
                                        	function select1Set(){
                                				//alert(document.getElementById("select1").checked);
                                				if(document.getElementById("select1").checked)	{
                                					document.getElementById("chargeDiv").style.display = "inline";
                                				}
                                				else{
                                					document.getElementById("chargeDiv").style.display = "none";
                                				}
                                			}
                                        </script>
                                <div id="chargeDiv" style="display:none">
                                
                                <div class="clearfix">

                                    <label for="echarge" class="form-label">Interview Rate <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="echarge" name="echarge" value="1200" /></div>

                                </div> 
                                
                                <div class="clearfix">

                                    <label for="elevel" class="form-label">Consultant Level<em></em><small id="rolenote"></small></label>

                                    <div class="form-input"><select id="elevel" name="elevel">
                                        <option value="1">初级</option>
                         	            <option value="2">中级</option>
                      	                <option value="3">高级</option>
                                    </select></div>

                                </div>
                              	 
                                <div class="clearfix">

                                    <label for="ebank" class="form-label">Bank<em></em><small id="rolenote"></small></label>

                                    <div class="form-input"><select id="ebank" name="ebank">
                                    </select></div>

                                </div>
                                	<script type="text/javascript">
                                		setBank(document.getElementById("ebank"));
                                		
                                		
                                		function setBank(bobj){
                                		Bank = "|工商银行|农业银行|中国银行|交通银行|招商银行|建设银行|深圳发展银行|浦发银行|民生银行|华夏银行|兴业银行|中信银行|光大银行|浙商银行|广东发展银行|徽商银行|平安银行|渤海银行|中信嘉华|东莞银行|汉口银行|福建海峡银行|东亚银行|恒生银行|汇丰中国|渣打银行|花旗银行|星展银行|恒丰银行|荷兰银行|华侨银行|德意志银行|永亨银行中国|南商银行中国|友利银行中国|巴黎银行中国|三菱东京日联银行|瑞穗银行|法国兴业银行|桂林市商业银行|湛江银行|富滇银行|柳州市商业银行|吉林银行|西安银行|北京银行|上海银行|南京银行|广州银行|厦门国际银行|杭州银行|宁波银行|泉州商业银行|成都银行|厦门市商业银行|包商银行|大连银行|哈尔滨银行|大庆银行|深圳农村商业银行|上海农商行|北京农商行|进出口银行|农业发展银行|国家开发银行|鄞州银行|邮政储蓄银行"; 
                                			var banks = Bank.split("|");
                                			var oOption;
                                			for(var j = 0;j < banks.length;j++) { 
                                				oOption = document.createElement("OPTION");
                                				oOption.text= banks[j];
                                				oOption.value= banks[j];
                                				bobj.add(oOption);
                                			}
                                		}
                                	</script>
                                    
                                    <div class="clearfix">

                                        <label for="esubbank" class="form-label">Sub-branch <em></em><small></small></label>
    
                                        <div class="form-input"><input type="text" id="esubbank" name="esubbank"  /></div>

                                    </div> 
                                    
                                    <div class="clearfix">

                                        <label for="eanumber" class="form-label">Account <em></em><small></small></label>
    
                                        <div class="form-input"><input type="text" id="eanumber" name="eanumber"  /></div>

                                    </div> 
                                    
                                    <div class="clearfix">

                                        <label for="eaname" class="form-label">Account Name <em></em><small></small></label>
    
                                        <div class="form-input"><input type="text" id="eaname" name="eaname"  /></div>

                                    </div> 

                                    	   

                                            
                                        </div>
                                    </div>
                                    <div class="form-action clearfix">

                                        <button class="button"  onclick="validate()" data-icon-primary="ui-icon-circle-check">OK</button>


                                    </div>
                     

                                	
                               
                                </div> 
                                 

                                

                            </form>
                        </section>
                    </div>
                </section>
            </section>

           



<script type="text/javascript">
 	function validate(){
			if(isEmpty(document.getElementById("ename").value)){ alert("行业顾问名不能为空"); document.getElementById("ename").focus(); return;}
            if(isEmpty(document.getElementById("ecellphone").value)){ alert("手机号不能为空"); document.getElementById("ecellphone").focus(); return;}
			if(!isEmpty(document.getElementById("ecellphone").value)) {if(!isMobile(document.getElementById("ecellphone").value)){alert("请输入正确的手机号"); document.getElementById("ecellphone").focus(); return; }}
			if(!isEmpty(document.getElementById("elandphone").value)) {if(!isPhone(document.getElementById("elandphone").value)){alert("请输入正确的座机号"); document.getElementById("elandphone").focus(); return; }}
			if(isEmpty(document.getElementById("email").value)){ alert("邮箱不能为空"); document.getElementById("email").focus(); return;}
			if(!(isEmail(document.getElementById("email").value))) {alert("请输入正确的邮箱格式"); document.getElementById("email").focus(); return;}
			if(!isEmpty(document.getElementById("eqq").value)) {if(!isNumber(document.getElementById("eqq").value)){alert("请输入正确的qq号"); document.getElementById("eqq").focus(); return; }}
			if(isEmpty(document.getElementById("eprofession").value)){ alert("请选择所属行业"); document.getElementById("eprofession").focus(); return;}
			
			if(isEmpty(document.getElementById("esubprofession").value)){ alert("请选择子行业"); document.getElementById("esubprofession").focus(); return;}
            if(isEmpty(document.getElementById("esex").value)){ alert("请选择性别"); document.getElementById("esex").focus(); return;}
            if(isEmpty(document.getElementById("ecomefrom").value)){ alert("请选择来源"); document.getElementById("ecomefrom").focus(); return;}
			//if(document.getElementById("select1").checked && isEmpty(document.getElementById("echarge").value)){ alert("收费标准不为空"); document.getElementById("echarge").focus(); return;}
//			if(!isEmpty(document.getElementById("echarge").value)) {if(!isNumber(document.getElementById("echarge").value)){alert("收费标准为数字"); document.getElementById("echarge").focus(); return; }}
//			if(!isEmpty(document.getElementById("ebank").value)) {if(!isName(document.getElementById("ebank").value)){alert("银行名为英文或中文"); document.getElementById("ebank").focus(); return; }}
//			if(!isEmpty(document.getElementById("esubbank").value)) {if(!isName(document.getElementById("esubbank").value)){alert("支行名为英文或中文"); document.getElementById("esubbank").focus(); return; }}
//			if(!isEmpty(document.getElementById("eanumber").value)) {if(!isNumber(document.getElementById("eanumber").value)){alert("银行账号为数字"); document.getElementById("eanumber").focus(); return; }}
//			if(!isEmpty(document.getElementById("eaname").value)) {if(!isName(document.getElementById("eaname").value)){alert("开户名为英文或中文"); document.getElementById("eaname").focus(); return; }}
			document.form1.submit();
	}
	
 </script> 
 