
<aside>
    <nav>
          <ul>
            <li <?php if($page_stat == 1) echo "class='current'"; ?>><a href="<?=$url_left['guestMain']?>" >Clients List</a></li>
            <li  <?php if($page_stat == 2) echo "class='current'"; ?>><a href="<?=$url_left['guestSearch']?>">Search</a></li>
            <li <?php if($page_stat == 3) echo "class='current'"; ?>><a href="<?=$url_left['guestAdd']?>" >Add</a></li>
            <li <?php if($page_stat == 4) echo "class='current'"; ?>><a>Detailed Information</a></li>
            <li <?php if($page_stat == 6) echo "class='current'"; ?>><a>Add Coopertation Project</a></li>
          </ul>
    </nav>
</aside>