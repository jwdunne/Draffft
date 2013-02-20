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
    
    $('.header-image').css({
        position: 'relative',
        top:      SCMF.position.verticalCenter('.header-image', '.header-image-container'),
        margin:   '0 5%'
    });
    
    $('.delete-comment').on('click', function() {
        var t       = $(this),
            comment = t.parents('.article-comments-container'),
            author  = comment.find('.comment-author-name span').text(),
            curl    = app_url + 'comment/delete/' + comment.attr('id');
            
        if (confirm("Delete comment by " + author + "?"))
        {
            $.ajax({
                type: 'POST',
                url: curl,
                success: function() {
                    comment.remove();
                }
            });
        }
    });

    $('.in-reply').each(function(i, el) {
        $(el).css({
            'margin-left': 15 * (i + 1)
        });
    });
    
});
