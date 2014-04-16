 <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>行业顾问信息</h1>
                        <button onclick="expertExcelGui()">导出顾问信息</button>
                        <button onclick="interviewExcelGui()">导出访谈信息</button>
                    </div>
                </header>
                <section class="container_12 clearfix">
                    <div class="grid_12">
                        <div id="demo" class="clearfix"> 
                            <table class="display" id="example"> 
                                <thead> 
                                           <tr>
                                            <th style="width: 8%">Consultant Name</th>
                                            <th  width="10%">Status</th>
                                            <th style="width: 10%">Company</th>
                                            <th style="width: 12%">Department</th>
                                            <th style="width: 12%">Position</th>
                                            <th style="width: 8%">Interview Rate</th>
                                            <th style="width: 8%">Consultant Level</th>
                                            </tr>
                                </thead> 
                                 <?php

                                if (!empty($r)) {
                                    $count = 0;
                                    foreach ($r as $a) { //输出信息
                                        if($count == 0)
                                                echo '<tr class="gradeA">';
                                            else
                                                echo '<tr class="gradeC">';
                                        echo '<td><a href="' .$url['expert'].'/showExpertInfo/'. $a[0] . '">' . $a[1] . '</a></td>
                                					<td>' . $a[2] . '</td><td>' . $a[3] . '</td><td>' . $a[4] . '</td>
                                					<td>' . $a[5] . '</td><td>' . $a[6] . '</td><td>' . $a[7] . '</td></tr>';
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
    

    
   