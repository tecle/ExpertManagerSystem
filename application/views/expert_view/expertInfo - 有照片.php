
<script>
function altImag(flag){
    if(flag==1)
        $('#cng_span').show();
    if(flag==2)
        $('#cng_span').hide();
}
$(document).ready(function(){$('#cng_span').hide();})
</script>
   <section >
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>Consultant Information</h1>
                    </div>
                </header>
                
                          <section class="container_12 clearfix"> 
                    <input type="button" onclick="f('1')" value="推荐顾问"/>
                    <input type="button" onclick="f('2')" value="安排访谈"/>    
                    <div style="float: right;"><button class="button" onclick="check_deleteExpert(<?=$eid?>)" >Delete</button></div>
        
      <!--基本信息-->   
                    <section class="portlet grid_12 leading" id="section_0">
                        <header>
                            <h2>Photo<button style="float:right" onclick="altImag(1)">modify</button> </h2>
                        </header>
                        <div id="img_span" >
                            <img id="ephoto" src="<?=($expert_info['ephoto']=="")?($url['upload']."/0.jpg"):($url['upload']."/".$expert_info['ephoto'])?>" 
                                style="height: 240px;"/>
                        </div>
                        <br />
                        <div id="cng_span" >
                            <input id="imgfile" type="file" size="45" name="file" class="input"/>
                            <button class="button" id="buttonUpload" onclick="uf()">Upload</button>
                            <button class="button" id="buttonCancel" onclick="altImag(2)">Cancel</button>
                        </div>
                        <br />
                    </section>      
                    <section class="portlet grid_12 leading" id="section_1"> 
                        <input type='text' name="expertid" style="display: none;" id='expertid' value="<?=$eid?>"  />
                        <header>
                            <h2>Basic Information<button style="float:right" onclick="basicChange()">modify</button> </h2>
                        </header>
                         <section >
                         <script>
                            document.getElementById("expertno").innerHTML = getProNum(document.getElementById("eprofession").value, document.getElementById("esubprofession").value, document.getElementById("expertid").value);
                        </script>
                        <div id="basic1">
                        
                       
                            <table class="display"> 
 
                                <tbody> 
                                    <tr class="gradeA">
                                    <th>Consultant No.:</th>
                                    <td id="expertno"></td>
                                    <td><td></td></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th width="18%" >Consultant Name：</th>
                                    <td id="sename" width="32%"><?= $expert_info['ename'] ?></td>
                                    <th width="15%">Birthday：</th>
                                    <td width="35%"><?= $expert_info['ebirthday'] ?></td>
                                    </tr>
               
                                    <tr class="gradeA">
                                    <th>Gender：</th>
                                    <td id="sesex">
                                    <?php 
                                        if($expert_info['esex']=='M')
                                            echo 'Male';
                                        elseif ($expert_info['esex']=='F') 
                                            echo 'Female';
                                        else
                                            echo $expert_info['esex'];
                                    
                                    ?></td>
                                    <th> Location:</th>
                                    <td><?= $expert_info['elocation'] ?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Mobile：</th>
                                    <td id="secellphone"><?= $expert_info['emobile'] ?></td>
                                    <th>Landline：</th>
                                    <td id="selandphone"><?= $expert_info['elandline'] ?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>E-mail：</th>
                                    <td id="semail"><?= $expert_info['eemail'] ?></td>
                                    <th>MSN：</th>
                                    <td id="semsn"><?= $expert_info['emsn'] ?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>QQ：</th>
                                    <td id="seqq"><?= $expert_info['eqq'] ?></td>
                                    <th>Status：</th>
                                    <td id="sestatus"><?= $expert_info['estate'] ?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Consultant Source：</th>
                                    <td id="secomefrom"><?= $expert_info['ecomefrom'] ?></td>
                                    <td></td>
                                    <td></td>
                                    </tr>
 
                                </tbody> 
 
                            </table>
                            </div>
                        
                        
                        <div id="basic2" style="display:none">
                        <?php
                           
                            if($expert_info['elocation'])
                            {
                                $llist = explode(',',$expert_info['elocation']);
                                $init_province = $llist[0];
                                $init_city = $llist[1];
                            }
                            else
                            {
                                $init_province = '';
                                $init_city = '';
                            }
                        ?>
                                 <div style="display: none">
                                    <input type="text" name="eprovince" id="eprovince" value="<?=$init_province?>" />
                                    <input type="text" name="ecity" id="ecity" value="<?=$init_city?>" />
                                    </div>
                          <table class="full"> 
 
                                <tbody> 
                                <tr>
                          	   <td><div class="clearfix">

                                    <label for="ename" class="form-label">Consultant Name <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="ename" name="ename" value="<?= $expert_info['ename'] ?>" /></div>

                                </div>
                                </td>
                                <p></p>
                                
                               <td> <div class="clearfix">

                                    <label for="ebirthday" class="form-label">Birthday<em></em><small id="rolenote"></small></label>
                                    <div class="form-input"><input type="text" id="ebirthday" value="<?= $expert_info['ebirthday'] ?>" name="ebirthday"  onclick="WdatePicker()" /></div>
                                 </div>
                                <p></p>
                                </td>
                                </tr>
                          	 <tr>
                             
                               <td> <div class="clearfix">

                                    <label for="esex" class="form-label">Gender<em></em><small></small></label>

                                    <div class="form-input"><select id="esex" name="esex">
            						<option value="M"  <?php if($expert_info['esex']=='M') echo "selected = true"?>>Male</option>
            						<option value="F" <?php if($expert_info['esex']=='F') echo "selected = true"?>>Female</option>
                                    </select></div>

                                </div></td>
                          
                               <td><div class="clearfix">

                                    <label for="eprovinces" class="form-label">Province<em></em><small></small></label>

                                    <select id="eprovinces" name="eprovinces" style="width: 200px;">
                                    </select>

                                </div></td>
                                </tr>
                                
                               <tr>
                               <td><div class="clearfix">

                                    <label for="ecellphone" class="form-label">Mobile <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="ecellphone" name="ecellphone" value="<?=$expert_info['emobile']?>"  /></div>
                                </div> </td>
                          	   
                          	    <script type="text/javascript">
                            	lobj = document.getElementById("eprovinces");
                            	cobj = document.getElementById("ecitys");
                                init_p = document.getElementById("eprovince").value;
                                init_c = document.getElementById("ecity").value;
                                addrInit(lobj, cobj , init_p, init_c);
                            	lobj.onchange = function(){select(lobj, cobj); setEprovince();}
                            	cobj.onchange = function(){setEcity();}
                        	    </script>
                                
                                <td>
                                <div class="clearfix">

                                    <label for="ecitys" class="form-label">City<em></em><small></small></label>

                                    <select id="ecitys" name="ecitys">
                                    </select>

                                </div></td>
                                </tr>
                                <tr>
                                <td><div class="clearfix">

                                    <label for="elandphone" class="form-label">Landline <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="elandphone" name="elandphone" value="<?= $expert_info['elandline'] ?>"  /></div>

                                </div> </td>
                                
                                <td><div class="clearfix">

                                    <label for="email" class="form-label no-description">Email <em></em><small></small></label>

                                    <div class="form-input"><input type="email" name="email" id="email" value="<?= $expert_info['eemail'] ?>" /></div>

                                </div> </td>
                                </tr>
                                <tr>
                                <td><div class="clearfix">

                                    <label for="emsn" class="form-label">MSN <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="emsn" name="emsn" value="<?= $expert_info['emsn'] ?>" /></div>

                                </div> </td>   
                                
                                <td><div class="clearfix">

                                    <label for="eqq" class="form-label">QQ <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="eqq" name="eqq" value="<?= $expert_info['eqq'] ?>" /></div>

                                </div></td>
                                </tr>
                                <tr>
                                <td><div class="clearfix">

                                    <label for="ecomefrom" class="form-label">Consultant Source <em></em><small></small></label>

                                    <div class="form-input"><select id="ecomefrom" name="ecomefrom" >
            						<option value="Data base" <?php if($expert_info['ecomefrom'] == 'Data base') echo "selected = true"?>>Data base</option>
            						<option value="Cold call" <?php if($expert_info['ecomefrom'] == 'Cold call') echo "selected = true"?>>Cold call</option>
                                    <option value="CV pool" <?php if($expert_info['ecomefrom'] == 'CV pool') echo "selected = true"?>>CV pool</option>
            						<option value="Contact list" <?php if($expert_info['ecomefrom'] == 'Contact list') echo "selected = true"?>>Contact list</option>
                                    <option value="SNS" <?php if($expert_info['ecomefrom'] == 'SNS') echo "selected = true"?>>SNS</option>
            						<option value="Reference" <?php if($expert_info['ecomefrom'] == 'Reference') echo "selected = true"?>>Reference</option>
                                    <option value="Vendor" <?php if($expert_info['ecomefrom'] == 'Vendor') echo "selected = true"?>>Vendor</option>
                                    <option value="Expert excel" <?php if($expert_info['ecomefrom'] == 'Expert excel') echo "selected = true"?>>Expert excel</option>
            						<option value="Call center" <?php if($expert_info['ecomefrom'] == 'Call center') echo "selected = true"?>>Call center</option>
                                    </select></div>
                                </div></td>
                          	   
                               <td><div class="clearfix">

                                    <label for="estatus" class="form-label">Status<em>*</em><small id="rolenote"></small></label>

                                    <div class="form-input"><select id="estatus" name="estatus" onchange="statusChange()">
                                    <option value="1" <?php if($expert_info['estate'] == '获得联系方式') echo 'selected = true' ?>>获得联系方式</option>
                              	    <option value="2" <?php if($expert_info['estate'] == '聘用') echo 'selected = true' ?>>聘用</option>
                            	    <option value="3" <?php if($expert_info['estate'] == '已合作') echo 'selected = true' ?>>已合作</option>
                                    </select></div>

                                </div>
                                </td>
                          	    </tr>
                                <tr><p></p></tr>
                                <tr>
                                <td colspan="2" ><div class="form-action clearfix" style="text-align: right;">

                                    <button class="button"  onclick="basicValidate()" data-icon-primary="ui-icon-circle-check">OK</button>

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
                                </script>
                        		<script type="text/javascript">
                        		function basicValidate(){                        		
                        			alterBasicInfo();
                        		}
                        		</script>
                        </section>
                    </section> 
                    
          <!-- 收费情况-->          
                   <section class="portlet grid_12 leading"> 
                	<?php
                
                        if (isset($expert_info['alevel'])) {
                            if ($expert_info['alevel'] == "1")
                                $expert_info['alevel'] = "初级";
                            else
                                if ($expert_info['alevel'] == "2")
                                    $expert_info['alevel'] = "中级";
                                else
                                    if ($expert_info['alevel'] == '3')
                                        $expert_info['alevel'] = "高级";
                        } else {
                            $expert_info['astandard'] = "NULL";
                            $expert_info['alevel'] = "NULL";
                            $expert_info['abank'] = "NULL";
                            $expert_info['asubbranch'] = "NULL";
                            $expert_info['acardnumber'] = "NULL";
                            $expert_info['aname'] = "NULL";
                        }
                    ?>
                        
                      <script type="text/javascript">
                     
                        	function chargeChange(){
                				document.getElementById("charge2").style.display = "inline";
                				document.getElementById("charge1").style.display = "none";	
                			}
                			function chargeUnchange(){
                				document.getElementById("charge1").style.display = "inline";
                				document.getElementById("charge2").style.display = "none";	
                			}
                        </script>
                	  <script type="text/javascript">
                			function costValidate(){
                		//	if(!isEmpty(document.getElementById("ebank").value)) {if(!isName(document.getElementById("ebank").value)){alert("银行名为英文或中文"); document.getElementById("ebank").focus(); return; }}
                			//if(!isEmpty(document.getElementById("esubbank").value)) {if(!isName(document.getElementById("esubbank").value)){alert("支行名为英文或中文"); document.getElementById("esubbank").focus(); return; }}
                			//if(!isEmpty(document.getElementById("eanumber").value)) {if(!isNumber(document.getElementById("eanumber").value)){alert("银行账号为数字"); document.getElementById("eanumber").focus(); return; }}
                			//if(!isEmpty(document.getElementById("eaname").value)) {if(!isName(document.getElementById("eaname").value)){alert("开户名为英文或中文"); document.getElementById("eaname").focus(); return; }}
                			alterCost();
                			}
                	  </script>

                        <header>
                            <h2>Account Information<button style="float:right" onclick="chargeChange()">modify</button> </h2>
                        </header>
                         <section >
                         <!--收费情况列表层-->
                        <div id="charge1">
                        
                            <table class="display"> 
 
                                <tbody> 
 
                                    <tr class="gradeC">
                                    <th width="15%">Interview Rate：</th>
                                    <td width="35%" id="secharge"><?= $expert_info['astandard'] ?></td>
                                    <th width="15%">Consultant Level：</th>
                                    <td id="selevel" width="35%"><?= $expert_info['alevel'] ?></td>
                                    </tr>
               
                                    <tr class="gradeC">
                                    <th>Bank：</th>
                                    <td id="sebank"><?= $expert_info['abank'] ?></td>
                                    <th>Sub-branch：</th>
                                    <td id="sesubbank"><?= $expert_info['asubbranch'] ?></td>
                                    </tr>
                                    
                                    <tr class="gradeC">
                                    <th>Account：</th>
                                    <td id="seanumber"><?= $expert_info['acardnumber'] ?></td>
                                    <th>Account Name：</th>
                                    <td id="seaname"><?= $expert_info['aname'] ?></td>
                                    </tr>
 
                                </tbody> 
 
                            </table>
                            </div>
                        <!--收费情况修改层-->    
                        <div id="charge2" style="display: none">
                            <table class="full"> 
 
                                <tbody> 
                                <tr>
                                <td><div class="clearfix">

                                    <label for="echarge" class="form-label">Interview Rate <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="echarge" name="echarge" value="<?= $expert_info['astandard'] ?>" /></div>

                                </div></td>
                                <td><div class="clearfix">

                                    <label for="elevel" class="form-label">Consultant Level<em></em><small id="rolenote"></small></label>

                                    <div class="form-input"><select id="elevel" name="elevel">
                                        <option value="1" <?php if($expert_info['alevel']=='初级') echo "selected = true"?>>初级</option>
                         	            <option value="2" <?php if($expert_info['alevel']=='中级') echo "selected = true"?>>中级</option>
                      	                <option value="3" <?php if($expert_info['alevel']=='高级') echo "selected = true"?>>高级</option>
                                    </select></div>

                                </div></td>                                
                                </tr>
                                <tr>
                                <td><div class="clearfix">

                                    <label for="ebank" class="form-label">Bank<em></em><small id="rolenote"></small></label>

                                    <div class="form-input"><select id="ebank" name="ebank">
                                    </select></div>
                                    <input type="hidden" value="<?=$expert_info['abank']?>" id="init_bank" />
                                <script type="text/javascript">//银行加载数据
                        		setBank(document.getElementById("ebank"), document.getElementById("init_bank").value);
                        		
                        		
                        		function setBank(bobj ,init_bank){
                        		Bank = "|工商银行|农业银行|中国银行|交通银行|招商银行|建设银行|深圳发展银行|浦发银行|民生银行|华夏银行|兴业银行|中信银行|光大银行|浙商银行|广东发展银行|徽商银行|平安银行|渤海银行|中信嘉华|东莞银行|汉口银行|福建海峡银行|东亚银行|恒生银行|汇丰中国|渣打银行|花旗银行|星展银行|恒丰银行|荷兰银行|华侨银行|德意志银行|永亨银行中国|南商银行中国|友利银行中国|巴黎银行中国|三菱东京日联银行|瑞穗银行|法国兴业银行|桂林市商业银行|湛江银行|富滇银行|柳州市商业银行|吉林银行|西安银行|北京银行|上海银行|南京银行|广州银行|厦门国际银行|杭州银行|宁波银行|泉州商业银行|成都银行|厦门市商业银行|包商银行|大连银行|哈尔滨银行|大庆银行|深圳农村商业银行|上海农商行|北京农商行|进出口银行|农业发展银行|国家开发银行|鄞州银行|邮政储蓄银行"; 
                        			var banks = Bank.split("|");
                        			var oOption;
                        			for(var j = 0;j < banks.length;j++) { 
                        				oOption = document.createElement("OPTION");
                        				oOption.text= banks[j];
                        				oOption.value= banks[j];
                                        if(init_bank == banks[j])
                                            oOption.selected = true;
                        				bobj.add(oOption);
                        			}
                        		}
                        	</script>
                          
                                </div></td>
                                
                                <td><div class="clearfix">

                                        <label for="esubbank" class="form-label">Sub-branch <em></em><small></small></label>
    
                                        <div class="form-input"><input type="text" id="esubbank" name="esubbank" value="<?= $expert_info['asubbranch'] ?>"  /></div>

                                    </div> </td>
                                </tr>
                                
                                <tr>
                                <td><div class="clearfix">

                                        <label for="eanumber" class="form-label">Account <em></em><small></small></label>
    
                                        <div class="form-input"><input type="text" id="eanumber" name="eanumber" value="<?= $expert_info['acardnumber'] ?>"  /></div>

                                    </div> </td>
        
                                <td><div class="clearfix">

                                        <label for="eaname" class="form-label">Account Name <em></em><small></small></label>
    
                                        <div class="form-input"><input type="text" id="eaname" name="eaname" value="<?= $expert_info['aname'] ?>"  /></div>

                                    </div></td>
                                </tr>
                                <tr>
                                <td colspan="2" ><div class="form-action clearfix" style="text-align: right;">

                                    <button class="button"  onclick="costValidate()" data-icon-primary="ui-icon-circle-check">OK</button>

                                    <button class="button" onclick="chargeUnchange()">Cancel</button>

                                </div></td></tr>
                                </tbody>
                            </table>
                            
                       </div>                       
                                
                        </section>
                    </section>
                    <!--收费情况结束-->
                    
                    <!--备注-->
                    <section class="portlet grid_12 leading"> 

                        <header>
                            <h2>Remark/Comments<button style="float:right" onclick="noteChange()">modify</button></h2>
                        </header>
                        
                        <section>
                            <div id="note1">
                                <?= nl2br(str_replace(' ','&nbsp;',$expert_info['eremark'])) ?>
                            </div>
                            <div id="note2" style="display: none">
                				<div>
                					<textarea name="eremark" id="eremark" cols="100" rows="10"><?= $expert_info['eremark'] ?></textarea>
                				</div>
                                <div class="form-action clearfix" style="text-align: right;">

                                    <button class="button"  onclick="noteValidate()" data-icon-primary="ui-icon-circle-check">OK</button>

                                    <button class="button" onclick="noteUnchange()">Cancel</button>

                                </div>	
                			</div>
                        </section>
                        
                        
                        <script type="text/javascript">
                			function noteValidate(){
                				if(isEmpty(document.getElementById("eremark").value)) {
                					//var note = trimText(document.getElementById("cnote").value);
                				    document.getElementById("eremark").value = " ";
                				}
                				alterRemark();
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
                	<!--工作经历-->
                    
                    <div id="work">
                    <section class="portlet grid_12 leading"> 
                        <input name="cur_exp" id="cur_exp" type='text' value='0' style='display:none'/>
                        <header>
                            <h2>工作经历<button style="float:right" onclick="work1Change()">modify</button><button style="float:right" onclick="work2Change('0',0)">add</button></h2>
                        </header>
                        
                        <section>
                            <div id="work1">
                            	<table id="workul" class="full" width="100%">
                                    <tbody>
                                	<tr>
                                    <th width="10%" >所属行业：</th>
                                    <td width="40" id="seprofession"><?= $expert_info['etrade'] ?></td>
                                    <th width="10%" >所属子行业：</th>
                                    <td width="40%" id="sesubprofession"><?= $expert_info['esubtrade'] ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                             </div>
                             <div id="work2" style="display: none">
                                <form class="form has-validation" id="work" name="work">
                        		<div style="display: none">
                        		<input type="text" name="eprofession" id="eprofession" value="<?= $expert_info['etrade'] ?>" />
                        		<input type="text" name="esubprofession" id="esubprofession" value="<?= $expert_info['esubtrade'] ?>" />
                        		</div>
                                <div class="clearfix">

                                    <label for="profession" class="form-label">Industry<em></em><small></small></label>

                                    <div class="form-input"><select id="profession" name="profession">
                                    </select></div>

                                </div>
                                
                                <div class="clearfix">

                                    <label for="subprofession" class="form-label">Sub-industry<em></em><small></small></label>

                                    <div class="form-input"><select id="subprofession" name="subprofession">
                                    </select></div>

                                </div>
                                </form>
                        		   <script type="text/javascript">
                        			listPro(document.getElementById("profession"),document.getElementById("subprofession"), document.getElementById("eprofession").value, document.getElementById("esubprofession").value);
                        			document.getElementById("profession").onchange = function(){selectPro(document.getElementById("profession"),document.getElementById("subprofession")); setEprofession(); setEsubprofession();}
                        			document.getElementById("subprofession").onchange = function(){setEsubprofession();}
                        	    </script>
                                <div class="form-action clearfix" style="text-align: center;">

                                        <button class="button"  onclick="tradeValidate()">OK</button>
                                        <button  onclick="work1Unchange()" >CANCEL</button>

                                    </div>
                             
                                  
                        
                              </div>
                        </section>                  
                    </section>
                 
                 
                 <!--每个工作经历-->
                 <div id="workexp">
                    <?php
                        if (!empty($expert_exps)) {
                        ?>
                        <script>
                            function changWork_exp(){
                                document.getElementById('workexps').style.display = "block";
                            }
                        </script>
                    <section class="tabs grid_12 leading">
                        
                        <ul class="clearfix" onclick="changWork_exp()">
                        
                        <?php    
                            
                            for($p=1;$p<=sizeof($expert_exps);$p++){
                        ?>
                            <li><a>工作经历<?=$p?></a></li>     
                         <?php
                         }
                         ?>                       
                        </ul>
                        
                        <section id="workexps" style="display: none;">
                        <?php
                            $i = 0;
                            foreach ($expert_exps as $row) {
                                $i++;
                                foreach ($row as $key => $value) {
                                    if ($value == '')
                                        $exp[$key] = 'NULL';
                                    else
                                        $exp[$key] = $value;
                        
                                }
                                if ($exp['istonow'] == '1')
                                    $exp['etime'] = '至今';
                        
                        ?>  
                            <div style="display: none;">
                                <input id="exp_company<?=$i?>" value="<?= $exp['company'] ?>"/>
                                <input id="exp_agency<?=$i?>" value="<?= $exp['agency'] ?>"/>
                                <input id="exp_position<?=$i?>" value="<?= $exp['position'] ?>"/>
                                <input id="exp_stime<?=$i?>" value="<?= $exp['stime'] ?>"/>
                                <input id="exp_etime<?=$i?>" value="<?= $exp['etime'] ?>"/>
                                <input id="exp_duty<?=$i?>" value="<?= $exp['duty'] ?>"/>
                                <input id="exp_area<?=$i?>" value="<?= $exp['area'] ?>"/>
                            </div>
                            <section class="clearfix">
                    
                                <table id="workul" class="display" width="100%">
                                    <tbody>
                                    <tr>
                                    <td colspan="4" ><div class="form-action clearfix" style="text-align: right;">

                                    <button class="button"  onclick="work2Change(<?= $exp['expid']?>,<?=$i?>)" data-icon-primary="ui-icon-circle-check">Modify</button>
                                    <button class="button"  onclick="check_deleteWork(<?=$eid?>,<?=$exp['expid']?>)" data-icon-primary="ui-icon-circle-check">Delete</button>
                                    </div></td>
                                    </tr>
                                    
                                    
                                	<tr class="gradeU">
                                    <th width="15%">公司：</th>
                                    <td width="35%" id="secompany1"><?= $exp['company'] ?></td>
                                    <th width="15%">机构：</th>
                                    <td width="35%" id="sesection1"><?= $exp['agency'] ?></td>
                                    </tr>
                                    
                                    <tr class="gradeU">
                                    <th>职位：</th>
                                    <td id="seposition1"><?= $exp['position'] ?></td>
                                    <td></td><td></td>
                                    </tr>
                                    
                                    <tr class="gradeU">
                                    <th>开始时间：</th>
                                    <td id="swstime1"><?= $exp['stime'] ?></td>
                                    <th>结束时间：</th>
                                    <td id="swetime1"><?= $exp['etime'] ?></td></tr>
                                    <tr class="gradeU">
                                    <th>工作职责及经验：</th>
                                    <td id="sresponsibilities"><?= $exp['duty'] ?></td>
                                    <th>专业领域：</th>
                                    <td id="sexperisearea"><?= $exp['area'] ?></td>                                    
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
                        
                    <div id="work3" style="display: none">
                    <section class="portlet grid_12 leading"> 
                        <header>
                            <h2></h2>
                        </header>
                        
                        <section>
                            <table>
                            <tbody>
                				<tr>
                                <td>
                                <div class="clearfix">

                                    <label for="year" class="form-label">From<em>*</em><small  id="rolenote"></small></label>
                                    <div class="form-input"><input type="text" id="stime" name="stime"  onclick="WdatePicker()" /></div>                            
                                </div>
                                </td>
                                <td><div class="clearfix">
                                    
            
                                    <label for="etonow" class="form-label">To<em></em><small></small></label>
                                    <div><label><input type="checkbox" name="etonow" checked="true" onclick="tonowCheck()" id="etonow" value="1" /> 至今</label> 
                                    </div>
                                    <div id="end_time" style="display: none;">
                                    <div class="form-input"><input type="text" id="etime" name="etime"  onclick="WdatePicker()" /></div>
                                </div>
                                <script type="text/javascript">
                           		function tonowCheck(){
                            		if(document.getElementById("etonow").checked){
                            			document.getElementById("etonow").value = "1";
                            			document.getElementById("end_time").style.display = "none";
                                    }
                                    else{
                                        document.getElementById("etonow").value = "0";
                            			document.getElementById("end_time").style.display = "inline";
                                    }
                                   // alert(document.getElementById("etonow").value );
                                    
                           		}
                            		
                                </script>
                                </td>
                                </tr>
                                
                                <tr>
                                <td>
                                <div class="clearfix">

                                    <label for="ecompany" class="form-label">Company <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="ecompany" name="ecompany" required="required" /></div>

                                </div>
                                </td>
                                <td>
                                <div class="clearfix">

                                    <label for="esection" class="form-label">Department <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="esection" name="esection" required="required" /></div>

                                </div>
                                </td>
                                </tr>
                                
                                <tr>
                                <td><div class="clearfix">

                                    <label for="eposition" class="form-label">Position <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="eposition" name="eposition" required="required" /></div>

                                </div></td>
                                </tr>
                                
                                <tr>
                                <td>
                                <div> <label for="responbilities" class="form-label">Responsibility</label></div>
                                <div><textarea name="responbilities" id="responbilities" cols="45" rows="5"></textarea></div>
                                </td>
                                
                                <td>
                                <div><label for="experisearea" class="form-label">Expertise</label></div>
                                <div><textarea name="experisearea" id="experisearea" cols="45" rows="5"></textarea></div>
                                </td>
                                </tr>
                                
                                <tr>
                                <td colspan="2">
                                <div class="form-action clearfix" style="text-align: right;">

                                    <button class="button"  onclick="expValidate()" data-icon-primary="ui-icon-circle-check">OK</button>

                                    <button class="button" onclick="work2Unchange()">Cancel</button>

                                </div>	
                                </td>
                                </tr>
                            </tbody>
                			</table>
                        </section>
                    </section> 
                       
                
                      </div>
                    <script type="text/javascript">
        	function work1Change(){
				document.getElementById("work2").style.display = "inline";
				document.getElementById("work1").style.display = "none";
				document.getElementById("addExperience").disabled = true;	
			}
			function work2Change(expid, num){

                document.getElementById("cur_exp").value = expid;
				document.getElementById("work3").style.display = "inline";
				document.getElementById("workexp").style.display = "none";	                
                if(expid!='0'){
                     document.getElementById("ecompany").value = document.getElementById('exp_company'+num).value;
                     document.getElementById("esection").value = document.getElementById('exp_agency'+num).value;
                     document.getElementById("eposition").value = document.getElementById('exp_position'+num).value;
                     document.getElementById("responbilities").value = document.getElementById('exp_duty'+num).value;
                     document.getElementById("experisearea").value = document.getElementById('exp_area'+num).value;
                     document.getElementById("stime").value = document.getElementById('exp_stime'+num).value;
                     document.getElementById("etime").value = document.getElementById('exp_etime'+num).value;
                }
			}
			function work1Unchange(){
				document.getElementById("work1").style.display = "inline";
				document.getElementById("work2").style.display = "none";	
				document.getElementById("addExperience").disabled = false;
			}
			function work2Unchange(){
				document.getElementById("workexp").style.display = "inline";
				document.getElementById("work3").style.display = "none";	
			}
        </script>
		<script type="text/javascript">
		function expValidate(){
		  if(document.getElementById("cur_exp").value == '0'){
            if(isEmpty(document.getElementById("stime").value)){ alert("from不能为空"); document.getElementById("stime").focus(); return;}
			if(isEmpty(document.getElementById("ecompany").value)){ alert("公司名不能为空"); document.getElementById("ecompany").focus(); return;}
			//if(!(isProjectName(document.getElementById("ecompany").value))) {alert("公司名只能为英文或中文或数字"); document.getElementById("ecompany").focus(); return;}
			if(isEmpty(document.getElementById("esection").value)){ alert("部门不能为空"); document.getElementById("esection").focus(); return;}
		//	if(!(isName(document.getElementById("esection").value))) {alert("部门只能为英文或中文"); document.getElementById("esection").focus(); return;}
			if(isEmpty(document.getElementById("eposition").value)){ alert("职位名不能为空"); document.getElementById("eposition").focus(); return;}
		//	if(!(isName(document.getElementById("eposition").value))) {alert("职位名只能为英文或中文"); document.getElementById("eposition").focus(); return;}
			if(!isEmpty(document.getElementById("responbilities").value)) document.getElementById("responbilities").value = trimText(document.getElementById("responbilities").value);
			if(!isEmpty(document.getElementById("experisearea").value)) document.getElementById("experisearea").value = trimText(document.getElementById("experisearea").value);
			addExp();
            }
          else
            alterExp();
        
		}
		</script>
        <script type="text/javascript">
		function tradeValidate(){
			if(!isEmpty(document.getElementById("eprofession").value)) {if(!isName(document.getElementById("eprofession").value)){alert("行业名为英文或中文"); document.getElementById("ebank").focus(); return; }}
			if(!isEmpty(document.getElementById("esubprofession").value)) {if(!isName(document.getElementById("esubprofession").value)){alert("子行业名为英文或中文"); document.getElementById("ebank").focus(); return; }}
			alterTrade();
		}
	  </script>
        </div>
        
      <!--工作经历结束-->
      <!--项目合作经验--> 
                  <section class="portlet grid_12 leading"> 

                        <header>
                            <h2>项目合作</h2>
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
                                        if (!empty($projects_joined)) {
                                            $tflag = 0;
                                            foreach ($projects_joined as $row) {
                                                if($tflag == 0)
                                                    echo '<tr class="gradeA">';
                                                else
                                                    echo '<tr class="gradeC">';
                                                echo '<td width="30%">' . $row['pname'] . '</td><td width="30%">' .
                                                    "<a href='".$url['project']."/showProjectInfo/" . $row['piid'] . "'>" . '详细' .
                                                    "</a></td></tr>";
                                                $tflag = ++$tflag%2;
                                            }
                                        }
                                   ?> 
                                </tbody>
                            </table>
                           
                            
                        </section>
                        
                        
                    </section> 
                    <!--项目合作经验结束--> 
                    <!--顾问评论--> 
                 <div id="comment1">  
                <section class="tabs side grid_12 leading">
                <script>
                    function expert_comment(){
                        document.getElementById("expertcomments").style.display = "block";
                    }
                </script>
                    <button onclick="commentChange()">Add Comment</button>
                        <ul class="clearfix" onclick="expert_comment()">
                        <?php
                            if(!empty($expert_comt)){   
                                        
                                for($pc=1;$pc<=sizeof($expert_comt);$pc++){
                        ?>

                            <li><a>Comment<?= $pc?></a></li>
                        <?php
                        }
                        ?>
                        </ul>
                        <section id="expertcomments" style="display: none;">
                        
                        <?php
                              $i=0;
                                foreach($expert_comt as $row){                            
                   
                             ?>
                        
                            <section class="clearfix">
                            <div style="text-align: right;"><button class="button" onclick="check_deleteComment(<?=$eid?>,<?=$row['cmtid']?>)" data-icon-primary="ui-icon-circle-check">Delete</button></div>
                                <dl>
                                <dt>Key Questions</dt> 
                                <dd id="projectproblem<?=$i?>"><?= $row['eproblem'] ?></dd> 
                                <dt>Comments</dt> 
                                <dd id="expertcomment<?=$i?>"><?= $row['ecomment'] ?></dd> 
                            </dl> 
                            </section>
                        <?php
                        }
                        ?>
                        </section>
                        <?php
                        }
                        ?>
                    </section>
                    </div>
                    <div id="comment2" style="display: none;">
                        <section class="portlet grid_12 leading"> 
                            <form class="form has-validation">
                                <div class="clearfix">

                                    <label for="eproblem" class="form-label">Key Questions <em>*</em><small>describe this consultant</small></label>

                                    <div class="form-input form-textarea"><textarea id="eproblem" name="eproblem" required="required" rows="5"></textarea></div>

                                </div>
                                
                                <div class="clearfix">

                                    <label for="ecomment" class="form-label">Comments <em>*</em><small>consultant’s answer</small></label>

                                    <div class="form-input form-textarea"><textarea id="ecomment" name="ecomment" required="required" rows="5"></textarea></div>

                                </div>
                                </form>
                                
                                <div class="form-action clearfix" style="text-align: center;">

                                    <button class="button" onclick="commentValidate()">OK</button>

                                    <button class="button" onclick="commentUnchange()">CANCEL</button>

                                </div>
                            
                        </section>
                    </div> 
                    
         <script type="text/javascript">
		function commentValidate(){
			if(isEmpty(document.getElementById("eproblem").value)) {alert("项目问题不能为空"); document.getElementById("eproblem").focus(); return; }
			if(isEmpty(document.getElementById("ecomment").value)) {alert("顾问评论不能为空"); document.getElementById("ecomment").focus(); return; }
			addComment();
		}
        function commentChange(){
				document.getElementById("comment1").style.display = "none";
				document.getElementById("comment2").style.display = "inline";	
			}
        function commentUnchange(){
				document.getElementById("comment1").style.display = "inline";
				document.getElementById("comment2").style.display = "none";	
			}
	  </script>
   <div style="display: none;">
   <?php
    if(empty($current_work)){
        echo '<input type="text" value="0" id="isHaveWorkExp"/>';
        }
    else{
        echo '<input type="text" value="1" id="isHaveWorkExp"/>';
       ?>
         <input type="text" value="<?=$current_work['agency']?>" id="curAgency"/>
         <input type="text" value="<?=$current_work['position']?>" id="curPosition"/>
         <input type="text" value="<?=$current_work['company']?>" id="curCompany"/>
         <input type="text" value="<?=$current_work['duty']?>" id="curDuty"/>
         <input type="text" value="<?=$current_work['area']?>" id="curArea"/>
   
   <?php } ?>
   </div>
                    
                    
            </section>
            </section>
    <script type="text/javascript">
            					
				function setEprovince(){
					document.getElementById("eprovince").value = document.getElementById("eprovinces").value;
					//alert(document.getElementById("eprovince").value);
				}
				
				function setEcity(){
					document.getElementById("ecity").value = document.getElementById("ecitys").value;
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
                function init_section_display(){
                    document.getElementById('section_1').style.display = "inline";
                }
                
                function check_deleteWork(eid, wid){
                     if(window.confirm("确实要删除该工作经历吗？"))
                     {
                         deleteWork(eid, wid);
                     }
                }
                
                function check_deleteComment(eid, cmtid){
                    if(window.confirm("确实要删除该评论吗？"))
                     {
                         deleteComment(eid, cmtid);
                     }
                }
                
                function check_deleteExpert(eid){
                    if(window.confirm("确实要删除该专家所有信息吗？"))
                     {
                         deleteExpert(eid);
                     }
                }
            </script>

      
    