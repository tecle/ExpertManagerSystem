  <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>Add Consultant Required</h1>
                    </div>
                </header>
                <section class="container_12 clearfix">
                    <div class="portlet grid_12">
                        <header>
                            <h2>Consultant Required Information</h2>
                        </header>
                        <section>
                            <form class="form has-validation" id="form1" name="form1" enctype="multipart/form-data">
                                <div style="display: none">
                                	<input type="text" id="eid" name="eid" value='<?= $eid ?>'/>
                                    <input type="text" id="piid" name="piid" value='<?= $piid ?>'/>
                                    <input type="text" id="halfhour" name="halfhour" value='<?= $ghalfhour?>' />
                                </div>
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
                                        function epichargeInit(){
                                            var list = alist.split('|');
                                            sobj.length = 0;
                                            for(var i = 0; i < list.length-1; i++){
                                                oOption = document.createElement("OPTION");
                                                oOption.value = list[i];
                                                oOption.text = list[++i];
                                                sobj.add(oOption);
                                            }
                                     
                                        }
                                     </script>
                                </div>
<!--安排访谈时间-->
                                <div id="preInter" style="display: none">
                                    <div class="clearfix">

                                        <label for="year" class="form-label">Interview Time<em></em><small id="rolenote"></small></label>
    
                                        <div class="form-input"><input type="text" id="itime" name="itime"  onclick="WdatePicker()" /></div>                     

                                    </div>
                                    <p></p>
                                   
                                  </div>
   <!--已访谈-->                          
                             <div id="interviewInfo" style="display: none"> 
                                  <div class="clearfix">

                                    <label for="service" class="form-label">Service<em></em><small id="rolenote"></small></label>

                                    <div class="form-input"><select id="service" name="service">
                                        <option value="">------Select Service---------</option>
                                        <option value="Phone interview">Phone interview</option>
                         	            <option value="F2F interview">F2F interview</option>
                      	                <option value="Field visit">Field visit</option>
                                        <option value="Road show">Road show</option>
                                        <option value="Survey">Survey</option>
                                        <option value="Data">Data</option>
                                        <option value="Document">Document</option>
                                        <option value="Referral">Referral</option>
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

                                    <div class="form-input"><input type="text" id="ietime" name="ietime" onfocus="WdatePicker({dateFmt:'HH:mm:00'});" /></div>

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
<!-- 时间控件-->

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
                                    <div style="text-align: right;">

                                        <button  onclick="validate()">OK</button>


                                    </div>                         
                                </div> 
                            
                        </section>
                    </div>
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
                  div4.style.display = "none";
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
				//	a_score = a_score.toFixed(0);				
					document.getElementById("ascore").value = a_score;
				}
				
          </script>
<script type="text/javascript">
 	function validate(){
			if(!isEmpty(document.getElementById("iltime").value) && (document.getElementById("iltime").value < 0)) {alert("结束时间要晚于开始时间"); document.getElementById("istime").focus(); return;}
			if(!isEmpty(document.getElementById("ifee").value)) {if(!isNumber(document.getElementById("ifee").value)){alert("访谈费用应为整数"); document.getElementById("ifee").focus(); return; }}
			var choose=$('#estatus').attr('value');
			var eid=$('#eid').attr('value');
			var piid=$('#piid').attr('value');
            var epicharge = $('#epicharge').attr('value');
            var itime = $('#itime').attr('value');
            var ucmt = $('#ucmt').attr('value');
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
                 + "&eanumber=" + eanumber + "&eaname=" + eaname;
			}
            str = str + "&ucmt=" + ucmt;
			callAjaxBoundEP(str,piid);
	}
		
 </script>