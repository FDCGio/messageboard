$(document).ready(function(){
    $('.search').select2({
        ajax: {
            url: '/messageboard/users/search_user', // Replace with the actual URL to your autocomplete action
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        theme: "classic",
        minimumInputLength: 3, // Adjust as needed
        placeholder: "Search for a recipient",
        templateResult: formatUser
    });

    function formatUser(user) {
        if(!user.id)
        {
            return user.text;
        }
        var $user = $(
            '<span><img src="' + user.image_url.toLowerCase() + '" style="width: 50px; height: 50px; border-radius:50px;"/> ' + user.text + '</span>',
            $('#receiver_id').val(user.id)
        );
        return $user;
    }

    $('#btnSend').click(function (e) {
        e.preventDefault();
    
        var data = {
            message: $('#message').val(),
            receiver_id: $('#receiver_id').val()
        };
    
        $.ajax({
            type: 'POST',
            url: '/messageboard/conversations/new_convo',
            data: data,
            dataType: 'json',
            success: function (response) {
                if (response.status === "Success") {
                    alert('Message sent successfully');
                    location.reload();
                } else {
                    alert('Message sending failed');
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
                alert('Error: ' + error);
            }
        });
    });
    
    
});