              <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>Clients Searching</h1>
                    </div>
                </header>
                <section class="container_12 clearfix">
                    <div class="portlet grid_12">
                        <header>
                            <h2>search</h2>
                        </header>
                        <section>
                            <form class="form has-validation" id="form1" name="form1" method="post" action="<?=$url['guest']?>/searchResult">
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
                            <h2>advanced search</h2>
                        </header>
                        <section>
                            <form  id="form2" name="form2" method="post" action="<?=$url['guest']?>/searchResult">
                				<input type="text" name="searchType" id="searchType" style="display:none" value="2" />
                                <table class="full">
                                <tbody>
                                <tr>
                                <td>
                                <div class="clearfix">
                                
                                    <label for="gname" class="form-label">Client <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gname" name="gname"  /></div>

                                </div>
                                </td>
                                
                                <td><div class="clearfix">

                                    <label for="gtype" class="form-label">ClientType<em></em><small></small></label>

                                    <div class="form-input"><select id="gtype" name="gtype">
                                        <option value="0">所有类型</option>
                              	        <option value="咨询">咨询</option>
                              	        <option value="私募基金">私募基金</option>
                                        <option value="公募基金">公募基金</option>
                                        <option value="对冲基金">对冲基金</option>
                                        <option value="企业">企业</option>
                                    </select></div>

                                </div>
                                </td>
                                
                                </tr>
                                <tr>
                                <td>
                                <div class="clearfix">

                                    <label for="gbclient" class="form-label">Business Contact <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gbclient" name="gbclient" /></div>

                                </div>
                                </td>

                                <td><div class="clearfix">

                                    <label for="gpclient" class="form-label">Payment Contact<em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gpclient" name="gpclient" /></div>

                                </div></td>
                                </tr>
                                <tr>
                                <td>
                                <div class="clearfix">

                                    <label for="gintroduction" class="form-label"> Client Introduction  <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gintroduction" name="gintroduction" /></div>

                                </div>
                                </td>
                                <td>
                                <div class="clearfix">

                                    <label for="gremark" class="form-label"> Remark <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="gremark" name="gremark" /></div>

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

           
 

   