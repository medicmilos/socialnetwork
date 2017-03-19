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

                <div id="galerija">  
                    <?php
                    echo "<div class='red_slika'>";
                    foreach ($galerija as $value) {
                        echo "<div class='img2'>";
                        echo "<a  class='example-image-link'  data-lightbox='example-set' data-title='$value->FirstName $value->LastName' href='" . base_url() . "images/members/" . $value->avatar . "'>";
                        echo "<img class='example-image' src='" . base_url() . "images/members/" . $value->avatar . "' alt='" . $value->FirstName . " " . $value->LastName . "'/></a>";
                        $fullName = $value->FirstName . " " . $value->LastName;
                        if (strlen($fullName) > 16) {
                            $prvideo = substr($fullName, 0, 16);
                            echo "<div class='descr2'><a href='" . base_url() . "Profile/user/" . $value->id_korisnik . "'>" . $prvideo . "...</a></div></div>";
                        } else {
                            echo "<div class='descr2'><a href='" . base_url() . "Profile/user/" . $value->id_korisnik . "'>" . $fullName . "</a></div></div>";
                        }
                    }
                    echo "<div class='cisti'></div></div>";
                    ?>
                    
                </div>
               
            </div> <?php echo $this->pagination->create_links(); ?>
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
<script type="text/javascript" src="<?php echo $base_url; ?>/js/lightbox-plus-jquery.min.js"></script>