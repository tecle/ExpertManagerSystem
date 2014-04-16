 <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>Clients List</h1>
                    </div>
                </header>
                <section class="container_12 clearfix">
                    <div class="grid_12">
                        <div id="demo" class="clearfix"> 
                            <table class="display" id="example"> 
                                <thead> 
                                           <tr>
                                           <th style="width:20%">Client</th>
                                           <th  width="20%">Client Type</th>
                                           <th style="width: 20%">Business Contact</th>
                                           <th style="width: 20%">Payment Contact</th>
                                           </tr>
                                </thead> 
                                 <?php
                                if(empty($r)){//已经到页尾
                            			echo '<script type="text/javascript">';
                            			echo 'alert("没有信息!"); ';
                            			echo '</script>';
                            	}
                            	else{//输出客户信息
                                     $count = 0;
                            		foreach($r as $row){
                            			foreach($row as $k1 => $k2){
                            				if($k2!="")
                            					$rows[$k1]=$k2;
                            				else
                            					$rows[$k1]="NULL";
                            			}
                                        if($count == 0)
                                                echo '<tr class="gradeA">';
                                            else
                                                echo '<tr class="gradeC">';
                            			echo "<td><a href='".$url['guest']."/showGuestInfo/".$rows['gid']."'>".$rows['gname']."</a></td>";
                            			echo "<td>".$rows['gtype']."</td><td>".$rows['gbclient']."</td><td>".$rows['gpclient']."</td></tr>";
                       		           $count = (++$count)%2;
                                    }
                            		
                            		
                            	}
                                ?>
                            </table>
                            <?php echo $page_str?> 
                        </div> 
                    </div>
                </section>
            </section>
    
 