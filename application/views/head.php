<!DOCTYPE html>
<html>
    <head> 
        <title><?php echo (isset($title)) ? $title : 'Network'; ?> </title>
        <?php print meta($meta); ?>
        <?php if (isset($links) && !empty($links)): ?>
            <?php foreach ($links as $link): ?>
                <?php print $link; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
        <link rel="stylesheet" href="http://formvalidation.io/vendor/formvalidation/css/formValidation.min.css">
        <script src="http://formvalidation.io/vendor/formvalidation/js/formValidation.min.js"></script>
        <script src="http://formvalidation.io/vendor/formvalidation/js/framework/bootstrap.min.js"></script>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $base_url; ?>images/favicon.ico">

        <script type="text/javascript" src="<?php echo $base_url; ?>js/main.js"></script> 
        <script type="text/javascript" src="<?php echo $base_url; ?>js/bootstrap-progressbar.js"></script>  


    </head>