$(function () {
    "use strict";
  
    $('#signinForm').validate({
        rules: {
            email: 'required',
            password: "required"
        },
        messages: {
            email: {
                required: "Please provide an email"
            },
            password: "Please provide a password"
        },
        errorPlacement: function(error, element){
            error.insertAfter(element).addClass('text-danger')
        }
    })

    $('#signupForm').validate({
        rules: {
            first_name: "required",
            last_name: "required",
            user_name: {
                required: true,
                minlength: 5
            },
            email: {
                email: true,
                required: true
            },
            password: {
                required: true,
                minlength: 5
            },
            con_password: {
                required: true,
                minlength: 5,
                equalTo: '#password'
            }
        },
        messages: {
            first_name: "Firstname cannot be empty",
            last_name: "Lastname cannot be empty",
            user_name: {
                required: "Please provide your username",
                minlength: "At least 5 characters is required"
            },
            email: {
                required: "Please provide an email"
            },
            password: {
                required: "Please provide a password",
                minlength: "At least 5 characters is required"
            },
            con_password: {
                required: "Please provide a password",
                minlength: "At least 5 characters is required",
                equalTo: "Passwords do not match"
            }
        },
        errorPlacement: function(error, element){
            error.insertAfter(element).addClass('text-danger')
        }
    })

    $('#entriesForm').validate({
        rules: {
            type: "required",
            category: "required",
            amount: "required",
            date_added: "required"
        },
        messages: {
            type: 'Select the type of entry',
            category: 'Select the category of entry',
            amount: "Enter amount of entry",
            date_added: "Enter date"
        },
        errorPlacement: function(label, element){
            label.insertAfter(element).addClass('text-danger')
        }
    })

    $('#forgotForm').validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email:{
                required: "Please enter an email",
            }
        },
        errorPlacement: function(label, element){
            label.insertAfter(element).addClass('text-danger')
        }
    })
    
    $('#resetForm').validate({
        rules: {
            password: {
                required: true,
                minlength: 5
            },
            conpassword: {
                required: true,
                minlength: 5,
                equalTo: '#password'
            }
        },
        messages: {
            password: {
                required: "Please provide a password",
                minlength: "At least 5 characters is required"
            },
            conpassword: {
                required: "Please provide a password",
                minlength: "At least 5 characters is required",
                equalTo: "Passwords do not match"
            }
        },
        errorPlacement: function(label, element){
            label.insertAfter(element).addClass('text-danger')
        }
    })
});