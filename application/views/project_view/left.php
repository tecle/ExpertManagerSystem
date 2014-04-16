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
</aside>