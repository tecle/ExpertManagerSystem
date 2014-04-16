


    <div class="right">
      <div class="right_title"><b>添加合作行业顾问</b>
        <div>首页 >行业顾问信息 > <span>添加合作行业顾问</span></div>
      </div>
      <div class="right_content">
  
 
 	<div><h2>行业顾问列表</h2></div>
    <form id="form3" name="form3" method="get" action="">
  <div id="experts">
  <div style="display:none">
      <input type="text" name="eid" id="eid" />
   </div>
		<div class="mainlist">
  		<table id="expertlist">
         <tr><th style="width: 8%">行业顾问姓名</th><th  width="10%">状态</th><th style="width: 10%">公司</th><th style="width: 12%">部门</th><th style="width: 12%">职位</th><th style="width: 8%">收费标准</th><th style="width: 8%">行业顾问等级</th></tr>
        
		<?php 
        	require '../php/search.php';
			if($sway==1){//全部显示
				$experts=searchAllExperts($pageNow,$pageSize);
				$pm='&searchType='.$sway;
				
			}
		else if($sway==2){//简单搜索，获取搜索关键字
			$kw=$_GET['keyword'];
        		if(!empty($kw)){//如果kw非空,获取符合条件的eid
        			$experts=searchExperts($kw,$pageNow,$pageSize);
				$pm='&searchType='.$sway.'&keyword='.$kw;
			}else{
					echo "<script language='javascript' type='text/javascript'>";
					echo 'alert("空的关键字！");';
					echo 'window.location.href="projetAddExpert1.php?piid="'.$pid.';';
					echo "</script>";
					exit;
        		}
		}
		else if($sway==3){//高级搜索
			$k['ename']=$_GET['ename'];
			$k['esex']=$_GET['esex'];
			$k['eprofession']=$_GET['eprofession'];
			$k['esubprofession']=$_GET['esubprofession'];
			if(empty($_GET['ep'])){
				$k['loc']="";
			}else if(empty($_GET['ec'])){
				$k['loc']=$_GET['ep'];
			}else{
				$k['loc']=$_GET['ep'].",".$_GET['ec'];
			}
			if($k['esex']=='0')//若用户为点击性别，则性别为空
				$k['esex']=""; 
			$k['ecompany']=$_GET['ecompany'];
			$k['esection']=$_GET['esection'];
			$k['eposition']=$_GET['eposition'];
			$k['responbilities']=$_GET['responbilities'];
			$k['experisearea']=$_GET['experisearea'];
			
			$isEmptyKW=true;
			foreach($k as $key => $value){
				if(!empty($value)){
					$isEmptyKW=false;
					break;
				}
			}
	
			if($isEmptyKW){
				echo "<script language='javascript' type='text/javascript'>";
					echo 'alert("您并没有给出一个搜索条件！");';
					echo 'window.location.href="projetAddExpert1.php?piid="'.$pid.';';
					echo "</script>";
					exit;
			}else{			 
				//$experts=searchExpertsWithMK($q,$i,$pageNow,$pageSize,$ot);//获取符合条件的行业顾问的eid
				//设置后缀参数
				$experts=searchExpertsWithMK($k,$pageNow,$pageSize,$ot);
				$pm="";
				foreach($k as $kk => $vk){
					$pm=$pm."&".$kk."=".$vk;
				}
				$pm=$pm.'&searchType='.$sway.'&orderType='.$ot.'&ep='.$_GET['ep'].'&ec='.$_GET['ec'];
				//将行业顾问信息保存在数组中
				
			}
		
		}
		
		//这里格式化输出数据
		if(!$experts){//先用js提示没有结果了，使用js跳转到前一个界面
				if($pageNow>1){
					echo "<script language='javascript' type='text/javascript'>";
					echo 'alert("已到达页尾！");';
					echo 'window.location.href="projectAddExpert1.php?pageNow='.($pageNow-1).'&piid='.$pid.$pm.'";';
					echo "</script>";
				}else{
					echo "<script language='javascript' type='text/javascript'>";
					echo 'alert("没有结果！");';
					echo 'window.location.href="projectAddExpert1.php?piid="'.$pid.';';
					echo "</script>";		
				}

        	}
        	else{
			$rn=$experts->num_rows;
        		for($i=0;$i<$rn;$i++){
        			$row=$experts->fetch_assoc();	
				$eids[$i]=$row['eid'];
				}
			foreach($eids as $ke => $ve){
				$a=getExpertMainInfo($ve); 
		   		echo '<tr><td><a href="projectAddExpert2.php?piid='.$pid.'&eid='.$ve.'">'.$a[1].'</a></td>
					<td>'.$a[2].'</td><td>'.$a[3].'</td><td>'.$a[4].'</td>
					<td>'.$a[5].'</td><td>'.$a[6].'</td><td>'.$a[7].'</td></tr>';

        		}
        	}
        ?>
		
        </table>
		</div>
        <br />
		<hr/>
		<div class="pageInation">
		<?php 
  				echo '<a href="projectAddExpert1.php?piid='.$pid.'&pageNow=1'.$pm.'">首页</a>';
  				if($pageNow>1)
  					echo '<a href="projectAddExpert1.php?piid='.$pid.'&pageNow='.($pageNow-1).$pm.'">上一页</a>';
  				echo '<a href="projectAddExpert1.php?piid='.$pid.'&pageNow='.($pageNow+1).$pm.'">下一页</a>';
  			?>
			</div>
  
  </form>
   <script type="text/javascript">
        	function eformSubmit(){
				document.eform.submit();	
			}
        </script>
    <div class="clear"></div>
    
<div class="clear"></div>
</div>
</div>
</div>
