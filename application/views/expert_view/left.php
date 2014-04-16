<aside>
    <nav>
          <ul>
            <li <?php if($page_stat == 1) echo "class='current'"; ?>><a href="<?=$url_left['expertMain']?>" >Consultants List</a></li>
            <li  <?php if($page_stat == 2) echo "class='current'"; ?>><a href="<?=$url_left['expertSearch']?>">Search</a></li>
            <li <?php if($page_stat == 3) echo "class='current'"; ?>><a href="<?=$url_left['expertAdd']?>" >Add</a></li>
            <li <?php if($page_stat == 4) echo "class='current'"; ?>><a>Detailed Information</a></li>
          </ul>
    </nav>
</aside>