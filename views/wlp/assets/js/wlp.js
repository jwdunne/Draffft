$(document).ready(function() {
    $('#comment-form').validate({
        rules: {
            comment: {
                required: true,
                minlength: 10
            }
        },
        
        messages: {
            comment: {
                required: "You must have a comment, to comment...",
                minlength: jQuery.format("Comments must be longer than {0} characters")
            }
        },
        
        errorPlacement: function(error, element) {
            error.appendTo($('.sfe-container'));
        }
    });
    
    $('#login-form').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: "required"
        },
        
        messages: {
            email: {
                required: "Please specify your email",
                email: "That is not a valid email address",
            },
            password: "Please enter your password"
        },
        
        errorPlacement: function(error, element) {}
    });
    
    $('#register-form').validate({
    
        rules: {
            username:   "required",
            first:      "required",
            last:       "required",
            email: {
                required:   true,
                email:      true
            },
            password:   "required"
        },
        
        messages: {
            username:   "Create a unique nickname",
            first:      "First name is required",
            last:       "Last name is required",
            email: {
                required: "Please specify your email",
                email: "That is not a valid email address",
            },
            password: "You must create a password",
            
        },
        
        errorPlacement: function(error, element) {}
    });
});
