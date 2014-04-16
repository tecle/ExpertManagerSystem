              <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>Projects Searching</h1>
                    </div>
                </header>
                <section class="container_12 clearfix">
                    <div class="portlet grid_12">
                        <header>
                            <h2>search</h2>
                        </header>
                        <section>
                            <form class="form has-validation" id="form1" name="form1" method="post" action="<?=$url_project?>/searchResult">
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
                            <form  id="form2" name="form2" method="post" action="<?=$url['project']?>/searchResult">
                				<input type="text" name="searchType" id="searchType" style="display:none" value="2" />
                                <table class="full">
                                <tbody>
                                <tr>
                                <td>
                                <div class="clearfix">
                                
                                    <label for="name" class="form-label">Project Name <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="name" name="name"  /></div>

                                </div>
                                </td>
                                <td>
                                <div class="clearfix">
                                
                                    <label for="code" class="form-label">Project Name <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="code" name="code"  /></div>

                                </div>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                <div class="clearfix">
                                
                                    <label for="em" class="form-label">Project Manager <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="em" name="em"  /></div>

                                </div>
                                </td>
                                <td>
                                <div class="clearfix">
                                
                                    <label for="dailyiquota" class="form-label">Daily Interview Quota <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="dailyiquota" name="dailyiquota"  /></div>

                                </div>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                <div class="clearfix">
                                
                                    <label for="pediscribe" class="form-label"> Detailed Request <em></em><small></small></label>

                                    <div class="form-input"><input type="text" id="pediscribe" name="pediscribe"  /></div>

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

           
 

   
  