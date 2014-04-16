<body style="overflow: hidden;">
    <div id="loading"> 

        <script type = "text/javascript"> 
            document.write("<div id='loading-container'><p id='loading-content'>" +
                           "<img id='loading-graphic' width='16' height='16' src='/CIFramework/public/templete/images/ajax-loader-eeeeee.gif' /> " +
                           "Loading...</p></div>");
        </script> 

    </div> 

    <div id="wrapper">
        <header>
            <h1><a><?= $left_title ?></a></h1>
            <nav>
				<ul id="main-navigation" class="clearfix"> 
					<li> 
						<a href="<?= $url['main'] ?>">Home</a> 
					</li> 
					<li class="dropdown"> 
						<a href="<?= $url['expert'] ?>">Consultant</a> 
                        <ul> 
                            <li> 
								<a href="<?= $url['expert'] ?>">Home</a> 
							</li> 
							<li> 
								<a href="<?= $url['expert'] ?>/addExpert">Add</a> 
							</li> 
							<li> 
								<a href="<?= $url['expert'] ?>/search">Search</a> 
							</li> 
						</ul>
					</li> 
					<li class="dropdown"> 
						<a href="<?= $url['project'] ?>">Project</a> 
                        <ul> 
                            <li> 
								<a href="<?= $url['project'] ?>">Home</a> 
							</li> 
							<li> 
								<a href="<?= $url['project'] ?>/addProject">Add</a> 
							</li> 
							<li> 
								<a href="<?= $url['project'] ?>/search">Search</a> 
							</li> 
						</ul>
					</li> 
					<li class="dropdown"> 
                        <a href="<?= $url['guest'] ?>">Client</a> 
                        <ul> 
                            <li> 
								<a href="<?= $url['guest'] ?>">Home</a> 
							</li> 
							<li> 
								<a href="<?= $url['guest'] ?>/addGuest">Add</a> 
							</li> 
							<li> 
								<a href="<?= $url['guest'] ?>/search">Search</a> 
							</li> 
						</ul>
					</li>	
                    <li> 
                        <a href="/CIFramework/index.php/email/welcome/">Email</a> 
					</li>
                    <li class="fr dropdown"> 
                        <a href="#" class="with-profile-image"><span><img src="/CIFramework/public/templete/images/profile-image.png" /></span><?=$_COOKIE["uname"]?></a> 
                        <ul>
                        <?php 
                        if($_COOKIE["urole"] == 'a') {
                        ?>
                            <li><a>管理员</a></li> 
                            <li><a href="<?= $url['admin'] ?>">进入管理员界面</a></li> 
                        <?php 
                        }
                        elseif($_COOKIE["urole"] == 'ua') {
                        ?>
                            <li><a>A类用户</a></a> 
                        <?php 
                        }
                        elseif($_COOKIE["urole"] == 'ub') {
                        ?>
                            <li><a>B类用户</a></li> 
                        <?php 
                        }
                        elseif($_COOKIE["urole"] == 'uc') {
                        ?>
                            <li><a>C类用户</a></li>
                        <?php 
                        }
                        elseif($_COOKIE["urole"] == 'ud') {
                        ?>
                            <li><a>D类用户</a></li>
                        <?php
                        }
                        ?>
                        <li><a  href="<?= $url['logout'] ?>">登出</a></li>        
                        </ul>
                    </li> 
				</ul> 
            </nav>
        </header>
     <section> 