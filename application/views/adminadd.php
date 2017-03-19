<div class="container top">

    <div class="row">
        <div class="span12 columns">
            <div class="well">

                <ul class="nav nav-pills">
                    <li role="presentation"><a href="<?php echo base_url(); ?>Feed">Home</a></li>
                    <li role="presentation" class="<?php
                    if (isset($klasa1)) {
                        echo $klasa1;
                    }
                    ?>"><a href="<?php echo base_url(); ?>Admin">Users</a></li>
                    <li role="presentation" class="<?php
                    if (isset($klasa2)) {
                        echo $klasa2;
                    }
                    ?>"><a href="<?php echo base_url(); ?>Admin/menu">Menu</a></li>
                    <li role="presentation" class="<?php
                    if (isset($klasa3)) {
                        echo $klasa3;
                    }
                    ?>"><a href="<?php echo base_url(); ?>Admin/poll">Poll</a></li>
                    <li role="presentation" class="<?php
                    if (isset($klasa4)) {
                        echo $klasa4;
                    }
                    ?>"><a href="<?php echo base_url(); ?>Admin/posts">Posts</a></li>
                    <li role="presentation" class="<?php
                    if (isset($klasa5)) {
                        echo $klasa5;
                    }
                    ?>"><a href="<?php echo base_url(); ?>Admin/comments">Comments</a></li>
                </ul>

            </div>
            <?php
            if (@$_SESSION["success"] == 1) {
                echo "<div class='alert alert-success' role='lert'
  <strong>Well done!</strong> You successfully executed your command.
</div>";
            }
            ?> 

            <?php
            $tabela = $this->uri->segment(3);
            if ($tabela == "korisnik") {


                //form data
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                $options_manufacture = array('' => "Select");


                //form validation
                echo validation_errors();

                echo form_open('Admin/add/', $attributes);
                ?>
                <fieldset>
                    <?php print form_open($base_url . 'Logovanje', $form_tag_atributiReg); ?>
                    <div class="form-group"> 
                        <?php print form_input($firstName_atributiReg); ?>
                    </div> 
                    <div class="form-group">
                        <?php print form_input($lastName_atributiReg); ?>
                    </div> 
                    <div class="form-group">
                        <?php print form_input($email_atributiReg); ?>
                    </div> 
                    <div class="form-group">
                        <?php print form_password($password_atributiReg); ?>
                    </div>  
                    <div class="input-group">
                        <label for="" class="col-xs-12 control-label">Your gender</label><br/>
                        <div class="radio">
                            <label class="male"><?php print form_radio($male_atributiReg); ?> Male </label>
                        </div>
                        <div class="radio">
                            <label><?php print form_radio($female_atributiReg); ?> Female</label>
                        </div>
                    </div> 
                    <?php print form_submit($submit_atributiReg); ?>
                    <?php print form_close(); ?>
                    <?php echo validation_errors(); ?>
                </fieldset>

            <?php } ?>

        </div>
    </div>