$(document).ready(function(){
    $("#c_pass").keyup(function(event) {
        var password = $("#password").val();
        var confirmPassword = $("#c_pass").val();

        if (password !== confirmPassword) {
            event.preventDefault();

            $('#c_pass').css('border-color','red');
            $('#error_msg').text('Password and Confirm password does not match!').css('color','red');
            $('#btnUpdate').prop('disabled',true);
        }
        else
        {
            $('#c_pass').css('border-color','black');
            $('#error_msg').text('');
            $('#btnUpdate').prop('disabled',false);
        }
    });
});