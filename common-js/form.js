$(document).ready(function(){
    $('form#subscribe').submit(function(event){
        var email = $('#email').attr('value');
        var validEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!validEmail.test(email)) {
            $('#mail-list-instructions').html('Please enter a valid email address:').css('color','red');
        } else {
            $.ajax({
                dataType: 'text',
                data: $(this).serialize(),
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                success: function(){
                    $('#mail-list').html('Thank you for your subscription, your address has been added to our list: '+email);
                },
                error: function(){
                    $('#mail-list').html('An error occured submitting the form data.').css('color','red');
                }
            });
        }
        event.preventDefault();
    });
});