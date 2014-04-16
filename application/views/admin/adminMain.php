<section>
                <header class="container_12 clearfix">
                    <div class="grid_12">
                        <h1>用户信息</h1>
                    </div>
                </header>
                <section class="container_12 clearfix">
                    <div class="grid_12">
                        <div id="demo" class="clearfix"> 
                            <table class="display" id="example"> 
                                <thead> 
                                    <tr> 
                                        <th style="width:16%">用户姓名</th>
                                        <th  width="16%">账号</th>
                                        <th style="width: 16%">密码</th>
                                        <th style="width: 16%">权限</th>
                                        <th style="width: 16%">相关信息</th>
                                        <th style="width: 16%">操作</th>
                                    </tr> 
                                </thead> 
                                <?php
                                    if (!empty($r)) {
                                        $count = 0;
                                        foreach ($r as $row) {
                                            if($count == 0)
                                                echo '<tr class="gradeA">';
                                            else
                                                echo '<tr class="gradeC">';
                                            echo '<td>' . $row->wname . '</td>
                                    				<td>' . $row->waccount . '</td>
                                    				<td>' . $row->wpassword . '</td>';
                                            if ($row->wrole == 'a')
                                                echo '<td>管理员</td>';
                                            elseif($row->wrole == 'ua')
                                                echo '<td>A类权限</td>';
                                            elseif($row->wrole == 'ub')
                                                echo '<td>B类权限</td>';
                                            elseif($row->wrole == 'uc')
                                                echo '<td>C类权限</td>';
                                            elseif($row->wrole == 'ud')
                                                echo '<td>D类权限</td>';
                                            else
                                                echo '<td>权限类型错误</td>';
                                               
                                            if ($row->winfo == "")
                                                echo '<td>NULL</td>';
                                            else
                                                echo '<td>' . $row->winfo . '</td>';
                                    
                                            echo '<td><a onclick="deleteUser(' . $row->wid . ')">删除</a>
                                    				    <a onclick="alterDialog(' . $row->wid . ')">修改</a></td></tr>';
                                            $count=(++$count)%2;
                                        }
                                    }
                                    ?>	
                            </table> 
                            <?php
                            echo $page_str;
                            ?>

                        </div> 
                    </div>
                </section>
            </section>
	<div id="alterDiv" style="display:none">
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="4" bordercolor="#666666">
        <tr>
          <td colspan="2" bgcolor="#eeeeee">若不填写则不修改</td>
        </tr>
		<tr>
          <td width="80" align="right">新登陆账号</td>
          <td><input type="text" id="uaccount" /></td>
        </tr>
        <tr>
          <td align="right">新密码</td>
          <td><input type="password" id="upassword"  /></td>
        </tr>
		<tr>
          <td align="right">确认密码</td>
          <td><input type="password" id="upassword1"  /></td>
        </tr>
        <tr>
          <td align="right">权限</td>
          <td>
          <select id="urole" name="urole">
          <option value="ud">D类权限</option>
          <option value="uc">C类权限</option>
          <option value="ub">B类权限</option>
          <option value="ua">A类权限</option>
          <option value="a">管理员</option>
          </select>
         </td>
        </tr>
        <tr>
          <td align="right">相关信息</td>
          <td><input type="text" id="uinfo"  /></td>
        </tr>
      </table>
    </div>
		
<script>
function alterDialog(wid)
{
	var diag = new Dialog();
	diag.Width = 300;
	diag.Height = 150;
	diag.Title = "修改用户信息";
	diag.InvokeElementId="alterDiv";
	diag.OKEvent = function(){
	//	if(isEmpty(document.getElementById("uaccount").value) && isEmpty(document.getElementById("upassword").value)){ alert("不能都为空"); document.getElementById("uaccount").focus(); return;}
		if(!(isEmpty(document.getElementById("uaccount").value)) && !(isAccountName(document.getElementById("uaccount").value))) {alert("账号由英文，数字，_,-构成"); document.getElementById("uaccount").focus(); return;}
		if(document.getElementById("upassword").value != document.getElementById("upassword1").value){alert("两次密码不相同"); document.getElementById("upassword").focus(); return; }
		if(!(isEmpty(document.getElementById("uaccount").value))){
			alterAccount(wid,document.getElementById("uaccount").value,document.getElementById("urole").value,document.getElementById("uinfo").value);
		}
		else{
			alterPassword(wid,document.getElementById("upassword").value,document.getElementById("urole").value,document.getElementById("uinfo").value);
		}
	};//点击确定后调用的方法
	diag.show();
}
</script>
 
        