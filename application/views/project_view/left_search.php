<aside>
    <nav>
          <ul>
            <li <?php if($page_stat == 1) echo "class='current'"; ?>><a href="<?= $url_left['projectMain'] ?>" >Projects List</a></li>
            <li  <?php if($page_stat == 2) echo "class='current'"; ?>><a href="<?= $url_left['projectSearch']?>">Search</a></li>
            <li <?php if($page_stat == 3) echo "class='current'"; ?>><a href="<?= $url_left['projectAdd']?>" >Add</a></li>
            <li <?php if($page_stat == 4) echo "class='current'"; ?>><a>Detailed Information</a></li>
            <li <?php if($page_stat == 5) echo "class='current'"; ?>><a>Consultant Required</a></li>
            <li <?php if($page_stat == 6 || $page_stat == 7) echo "class='current'"; ?>><a>Add Consultant Required</a></li>
          </ul>
    </nav>
    <nav>
                    <h2>搜索</h2>
                    <ul>
                        <li><a href="<?=$url['project']?>/addExpert/<?=$pid?>/1/1">显示全部专家</a></li>
                        <li><a onclick="searchGui()">普通搜索</a></li>
                        <li><a onclick="hsearchGui()">高级搜索</a></li>
                    </ul>
                </nav>
</aside>  
<!--
<div class="box_1">
<a href="<?=$url['project']?>/addExpert/<?=$pid?>/1/1">显示全部专家</a>
		<div class="left_title"><input type="checkbox" name="select1" id="select1" onclick="search()" /> 普通搜索</h5></div>
		<div class="left_news" id="normal_search" style="display:none">
	<form id="form1" name="form1" method="post" action="<?= $url['project']?>/addExpert/<?= $pid?>/" >
		<div>
			<label for="keyword">关键字</label>
			<input type="text" name="keyword" id="keyword" />
		</div>
		<input type="text" name="searchType" id="searchType" value="2" style="display:none" />
		<input type="text" name="piid" id="piid" style="display:none" value="<?=$pid?>"/>
		<input type="submit" name="search" id="search2" style="float:right" value="提交" />
    </form>
        </div>
		
      </div>
	  <script type="text/javascript">
		function search(){
				if (document.getElementById("select1").checked) 
					document.getElementById("normal_search").style.display = "inline";
				else 
					document.getElementById("normal_search").style.display = "none";
			}
		function hsearch(){
				if (document.getElementById("select2").checked) document.getElementById("complex_search").style.display = "inline";
				else document.getElementById("complex_search").style.display = "none";
			}
		</script>
      <div class="box_1">
        <div class="left_title"><input type="checkbox" name="select2" id="select2" onclick="hsearch()" />高级搜索</div>
        <div class="left_news" id="complex_search" style="display:none">
          <form id="form2" name="form2" method="post" action="<?= $url['project']?>/addExpert/<?= $pid?>">
		<input type="text" name="searchType" id="searchType" value="3" style="display:none" />
		<input type="text" name="piid" id="piid" style="display:none" value="<?=$pid?>"/>
      	<div style="display:none">
					<input type="text" name="ep" id="ep" />
					<input type="text" name="ec" id="ec" />
					<input type="text" name="eprofession" id="eprofession" />
					<input type="text" name="esubprofession" id="esubprofession" />
				</div>
				<script type="text/javascript">
				function setEprovince(){
					document.getElementById("ep").value = document.getElementById("province").value;
				}
				
				function setEcity(){
					document.getElementById("ec").value = document.getElementById("city").value;
				}
				
				function setEprofession(){
					document.getElementById("eprofession").value = document.getElementById("profession").value;
				}
				
				function setEsubprofession(){
					document.getElementById("esubprofession").value = document.getElementById("subprofession").value;
				}
				</script>
				<div>
					<label for="ename">姓名:</label>
					<input type="text" name="ename" id="ename" />
				</div>
				<div>
					<label for="esex">性别:</label>
					<select name="esex" id="esex">
						<option value="0">请选择</option>
						<option value="M">男</option>
						<option value="F">女</option>
					</select>
				</div>
				<div>所在地：
				<p>
				<select name="province" id="province">
			  </select>
			  省
			  <select name="city" id="city">
			  </select>
			  市
			  </div>
  	    <script type="text/javascript">
			lobj = document.getElementById("province");
			cobj = document.getElementById("city");
            addrInit(lobj, cobj);
			lobj.onchange = function(){select(lobj, cobj); setEprovince();}
			cobj.onchange = function(){setEcity();}
	    </script>
		<div><label for="profession">所属行业:</label>
  	      <select name="profession" id="profession" >
  	      </select>
	    </div>
	    <div><label for="subprofession">子行业:</label>
		<p>
  	      <select name="subprofession" id="subprofession" >
  	      </select>
		   <script type="text/javascript">
			listPro(document.getElementById("profession"),document.getElementById("subprofession"));
			document.getElementById("profession").onchange = function(){selectPro(document.getElementById("profession"),document.getElementById("subprofession")); setEprofession(); setEsubprofession();}
			document.getElementById("subprofession").onchange = function(){setEsubprofession();}
	    </script>
	    </div>
		<div> <label for="ecompany">公司：</label>
        <input type="text" name="ecompany" id="company" /></div>
      <div>  <label for="esection">部门：</label></div>
       <div> <input type="text" name="esection" id="esection" /></div>
        <div><label for="eposition">职位：</label>
        <input type="text" name="eposition" id="eposition" /></div>
       <div> <label for="responbilities">工作职责：</label>
        <input type="text" name="responbilities" id="responbilities"/></div>
        <div><label for="experisearea">专业领域：</label>
        <input type="text" name="experisearea" id="experisearea" cols="45" rows="5" /></div>
        <input type="submit" name="search" id="search2" style="float:right" value="提交" />
		</div>
      </p>
  </form>
      </div>
-->
   