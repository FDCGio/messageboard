$(document).ready(function(){
    $("#messageForm").on('click', '.btnReply',function () {
        var conversation_id = $(this).data("conversation_id");
        var url = "/messageboard/messages/reply_page?conversation_id=" + conversation_id;

        $.get(url, function (response) {

            window.location.href = url;
        }).fail(function () {
            console.error("Ajax Error");
        });

    });

    var offset = 10;
    var limit = 10;
    $('#btnShow').click(function () {

        $.ajax({
            url: '/messageboard/messages/show_more',
            type: 'POST',
            data: { offset: offset, limit: limit }, 
            dataType: 'json',
            success: function (data) {
                if (data.conversations.length > 0) 
                {
                    $.each(data.conversations, function(index, conversation) {
                        var conversationHtml = '<div class="card" id="convo">';
                        conversationHtml += '<div class="card-header">';
                        
                        var currentUserId = '<?php echo json_encode($currentUserId); ?>';
                        
                        if (currentUserId == conversation.Message[0].sender_id) {
                            conversationHtml += '<div><strong>' + conversation.User2.name + '</strong></div>';
                        } else {
                            conversationHtml += '<strong>' + conversation.User1.name + '</strong>';
                        }
                        
                        conversationHtml += '</div>';
                        conversationHtml += '<div class="card-body">';
                        
                        if (conversation.User1.profile_img) {
                            conversationHtml += '<div class="row">';
                            conversationHtml += '<div class="col-md-2">';
                            conversationHtml += '<img id="img_preview" src="/messageboard/img/user_images/' + conversation.User1.profile_img + '" style="width: 80px; height: 80px;">';
                            conversationHtml += '</div>';
                            conversationHtml += '<div class="col-md-10" style="opacity:0.7;">';
                            conversationHtml += conversation.Message[0].message_text;
                            conversationHtml += '</div>';
                            conversationHtml += '</div>';
                        } else {
                            conversationHtml += '<div class="row">';
                            conversationHtml += '<div class="col-md-2">';
                            conversationHtml += '<img id="img_preview" src="/messageboard/img/empty_img.png" style="width: 80px; height: 80px;">';
                            conversationHtml += '</div>';
                            conversationHtml += '<div class="col-md-10" style="opacity:0.7;">';
                            conversationHtml += conversation.Message[0].message_text;
                            conversationHtml += '</div>';
                            conversationHtml += '</div>';
                        }
                        
                        conversationHtml += '</div>';
                        conversationHtml += '<div class="card-footer">';
                        conversationHtml += '<div class="timestamp" style="float:right;">';
                        conversationHtml += '<button class="btn btn-success btn-sm btnReply" type="button" data-sender_id="' + conversation.Message[0].sender_id + '" id="btnReply" style="margin-right:5px;">Reply</button>';
                        conversationHtml += '<button class="btn btn-danger btn-sm btnDelete" type="button" data-sender_id="' + conversation.Message[0].sender_id + '" id="btnDelete" style="margin-right:5px;">Delete Conversation</button>';
                        
                        var messageDate = new Date(conversation.Message[0].created);
                        conversationHtml += messageDate.getFullYear() + '/' + (messageDate.getMonth() + 1) + '/' + messageDate.getDate() + ' ' + messageDate.getHours() + ':' + messageDate.getMinutes();
                        
                        conversationHtml += '</div>';
                        conversationHtml += '</div>';
                        conversationHtml += '<div style="clear: both;"></div>';
                        conversationHtml += '</div><br>';
                        
                        $('#messageForm .col-md-12').append(conversationHtml);
                    });
                    offset += limit;
                }
                else 
                {
                    $('#btnShow').hide();
                    var noMoreMessage = $('<p class="no-more-message" style="background-color:#f2f2f2; text-align: center;padding: 10px;font-weight: bold;color: #777;">No more conversations to load</p>');
                    $('#messageForm .show_more').append(noMoreMessage);
                }
            }
        });

    });


    $('.btnDelete').click(function(){
        var conversation_id = $(this).data('conversation_id');
        $.ajax({
            url: '/messageboard/messages/deleteConvo',
            type: 'POST',
            data: { conversation_id: conversation_id }, 
            dataType: 'json',
            success: function (response) {
                if(response.success)
                {
                    alert('Conversation deleted');
                    location.reload();
                }
                else
                {
                    alert('Failed to delete');
                }
            },
            error: function(xhr, status, error) {
                alert('error' + error);
            }
        });
    });

});