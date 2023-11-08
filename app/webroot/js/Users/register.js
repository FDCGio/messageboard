$(document).ready(function(){
    $("#UserPasswordConfirmation").keyup(function(event) {
        var password = $("#UserPassword").val();
        var confirmPassword = $("#UserPasswordConfirmation").val();

        if (password !== confirmPassword) {
            event.preventDefault();

            $('#UserPasswordConfirmation').css('border-color','red');
            $('#error_msg').text('Password and Confirm password does not match!').css('color','red');
            $('#btnRegister').prop('disabled',true);
        }
        else
        {
            $('#UserPasswordConfirmation').css('border-color','black');
            $('#error_msg').text('');
            $('#btnRegister').prop('disabled',false);
        }
    });
    
    setTimeout(function() {
        $("#flashMessage").fadeOut(2000);
    });
});