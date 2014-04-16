   <?php
   if(empty($guest_company)){
    ;
   }else{
   ?>
    <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>Client Information</h1>
                    </div>
                </header>
                <div style="text-align: right;"><button class="button" onclick="check_deleteGuest(<?=$gid?>)" >Delete</button></div>
                <section class="container_12 clearfix">       
      <!--基本信息-->         
                    <section class="portlet grid_12 leading"> 
                        <header>
                            <h2>Basic Information<button style="float:right" onclick="basicChange()">modify</button> </h2>
                        </header>
                         <section >
                        <div id="basic1">
                        
                       
                            <table class="display"> 
 
                                <tbody> 
 
                                    <tr class="gradeA">
                                    <th width="18%">Client：</th>
                                    <td width="32%"><?= $guest_company['gname'] ?></td>
                                    <th width="15%">Client type：</th>
                                    <td id="scbirthday" width="35%"><?= $guest_company['gtype'] ?></td>
                                    </tr>   
                                                
                                    <tr class="gradeA">
                                    <th>Half-hour Policy：</th>
                                    <td><?= $guest_company['ghalfhour'] ?></td>
                                    <td><td></td></td>
                                    </tr>
					                
                                    <tr class="gradeA">
                                    <th>Client Introduction ：</th>
                                    <td colspan="3"><?= $guest_company['gintroduction'] ?></td>
                                    </tr>
 
                                </tbody> 
 
                            </table>
                            </div>
                        
                        
                        <div id="basic2" style="display:none">
                                 
                          <table class="full"> 
 
                                <tbody>
                                <tr>
                                <td>
                                <div class="clearfix">

                                    <label for="gname" class="form-label">Client <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gname" name="gname" value="<?=$guest_company['gname']?>" /></div>

                                </div>
                                </td>
                                <td>
                                <div class="clearfix">
    
                                        <label for="gtype" class="form-label">Client type<em></em><small></small></label>
    
                                        <div class="form-input"><select id="gtype" name="gtype" >
                                        <option value="咨询" <?php if($guest_company['gtype'] == '咨询') echo 'selected = true';?>>咨询</option>
                               	        <option value="私募基金" <?php if($guest_company['gtype'] == '私募基金') echo 'selected = true';?>>私募基金</option>
                                        <option value="公募基金" <?php if($guest_company['gtype'] == '公募基金') echo 'selected = true';?>>公募基金</option>
                                        <option value="对冲基金" <?php if($guest_company['gtype'] == '对冲基金') echo 'selected = true';?>>对冲基金</option>
                                        <option value="企业">企业</option>
                                        </select></div>
    
                                </div>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                <div class="clearfix">
    
                                        <label for="ghalfhour" class="form-label">Half-hour Policy<em></em><small></small></label>
    
                                        <div class="form-input"><select id="ghalfhour" name="ghalfhour" >
                                        <option value="Y" <?php if($guest_company['ghalfhour'] == 'Y') echo 'selected = true';?>>有</option>
                               	        <option value="N" <?php if($guest_company['ghalfhour'] == 'N') echo 'selected = true';?>>无</option>
                                        </select></div>
    
                                </div>
                                </td>
                                <td>
                                <div class="clearfix">
    
                                        <label for="gintroduction" class="form-label">Client Introduction <em></em><small></small></label>
    
                                        <div class="form-input form-textarea"><textarea id="gintroduction" name="gintroduction" rows="5"><?= $guest_company['gintroduction'] ?></textarea></div>
    
                                </div>
                                </td>
                                </tr>
                                
                                <td colspan="2" ><div  style="text-align: right;">

                                    <button class="button"  onclick="basicValidate()">OK</button>

                                    <button class="button" onclick="basicUnchange()">Cancel</button>

                                </div></td></tr>
                          </tbody>
                </table>
                        
                                </div>
                              <script type="text/javascript">
                    			function basicChange(){
                    					document.getElementById("basic2").style.display = "inline";
                    					document.getElementById("basic1").style.display = "none";	
                    				}
                    			function basicUnchange(){
                    				document.getElementById("basic1").style.display = "inline";
                    				document.getElementById("basic2").style.display = "none";	
                    			}
                    			function basicValidate(){
                    				guestBasicChange();				
                    				
                    			}
                                function guestBasicChange(){
                                    var gid = $('#gid').attr('value');
                                    var gname = $('#gname').attr('value');
                                    var ghalfhour = $('#ghalfhour').attr('value');
                                    var gtype = $('#gtype').attr('value');
                                    var gintroduction = $('#gintroduction').attr('value');	
                    				var str="type=1"+"&gid="+gid+"&gname="+gname+"&ghalfhour="+ghalfhour+"&gtype="+gtype+"&gintroduction="+gintroduction+"&gremark=";
                                    callGuestAjax(str);
                                }
                    			</script>
                        </section>
                    </section> 
                 
                 <!--业务联系人-->   
                    <section class="portlet grid_12 leading"> 
                        <header>
                            <h2>Business Contact<button style="float:right" onclick="gbcbasicChange()">modify</button> </h2>
                        </header>
                        <div id="gbclientDiv">
       	
			<script type="text/javascript">
			function gbcbasicChange(){
					document.getElementById("gbcbasic2").style.display = "inline";
					document.getElementById("gbcbasic1").style.display = "none";	
				}
			function gbcbasicUnchange(){
				document.getElementById("gbcbasic1").style.display = "inline";
				document.getElementById("gbcbasic2").style.display = "none";	
			}
			function gbcbasicValidate(){
				//alert(document.getElementById("ename").value);
				//if(!isEmpty($('#ename').attr('value')) {
					//if(!isName($('#ename').attr('value'))){
						//alert("行业顾问名只能为字母或中文"); 
						//document.getElementById("ename").focus(); 
						//return; }
						//}
				//if(!isEmpty(document.getElementById("ecellphone").value)) {if(!isMobile(document.getElementById("ecellphone").value)){alert("请输入正确的手机号"); document.getElementById("ecellphone").focus(); return; }}
				//if(!isEmpty(document.getElementById("elandphone").value)) {if(!isPhone(document.getElementById("elandphone").value)){alert("请输入正确的座机号"); document.getElementById("elandphone").focus(); return; }}
				//if(!isEmpty(document.getElementById("email").value)) {if(!(isEmail(document.getElementById("email").value))) {alert("请输入正确的邮箱格式"); document.getElementById("email").focus(); return;}}
				//if(!isEmpty(document.getElementById("msn").value)) document.getElementById("msn").value = trimText(document.getElementById("msn").value);
				//if(!isEmpty(document.getElementById("eqq").value)) {if(!isNumber(document.getElementById("eqq").value)){alert("请输入正确的qq号"); document.getElementById("eqq").focus(); return; }}
				//if(!isEmpty(document.getElementById("eother").value)) document.getElementById("eother").value = trimText(document.getElementById("eother").value);
				gbcChange();
				
				
			}
            function gbcChange(){
                var cname=$('#gbcname').attr('value');
				var csex=$('#gbcsex').attr('value');
				var cposition=$('#gbcposition').attr('value');
				var cmobile=$('#gbccellphone').attr('value');
				var clandline=$('#gbclandphone').attr('value');
				var cemail=$('#gbcemail').attr('value');
                var cbirthday=$('#gbcbirthday').attr('value');
				var cid=$('#gdid').attr('value');
				if(csex=='3')
					csex=''; 			
				var str="type=2"+"&cname="+cname+"&cposition="+cposition+
                "&csex="+csex+"&cmobile="+cmobile+"&clandline="+clandline+
                "&cemail="+cemail+"&cid="+cid+"&cbirthday="+cbirthday;
				callGuestAjax(str);
            }
			</script>
        </div>
                         <section >
                         <input type="text" name="gdid" id="gdid" value="<?=$contact_info['cid']?>" style="display: none;"/>
                        <div id="gbcbasic1">
                        
                       
                            <table class="display"> 
 
                                <tbody> 
                                <tr class="gradeC">
                                <th width="15%">Client Name：</th>
                                <td width="35%"><?= $contact_info['cname'] ?></td>
                                <th width="15%">Birthday：</th>
                                <td id="scbirthday" width="35%"><?= $contact_info['cbirthday'] ?></td>
                                </tr> 
                                              
                                <tr class="gradeC">
                                <th>Gender：</th>
                                <td><?php if($contact_info['csex']=='F') echo 'Female'; else echo 'Male';  ?></td>
                                <th>Position：</th>
                                <td><?= $contact_info['cposition'] ?></td>
                                </tr>
                                
            					<tr class="gradeC">
                                <th>Mobile：</th>
                                <td><?= $contact_info['cmobile'] ?></td>
                                <th>Landline：</th><td><?= $contact_info['clandline'] ?></td>
                                </tr>
                                
            					<tr class="gradeC">
                                <th>Email：</th>
                                <td><?= $contact_info['cemail'] ?></td>
                                <td><td></td></td>
                                </tr>
                                    
 
                                </tbody> 
 
                            </table>
                            </div>
                        
                        
                        <div id="gbcbasic2" style="display:none">
                              
                          <table class="full"> 
 
                                <tbody>
                                <tr>
                                <td>
                                <div class="clearfix">

                                    <label for="gbcname" class="form-label">Client Name <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gbcname" name="gbcname" value="<?= $contact_info['cname'] ?>"/></div>

                            </div>
                            </td>
                            <td>
                            <div class="clearfix">

                                    <label for="byear" class="form-label">Birthday<em></em><small ></small></label>

                                    <div class="form-input"><input type="text" id="gbcbirthday" name="gbcbirthday" value="<?= $contact_info['cbirthday'] ?>"  onclick="WdatePicker()" /></div>
                            </div>
                            </td>
                            </tr>
                            <p></p>
                            <tr>
                            <td>
                            <div class="clearfix">

                                    <label for="gbcsex" class="form-label">Gender<em></em><small></small></label>

                                    <div class="form-input"><select id="gbcsex" name="gbcsex" >
                                    <option value="M" <?php if($contact_info['csex']=='M') echo 'selected = true';?>>Male</option>
                           	        <option value="F" <?php if($contact_info['csex']=='F') echo 'selected = true';?>>Female</option>
                                    </select></div>

                            </div>
                            </td>
                            <td>
                            
                            <div class="clearfix">

                                    <label for="gbcposition" class="form-label">Position <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gbcposition" name="gbcposition" value="<?= $contact_info['cposition'] ?>" /></div>

                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                            <div class="clearfix">

                                    <label for="gbclandphone" class="form-label">Landline <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gbclandphone" name="gbclandphone" value="<?= $contact_info['clandline'] ?>" /></div>

                            </div>
                            </td>
                            <td>
                            <div class="clearfix">

                                    <label for="gbccellphone" class="form-label">Mobile <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gbccellphone" name="gbccellphone" value="<?= $contact_info['cmobile'] ?>" /></div>

                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                            <div class="clearfix">

                                    <label for="gbcemail" class="form-label">Email <em></em><small></small></label>

                                    <div class="form-input"><input type="email" id="gbcemail" name="gbcemail" value="<?= $contact_info['cemail'] ?>" /></div>

                            </div>
                               </td> 
                                <td colspan="2" ><div  style="text-align: right;">

                                    <button class="button"  onclick="gbcbasicValidate()">OK</button>

                                    <button class="button" onclick="gbcbasicUnchange()">Cancel</button>

                                </div></td></tr>
                          </tbody>
                </table>
                        
                                </div>
                             
                        </section>
                    </section> 
                    
                    <!--付款联系人-->
                    
                    <section class="portlet grid_12 leading"> 
                        <header>
                            <h2>Payment Contact<button style="float:right" onclick="gpcbasicChange()">modify</button> </h2>
                        </header>
                        <div id="gpclientDiv">
       	
			<script type="text/javascript">
			function gpcbasicChange(){
					document.getElementById("gpcbasic2").style.display = "inline";
					document.getElementById("gpcbasic1").style.display = "none";	
				}
			function gpcbasicUnchange(){
				document.getElementById("gpcbasic1").style.display = "inline";
				document.getElementById("gpcbasic2").style.display = "none";	
			}
			function gpcbasicValidate(){
				//alert(document.getElementById("ename").value);
				//if(!isEmpty($('#ename').attr('value')) {
					//if(!isName($('#ename').attr('value'))){
						//alert("行业顾问名只能为字母或中文"); 
						//document.getElementById("ename").focus(); 
						//return; }
						//}
				//if(!isEmpty(document.getElementById("ecellphone").value)) {if(!isMobile(document.getElementById("ecellphone").value)){alert("请输入正确的手机号"); document.getElementById("ecellphone").focus(); return; }}
				//if(!isEmpty(document.getElementById("elandphone").value)) {if(!isPhone(document.getElementById("elandphone").value)){alert("请输入正确的座机号"); document.getElementById("elandphone").focus(); return; }}
				//if(!isEmpty(document.getElementById("email").value)) {if(!(isEmail(document.getElementById("email").value))) {alert("请输入正确的邮箱格式"); document.getElementById("email").focus(); return;}}
				//if(!isEmpty(document.getElementById("msn").value)) document.getElementById("msn").value = trimText(document.getElementById("msn").value);
				//if(!isEmpty(document.getElementById("eqq").value)) {if(!isNumber(document.getElementById("eqq").value)){alert("请输入正确的qq号"); document.getElementById("eqq").focus(); return; }}
				//if(!isEmpty(document.getElementById("eother").value)) document.getElementById("eother").value = trimText(document.getElementById("eother").value);
				gpcChange();
				
				
			}
            function gpcChange(){
                var cname=$('#gpcname').attr('value');
				var csex=$('#gpcsex').attr('value');
				var cposition=$('#gpcposition').attr('value');
				var cmobile=$('#gpccellphone').attr('value');
				var clandline=$('#gpclandphone').attr('value');
				var cemail=$('#gpcemail').attr('value');
				var cbirthday=$('#gpcbirthday').attr('value');
				var cid=$('#gpid').attr('value');
				if(csex=='3')
					csex=''; 			
				var str="type=2"+"&cname="+cname+"&csex="+csex+"&cposition="+cposition+"&cmobile="+cmobile+"&clandline="+clandline+"&cemail="+cemail+"&cid="+cid+"&cbirthday="+cbirthday;
				callGuestAjax(str);
            }
			</script>
        </div>
                         <section >
                         <input type="text" name="gpid" id="gpid" value="<?=$pay_info['cid']?>" style="display: none;"/>
                        <div id="gpcbasic1">
                        
                       
                            <table class="display"> 
 
                                <tbody> 
                                <tr class="gradeU">
                                <th width="15%">Client Name：</th>
                                <td width="35%"><?= $pay_info['cname'] ?></td>
                                <th width="15%">Birthday：</th>
                                <td id="scbirthday" width="35%"><?= $pay_info['cbirthday'] ?></td>
                                </tr> 
                                              
                                <tr class="gradeU">
                                <th>Gender：</th>
                                <td><?php if($pay_info['csex']=='F') echo 'Female'; else echo 'Male';  ?></td>
                                <th>Position：</th>
                                <td><?= $pay_info['cposition'] ?></td>
                                </tr>
                                
            					<tr class="gradeU">
                                <th>Mobile：</th>
                                <td><?= $pay_info['cmobile'] ?></td>
                                <th>Landline：</th><td><?= $pay_info['clandline'] ?></td>
                                </tr>
                                
            					<tr class="gradeU">
                                <th>Email：</th>
                                <td><?= $pay_info['cemail'] ?></td>
                                <td><td></td></td>
                                </tr>
                                    
 
                                </tbody> 
 
                            </table>
                            </div>
                        
                        
                        <div id="gpcbasic2" style="display:none">
                              
                          <table class="full"> 
 
                                <tbody>
                                <tr>
                                <td>
                                <div class="clearfix">

                                    <label for="gpcname" class="form-label">Client Name <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gpcname" name="gpcname" value="<?= $pay_info['cname'] ?>"/></div>

                            </div>
                            </td>
                            <td>
                            <div class="clearfix">

                                    <label for="gpyear" class="form-label">Birthday<em></em><small ></small></label>

                                    <div class="form-input"><input type="text" id="gpcbirthday" name="gpcbirthday" value="<?= $pay_info['cbirthday'] ?>" onclick="WdatePicker()" /></div>

                            </div>
                            </td>
                            </tr>
                            <p></p>
                            <tr>
                            <td>
                            <div class="clearfix">

                                    <label for="gpcsex" class="form-label">Gender<em></em><small></small></label>

                                    <div class="form-input"><select id="gpcsex" name="gpcsex" >
                                    <option value="M" <?php if($pay_info['csex']=='M') echo 'selected = true';?>>Male</option>
                           	        <option value="F" <?php if($pay_info['csex']=='F') echo 'selected = true';?>>Female</option>
                                    </select></div>

                            </div>
                            </td>
                            <td>
                            
                            <div class="clearfix">

                                    <label for="gpcposition" class="form-label">Position <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gpcposition" name="gpcposition" value="<?= $pay_info['cposition'] ?>" /></div>

                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                            <div class="clearfix">

                                    <label for="gpclandphone" class="form-label">Landline <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gpclandphone" name="gpclandphone" value="<?= $pay_info['clandline'] ?>" /></div>

                            </div>
                            </td>
                            <td>
                            <div class="clearfix">

                                    <label for="gpccellphone" class="form-label">Mobile <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gpccellphone" name="gpccellphone" value="<?= $pay_info['cmobile'] ?>" /></div>

                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                            <div class="clearfix">

                                    <label for="gpcemail" class="form-label">Email <em></em><small></small></label>

                                    <div class="form-input"><input type="email" id="gpcemail" name="gpcemail" value="<?= $pay_info['cemail'] ?>" /></div>

                            </div>
                               </td> 
                                <td colspan="2" ><div  style="text-align: right;">

                                    <button class="button"  onclick="gpcbasicValidate()">OK</button>

                                    <button class="button" onclick="gpcbasicUnchange()">Cancel</button>

                                </div></td></tr>
                          </tbody>
                </table>
                        
                                </div>
                             
                        </section>
                    </section> 
                    
                    <!--备注-->
                    <section class="portlet grid_12 leading"> 

                        <header>
                            <h2>Remark<button style="float:right" onclick="noteChange()">modify</button></h2>
                        </header>
                        
			
                        <section>
                            <div id="note1">
                                <?= nl2br(str_replace(' ','&nbsp;',$guest_company['gremark'])) ?>
                            </div>
                            <div id="note2" style="display: none">
                				<div>
                					<textarea name="gremark" id="gremark" cols="100" rows="10"><?= $guest_company['gremark'] ?></textarea>
                				</div>
                                <div class="form-action clearfix" style="text-align: right;">

                                    <button class="button"  onclick="noteValidate()" data-icon-primary="ui-icon-circle-check">OK</button>

                                    <button class="button" onclick="noteUnchange()">Cancel</button>

                                </div>	
                			</div>
                        </section>
                        
                        
                        <script type="text/javascript">
                			function noteValidate(){
                				if(!isEmpty(document.getElementById("gremark").value)) {
                					var gid = $('#gid').attr('value');
                                    var gremark = $('#gremark').attr('value');
                    				var str="type=1"+"&gid="+gid+"&gname="+"&ghalfhour="+"&gtype="+"&gintroduction="+"&gremark="+gremark;
                    				callGuestAjax(str);
                				}
                				
                			}
                			function noteChange(){
                					document.getElementById("note2").style.display = "inline";
                					document.getElementById("note1").style.display = "none";
                				}
                				
                			function noteUnchange(){
                				document.getElementById("note1").style.display = "inline";
                				document.getElementById("note2").style.display = "none";	
                				
                			}
                			</script>

                    </section> 
                    
                     <!--备注结束-->
   <!--所有其他联系人-->
                <input type="text" style="display: none;" id="cur_contact" value="0" />
                <div id="contacts">
                <button onclick="contactsChange(0,0)">Add Contact</button>
                    <?php
                        if (!empty($client_others)) {
                        ?>
                        <script>
                            function changContactsInfo(){
                                document.getElementById('contactsinfo').style.display = "block";
                            }
                        </script>
                    <section class="tabs grid_12 leading">
                        
                        <ul class="clearfix" onclick="changContactsInfo()">
                        
                        <?php    
                            
                            for($p=1;$p<=sizeof($client_others);$p++){
                        ?>
                            <li><a>Contact<?=$p?></a></li>     
                         <?php
                         }
                         ?>                       
                        </ul>
                        
                        <section id="contactsinfo" style="display: none;">
                        <?php
                            $i = 0;
                            foreach ($client_others as $row) {
                                $i++;
                                foreach ($row as $key => $value) {
                                    if ($value == '')
                                        $cother[$key] = 'NULL';
                                    else
                                        $cother[$key] = $value;
                        
                                }
                        
                        ?>  

                            <div style="display: none;">
                                <input id="c_name<?=$i?>" value="<?= $cother['cname'] ?>"/>
                                <input id="c_birthday<?=$i?>" value="<?= $cother['cbirthday'] ?>"/>
                                <input id="c_sex<?=$i?>" value="<?= $cother['csex'] ?>"/>
                                <input id="c_position<?=$i?>" value="<?= $cother['cposition'] ?>"/>
                                <input id="c_mobile<?=$i?>" value="<?= $cother['cmobile'] ?>"/>
                                <input id="c_landline<?=$i?>" value="<?= $cother['clandline'] ?>"/>
                                <input id="c_email<?=$i?>" value="<?= $cother['cemail'] ?>"/>
                            </div>
                            <section class="clearfix">
                    
                                <table id="workul" class="display" width="100%">
                                    <tbody> 
                                    <tr>
                                    <td colspan="4" ><div class="form-action clearfix" style="text-align: right;">

                                    <button class="button"  onclick="contactsChange(<?= $cother['cid']?>,<?=$i?>)" data-icon-primary="ui-icon-circle-check">Modify</button>
                                    <button class="button"  onclick="check_deleteContact(<?=$gid?>,<?= $cother['cid']?>)" data-icon-primary="ui-icon-circle-check">Delete</button>
                                    </div></td>
                                    </tr>
                                    <tr class="gradeX">
                                    <th width="15%">Client Name：</th>
                                    <td width="35%"><?= $cother['cname'] ?></td>
                                    <th width="15%">Birthday：</th>
                                    <td id="scbirthday" width="35%"><?= $cother['cbirthday'] ?></td>
                                    </tr> 
                                                  
                                    <tr class="gradeX">
                                    <th>Gender：</th>
                                    <td><?php if($cother['csex']=='F') echo 'Female'; else echo 'Male';  ?></td>
                                    <th>Position：</th>
                                    <td><?= $cother['cposition'] ?></td>
                                    </tr>
                                    
                					<tr class="gradeX">
                                    <th>Mobile：</th>
                                    <td><?= $cother['cmobile'] ?></td>
                                    <th>Landline：</th><td><?= $cother['clandline'] ?></td>
                                    </tr>
                                    
                					<tr class="gradeX">
                                    <th>Email：</th>
                                    <td><?= $cother['cemail'] ?></td>
                                    <td><td></td></td>
                                    </tr>
                                        
     
                                    </tbody> 
                                </table>
                            </section>
                    <?php
                            }                                              
                        ?>
                        </section>
                      	
                    </section>
                     <?php
                    }                                           
                        ?> 
                        </div>
                        
     <!--修改每个联系人-->
                <div id="contacts2" style="display: none">
                    <section class="portlet grid_12 leading"> 
                        <section>    
                          <table class="full"> 
 
                                <tbody>
                                <tr>
                                <td>
                                <div class="clearfix">

                                    <label for="gcname" class="form-label">Client Name <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gcname" name="gcname"/></div>

                            </div>
                            </td>
                            <td>
                            <div class="clearfix">

                                    <label for="gyear" class="form-label">Birthday<em></em><small ></small></label>

                                    <div class="form-input"><input type="text" id="gcbirthday" name="gcbirthday"  onclick="WdatePicker()" /></div>
                                                               

                            </div>
                            </td>
                            </tr>
                            <p></p>
                            <tr>
                            <td>
                            <div class="clearfix">

                                    <label for="gcsex" class="form-label">Gender<em></em><small></small></label>

                                    <div class="form-input"><select id="gcsex" name="gcsex" >
                                    <option value="M">Male</option>
                           	        <option value="F">Female</option>
                                    </select></div>

                            </div>
                            </td>
                            <td>
                            
                            <div class="clearfix">

                                    <label for="gcposition" class="form-label">Position <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gcposition" name="gcposition"  /></div>

                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                            <div class="clearfix">

                                    <label for="gclandphone" class="form-label">Landline <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gclandphone" name="gclandphone"  /></div>

                            </div>
                            </td>
                            <td>
                            <div class="clearfix">

                                    <label for="gccellphone" class="form-label">Mobile <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gccellphone" name="gccellphone"  /></div>

                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                            <div class="clearfix">

                                    <label for="gcemail" class="form-label">Email <em></em><small></small></label>

                                    <div class="form-input"><input type="email" id="gcemail" name="gcemail"/></div>

                            </div>
                               </td> 
                                <td colspan="2" ><div  style="text-align: right;">

                                    <button class="button"  onclick="contactsbasicValidate()">OK</button>

                                    <button class="button" onclick="contactsUnchange()">Cancel</button>

                                </div></td></tr>
                          </tbody>
                        </table>
                        
                        </section>
                    </section> 
                       
                
                      </div>
      <!--项目合作经验--> 
                  <section class="portlet grid_12 leading"> 

                        <header>
                            <h2>项目合作<a href="<?=$url['guest']?>/addProject/<?= $guest_company['gid'] ?>/1/1"><button>Add</button></a></h2>
                        </header>
    
                        <section>
                            <table class="display">
                                <thead> 
                                      <tr>
                                      <th width="30%" style="text-align:left">项目名称</th>
                                      <th width="30%" style="text-align:left">详细信息</th>
                                      </tr>     
                                </thead> 
                                <tbody>
                                    <?php
                                    //此处显示项目，默认显示10个项目
                                    
                                    if (!empty($guest_project)) { //结果不为空
                                         $tflag = 0;
                                        foreach ($guest_project as $v => $k) {
                                            if($tflag == 0)
                                                echo '<tr class="gradeA">';
                                            else
                                                echo '<tr class="gradeC">';
                                            echo "<td>" . $v .
                                                "</td><td><a target='_blank' href='".$url['project']."/showProjectInfo/" . $k .
                                                "'>点击查看</a></td></tr>";
                                             $tflag = ++$tflag%2;
                                        }
                                        //输出上一页和下一页
                                        echo "<tr><td colspan='4'>";
                                        echo "<div class='pageInation'>";
                                        echo "</div></td></tr>";
                                    }
                                    ?> 	
                                </tbody>
                            </table>
                           
                            
                        </section>
                        
                        
                    </section> 
                    <!--项目合作经验结束--> 
                   

                    
                    
            </section>
            </section>

      
       <?php

if (empty($guest_company)) { //没有结果
    echo 'No data!';
    exit;
}
echo "<input name='gid' id='gid' style='display:none' value='" . $guest_company['gid'] .
    "' />";

if ($contact_info['csex'] == "M")
    $contact_info['csex'] = "男";
else
    $contact_info['csex'] = "女";
if ($pay_info['csex'] == "M")
    $pay_info['csex'] = "男";
else
    $pay_info['csex'] = "女";
?>
    

		<script type="text/javascript">       	
		
        function check_deleteGuest(gid){
                    if(window.confirm("确实要删除该客户所有信息吗？"))
                     {
                         deleteGuest(gid);
                     }
                }
        function contactsChange(cid, num){

                document.getElementById("cur_contact").value = cid;
				document.getElementById("contacts2").style.display = "inline";
				document.getElementById("contacts").style.display = "none";	                
                if(cid!='0'){
                     document.getElementById("gcname").value = document.getElementById('c_name'+num).value;
                     document.getElementById("gcposition").value = document.getElementById('c_position'+num).value;
                     document.getElementById("gccellphone").value = document.getElementById('c_mobile'+num).value;
                     document.getElementById("gclandphone").value = document.getElementById('c_landline'+num).value;
                     document.getElementById("gcemail").value = document.getElementById('c_email'+num).value;
                     document.getElementById("gcbirthday").value = document.getElementById('c_birthday'+num).value;
			         cssex = document.getElementById("c_sex"+num).value;
                }
            }
            function contactsUnchange(){
				document.getElementById("contacts").style.display = "inline";
				document.getElementById("contacts2").style.display = "none";	
            }
            function contactsbasicValidate(){
                var cname=$('#gcname').attr('value');
				var csex=$('#gcsex').attr('value');
				var cposition=$('#gcposition').attr('value');
				var cmobile=$('#gccellphone').attr('value');
				var clandline=$('#gclandphone').attr('value');
				var cemail=$('#gcemail').attr('value');
				var cbirthday=$('#gcbirthday').attr('value');
				var cid=$('#cur_contact').attr('value');
                var gid=$('#gid').attr('value');
				
                if(cid == '0')			
				    var str="type=4"+"&ccompany=&cremark=&gid="+gid+"&cname="+cname+"&csex="+csex+"&cposition="+cposition+"&cmobile="+cmobile+"&clandline="+clandline+"&cemail="+cemail+"&cbirthday="+cbirthday;
				else
                    var str="type=2"+"&cname="+cname+"&csex="+csex+"&cposition="+cposition+"&cmobile="+cmobile+"&clandline="+clandline+"&cemail="+cemail+"&cid="+cid+"&cbirthday="+cbirthday;
                callGuestAjax(str);
            }
            function check_deleteContact(gid, cid){
                     if(window.confirm("确实要删除该联系人吗？"))
                     {
                         var str="type=6"+"&gid=" + gid + "&cid=" + cid;
                         callGuestAjax(str);
                     }
                }
		</script>
<?php } ?>		
       