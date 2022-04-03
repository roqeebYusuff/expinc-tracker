<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign up - ExpInc Tracker</title>
        
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
                    <div class="card col-lg-5 col-md-7 my-4">
                        <h2 class="brand-logo text-center"><i class="fas fa-gauge-med"></i> expInc tracker</h2>
                        <div class="mt-2">
                            <h5 class="p-0 m-0">Sign up</h5>
                            <p class="p-0 m-0 text-muted">Create your account</p>
                        </div>
                        <div class="card-body px-0">
                            <?php echo form_open_multipart('', ['id' => 'signupForm']) ?>
                                <div class="row">   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name" class="form-label">Firstname</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name" class="form-label">Lastname</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="user_name" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between align-items-center showHide">
                                                <label for="password" class="form-label">Password</label>
                                                <i class="fas fa-eye"></i>
                                            </div>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between align-items-center showHide">
                                                <label for="con_password" class="form-label">Confirm Password</label>
                                                <i class="fas fa-eye"></i>
                                            </div>
                                            <input type="password" class="form-control" id="con_password" name="con_password" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="button" onclick="signup()" class="btn btn-dark btn-bdg shadow">Get Started</button>
                                </div>

                                <p class="m-0 mt-3 text-center">
                                    Already have an account? <a href="<?php echo base_url('auth/signin') ?>">Sign in.</a>
                                </p>
                                <p class="m-0 text-center">Back to <a href="<?php echo base_url() ?>">Home</a></p>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                            
                </div>
            </div>
        </section>

        <script src="<?php echo base_url('assets') ?>/js/jquery.min.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/validate.min.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/formValidations.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/iziToast.min.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/toasts.js"></script>

        <script>
            $(document).ready( function () {
                $('.showHide > i').click( function() {
                    $(this).toggleClass('fa-eye fa-eye-slash')
                    inputField = $(this).parent().next('input')
                    inputField.attr('type', inputField.attr('type') === 'password' ? 'text' : 'password')
                })
            })

            
            function signup(){
                if(!$('#signupForm').valid()){
                    return
                }
                var button = $('#signupForm button')

                var frmData = {}
                var data = $('#signupForm').serializeArray()

                $.each(data, function(key, input){
                    frmData[input.name] = input.value
                })

                button.addClass('disabled').html('<span class="spinner-border spinner-border-sm me-2"></span>')

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('auth/register') ?>',
                    data: frmData
                })
                .always( () => {
                    button.removeClass('disabled').html('Get Started')
                })
                .done ( (response) => {
                    if(response == 'success'){
                        successToast('Success', 'Successfully registered')
                        $('#signupForm')[0].reset()
                        setTimeout(() => {
                            document.location = '<?php echo base_url('auth/signin') ?>'
                        }, 3000);
                    }
                    else{
                        warningToast('Error', response)
                    }
                })
                .fail( (response) => {
                    errorToast('Error', response)
                })
            }
        </script>
    </body>
</html>