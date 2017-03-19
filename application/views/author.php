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
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3">
                    <img class="img-responsive" src="<?php echo $base_url; ?>images/milos.png" alt="Milos MEdic" />
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <p class="about_author">I am a student currently living in Belgrade(Serbia) and I am on the third year of ICT collage, which is a great school for learning about internet technologies.
                        I am interested in Web development, and I have created different sites using HTML(5), CSS(3), JavaScript, jQuery, AJAX, PHP, MySQL and I'm familiar with basics of Git and responsive design technology - Bootstrap.
                        I've also learned about basic programing with languages Java and C#.
                        I'm a sociable and hardworking person, my goal is to find a company which can provide me, as a beginner, with valuable instructions and informations and I am interested in volunteering to gain experience in the field.</p>
                </div>
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
