    <div class="right">
      <div class="right_title"><b>合作行业顾问状态</b>
        <div>首页 >行业顾问信息 > <span>合作行业顾问状态</span></div>
      </div>
      <div class="right_content">
      <div id="basicDiv">

	  <?php
			$rn=$result->num_rows;
			for($i=0;$i<$rn;$i++){
				$row=$result->fetch_assoc();
				$ename=getExpertName($row['eid']);
				switch($row['state']){
					case '1':
						$ste='聘用';
						$style=1;
						break;
					case '2':
						$ste='合作';
						$style=1;
						break;
					case '3':
						$ste='推荐';
						$style=1;
						break;
					case '4':
						$ste='已预约';
						$style=2;
						break;
					case '5':
						$ste='已访谈';
						$style=3;
						break;
					case '6':
						$ste='已评分';
						$style=4;
						break;
					case '7':
						$ste='已付款';
						$style=4;
						break;
					default:
						$ste='未知';
						$style=0;
						break;
				}
				$itime=$row['itime'];
				$st=$row['starttime'];
				$et=$row['endtime'];
				$tt=$row['totaltime'];
				$cost=$row['cost'];
				$sr=$row['scorer'];
				$s1=$row['s1'];
				$s2=$row['s2'];
				$s3=$row['s3'];
				$avgs=$row['avgs'];
				
				
			
	  
	  ?>
	  <hr/>
	  <div><h2>行业顾问状态信息</h2>
        	<table width="100%">
            	<tr><th width="10%">行业顾问名：</th><td width="40%" id="sename"><?=$ename?></td><th width="10%">状态：</th><td width="40%" id="sestatus"><?=$ste?></td></tr>
            </table>
        </div>
		<hr/>
	  <div><h2>合作信息</h2></div>
	  <?php 
		if($style==1){
	  ?>
        <div id="basic2"><span>无</span>
        </div>
	  <?php
		}else if($style==2){
		?>
		<div id="basic2">
		<table id="interviewtb" width="100%">
        	<tr><th>访谈安排日期：</th><td id="idatep"><?=$itime?></td><td></td><td id="idate"></td></tr>
        </table>
        </div>
		<?php
		}else if($style==3){
		?>
		<div id="basic2">
		<table id="interviewtb" width="100%">
        	<tr><th >访谈安排日期：</th><td  id="idatep"><?=$itime?></td></tr>
            <tr><th width="15%">访谈开始时间：</th><td width="35%" id="istime"><?=$st?></td><th width="15%">访谈结束时间：</th><td width="35%" id="ietime"><?=$et?></td></tr>
            <tr><th>持续时间（min）：</th><td id="iltime"><?=$tt?></td><th>访谈费用：</th><td id="ifee"><?=$cost?></td></tr>
		</table>
		</div>
		<?php
	  }else if($style==4){
		?>
		<div id="basic2">
		<table id="interviewtb" width="100%">
        	<tr><th>访谈安排日期：</th><td id="idatep"><?=$itime?></td></tr>
            <tr><th width="15%">访谈开始时间：</th><td width="35%" id="istime"><?=$st?></td><th width="15%">访谈结束时间：</th><td width="35%" id="ietime"><?=$et?></td></tr>
            <tr><th>持续时间（min）：</th><td id="iltime"><?=$tt?></td><th>访谈费用：</td><td id="ifee"><?=$cost?></td></tr>
            <tr><th>评分人：</th><td id="iscorer"><?=$sr?></td></tr>
            <tr><th>行业熟练程度：</th><td id="score1"><?=$s1?></td><th>沟通交流程度：</td><td id="score2"><?=$s2?></td></tr>
            <tr><th>未来合作可能：</th><td id="score3"><?=$s3?></td><th>综合得分：</td><td id="ascore"><?=$avgs?></td></tr>
        </table>
        </div>
		<?php
		}
	}

	  ?>
        <br />
        </div>
           <div style="text-align: center">
	     <?php
			if(expertsIsFull($pid)){
				echo '<a href="projectInfo.php?piid='.$pid.'"><img src="<?= $url['image']?>return.jpg" ></a>';
			}else{
	     ?>
        <a href="projectAddExpert1.php?piid=<?=$pid?>"><img src="<?= $url['image']?>keep_add.jpg"/></a>
        <a href="projectInfo.php?piid=<?=$pid?>"><img src="<?= $url['image']?>return.jpg" ></a>

           <?php
	     }

	     
	     ?>        </div>
            </div>
</div>
	