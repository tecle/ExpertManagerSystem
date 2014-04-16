
<input type="text" name="proid" id="proid" style="display:none" value="<?= $pid ?>"/>
<?php
foreach ($project_basic as $k => $v)
    $bi[$k] = $v;
if (empty($project_guest)) { //如果没有结果
    $pguest = '<a href="' . $url_to_guest_main . '" target="_blank">查看所有客户</a>';
    $gbcname = '';
} else { //找到了客户
    $pguest = '<a href="' . $url_to_guest_main . '/showGuestInfo/' . $project_guest['cid'] .
        '" target="_blank" alt="点击查看客户信息">' . $project_guest['gname'] . '</a>';
    $gbcname = $project_guest['gbcname'];
}

if (!empty($project_detail) ) {
    foreach ($project_detail as $k => $v)
        $bd[$k] = $v;
} else { //若没有详细信息，则不能给出详细信息表

}
?>

 <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>Project Information</h1>
                    </div>
                </header>
                <a href='<?= $url_project?>/buildPdf/<?=$pid?>' target="_blank"><button>打印pdf</button></a>
                <div style="text-align: right;"><button class="button" onclick="check_deleteProject(<?=$pid?>)" >Delete</button></div>
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
                                    <th width="15%">Project Name:</th>
                                    <td id="spname" width="35%"><?= $bi['pname'] ?></td>
                                    <th width="15%">Project Code:</th>
                                    <td width="40%" id="spcode"><?= $bi['pcode'] ?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Client:</th>
                                    <td id="spclient"><?= $pguest ?></td>                                    
                                    <th>Main Contact:</th>
                                    <td><?= isset($project_detail['contact'])?$project_detail['contact']:""?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Project Manager:</th>
                                    <td id="spem"><?= $bi['pem'] ?></td>
                                    <th>Mobile No:</th>
                                    <td><?= $bi['pemcontact']?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Published Time:</th>
                                    <td id="spcode"><?= $bi['createtime'] ?></td>
                                    <td><td></td></td>
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

                                    <label for="pname" class="form-label">Project Name <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="pname" name="pname" value="<?= $bi['pname'] ?>"  /></div>

                                </div>
                                </td>
                                <td>
                                <div class="clearfix">

                                    <label for="pcode" class="form-label">Project Code <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="pcode" name="pcode" value="<?= $bi['pcode'] ?>" /></div>

                                </div>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                <div class="clearfix">

                                    <label for="pem" class="form-label">Project Manager <em></em><small></small></label>

                                    <div class="form-input"><select name="pem" id="pem" >
                                        <option value="">请选择联系人</option>
                                    <?php
                                        if($contact_list){
                                            foreach($contact_list as $contacts){
                                    ?>
                              	        <option value="<?=$contacts?>"><?=$contacts?></option>
                           	        <?php
                                       }}
                                       else{
                                       ?>
                                            <option value="">请先关联客户</option>
                                    <?php
                                    }
                                    ?>
                                      </select></div>
                                </div>
                                </td>
                                <td>
                                <div class="clearfix">

                                    <label for="pcontact" class="form-label">Main Contact <em></em><small></small></label>

                                    <div class="form-input"><select name="pcontact" id="pcontact" >
                                        <option value="">请选择联系人</option>
                                    <?php
                                        if($contact_list){
                                            foreach($contact_list as $contacts){
                                    ?>
                              	        <option value="<?=$contacts?>"><?=$contacts?></option>
                           	        <?php
                                       }}
                                       else{
                                       ?>
                                            <option value="">请先关联客户</option>
                                    <?php
                                    }
                                    ?>
                                      </select></div>
                                </div>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                <div class="clearfix">

                                    <label for="pemcontact" class="form-label">Mobile No <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="pemcontact" name="pemcontact" value="<?= $bi['pemcontact']?>" /></div>

                                </div>
                                </td>
                                </tr>
                                <tr>
                                <td colspan="2" ><div  style="text-align: right;">

                                    <button class="button"  onclick="alterProBasic()">OK</button>

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
                        </section>
                    </section> 
                 
                 <!--客户偏好-->   
                    <section class="portlet grid_12 leading"> 
                        <header>
                            <h2>Client Preference<button style="float:right" onclick="needChange()">modify</button> </h2>
                        </header>
                         <section >
    	
        
        
  	
      <script type="text/javascript">
        	function needChange(){
				document.getElementById("need2").style.display = "inline";
				document.getElementById("need1").style.display = "none";	
			}
			function needUnchange(){
				document.getElementById("need1").style.display = "inline";
				document.getElementById("need2").style.display = "none";	
			}
        </script>
  
                        <div id="need1">
        	
                            <table class="display"> 
 
                                <tbody> 
                                
                                <tr class="gradeC">
                                <th width="18%">Consultant Required:</th>
                                <td width="32%"><?=isset($project_detail['eneed'])?$project_detail['eneed']:""?></td>
                                <th width="15%">Deadline：</th>
                                <td width="35%"><?=isset($project_detail['endtime'])?$project_detail['endtime']:""?></td>
                                </tr>
                                
                                <tr class="gradeC">
                                <th>Update Frequency：</th>
                                <td><?=isset($project_detail['updatefreq'])?$project_detail['updatefreq']:""?></td>
                                <th>Contact Approach：</th>
                                <td><?=isset($project_detail['comchannel'])?$project_detail['comchannel']:""?></td>
                                </tr>
                                
                                <tr class="gradeC">
                                <th>Daily Interview Quota：</th>
                                <td><?=isset($project_detail['dailyiquota'])?$project_detail['dailyiquota']:""?></td>
                                <th>Interview SMS:</th>
                                <td><?=isset($project_detail['isms'])?$project_detail['isms']:""?></td>
                                </tr>
                                    
 
                                </tbody> 
 
                            </table>
                            </div>
                        
                        
                        <div id="need2" style="display:none">
                            
                          <table class="full"> 
 
                                <tbody>
                                <tr>
                                <td>
                                <div class="clearfix">

                                    <label for="peneed" class="form-label"> Consultant Required <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="peneed" name="peneed" value="<?=isset($project_detail['eneed'])?$project_detail['eneed']:""?>" /></div>

                                </div>
                                </td>
                                <td>
                                <div class="clearfix">

                                    <label for="eyear" class="form-label">Deadline<em></em><small id="rolenote"></small></label>
                                    <div class="form-input"><input type="text" id="endtime" name="endtime" value="<?=isset($project_detail['endtime'])?$project_detail['endtime']:""?>"  onclick="WdatePicker()" /></div>
                                    
                                    </div>
                                </td>
                                <p></p>
                            </tr>
                            <tr>
                            <td>
                                <div class="clearfix">

                                    <label for="updatefreq" class="form-label"> Update Frequency <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="updatefreq" name="updatefreq" value="<?=isset($project_detail['updatefreq'])?$project_detail['updatefreq']:""?>" /></div>

                                </div>
                                </td>
                                <td>
                                <div class="clearfix">

                                    <label for="comchannel" class="form-label"> Contact Approach <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="comchannel" name="comchannel" value="<?=isset($project_detail['comchannel'])?$project_detail['comchannel']:""?>" /></div>

                                </div>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                <div class="clearfix">

                                    <label for="iSMS" class="form-label"> Interview SMS <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="iSMS" name="iSMS" value="<?=isset($project_detail['isms'])?$project_detail['isms']:""?>" /></div>

                                </div>
                                </td>
                                <td>
                                <div class="clearfix">

                                    <label for="dailyiquota" class="form-label">Daily Interview Quota <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="dailyiquota" name="dailyiquota" value="<?=isset($project_detail['dailyiquota'])?$project_detail['dailyiquota']:""?>" /></div>

                                </div>
                                </td>
                                <tr>
                                <td colspan="2" ><div  style="text-align: right;">

                                    <button class="button"  onclick="alterNeedInfo()">OK</button>

                                    <button class="button" onclick="needUnchange()">Cancel</button>

                                </div></td></tr>
                          </tbody>
                </table>
                        
                                </div>
                             
                        </section>
                    </section> 
                    
                    
                    
                    <!--详细需求-->
                    <section class="portlet grid_12 leading"> 

                        <header>
                            <h2> Detailed Request<button style="float:right" onclick="discribeChange()">modify</button></h2>
                        </header>
                       <section>
                            <div id="discribe1">
                                <?=nl2br(str_replace(' ','&nbsp;',isset($project_detail['pediscribe'])?$project_detail['pediscribe']:""))?>
                            </div>
                            <div id="discribe2" style="display: none">
                				<div>
                					<textarea name="pediscribe" id="pediscribe" cols="100" rows="10"><?=isset($project_detail['pediscribe'])?$project_detail['pediscribe']:""?></textarea>
                				</div>
                                <div class="form-action clearfix" style="text-align: right;">

                                    <button class="button"  onclick="discribeValidate()" data-icon-primary="ui-icon-circle-check">OK</button>

                                    <button class="button" onclick="discribeUnchange()">Cancel</button>

                                </div>	
                			</div>
                        </section>
                        
                        
                        <script type="text/javascript">
            			function discribeValidate(){
            				if(document.getElementById("pediscribe").value!="") {
            					//var note = trimText(document.getElementById("cnote").value);
            					alterProDiscribe();
            				}
            				
            			}
            			function discribeChange(){
            					document.getElementById("discribe2").style.display = "inline";
            					document.getElementById("discribe1").style.display = "none";
            				}
            				
            			function discribeUnchange(){
            				document.getElementById("discribe1").style.display = "inline";
            				document.getElementById("discribe2").style.display = "none";	
            				
            			}
            			</script>

                    </section> 
                    
                     <!--详细需求结束-->
                     
                     <!--备注-->
                    <section class="portlet grid_12 leading"> 

                        <header>
                            <h2>Remark<button style="float:right" onclick="noteChange()">modify</button></h2>
                        </header>
			
                        <section>
                            <div id="note1">
                                <?=nl2br(str_replace(' ','&nbsp;',isset($project_detail['premark'])?$project_detail['premark']:""))?>
                            </div>
                            <div id="note2" style="display: none">
                				<div>
                					<textarea name="premark" id="premark" cols="100" rows="10"><?=isset($project_detail['premark'])?$project_detail['premark']:""?></textarea>
                				</div>
                                <div class="form-action clearfix" style="text-align: right;">

                                    <button class="button"  onclick="noteValidate()" data-icon-primary="ui-icon-circle-check">OK</button>

                                    <button class="button" onclick="noteUnchange()">Cancel</button>

                                </div>	
                			</div>
                        </section>
                        
                        
                        <script type="text/javascript">
            			function noteValidate(){
            				if(document.getElementById("premark").value!="") {
            					alterProRemark();
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
   
      <!--合作专家--> 
                  <section class="portlet grid_12 leading"> 

                        <header>
                            <h2>Consultants <a href="<?=$url_project?>/addExpert/<?= $pid ?>/1/1"><button>Add</button></a></h2>
                        </header>
    
                        <section>
                            <table class="display">
                                <thead> 
                                      <tr>
                                        <th style="text-align:left" width="18%">Consultant Name</td>
                                        <th style="text-align:left" width="22%">Company</th>
                                        <th style="text-align:left" width="8%">Status</th>
                                        <th style="text-align:left" width="22%">Interview Start Time</th>
                                        <th style="text-align:left" width="10%">TotalTime(min)</th>
                                        <th style="text-align:left" width="20%">Detail</th>
                                      </tr>     
                                </thead> 
                                <tbody>
<?php

if (!empty($project_expert)) {
    $tflag = 0;
    foreach ($project_expert as $row) {
        $url_added = $url_project."/addExpertFinish/"  . $pid;
        $st = $row['state'];
        if (empty($st))
            $st = "没有相关信息";
        else {
            switch ($st) {
                case '1':
                    $st = '聘用';
                    break;
                case '2':
                    $st = '合作';
                    //$style=1;
                    break;
                case '3':
                    $st = '推荐';
                    //$style=1;
                    break;
                case '4':
                    $st = '已预约';
                    //$style=2;
                    break;
                case '5':
                    $st = '已访谈';
                    //$style=3;
                    break;
                case '6':
                    $st = '已评分';
                    //$style=4;
                    break;
                case '7':
                    $st = '已付款';
                    //$style=4;
                    break;
                default:
                    $st = '待定';
                    //$style=0;
                    break;
            }

        }
        if($tflag == 0)
            echo '<tr class="gradeA" id="etr'.$row['eid'].'">';
        else
            echo '<tr class="gradeC" id="etr'.$row['eid'].'">';
?>
        	
                <td><?= $row['ename'] ?></td>
                <td><?= $row['ecompany'] ?></td>
                <td><?= $st ?></td>   
                <td><?= $row['starttime'] ?></td> 
                <td><?= $row['totaltime'] ?></td>              
                <td>
                    <a href="<?= $url_added ?>">查看详细</a>
                    <button onclick="deleteExpert9(<?=$row['ecid']?>)">删除顾问</button>
                </td></tr>
            
           <?php
           $tflag = ++$tflag%2;
    }}
?>
                                </tbody>
                            </table>                                           
                        </section>
                    </section> 
                    <!--项目合作经验结束--> 
            </section>
            </section>

	<script>
    ;
    function deleteExpert9(ecid){
        var delUrl="/CIFramework/index.php/project/welcome/projectAjax";
        if(window.confirm("确实要删除该顾问吗？")){
            var data={
                type:"9",
                ecid:ecid
            };
             $.ajax({
    			url:delUrl,
                type:"POST",
    			dataType:"text",
    			data:data,
    			success:function(data0){
    			     if($.trim(data0)=="y"){
    			         alert("Delete Success!");
                         $('#etr'+eid).remove();
    			     }else if($.trim(data0)=="n"){
    			         alert("Delete Failed!");
    			     }else
                         alert(data0);
    			},
    			error:function(data,statu,e){
    				alert(e);
    			}
    		});
        }
    }
    function check_deleteProject(pid){
        if(window.confirm("确实要删除该项目所有信息吗？"))
         {
             deleteProject(pid);
         }
    }
    </script>