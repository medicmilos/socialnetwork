<div class="container">
    <div class="row equal">

        <div class="aside-left-parent col-xs-12 col-sm-3">  
            <nav role="navigation" class=" navbar-default">  
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> 
                <div class="aside-left col-xs-12 col-sm-8"> 
                    <div id="navbarCollapse" class="collapse navbar-collapse nav-justified">
                        <?php if (isset($leviMenu)): ?>
                            <ul class="nav nav-tabs nav-stacked">
                                <?php foreach ($leviMenu as $link): ?>
                                    <?php if ($link->link == "Profile/user") { ?>
                                        <li>

                                            <?php print anchor($link->link . "/" . $_SESSION["id_korisnik"], "<span class='left-icon " . $link->class . "'></span><span>" . $link->name . "</span>"); ?>
                                        </li>
                                    <?php } else { ?>
                                        <li>

                                            <?php print anchor($link->link, "<span class='left-icon " . $link->class . "'></span><span>" . $link->name . "</span>"); ?>
                                        </li>

                                    <?php } ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>

        <div class="col-xs-12 col-sm-6">
            <div class="whatisnew2 col-xs-12 col-sm-12 col-sm-offset-0.5">

                <p>Subscribed to:</p>
                <?php
                if (isset($subscribedTo)) {
                    foreach ($subscribedTo as $value) {
                        //echo "<a href='" . base_url() . "Profile/user/" . $value->id_korisnik . "'>".$value->FirstName." ".$value->LastName."</a><br/>"; 
                        echo "<div class='commentblk subsdvojka profileRight4Inner1 col-xs-12 col-sm-12'><div class='profileRight4Inner12 col-xs-12 col-sm-12'><img src=" . base_url() . "images/members/" . $value->avatar . "" . " width='200' height='201' " . " ><div class='usercontent'><div class='flname'><a href='" . base_url() . "Profile/user/" . $value->id_korisnik . "'>" . $value->FirstName . " " . $value->LastName . "</a></div></div></div></div><br/>";
                    }
                } else {
                    echo "nije subscribovato nikoga";
                }
                ?>
            </div>
        </div>
        <div class="aside-right-parent col-xs-12 col-sm-3">
            <nav role="navigation" class=" navbar-default">  
                <button type="button" data-target="#navbarCollapse2" data-toggle="collapse" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> 
                <div class="aside-right col-xs-12 col-sm-10">
                    <div id="navbarCollapse2" class="collapse navbar-collapse nav-justified">
                        <ul class="nav nav-tabs nav-stacked">
                            <?php if (isset($desniMenu)): ?>
                                                            <ul class="nav nav-tabs nav-stacked">
                                <?php foreach ($desniMenu as $link): ?>
                                                                    <li>
                                    <?php print anchor($link->link, "<span>" . $link->name . "</span>"); ?>
                                                                    </li>
                                <?php endforeach; ?>
                        </ul>
                            <?php endif; ?> 
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div> 