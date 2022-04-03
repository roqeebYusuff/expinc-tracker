<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign in - ExpInc Tracker</title>
        
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
                    <div class="card col-lg-5 col-md-7">
                        <h2 class="brand-logo text-center"><i class="fas fa-gauge-med"></i> expInc tracker</h2>
                        <div class="mt-2">
                            <h5 class="p-0 m-0">Sign in</h5>
                            <p class="p-0 m-0 text-muted">Sign in to continue</p>
                        </div>
                        <div class="card-body px-0">
                            <?php echo form_open_multipart('', ['id' => 'signinForm']) ?>
                                <div class="row">   
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email/Username</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder=" ">
                                        </div>
                                    </div>

                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="float-end">
                                                <i class="fas fa-eye" id="showHide"></i>
                                            </div>
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                            <div class="text-end"><a href="<?php echo base_url('auth/forgot-password') ?>">Forgot password?</a></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button onclick="signin()" class="btn btn-dark btn-bdg shadow">Sign in</button>
                                </div>

                                <p class="m-0 mt-3 text-center">
                                    Don’t have an account? <a href="<?php echo base_url('auth/signup') ?>">Sign up.</a>
                                </p>
                                <p class="m-0 text-center">Back to <a href="<?php echo base_url() ?>">Home</a></p>
                            <?php echo form_close() ?>
                        </div>
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

        <script>
            $(document).ready( () => {
                var message = '<?php echo $message ?>'
                if(message != ''){
                    errorToast('Error', message)
                }

                $('#showHide').click( () => {
                    $('#password').attr('type', $('#password').attr('type') === 'password' ? 'text' : 'password')
                    $('#showHide').toggleClass('fa-eye fa-eye-slash')
                })
            })

            function signin(){
                if(!$('#signinForm').valid()){
                    return
                }
                var target = $('#signinForm button')
                target.addClass('disabled').html('<span class="spinner-border spinner-border-sm me-2"></span> Signing in...');
            }
        </script>
    </body>
</html>