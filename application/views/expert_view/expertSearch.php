              <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>行业顾问搜索</h1>
                    </div>
                </header>
                <section class="container_12 clearfix">
                    <div class="portlet grid_12">
                        <header>
                            <h2>普通搜索</h2>
                        </header>
                        <section>
                            <form class="form has-validation" id="form1" name="form1" method="post" action="searchResult">

                                <input type="text" name="pageNow" id="pageNow" style="display:none" value="1" />
                                <input type="text" name="orderType" id="orderType" style="display:none" value="1" />
                                <input type="text" name="searchType" id="searchType" style="display:none" value="1" />
                                <div class="clearfix">

                                    <label for="keyword" class="form-label">Key word <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="keyword" name="keyword" /></div>

                                </div>
                                

                                <div class="form-action clearfix">

                                    <button class="button" type="submit" data-icon-primary="ui-icon-circle-check">OK</button>


                                </div>

                            </form>
                        </section>
                    </div>
                    
                    <div class="portlet grid_12">
                        <header>
                            <h2>高级搜索</h2>
                        </header>
                        <section>
                            <form  id="form2" name="form2" method="post" action="searchResult">
                        
                                <input type="text" name="pageNow" id="pageNow" style="display:none" value="1" />
                				<input type="text" name="orderType" id="orderType" style="display:none" value="1" />
                				<input type="text" name="searchType" id="searchType" style="display:none" value="2" />
                				<div style="display:none">
                					<input type="text" name="ep" id="ep" />
                					<input type="text" name="ec" id="ec" />
                					<input type="text" name="eprofession" id="eprofession" />
                					<input type="text" name="esubprofession" id="esubprofession" />
                				</div>
                				<script type="text/javascript">
                				function setEprovince(){
                					document.getElementById("ep").value = document.getElementById("province").value;
                					//alert(document.getElementById("ep").value);
                				}
                				
                				function setEcity(){
                					document.getElementById("ec").value = document.getElementById("city").value;
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
                                <table class="full">
                                <tbody>
                                <tr>
                                <td>
                                <div class="clearfix">
                                
                                    <label for="ename" class="form-label">姓名 <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="ename" name="ename"  /></div>

                                </div>
                                </td>
                                
                                <td><div class="clearfix">

                                    <label for="esex" class="form-label">性别<em></em><small></small></label>

                                    <div class="form-input"><select id="esex" name="esex">
                                    <option value="0">请选择</option>
            						<option value="M">男</option>
            						<option value="F">女</option>
                                    </select></div>

                                </div>
                                </td>
                                
                                <tr>
                                <td>
                                <div class="clearfix">

                                    <label for="province" class="form-label">所在省<em></em><small></small></label>

                                    <div class="form-input"><select id="province" name="province">
                                    </select></div>

                                </div>
                                </td>
                                <td>
                                <div class="clearfix">

                                    <label for="city" class="form-label">所在市<em></em><small></small></label>

                                    <div class="form-input"><select id="city" name="city">
                                    </select></div>

                                </div>
                                </td>
                                
                                <script type="text/javascript">
                    			lobj = document.getElementById("province");
                    			cobj = document.getElementById("city");
                                addrInit(lobj, cobj);
                    			lobj.onchange = function(){
                    				select(lobj, cobj); 
                    				setEprovince();
                    				}
                    			cobj.onchange = function(){
                    				setEcity();
                    				}
            	                </script>
                                </tr>
                                <tr>
                                <td>
                                <div class="clearfix">

                                    <label for="profession" class="form-label">所属行业<em></em><small></small></label>

                                    <div class="form-input"><select id="profession" name="profession">
                                    </select></div>

                                </div>
                                </td>
                                
                                <td>
                                <div class="clearfix">

                                    <label for="subprofession" class="form-label">子行业<em></em><small></small></label>

                                    <div class="form-input"><select id="subprofession" name="subprofession">
                                    </select></div>

                                </div>
                                </td>
                                </tr>
                                
                                <script type="text/javascript">
                        			listPro(document.getElementById("profession"),document.getElementById("subprofession"));
                        			document.getElementById("profession").onchange = function(){
                        				selectPro(document.getElementById("profession"),document.getElementById("subprofession")); 
                        				setEprofession(); 
                        				setEsubprofession();
                        				}
                        			document.getElementById("subprofession").onchange = function(){
                        			setEsubprofession();
                        			}
                        	    </script>
                                <td>
                                <div class="clearfix">

                                    <label for="ecompany" class="form-label">公司 <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="ecompany" name="ecompany" /></div>

                                </div>
                                </td>

                                <td><div class="clearfix">

                                    <label for="esection" class="form-label">部门<em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="esection" name="esection" /></div>

                                </div></td>
                                
                                <td>
                                <div class="clearfix">

                                    <label for="eposition" class="form-label">职位 <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="eposition" name="eposition" /></div>

                                </div>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                <div class="clearfix">

                                    <label for="responbilities" class="form-label">工作职责 <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="responbilities" name="responbilities" /></div>

                                </div>
                                </td>
                                <td>
                                <div class="clearfix">

                                    <label for="experisearea" class="form-label">专业领域 <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="experisearea" name="experisearea" /></div>

                                </div>
                                </td>
                                </tr>

                                
                                </tbody>
                                </table>

                                <div class="form-action clearfix" style="text-align: right;">

                                    <button class="button" type="submit"  data-icon-primary="ui-icon-circle-check">OK</button>
                                  

                                </div>

                            </form>
                        </section>
                    </div>
                    
                </section>
            </section>

           
  