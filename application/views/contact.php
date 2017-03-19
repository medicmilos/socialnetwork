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
                <?php print form_open($base_url . 'Contact', $form_tag_atributi); ?>
                <h3>Contact Form</h3>
                <h4>Contact us for custom quote</h4>
                <fieldset class="form-group">
                    <?php print form_input($fullName_atributi); ?>
                </fieldset>
                <fieldset class="form-group">
                    <?php print form_input($email_atributi); ?>
                </fieldset>	
                <fieldset class="form-group">
                    <?php print form_textarea($textarea_atributiReg); ?>
                </fieldset>

                <?php print form_submit($submit_atributi); ?>
                <?php print form_close(); ?>
                <?php echo validation_errors(); ?>
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
