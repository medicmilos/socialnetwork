
<div class="container container-wlcm">
    <div class="row equal">
        <div class="col-xs-12 col-sm-12 col-sm-offset-3">
            <h4 class="wrap-in wrap-in-lost-password">Your new password has been sent. Check your email account.</h4>
        </div>
        <div class="login lostpass col-xs-12 col-sm-12 col-sm-offset-4 col-xs-offset-1">
            <?php print form_open($base_url . 'Logovanje/login', $form_tag_atributi); ?>
            <div class="form-group">
                <?php print form_input($email_atributi); ?>
            </div>
            <div class="form-group"> 
                <?php print form_password($password_atributi); ?>
            </div><br/>
            <div class="form-group">
                <?php echo form_submit($submit_atributi); ?> 
            </div>
            <?php print form_close(); ?>
        </div>
    </div>
</div>