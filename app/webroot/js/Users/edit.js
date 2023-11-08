$(document).ready(function(){
    $('#datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true,
        yearRange: 'c-100:c+10'
    });

    $('#profile_img').change(function() {
        var file = $(this)[0].files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img_preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    setTimeout(function() {
        $("#flashMessage").fadeOut(2000);
    });
    
});