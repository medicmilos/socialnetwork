<body>
<?php include_once("analyticstracking.php") ?>
    <nav id="visina" class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div id="visina"  class="container-fluid">
            <div class="col-xs-12 col-sm-7 col-sm-offset-3 alldropdown">	
                <a class="ol-xs-12 navbar-brand" href="<?php echo $base_url; ?>Feed"></a>
                <?php if ($this->session->userdata('ulogovan')): ?>
                    
                    <span class="dropdown settings"> 
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url(); ?>Profile/user/<?php echo $this->session->userdata('id_korisnik'); ?>">My profile</a></li>
                            <li><?php print anchor("Logovanje/logout", "Logout"); ?></li>
                        </ul>
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">	
                            <?php print "<span class='firstname'>" . $this->session->userdata('FirstName') . "</span>"; ?>
                            <span class="slika">

                                <?php
                                echo "<img src=" . base_url() . "images/members/" . $this->session->userdata('avatar') . "" . " width='200' height='201' " . " >";
                                ?> 
                            </span><span class="caret"></span></a> 
                    </span> 
                <?php endif; ?>
            </div> 	 
        </div>  
    </nav>