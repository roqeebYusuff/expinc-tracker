<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Forgot Password - ExpInc Tracker</title>
        
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
                            <h5 class="p-0 m-0">Forgot Password</h5>
                            <p class="p-0 m-0 text-muted">Enter your registered email address. We will send instructions to help reset your password</p>
                        </div>
                        <div class="card-body px-0">
                            <?php echo form_open_multipart('', ['id' => 'forgotForm']) ?>
                                <div class="row">   
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder=" ">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="button" onclick="forgotPass()" class="btn btn-dark btn-bdg shadow">Send</button>
                                </div>

                                <p class="m-0 text-center">Back to <a href="<?php echo base_url('auth/signin') ?>">Signin</a></p>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                            
                </div>
            </div>
        </section>

        <div class="modal fade" id="successmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createmodal" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content shadow">
                    <div class="modal-body text-center my-4">
                        <h4>Check your inbox and spam folder</h4>
                        <p class="text-muted"></p>
                        <button type="button" class="btn btn-primary py-0" data-bs-dismiss="modal">okay</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo base_url('assets') ?>/js/jquery.min.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/bootstrap.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/validate.min.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/formValidations.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/iziToast.min.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/toasts.js"></script>

        <script>
            $(document).ready( () => {
                // $('#successmodal').modal('show')
            })

            function forgotPass(){
                if(!$('#forgotForm').valid()){
                    return
                }

                var frmData = {}

                var data = $('#forgotForm').serializeArray()
                $.each(data, (key, input) => {
                    frmData[input.name] = input.value
                })

                var button = $('#forgotForm button')
                button.addClass('disabled').html('<span class="spinner-border spinner-border-sm me-2"></span>')

                $.ajax({
                    method: 'POST',
                    url: '<?php echo base_url() ?>/reset/forgotpassword',
                    data: frmData
                })
                .done( (response) => {
                    $('#successmodal .modal-body p').html(`If ${frmData.email} matches the email address on your account, then a password reset link has just been sent to ${frmData.email}`)
                    $('#successmodal').modal('show')
                    // if(response == 'success'){
                    //     successToast('success', 'email sent')
                    // }
                    // else if(response == 'error'){
                    //     warningToast('Warning', 'Unable to send email')
                    // }
                    // else{
                    //     warningToast('Warning', response)
                    // }
                })
                .fail( (response) =>{
                    console.log(response)
                    errorToast('Error', response)
                })
                .always( () =>{
                    button.removeClass('disabled').html('Send')
                })
            }
        </script>
    </body>
</html>