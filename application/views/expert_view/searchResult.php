 <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>行业顾问搜索结果</h1>
                    </div>
                </header>
                <section class="container_12 clearfix">
                    <div class="grid_12">
                        <div id="demo" class="clearfix"> 
                            <table class="display" id="example"> 
                                <thead> 
                                           <tr>
                                            <th style="width: 8%">行业顾问姓名</th>
                                            <th  width="10%">状态</th>
                                            <th style="width: 10%">公司</th>
                                            <th style="width: 12%">部门</th>
                                            <th style="width: 12%">职位</th>
                                            <th style="width: 8%">收费标准</th>
                                            <th style="width: 8%">行业顾问等级</th>
                                            </tr>
                                </thead> 
                                <?php
                                //生成链接，一定要含有变量url_deal_click
                                if (empty($s_result)) { //先用js提示没有结果了，使用js跳转到前一个界面
                                        echo "<script language='javascript' type='text/javascript'>";
                                        echo 'alert("没有结果！");';
                                        echo "</script>";
                        
                        
                                } else {
                                    $count = 0;
                                    foreach ($s_result as $a) {
                                        if(empty($a))
                                            continue;
                                        if($count == 0)
                                                echo '<tr class="gradeA">';
                                            else
                                                echo '<tr class="gradeC">';
                                        echo '<td><a href="' .$url_deal_click. $a[0] . '">' . $a[1] . '</a></td>
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
    

    