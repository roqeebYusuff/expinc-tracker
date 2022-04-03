<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Password Expired - ExpInc Tracker</title>
        
        <link rel="shortcut icon" href="<?php echo base_url('assets') ?>/img/favicon.svg" type="image/x-icon">

        <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url('assets') ?>/fontawesome/css/all.css">
        <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/iziToast.min.css">
    </head>
    <body>
        <section id="auth">
            <div class="container-fluid">
                <div class="wrapper min-vh-100 d-flex align-items-center justify-content-center">
                    <div class="col-md-6 col-9 text-center">
                        <h4 class="text-white">Password Reset Link is Invalid/Expired</h4>
                        <p class="text-muted">It looks like you are too late to reset your password. You are trying to use the expired link which is valid only for an hour</p>
                        <a href="<?php echo base_url('auth/forgot-password') ?>" class="btn btn-primary my-1">Back to Forgot Password</a>
                    </div>   
                </div>
            </div>
        </section>

        <script src="<?php echo base_url('assets') ?>/js/jquery.min.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/bootstrap.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/validate.min.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/formValidations.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/iziToast.min.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/toasts.js"></script>
    </body>
</html>