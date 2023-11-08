$(document).ready(function () {
    var birthdateString = $('#birthdate').text();
    var birthdate = new Date(birthdateString);

    // Calculate the age based on the birthdate
    var currentDate = new Date();
    var age = currentDate.getFullYear() - birthdate.getFullYear();

    // If the current date hasn't occurred this year yet, subtract 1 from the age
    if (currentDate.getMonth() < birthdate.getMonth() || (currentDate.getMonth() === birthdate.getMonth() && currentDate.getDate() < birthdate.getDate())) {
        age--;
    }

    // Display the age in the HTML
    $('#age').text(age);
    
    var offset = 10;
    var limit = 10;
    var cardBody = $('.card-body');
    var replyText = $('#reply_text');

    cardBody.scrollTop(cardBody[0].scrollHeight);
    replyText.focus();

    replyText.keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
            $('#send_reply').click();
        }
    });

    $("#send_reply").click(function () {
        var reply_message = replyText.val();
        var conversation_id = $(this).data('conversation_id');
        var user1 = $('.profile-img').data('user1');
        var user2 = $('.profile-img').data('user2');

        var data = {
            message_text: reply_message,
            sender_id: user1,
            receiver_id: user2,
            conversation_id: conversation_id
        };

        $.ajax({
            type: 'POST',
            url: '/messageboard/messages/reply',
            data: data,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    var newMessage = response.message;
                    var sender = response.sender;
                    var messageContainer = $('.conversation-container');
                    var messageDiv = $('<div class="message sender"></div>');
                    var profileImg = $('<img class="profile-img" style="width: 50px;height: 50px;border-radius: 50%;background-color: #fff;margin-top:10px;" src="/messageboard/img/user_images/' + sender.User.profile_img + '"alt="' + newMessage.sender_name + '" />');
                    var messageContent = $('<div class="message-content" style="background-color: #007bff;color: white;padding: 10px;border-radius: 10px;margin-right:10px;">' + newMessage.Message.message_text + '</div>');
                    var messageTime = $('<div class="message-time" style="font-size: 12px;margin-right: 10px;">' + newMessage.Message.created + '</div>');
                    var deleteIcon = $('<i class="delete-icon fas fa-trash btnDelete" data-message-id="' + newMessage.Message.id + '" style="margin-right:10px;"></i>');
                
                    messageDiv.append(messageTime, messageContent, deleteIcon, profileImg);
                    messageContainer.append(messageDiv);
                    replyText.val('');
                    replyText.focus('');
                    cardBody.scrollTop(cardBody[0].scrollHeight);

                    applyEllipsis();
                } else {
                    alert('Error on response status');
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
                alert('Error: ' + error);
            }
        });
    });

    $('.btnDelete').click(function() {
        var messageID = $(this).data('message-id');
        var $message = $(this).closest('.message'); 
    
        $.ajax({
            type: 'POST',
            url: '/messageboard/messages/delete',
            data: { messageID: messageID },
            success: function(response) {
                $message.fadeOut('fast', function() {
                    $message.remove();
                });
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    });

    function applyEllipsis()
    {
        $('.message-content').each(function () {
            var content = $(this);
            var originalText = content.text();
            var maxLength = 150; // Set the maximum length to 150 characters
            var isTruncated = true;
        
            if (originalText.length > maxLength) {
                var truncatedText = originalText.substring(0, maxLength) + '...';
                content.text(truncatedText);
        
                content.attr('title', originalText); // Add a tooltip with the full content
        
                content.css('cursor', 'pointer'); // Change cursor to pointer
        
                var contentWrapper = $('<div class="message-content-wrapper"></div>'); // Create a wrapper div
                content.wrap(contentWrapper); // Wrap the content within the new div
        
                content.click(function () {
                    if (isTruncated) {
                        content.text(originalText);
                    } else {
                        content.text(truncatedText);
                    }
                    isTruncated = !isTruncated;
                });
        
                // Automatically add a line break after 200 characters
                if (originalText.length > maxLength) {
                    content.html(content.html().replace(/(.{200})/g, '$1<br>'));
                }
            }
        });
    }

    $('.message-content').each(function () {
        var content = $(this);
        var originalText = content.text();
        var maxLength = 150; // Set the maximum length to 150 characters
        var isTruncated = true;
    
        if (originalText.length > maxLength) {
            var truncatedText = originalText.substring(0, maxLength) + '...';
            content.text(truncatedText);
    
            content.attr('title', originalText); // Add a tooltip with the full content
    
            content.css('cursor', 'pointer'); // Change cursor to pointer
    
            var contentWrapper = $('<div class="message-content-wrapper"></div>'); // Create a wrapper div
            content.wrap(contentWrapper); // Wrap the content within the new div
    
            content.click(function () {
                if (isTruncated) {
                    content.text(originalText);
                } else {
                    content.text(truncatedText);
                }
                isTruncated = !isTruncated;
            });
    
            // Automatically add a line break after 200 characters
            if (originalText.length > maxLength) {
                content.html(content.html().replace(/(.{200})/g, '$1<br>'));
            }
        }
    });

    function loadMoreMessages() {
        var conversation_id = $('#btnShow').data('conversation_id');
        $.ajax({
            type: 'GET',
            url: '/messageboard/messages/showConvo',
            data: {
                conversation_id: conversation_id,
                offset: offset,
                limit: limit
            },
            dataType: 'json',
            success: function (response) {
                if (response.messages.length > 0) 
                {
                    var messageContainer = $('.conversation-container');
                    var currentUserId = response.currentUserId;

                    response.messages.forEach(function (message) {
                        var messageDiv = $('<div class="message"></div>');
                        var messageContent = $('<div class="message-content"></div>');
                        var messageTime = $('<div class="message-time"></div');
                        
                        if (message.sender.id === currentUserId) {
                            // Message is from the sender
                            messageTime.text(message.Message.created);
                            messageContent.text(message.Message.message_text);
                            messageDiv.addClass('sender');
                            
                            var deleteIcon = $('<i class="delete-icon fas fa-trash btnDelete" style="margin-left:10px;"></i>');
                            deleteIcon.attr('data-message-id', message.Message.id);
                            
                            var profileImage = $('<img class="profile-img" />');
                            profileImage.attr('src', '/messageboard/img/user_images/' + message.sender.profile_img);
                            profileImage.attr('alt', message.sender.name);
                            profileImage.attr('data-user1', message.sender.id);
                            profileImage.attr('data-user2', message.receiver.id);
                            profileImage.addClass('sender-img');
                            
                            messageDiv.append(messageTime, messageContent, deleteIcon, profileImage);
                        } else {
                            // Message is from the receiver
                            var profileImage = $('<img class="profile-img" />');
                            profileImage.attr('src', '/messageboard/img/user_images/' + message.sender.profile_img);
                            profileImage.attr('alt', message.receiver.name);
                            profileImage.attr('data-user1', message.sender.id);
                            profileImage.attr('data-user2', message.receiver.id);
                            profileImage.addClass('receiver-img');
                            
                            messageContent.text(message.Message.message_text);
                            messageTime.text(message.Message.created);
                            messageDiv.addClass('receiver');
                            
                            messageDiv.append(profileImage, messageContent, messageTime);
                        }
                        
                        messageContainer.prepend(messageDiv);
                    });
                    
                    offset += 10;
                    
                } 
                else 
                {
                    $('#btnShow').hide();
                    var noMoreMessage = $('<p class="no-more-message" style="background-color:#f2f2f2; text-align: center;padding: 10px;font-weight: bold;color: #777;">No more conversations to load</p>');
                    $('#messageForm .show_more').append(noMoreMessage);
                }
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    }
    
    
    $('#btnShow').on('click', function (e) {
        e.preventDefault();
        loadMoreMessages();
    });
    
    $('#messageSearch').on('input', function () {
        var searchKeyword = $(this).val().toLowerCase();

        // Iterate through messages and hide those that don't match the search keyword
        $('.message').each(function () {
            var messageText = $(this).find('.message-content').text().toLowerCase();
            if (messageText.includes(searchKeyword)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    
});
