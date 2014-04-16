  <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>Add Project</h1>
                    </div>
                </header>
                <section class="container_12 clearfix">
                    <div class="portlet grid_12">
                        <header>
                            <h2>Project Information</h2>
                        </header>
                        <section>
                            <form class="form has-validation" id="form1" name="form1" method="POST" action="<?= $url['project']?>/addAnProject" enctype="multipart/form-data">
                                <h2>Basic Information</h2>
                                <div class="clearfix">

                                    <label for="pname" class="form-label">Project Name <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="pname" name="pname" required="required" /></div>

                                </div>
                                <div class="clearfix">

                                    <label for="pcode" class="form-label">Project Code <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="pcode" name="pcode" required="required" /></div>

                                </div>
                                <div class="clearfix">

                                    <label for="pem" class="form-label">Project Manager <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="pem" name="pem" required="required"/></div>

                                </div>
                                <div class="clearfix">

                                    <label for="pemcontact" class="form-label">Main Contact <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="pcontact" name="pcontact" required="required" /></div>

                                </div>
                                <div class="clearfix">

                                    <label for="pemcontact" class="form-label">Mobile No <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="pemcontact" name="pemcontact" required="required" /></div>

                                </div>
                                <h2>Client Preference</h2>
                                
                                <div class="clearfix">

                                    <label for="peneed" class="form-label"> Consultant Required <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="peneed" name="peneed" /></div>

                                </div>
                                <div class="clearfix">

                                    <label for="eyear" class="form-label">Deadline<em></em><small id="rolenote"></small></label>

                                    <div class="form-input"><input type="text" id="endtime" name="endtime"  onclick="WdatePicker()" /></div>

                                </div>
                                <p></p>
                                <div class="clearfix">

                                    <label for="updatefreq" class="form-label"> Update Frequency <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="updatefreq" name="updatefreq" /></div>

                                </div>
                                <div class="clearfix">

                                    <label for="comchannel" class="form-label"> Contact Approach <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="comchannel" name="comchannel" /></div>

                                </div>
                                <div class="clearfix">

                                    <label for="iSMS" class="form-label"> Interview SMS <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="iSMS" name="iSMS" /></div>

                                </div>
                                <div class="clearfix">

                                    <label for="dailyiquota" class="form-label">Daily Interview Quota <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="dailyiquota" name="dailyiquota" /></div>

                                </div>
                    	       	<h2>Detailed Request</h2>
                                <div class="clearfix">


                                    <div class="form-input form-textarea"><textarea id="pediscribe" name="pediscribe" rows="5"></textarea></div>

                                </div>
                            
                                <h2>Remark</h2>
                                <div class="clearfix">


                                    <div class="form-input form-textarea"><textarea id="premark" name="premark" rows="5"></textarea></div>

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
			if(isEmpty(document.getElementById("pname").value)){ alert("项目名不能为空"); document.getElementById("pname").focus(); return;}
//			if(!(isProjectName(document.getElementById("pname").value))) {alert("项目名只能为英文或中文或数字"); document.getElementById("pname").focus(); return;}			
			if(isEmpty(document.getElementById("pcode").value)){ alert("项目代码不能为空"); document.getElementById("pcode").focus(); return;}
//			if(!(isProjectName(document.getElementById("pcode").value))) {alert("项目代码只由中文，英文，数字及下划线组成"); document.getElementById("pcode").focus(); return;}
			if(isEmpty(document.getElementById("pem").value)){ alert("项目经理不能为空"); document.getElementById("pem").focus(); return;}
//			if(!(isName(document.getElementById("pem").value))) {alert("项目经理只能为英文或中文"); document.getElementById("pem").focus(); return;}	
//			if(!isEmpty(document.getElementById("peneed").value)) {if(!isNumber(document.getElementById("peneed").value)){alert("所需行业顾问数只能为数字"); document.getElementById("peneed").focus(); return; }}			
			if(isEmpty(document.getElementById("pcontact").value)){ alert("Main Contact不能为空"); document.getElementById("pcontact").focus(); return;}
            if(isEmpty(document.getElementById("pemcontact").value)){ alert("Mobile No不能为空"); document.getElementById("pemcontact").focus(); return;}
            document.form1.submit();
	}
		
 </script> 
	
   
