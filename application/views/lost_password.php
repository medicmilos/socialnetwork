<div class="container container-wlcm">
    <div class="row equal">
        <div class="login lostpass col-xs-12 col-sm-12 col-sm-offset-3 col-xs-offset-1">
            <?php if (isset($form_tag_atributi)): ?>
                <h4 class="wrap-in wrap-in-lost-password">To reset your password, enter the email address you use to sign in to network.milosmedic.com.</h4>
                <?php print form_open($base_url . 'logovanje/lostPassword', $form_tag_atributi); ?>
                <div class="form-group">
                    <?php print form_input($email_atributi); ?>
                </div>
                <?php echo form_submit($submit_atributi); ?>
                <?php print form_close(); ?> 
                <?php if (isset($nepoznat_korisnik)): ?>
                    <?php print $nepoznat_korisnik; ?>
                <?php endif; ?>
            <?php endif; ?>
            <h5 class="wrap-in"><?php echo validation_errors(); ?></h5>
        </div> 
    </div>
</div>