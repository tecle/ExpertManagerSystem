<aside>
    <nav>
          <ul>
            <li <?php if($page_stat == 1) echo "class='current'"; ?>><a href="<?=$url_left['show_userinfo']?>" >查看用户信息</a></li>
            <li  <?php if($page_stat == 2) echo "class='current'"; ?>><a href="<?=$url_left['add_user']?>">添加用户</a></li>
            <li <?php if($page_stat == 3) echo "class='current'"; ?>><a href="<?=$url_left['show_log']?>" >日志查看</a></li>
          </ul>
    </nav>
</aside>