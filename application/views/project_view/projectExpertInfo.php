   <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>Consultant Required</h1>
                    </div>
                </header>
                <a href="<?php echo $url['project'].'/addExpert/'.$piid.'/1/1'?>"><button>ADD</button></a>
                <a href="<?php echo $url['project'].'/showProjectInfo/'.$piid?>"><button>RETURN</button></a>
                <section class="container_12 clearfix">              
                    <input type="text" id="piid" name="piid" value='<?= $piid ?>' style="display: none;"/>
                    <input type="text" id="halfhour" name="halfhour" value="<?= $ghalfhour?>" style="display: none;"/>
                	<!--合作专家-->
             
                 <!--每个合作专家-->
	  
                    <script type="text/javascript">
                	  var eidUsing;
                      var pidUsing;
                      var ecidUsing;
                        function basicChange(eid,piid,ecid,num){
                			ecidUsing=ecid;
                            pidUsing=piid;
                            eidUsing=eid;
                           	document.getElementById("basicDiv").style.display = "none";
                			document.getElementById("statusChange").style.display = "inline";
                            //初始化文本信息
                             document.getElementById("iltime").value = document.getElementById('init_tt'+num).value;
                             document.getElementById("ilhour").value = document.getElementById('init_il'+num).value;
                             document.getElementById("ifee").value = document.getElementById('init_cost'+num).value;
                             document.getElementById("ascore").value = document.getElementById('init_avgs'+num).value;
                             document.getElementById("echarge").value = document.getElementById('init_echarge'+num).value;
                             document.getElementById("esubbank").value = document.getElementById('init_esubbank'+num).value;
                             document.getElementById("eanumber").value = document.getElementById('init_eanumber'+num).value;                            
                             document.getElementById("eaname").value = document.getElementById('init_eaname'+num).value; 
                             document.getElementById("cmid").value = document.getElementById('init_cid'+num).value;
                             document.getElementById("ucmt").value = document.getElementById('init_cmt'+num).value;
                             setBank(document.getElementById("ebank"),document.getElementById('init_ebank'+num).value);                    
                             init_st = document.getElementById('init_st' + num).value;
                             init_et = document.getElementById('init_et' + num).value;
                           //初始化访谈时间
                             if(init_st){
                                document.getElementById("istime").value = init_st.split(' ')[1];
                             }
                             else{
                                document.getElementById("istime").value = '';
                             }
                             
                             if(init_et){
                                document.getElementById("ietime").value = init_et.split(' ')[1];
                             }
                             else{
                                document.getElementById("ietime").value = '';
                             }
                            //初始化访谈安排日期
                             document.getElementById('itime').value = document.getElementById('init_itime' + num).value;
                             //初始化访谈日期
                             etime = '';
                             if(init_st)
                                etime = init_st.split(' ')[0];
                             document.getElementById('idate').value = etime;
                             //初始化评分人
                             
                             init_sr = document.getElementById('init_sr' + num).value;
                            // alert(init_sr);
                            //初始化Service
                            var init_service = document.getElementById('init_service' + num).value;
                            serveobj = document.getElementById("service");
                            serveobj.length = 0;
                             oOption = document.createElement("OPTION");
                             oOption.value = '';
                             oOption.text = '------Select Service---------';
                             serveobj.add(oOption);
                             oOption = document.createElement("OPTION");
                             oOption.value = 'Phone interview';
                             oOption.text = 'Phone interview';
                             if(init_service == "Phone interview")
                                oOption.selected = true;
                             serveobj.add(oOption);
                             oOption = document.createElement("OPTION");
                             oOption.value = 'F2F interview';
                             oOption.text = 'F2F interview';
                             if(init_service == "F2F interview")
                                oOption.selected = true;
                             serveobj.add(oOption);
                             oOption = document.createElement("OPTION");
                             oOption.value = 'Field visit';
                             oOption.text = 'Field visit';
                             if(init_service == "Field visit")
                                oOption.selected = true;
                             serveobj.add(oOption);
                             oOption = document.createElement("OPTION");
                             oOption.value = 'Road show';
                             oOption.text = 'Road show';
                             if(init_service == "Road show")
                                oOption.selected = true;
                             serveobj.add(oOption);
                             oOption = document.createElement("OPTION");
                             oOption.value = 'Survey';
                             oOption.text = 'Survey';
                             if(init_service == "Survey")
                                oOption.selected = true;
                             serveobj.add(oOption);
                             oOption = document.createElement("OPTION");
                             oOption.value = 'Data';
                             oOption.text = 'Data';
                             if(init_service == "Data")
                                oOption.selected = true;
                             serveobj.add(oOption);
                             oOption = document.createElement("OPTION");
                             oOption.value = 'Document';
                             oOption.text = 'Document';
                             if(init_service == "Document")
                                oOption.selected = true;
                             serveobj.add(oOption);
                             oOption = document.createElement("OPTION");
                             oOption.value = 'Referral';
                             oOption.text = 'Referral';
                             if(init_service == "Referral")
                                oOption.selected = true;
                             serveobj.add(oOption);
                            //初始化专家等级
                             var init_elevel = document.getElementById('init_elevel' + num).value;
                             levelobj = document.getElementById("elevel");
                             levelobj.length = 0;
                             oOption = document.createElement("OPTION");
                             oOption.value = 1;
                             oOption.text = '初级';
                             if(init_elevel == '初级')
                                oOption.selected = true;
                             levelobj.add(oOption);
                              oOption = document.createElement("OPTION");
                             oOption.value = 2;
                             oOption.text = '中级';
                             if(init_elevel == "中级")
                                oOption.selected = true;
                             levelobj.add(oOption);
                              oOption = document.createElement("OPTION");
                             oOption.value = 3;
                             oOption.text = '高级';
                             if(init_elevel == "高级")
                                oOption.selected = true;
                             levelobj.add(oOption);
                             
                             var inits = new Array();
                             inits[1] = document.getElementById('init_s1' + num).value;
                             inits[2] = document.getElementById('init_s2' + num).value;
                             inits[3] = document.getElementById('init_s3' + num).value;
                             for(var scorei=1; scorei<=3; scorei++){
                                score_obj = document.getElementById('score'+scorei);
                                score_obj.length = 0;
                                for(var optioni=1; optioni<=3; optioni++){
                                    oOption = document.createElement("OPTION");
                                    oOption.value = optioni;
                                    oOption.text = optioni+'分';
                                    if(inits[scorei] == optioni)
                                        oOption.selected = true;
                                    score_obj.add(oOption);
                                }
                             }
                             init_wname = document.getElementById('init_wname'+ num).value;
                             epichargeInit(init_wname);
                             init_state = document.getElementById('init_stat'+ num).value;
                             istobj = document.getElementById('estatus');
                             istobj.length = 0;
                             oOption = document.createElement("OPTION");
                             oOption.value = 1;
                             oOption.text = '聘用';
                             if(init_state == 1)
                                oOption.selected = true;
                             istobj.add(oOption);
                              oOption = document.createElement("OPTION");
                             oOption.value = 2;
                             oOption.text = '合作';
                             if(init_state == 2)
                                oOption.selected = true;
                             istobj.add(oOption);
                              oOption = document.createElement("OPTION");
                             oOption.value = 3;
                             oOption.text = '推荐';
                             if(init_state == 3)
                                oOption.selected = true;
                             istobj.add(oOption);
                              oOption = document.createElement("OPTION");
                             oOption.value = 4;
                             oOption.text = '已预约';
                             if(init_state == 4)
                                oOption.selected = true;
                             istobj.add(oOption); oOption = document.createElement("OPTION");
                             oOption.value = 5;
                             oOption.text = '已访谈';
                             if(init_state == 5)
                                oOption.selected = true;
                             istobj.add(oOption); oOption = document.createElement("OPTION");
                             oOption.value = 6;
                             oOption.text = '已评分';
                             if(init_state == 6)
                                oOption.selected = true;
                             istobj.add(oOption);
                              oOption = document.createElement("OPTION");
                             oOption.value = 7;
                             oOption.text = '已付款';
                             if(init_state == 7)
                                oOption.selected = true;
                             istobj.add(oOption);
                             statusChange();
                              	       // <option value="1">聘用</option>
//                              	        <option value="2">合作</option>
//                                        <option value="3">推荐</option>
//                                        <option value="4">已预约</option>
//                                        <option value="5">已访谈</option>
//                                        <option value="6">已评分</option>
//                                        <option value="7">已付款</option>
                             
			         }
                 	    function basicUnchange(){
                        	document.getElementById("basicDiv").style.display = "inline";
                        	document.getElementById("statusChange").style.display = "none";
                        	}
                    </script>
                    <?php
                        if(!empty($experts)){
                        ?>
                    <section class="portlet grid_12 leading">
                         <header>
                            <h2>Consultants</h2>
                        </header>
                        <section id="consultants" >
                        
                        <div  id="basicDiv">
                        <?php
                            $p = 1;
                             foreach($experts as $row){
                			     switch($row['state']){
                					case '1':
                						$ste='聘用';
                						$style=1;
                						break;
                					case '2':
                						$ste='合作';
                						$style=1;
                						break;
                					case '3':
                						$ste='推荐';
                						$style=1;
                						break;
                					case '4':
                						$ste='已预约';
                						$style=2;
                						break;
                					case '5':
                						$ste='已访谈';
                						$style=3;
                						break;
                					case '6':
                						$ste='已评分';
                						$style=4;
                						break;
                					case '7':
                						$ste='已付款';
                						$style=4;
                						break;
                					default:
                						$ste='未知';
                						$style=0;
                						break;
                				}
                                $ename=$row['ename'];
                                $wname=$row['wname'];
                				$itime=$row['itime'];
                				$st=$row['starttime'];
                				$et=$row['endtime'];
                				$tt=$row['totaltime'];
                                $il=$row['ilhour'];
                                $sv=$row['service'];
                				$cost=$row['cost'];
                				$sr=$row['scorer'];
                				$s1=$row['s1'];
                				$s2=$row['s2'];
                				$s3=$row['s3'];
                				$avgs=$row['avgs'];
                				$eid=$row['eid'];
                                $ecid=$row['ecid'];
                                isset($row['astandard'])?$aa=$row['astandard']:$aa="";
                                isset($row['alevel'])?$bb=$row['alevel']:$bb="";
                                isset($row['abank'])?$cc=$row['abank']:$cc="";
                                isset($row['asubbranch'])?$dd=$row['asubbranch']:$dd="";
                                isset($row['acardnumber'])?$ee=$row['acardnumber']:$ee="";
                                isset($row['aname'])?$ff=$row['aname']:$ff="";
                                
                                $bb=($bb=="")?"":(($bb=='1')?"初级":(($bb=="2")?"中级":"高级"));
                                
                        ?>
                            <section class="clearfix" id="sec_<?=$p?>">
                                <div style="display: none;">
                                    <input type="text" id="init_stat<?=$p?>" value="<?=$row['state']?>" />
                                    <input type="text" id="init_cmt<?=$p?>" value="<?=$row['ucmt']?>" />
                                    <input type="text" id="init_cid<?=$p?>" value="<?=$row['comment']?>" /> 
                                    <input type="text" id="init_wname<?=$p?>" value="<?=$wname?>" />
                                    <input type="text" id="init_itime<?=$p?>" value="<?=$itime?>" />
                                    <input type="text" id="init_service<?=$p?>" value="<?=$sv?>" />
                                    <input type="text" id="init_st<?=$p?>" value="<?=$st?>" />
                                    <input type="text" id="init_et<?=$p?>" value="<?=$et?>" />
                                    <input type="text" id="init_tt<?=$p?>" value="<?=$tt?>" />
                                    <input type="text" id="init_il<?=$p?>" value="<?=$il?>" />
                                    <input type="text" id="init_cost<?=$p?>" value="<?=$cost?>" />
                                    <input type="text" id="init_sr<?=$p?>" value="<?=$sr?>" />
                                    <input type="text" id="init_s1<?=$p?>" value="<?=$s1?>" />
                                    <input type="text" id="init_s2<?=$p?>" value="<?=$s2?>" />
                                    <input type="text" id="init_s3<?=$p?>" value="<?=$s3?>" />
                                    <input type="text" id="init_avgs<?=$p?>" value="<?=$avgs?>" />  
                                    <input type="text" id="init_echarge<?=$p?>" value="<?=$aa?>" />  
                                    <input type="text" id="init_elevel<?=$p?>" value="<?=$bb?>" />  
                                    <input type="text" id="init_ebank<?=$p?>" value="<?=$cc?>" />  
                                    <input type="text" id="init_esubbank<?=$p?>" value="<?=$dd?>" />  
                                    <input type="text" id="init_eanumber<?=$p?>" value="<?=$ee?>" />
                                    <input type="text" id="init_eaname<?=$p?>" value="<?=$ff?>" />      
                                                                  
                                </div>
                                <table id="workul" class="display" width="100%">
                                    <tbody>
                                    <tr>
                                     <td colspan="2"><h2>Consultants <?=$p?></h2></td>
                                    <td colspan="2" ><div class="form-action clearfix" style="text-align: right;">
                                    
                                    <button class="button"  onclick="basicChange(<?=$eid?>,<?=$piid?>,<?=$ecid?>,<?=$p?>)" data-icon-primary="ui-icon-circle-check">Modify</button>

                                    </div></td>
                                    </tr>

                                    <tr class="gradeA">
                                    <th width="18%">Consultant Name：</th>
                                    <td id="sename" width="32%"><a href="<?= $url['expert']?>/showExpertInfo/<?=$eid?>"><?=$ename?></a></td>
                                    <th width="15%">Status：</th>
                                    <td width="35%" id="sestatus"><?=$ste?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>PIC：</th>
                                    <td><?=$wname ?></td>
                                    <td><td></td></td>
                                    </tr>
                            		<?php 
                            		if($style==1){
                            	  ?>
                            	  <?php
                            		}else if($style==2){
                            		?>	
                       	            <tr class="gradeA">
                                    <th> Interview Time：</th>
                                    <td id="idatep"><?=$itime?></td>
                                    <td></td><td></td>
                                    </tr>
                            		<?php
                            		}else if($style==3){
                            		?>
            	                    <tr class="gradeA">
                                    <th> Interview Time：</th>
                                    <td ><?=$itime?></td>
                                    <th>Service:</th>
                                    <td><?=$sv?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th width="18%">Start from：</th>
                                    <td width="32%"><?=$st?></td>
                                    <th width="15%"> To：</th>
                                    <td width="35%"><?=$et?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Time Length（min）：</th>
                                    <td><?=$tt?></td>
                                    <th> Expense：</th>
                                    <td><?=$cost?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Charge Length(h):</th>
                                    <td><?=$il?></td>
                                    <td></td><td></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Interview Rate：</th>
                                    <td id="secharge"><?=$aa?></td>
                                    <th>Consultant Level：</th>
                                    <td id="selevel"><?=$bb?></td>
                                    </tr>
               
                                    <tr class="gradeA">
                                    <th>Bank：</th>
                                    <td id="sebank"><?=$cc?></td>
                                    <th>Sub-branch：</th>
                                    <td id="sesubbank"><?=$dd?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Account：</th>
                                    <td id="seanumber"><?=$ee?></td>
                                    <th>Account Name：</th>
                                    <td id="seaname"><?=$ff?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Client comments:</th>
                                    <td colspan="3"><?=$row['ucmt']?></td>
                                    </tr>
                            		<?php
                            	  }else if($style==4){
                            		?>
                       	            <tr class="gradeA">
                                    <th>Interview Time：</th>
                                    <td><?=$itime?></td>
                                    <th>Service:</th>
                                    <td><?=$sv?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th width="18%">Start from：</th>
                                    <td width="32%"><?=$st?></td>
                                    <th width="15%">To：</th>
                                    <td width="35%"><?=$et?></td>                                    
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Time Length（min）：</th>
                                    <td><?=$tt?></td>
                                    <th>Expense：</th>
                                    <td><?=$cost?></td></tr>
                                    
                                    <tr class="gradeA">
                                    <th>Charge Length(h):</th>
                                    <td><?=$il?></td>
                                    <td></td><td></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Interview Rate：</th>
                                    <td id="secharge"><?=$aa?></td>
                                    <th>Consultant Level：</th>
                                    <td id="selevel"><?=$bb?></td>
                                    </tr>
               
                                    <tr class="gradeA">
                                    <th>Bank：</th>
                                    <td id="sebank"><?=$cc?></td>
                                    <th>Sub-branch：</th>
                                    <td id="sesubbank"><?=$dd?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Account：</th>
                                    <td id="seanumber"><?=$ee?></td>
                                    <th>Account Name：</th>
                                    <td id="seaname"><?=$ff?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Rating Marker：</th>
                                    <td><?=$sr?></td>  
                                    <td></td><td></td>                                  
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Expertise：</th>
                                    <td><?=$s1?></td>
                                    <th>Communication：</th>
                                    <td ><?=$s2?></td>
                                    </tr>
                                    
                                    <tr class="gradeA">
                                    <th>Drive and initiative：</th>
                                    <td><?=$s3?></td>
                                    <th>Total Rating：</th>
                                    <td ><?=$avgs?></td>
                                    </tr>
                                    <tr class="gradeA">
                                    <th>Client comments:</th>
                                    <td colspan="3"><?=$row['ucmt']?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </section>
                            <br />
                    <?php
                    $p++;
                            }                                              
                        ?>
                        </div>
                        <div  id="statusChange" style="display: none">
                        <section>
                        <div style="display: none">
                        	<input type="text" id="eid" name="eid" />
                            <input type="text" id="cmid" name="cmid"/>
                        </div>
                        <form class="form">
                       <div class="clearfix">
                                    <label for="estatus" class="form-label">Status<em></em><small id="rolenote"></small></label>
                              	      <div class="form-input"><select name="estatus" id="estatus" onchange="statusChange()">
                              	        <option value="1">聘用</option>
                              	        <option value="2">合作</option>
                                        <option value="3">推荐</option>
                                        <option value="4">已预约</option>
                                        <option value="5">已访谈</option>
                                        <option value="6">已评分</option>
                                        <option value="7">已付款</option>
                                      </select></div>
                                </div>
                                <div class="clearfix">

                                    <label for="epicharge" class="form-label">PIC<em>*</em><small></small></label>

                                    <div class="form-input"><select id="epicharge" name="epicharge" onchange="statusChange()">
                                    </select></div>
                                        <script>//获取admin列表
                                        var sobj = document.getElementById("epicharge");
                                        var alist;
                                        getAdminList('type=6');
                                        function getAdminList(string){
                                        $.ajax({
                                                    type: 'post',
                                                    //可选get
                                                    url: '/CIFramework/index.php/project/welcome/projectAjax',
                                                    //这里是接收数据的PHP程序
                                                    data: string,
                                                    //传给PHP的数据，多个参数用&连接
                                                    dataType: 'text',
                                                    //服务器返回的数据类型 可选XML ,Json jsonp script html text等
                                                    success: function(msg) {
                                                           // return msg;
                                                            alist = msg;
                                                            epichargeInit();
                                                            //这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
                                                    },
                                                    error: function() {
                                                            alert("获取用户列表失败!");
                                                    }
                                            })
                                    }
                                        function epichargeInit(name){
                                            var list = alist.split('|');
                                            sobj.length = 0;
                                            for(var i = 0; i < list.length-1; i++){
                                                oOption = document.createElement("OPTION");
                                                oOption.value = list[i];
                                                oOption.text = list[++i];
                                                if(name == list[i])
                                                    oOption.selected = true;
                                                sobj.add(oOption);
                                            }
                                     
                                        }
                                     </script>
                                </div>
<!--安排访谈时间-->
                                
                                <div id="preInter" style="display: none">
                                   <div style="display: none">
                              		<input type="text" name="iyearp" id="iyearp" />
                                    <input type="text" name="imonthp" id="imonthp" />
                                    <input type="text" name="idayp" id="idayp" />
                                    </div>
                                    <div class="clearfix">

                                        <label for="year" class="form-label">Interview Time<em></em><small id="rolenote"></small></label>
    
                                        <div class="form-input"><input type="text" id="itime" name="itime"  onclick="WdatePicker()" /></div>
                                        
                                    </div>
                                    <p></p>
                                   
                                  </div>
   <!--已访谈-->                          
                             <div id="interviewInfo" style="display: none"> 
                                 <div style="display: none">
                          		<input type="text" name="iyear" id="iyear" />
                                <input type="text" name="imonth" id="imonth" />
                                <input type="text" name="iday" id="iday" />
                                </div>
                                <div class="clearfix">

                                    <label for="service" class="form-label">Service<em></em><small id="rolenote"></small></label>

                                    <div class="form-input"><select id="service" name="service">
                                        
                                    </select></div>

                                </div> 
                                <div class="clearfix">

                                        <label for="year" class="form-label">Interview Time<em></em><small id="rolenote"></small></label>
    
                                        
                                        <div class="form-input"><input type="text" id="idate" name="idate"  onclick="WdatePicker()" /></div>
                            

                                    </div>
                                    <p></p>
                                
                            
                            <div class="clearfix">

                                    <label for="istime" class="form-label">Start from <em></em><small>格式为HH:MM:SS，如08:01:00</small></label>

                                    <div class="form-input"><input type="text" id="istime" name="istime" onfocus="WdatePicker({dateFmt:'HH:mm:00'});"/></div>

                            </div>  
                            <div class="clearfix">

                                    <label for="ietime" class="form-label">To <em></em><small>格式为HH:MM:SS，如08:01:00</small></label>

                                    <div class="form-input"><input type="text" id="ietime" name="ietime" onfocus="WdatePicker({dateFmt:'HH:mm:00'});"/></div>

                            </div>
                            <div class="clearfix">

                                    <label for="iltime" class="form-label">Time Length <em></em><small>点击空白处自动计算</small></label>

                                    <div class="form-input"><input type="text" id="iltime" name="iltime" onclick="calculateTime()" /></div>

                            </div>
                            <div class="clearfix">

                                    <label for="ilhour" class="form-label">Charge Length <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="ilhour" name="ilhour" /></div>

                            </div> 

                            <div class="clearfix">

                                    <label for="ifee" class="form-label">Expense <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="ifee" name="ifee" /></div>

                            </div>  
                            
                            <div class="clearfix">

                                    <label for="echarge" class="form-label">Interview Rate <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="echarge" name="echarge"/></div>

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
                                <script type="text/javascript">//银行加载数据
                        		setBank(document.getElementById("ebank"));
                        		
                        		
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
                          
                                </div>
                                
                            <div class="clearfix">

                                        <label for="esubbank" class="form-label">Sub-branch <em></em><small></small></label>
    
                                        <div class="form-input"><input type="text" id="esubbank" name="esubbank"  /></div>

                                    </div>
                            <div class="clearfix">

                                        <label for="eanumber" class="form-label">Account <em></em><small></small></label>
    
                                        <div class="form-input"><input type="text" id="eanumber" name="eanumber" /></div>

                                    </div>
        
                            <div class="clearfix">

                                        <label for="eaname" class="form-label">Account Name <em></em><small></small></label>
    
                                        <div class="form-input"><input type="text" id="eaname" name="eaname" /></div>

                                    </div>         
                        </div>
<!--已评分!-->
                        <div id="interviewScore" style="display: none">
                            <div class="clearfix">

                                    <label for="iscorer" class="form-label">Rating Marker<em></em><small></small></label>

                                    <div class="form-input"><select id="iscorer" name="iscorer" >
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
                             
                             <div class="clearfix">

                                    <label for="score1" class="form-label">Expertise<em></em><small></small></label>

                                    <div class="form-input"><select id="score1" name="score1" >
                                        <option value="1">1分</option>
                              	        <option value="2">2分</option>
                                        <option value="3">3分</option>
                                    </select></div>
                                    
                             </div>
                             <div class="clearfix">

                                    <label for="score2" class="form-label">Communication<em></em><small></small></label>

                                    <div class="form-input"><select id="score2" name="score2" >
                                        <option value="1">1分</option>
                              	        <option value="2">2分</option>
                                        <option value="3">3分</option>
                                    </select></div>
                                    
                             </div>
                             <div class="clearfix">

                                    <label for="score3" class="form-label"> Drive and initiative<em></em><small></small></label>

                                    <div class="form-input"><select id="score3" name="score3" >
                                        <option value="1">1分</option>
                              	        <option value="2">2分</option>
                                        <option value="3">3分</option>
                                    </select></div>
                                    
                             </div>

                             <div class="clearfix">

                                    <label for="ascore" class="form-label">Total Rating <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="ascore" name="ascore" onclick="calculateScore()"/></div>

                             </div>
                             
                            </div>
                            <div id="comments" style="display: none">
                                
                                <div class="clearfix">
                                    <label for="ucmt" class="form-label">Client comments <em></em><small></small></label>
                                    <div class="form-input form-textarea"><textarea id="ucmt" name="ucmt" rows="5"></textarea></div>

                                </div>
                            </div>
                            </form>
                                <div  style="text-align: right;">

                                    <button   onclick="validate()">OK</button>

                                    <button  onclick="basicUnchange()">Cancel</button>

                                </div>
                            	
                        </section>
                        </div>
                        </section>
                      	
                    </section>
                     <?php
                    }                                           
                        ?> 
        
      <!--所需专家结束-->
                    
                    
            </section>
            </section>
    
          <script type="text/javascript">
		  
          function statusChange(){
			  div1 = document.getElementById("preInter");
			  div2 = document.getElementById("interviewInfo");
			  div3 = document.getElementById("interviewScore");
              div4 = document.getElementById("comments");
			  i = document.getElementById("estatus").value;
			  if(i == 4){
				  div1.style.display = "inline";
				  div2.style.display = "none";
				  div3.style.display = "none";
                  div4.style.display = "none";
				  }
			  else if(i == 5){
				  div2.style.display = "inline";
				  div1.style.display = "none";
				  div3.style.display = "none";
                  div4.style.display = "inline";
				  }
			  else if(i == 6){
				  div3.style.display = "inline";
				  div2.style.display = "inline";
				  div1.style.display = "none";
                  div4.style.display = "inline";
				  }
              else if(i == 7){
                  div3.style.display = "none";
				  div2.style.display = "none";
				  div1.style.display = "none";
                  div4.style.display = "inline";
              }
			  else {
				  div1.style.display = "none";
				  div2.style.display = "none";
				  div3.style.display = "none";
				  }
			  }
				function calculateTime(){
					s_time = document.getElementById("istime").value.split(':');
					e_time = document.getElementById("ietime").value.split(':');
                    if(s_time==""||e_time=="")
                        return;
					a_time = (Number(e_time[0]) - Number(s_time[0]))*60 + Number(e_time[1]) - Number(s_time[1]);
                    if(a_time<=0){
                        alert('End time is too early!');
                        $('#ietime').val("");
                        return;
                    }
                    a_hour = Math.ceil(a_time/30)*Number(document.getElementById("halfhour").value);
					document.getElementById("iltime").value = a_time;
                    document.getElementById("ilhour").value = a_hour;
				}
				function calculateScore(){
					score_1 = document.getElementById("score1").value;
					score_2 = document.getElementById("score2").value;
					score_3 = document.getElementById("score3").value;
                    if(score_1==""||score_2==""||score_3=="")
                        return;
				    a_score = (Number(score_1) + Number(score_2) + Number(score_3));		
					document.getElementById("ascore").value = a_score;
				}
				function basicSubmit(){
					document.form1.submit();
					}
          </script>
	    
	    <script type="text/javascript">
 	function validate(){
			var choose=$('#estatus').attr('value');
			var eid=eidUsing;
			var piid=pidUsing;
            var ecid=ecidUsing;
            var epicharge = $('#epicharge').attr('value');
            var itime = $('#itime').attr('value');
			if((choose>=1 && choose<=3)|| choose==7)
			{
				var str="state="+choose+"&eid="+eid+"&piid="+piid + "&epicharge=" + epicharge;
			}else if(choose==4){
                if(itime==""){
					alert("请填写日期!");
					return;
				}
				var str="state=4&days="+itime+"&eid="+eid+"&piid="+piid + "&epicharge=" + epicharge;
			}else if(choose==5){
				var date=$('#idate').attr('value');
				if(date==""){
					alert("请填写日期!");
					return;
				}
				var sdate=($('#istime').attr('value')=="")?"":(date+" "+$('#istime').attr('value'));
				var edate=($('#ietime').attr('value')=="")?"":(date+" "+$('#ietime').attr('value'));
                var service=$('#service').attr('value');
				var ltime=$('#iltime').attr('value');
				var cost=$('#ifee').attr('value');
                var ilhour=$('#ilhour').attr('value');
                var echarge=$('#echarge').attr('value');
                var elevel=$('#elevel').attr('value');
                var ebank=$('#ebank').attr('value');
                var esubbank=$('#esubbank').attr('value');
                var eanumber=$('#eanumber').attr('value');
                var eaname=$('#eaname').attr('value');
				var str="state=5&starttime="+sdate+"&endtime="+edate+"&totaltime="+ltime+"&service="+service
                +"&ilhour="+ilhour+"&cost="+cost+"&eid="+eid+"&piid="+piid + "&epicharge="
                 + epicharge + "&echarge=" + echarge + "&elevel=" + elevel + "&ebank=" + ebank + "&esubbank=" + esubbank
                 + "&eanumber=" + eanumber + "&eaname=" + eaname;
			}else if(choose==6){
				var date=$('#idate').attr('value');
				if(date==""){
					alert("请填写日期!");
					return;
				}
                var sdate=($('#istime').attr('value')=="")?(date+" 0:0:0"):(date+" "+$('#istime').attr('value'));
				var edate=($('#ietime').attr('value')=="")?(date+" 0:0:0"):(date+" "+$('#ietime').attr('value'));
                var service=$('#service').attr('value');
				var ltime=$('#iltime').attr('value');
				var cost=$('#ifee').attr('value');
                var ilhour=$('#ilhour').attr('value');
                var echarge=$('#echarge').attr('value');
                var elevel=$('#elevel').attr('value');
                var ebank=$('#ebank').attr('value');
                var esubbank=$('#esubbank').attr('value');
                var eanumber=$('#eanumber').attr('value');
                var eaname=$('#eaname').attr('value');
				var scorer=$('#iscorer').attr('value');
				if(scorer==""){
					alert("评分人为空！");
						return;
					}
				var s1=$('#score1').attr('value');
				var s2=$('#score2').attr('value');
				var s3=$('#score3').attr('value');
				calculateScore();
				var avgs=$('#ascore').attr('value');
				var str="state=6&scorer="+scorer+"&s1="+s1+"&s2="+s2+"&s3="+s3+"&eid="+eid+"&piid="+piid+"&avgs="+avgs + "&epicharge=" + epicharge
                +"&starttime="+sdate+"&endtime="+edate+"&totaltime="+ltime+"&service="+service
                +"&ilhour="+ilhour+"&cost="+cost+ "&echarge=" + echarge + "&elevel=" + elevel + "&ebank=" + ebank + "&esubbank=" + esubbank
                 + "&eanumber=" + eanumber + "&eaname=" + eaname;;
                 }
            str+="&ecid="+ecid;
            //alert(str);
			callAjaxAlterEP(str);
            var cmtid = $('#cmid').attr('value');
            var ctnt = $('#ucmt').attr('value');
            str = "type=11&cmtid=" + cmtid + "&ctnt=" + ctnt;
           // alert(str);
            callAjaxToProject(str);
	}
		
 </script>

       
   