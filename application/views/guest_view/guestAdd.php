 <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>Add Client</h1>
                    </div>
                </header>
                <section class="container_12 clearfix">
                    <div class="portlet grid_12">
                        <header>
                            <h2>Client Information</h2>
                        </header>
                        <section>
                            
                            <form class="form has-validation" id="form1" name="form1" method="POST" action="/CIFramework/index.php/guest/welcome/addclient" enctype="multipart/form-data">
                            <h2>Basic Information</h2>
                            <div class="clearfix">

                                    <label for="gname" class="form-label">Client <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="gname" name="gname" required="required" /></div>

                            </div>
                            
                            <div class="clearfix">

                                    <label for="gtype" class="form-label">Client type<em>*</em><small></small></label>

                                    <div class="form-input"><select id="gtype" name="gtype" >
                                    <option value="咨询">咨询</option>
                           	        <option value="私募基金">私募基金</option>
                                    <option value="公募基金">公募基金</option>
                                    <option value="对冲基金">对冲基金</option>
                                    <option value="企业">企业</option>
                                    </select></div>

                            </div>
                            
                            <div class="clearfix">

                                    <label for="ghalfhour" class="form-label">Half-hour Policy<em>*</em><small></small></label>

                                    <div class="form-input"><select id="ghalfhour" name="ghalfhour" >
                                    <option value="Y">有</option>
                           	        <option value="N">无</option>
                                    </select></div>

                            </div>
                            
                            <div class="clearfix">

                                    <label for="gintroduction" class="form-label">Client Introduction <em></em><small></small></label>

                                    <div class="form-input form-textarea"><textarea id="gintroduction" name="gintroduction" rows="5"></textarea></div>

                            </div>
                            
                            <div class="clearfix">

                                    <label for="gremark" class="form-label">Remark <em></em><small></small></label>

                                    <div class="form-input form-textarea"><textarea id="gremark" name="gremark" rows="5"></textarea></div>

                            </div>
                            
                            <h2>Business Contact</h2>
                            
                            
                            <div class="clearfix">

                                    <label for="gbcname" class="form-label">Client Name <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="gbcname" name="gbcname" required="required" /></div>

                            </div>
                            
                            <div class="clearfix">

                                    <label for="byear" class="form-label">Birthday<em></em><small id="rolenote"></small></label>

                                    <div class="form-input"><input type="text" id="gbcbirthday" name="gbcbirthday"  onclick="WdatePicker()" /></div>
                                    
                            

                            </div>
                            <p></p>
                            <div class="clearfix">

                                    <label for="gbcsex" class="form-label">Gender<em></em><small></small></label>

                                    <div class="form-input"><select id="gbcsex" name="gbcsex" >
                                    <option value="M">Male</option>
                           	        <option value="F">Female</option>
                                    </select></div>

                            </div>
                            
                            <div class="clearfix">

                                    <label for="gbcposition" class="form-label">Position <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gbcposition" name="gbcposition" /></div>

                            </div>
                            
                            <div class="clearfix">

                                    <label for="gbclandphone" class="form-label">Landline <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gbclandphone" name="gbclandphone" /></div>

                            </div>
                            
                            <div class="clearfix">

                                    <label for="gbccellphone" class="form-label">Mobile <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="gbccellphone" name="gbccellphone" required="required" /></div>

                            </div>
                            
                            <div class="clearfix">

                                    <label for="gbcemail" class="form-label">Email <em>*</em><small></small></label>

                                    <div class="form-input"><input type="email" id="gbcemail" name="gbcemail" required="required"/></div>

                            </div>
                            
                            <h2>Payment Contact</h2>
                            
                            <div class="clearfix">

                                    <label for="gpcname" class="form-label">Client Name <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="gpcname" name="gpcname"  /></div>

                            </div>
                            
                            <div class="clearfix">

                                    <label for="pyear" class="form-label">Birthday<em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gpcbirthday" name="gpcbirthday"  onclick="WdatePicker()" /></div>

                            </div>
                            <p></p>
                            <div class="clearfix">

                                    <label for="gpcsex" class="form-label">Gender<em></em><small></small></label>

                                    <div class="form-input"><select id="gpcsex" name="gpcsex" >
                                    <option value="M">Male</option>
                           	        <option value="F">Female</option>
                                    </select></div>

                            </div>
                            
                            <div class="clearfix">

                                    <label for="gpcposition" class="form-label">Position <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gpcposition" name="gpcposition" /></div>

                            </div>
                            
                            <div class="clearfix">

                                    <label for="gpclandphone" class="form-label">Landline <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gpclandphone" name="gpclandphone" /></div>

                            </div>
                            
                            <div class="clearfix">

                                    <label for="gpccellphone" class="form-label">Mobile <em>*</em><small></small></label>

                                    <div class="form-input"><input type="text" id="gpccellphone" name="gpccellphone" required="required" /></div>

                            </div>
                            
                            <div class="clearfix">

                                    <label for="gpcemail" class="form-label">Email <em>*</em><small></small></label>

                                    <div class="form-input"><input type="email" id="gpcemail" name="gpcemail" required="required" /></div>

                            </div>                                                                  

                            
                            <div class="form-action clearfix">

                                        <button class="button"  onclick="validate()" data-icon-primary="ui-icon-circle-check">OK</button>

                            </div>
                         

                                

                            </form>
                        </section>
                    </div>
                </section>
            </section>

           
 