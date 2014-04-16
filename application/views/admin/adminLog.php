 <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>日志信息</h1>
                    </div>
                </header>
                <section class="container_12 clearfix">
                    <div class="grid_12">
                        <div id="demo" class="clearfix"> 
                            <table class="display" id="example"> 
                                <thead> 
                                    <tr> 
                                         <th style="width:20%">操作人员</th>
                                         <th style="width: 40%">操作日期</th>
                                         <th style="width: 40%">操作内容</th>
                                    </tr> 
                                </thead> 
                                <?php 
            
                                if(empty($log_data_array)){
                                    ;
                                }else
                                foreach($log_data_array as $k=>$v){
                                        echo $v;
                                        }
                                       
                                ?>	
                            </table>
                            <?php echo $page_str?> 
                        </div> 
                        <input type="button" id="button1" value="日志删除" onclick="delLogGui()"/>
                    </div>
                </section>
            </section>
    
