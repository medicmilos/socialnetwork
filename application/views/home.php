
<div class="container container-wlcm">
    <div class="row equal">
        <div class="col-xs-12 col-sm-8">   
            <h3 class="text-center">Social network</h3>
            <p class="text-center">This is not in information age. It’s an age of networked intelligence.</p>
            <p class="text-center">-Don Tapscott, Author of ‘Wikinomics’</p>
            <img class="img-responsive" src="images/main.png">
        </div>
        <div class="col-xs-12 col-sm-4">

            <div class="login col-xs-12 col-sm-12">
                <?php print form_open($base_url . 'Logovanje/login', $form_tag_atributi); ?>
                <div class="form-group">
                    <?php print form_input($email_atributi); ?>
                </div>
                <div class="form-group"> 
                    <?php print form_password($password_atributi); ?>
                </div><br/>
                <div class="form-group">
                    <?php echo form_submit($submit_atributi); ?>
                    <div class="forgot">
                        <a href="<?php base_url(); ?>Logovanje/lostPassword" >Forgot your password?</a>
                    </div>
                </div>
                <?php print form_close(); ?>
            </div>
            <div class="register col-xs-12  col-sm-12">
                <h4 class="text-center">For the first time on Sn?</h4>
                <p class="text-center">Sign up for Sn</p>
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
                <div class="form-group">
                    <?php print form_password($password_confirm_atributiReg); ?>
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
            </div>

        </div>
    </div>
</div> 