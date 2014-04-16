 <section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>Projects List</h1>
                    </div>
                </header>
                <section class="container_12 clearfix">
                    <div class="grid_12">
                        <div id="demo" class="clearfix"> 
                            <table class="display" id="example"> 
                                <thead> 
                                           <tr>
                                           <th width="16%">Project Client</th>
                                           <th width="16%">Project Name</th>
                                           <th width="16%">Project Code</th>
                                           <th width="16%">Project Manager</th>
                                           <th width="16%">Published Time</th>
                                           </tr>
                                </thead> 
                                
<?php
    if (!empty($r)) {
        //输出结果到网页
        $count = 0;
        foreach($r as $row) {
            if($count == 0)
                echo '<tr class="gradeA">';
            else
                echo '<tr class="gradeC">';
            
            if($row['gid']!="0")
                echo "<td><a href='".$url['guest']."/showGuestInfo/".$row['gid']."'>".$row['gname']."</a></td><td><a href='".
                    $deal_url. $row['piid'] . "'>" . $row['pname'] .
                    "</a></td><td>" . $row['pcode'] . "</td><td>" . $row['pem'] . "</td><td>" . $row['createtime'] .
                    "</td>";
            else
                echo "<td>".$row['gname']."</td><td><a href='".
                    $deal_url. $row['piid'] . "'>" . $row['pname'] .
                    "</a></td><td>" . $row['pcode'] . "</td><td>" . $row['pem'] . "</td><td>" . $row['createtime'] .
                    "</td>";
            echo "</tr>";
            
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
    
 