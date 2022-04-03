<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Password - ExpInc Tracker</title>
        
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
                    <div class="card col-lg-5 col-md-7 col-sm-8 col-8">
                        <h2 class="brand-logo text-center"><i class="fas fa-gauge-med"></i> expInc tracker</h2>
                        <div class="mt-2">
                            <h5 class="p-0 m-0">Reset Password</h5>
                            <p class="p-0 m-0 text-muted">Enter your registered email address. We will send instructions to help reset your password</p>
                        </div>
                        <div class="card-body px-0">
                            <?php echo form_open_multipart('', ['id' => 'resetForm']) ?>
                                <input type="hidden" name="user" value="<?php echo $userid ?>">
                                <div class="row">   
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between align-items-center showHide">
                                                <label for="password" class="form-label">Password</label>
                                                <i class="fas fa-eye"></i>
                                            </div>
                                            <input type="password" class="form-control" id="password" name="password" placeholder=" ">
                                        </div>
                                    </div>
                                     
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between align-items-center showHide">
                                                <label for="conpassword" class="form-label">Confirm Password</label>
                                                <i class="fas fa-eye"></i>
                                            </div>
                                            <input type="password" class="form-control" id="conpassword" name="conpassword" placeholder=" ">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="button" onclick="savePass()" class="btn btn-dark btn-bdg shadow">Reset Password</button>
                                </div>

                                <p class="m-0 text-center">Back to <a href="<?php echo base_url('auth/signin') ?>">Signin</a></p>
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
                $('.showHide > i').click( function() {
                    $(this).toggleClass('fa-eye fa-eye-slash')
                    inputField = $(this).parent().next('input')
                    inputField.attr('type', inputField.attr('type') === 'password' ? 'text' : 'password')
                })
            })

            function savePass(){
                if(!$('#resetForm').valid()){
                    return
                }

                var frmData = {}

                var data = $('#resetForm').serializeArray()
                $.each(data, (key, input) => {
                    frmData[input.name] = input.value
                })

                var button = $('#resetForm button')
                button.addClass('disabled').html('<span class="spinner-border spinner-border-sm me-2"></span>')

                $.ajax({
                    method: 'POST',
                    url: '<?php echo base_url() ?>/reset/savepass',
                    data: frmData
                })
                .done( (response) => {
                    if(response == 'success'){
                        successToast('success', 'Password has successfully been reset.')
                        $('#resetForm')[0].reset()
                    }
                    else{
                        successToast('error', 'An error occured while trying to reset your password')
                    }
                })
                .fail( (response) =>{
                    errorToast('Error', response)
                })
                .always( () =>{
                    button.removeClass('disabled').html('Send')
                })
            }
        </script>
    </body>
</html>