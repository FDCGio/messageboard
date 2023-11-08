<?php echo $this->Html->css('messages/reply_page'); ?>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <br>
        <div class="card">
            <div class="card-header">
                <h2 class="conversation-title">
                    Conversation with 
                    <?php echo $currentUserId === $conversation[0]['sender']['id'] ? 
                        $conversation[0]['receiver']['name'] : $conversation[0]['sender']['name']; ?>
                </h2>
                <div class="message-search">
                    <input type="text" id="messageSearch" placeholder="Search messages">
                </div>
            </div>
            <form id="messageForm">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if($hasMore === true): ?>
                                    <div class="show_more" style="text-align: center;">
                                    <a href="#" id="btnShow" data-conversation_id="<?php echo $conversation[0]['Conversation']['id']; ?>">Show More</a>
                                    </div>
                                <?php else :?>
                                    <div class="show_more" style="text-align: center;">
                                    <a href="#" id="btnShow" data-conversation_id="<?php echo $conversation[0]['Conversation']['id']; ?>" hidden>Show More</a>
                                    </div>
                                <?php endif; ?>
                                <div class="conversation-container">
                                    <?php foreach ($conversation as $message) : ?>
                                        <?php if ($message['sender']['id'] === $currentUserId) : ?>
                                            <div class="message sender">
                                                <div class="message-time sender_time">
                                                    <?php echo date('Y/m/d H:i', strtotime($message['Message']['created'])); ?>
                                                </div>
                                                <div class="message-content sender_content">
                                                    <?php echo $message['Message']['message_text']; ?>
                                                </div>
                                                <i class="delete-icon fas fa-trash btnDelete" data-message-id="<?php echo $message['Message']['id']; ?>" style="margin-left:10px;"></i>
                                                <img class="profile-img" data-bs-toggle="modal" data-bs-target="#profileModal" 
                                                data-user1="<?php echo $currentUserId; ?>" 
                                                data-user2="<?php echo $message['receiver']['id']; ?>" 
                                                src="<?php echo $this->webroot . 'img/user_images/' . $message['sender']['profile_img']; ?>" 
                                                alt="<?php echo $message['sender']['name']; ?>" />
                                            </div>
                                        <?php else : ?>
                                            <div class="message receiver">
                                                <img class="profile-img" data-bs-toggle="modal" data-bs-target="#profileModal" 
                                                data-user1="<?php echo $currentUserId; ?>" 
                                                data-user2="<?php echo $message['sender']['id']; ?>" 
                                                src="<?php echo $this->webroot . 'img/user_images/' . $message['sender']['profile_img']; ?>" 
                                                alt="<?php echo $message['receiver']['name']; ?>" />
                                                <div class="message-content receiver_content">
                                                    <?php echo $message['Message']['message_text']; ?>
                                                </div>
                                                <div class="message-time receiver_time">
                                                    <?php echo date('Y/m/d H:i', strtotime($message['Message']['created'])); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="reply-input">
                        <textarea id="reply_text" rows="3" placeholder="Type your message"></textarea>
                        <button type="button" id="send_reply" data-conversation_id="<?php echo $conversation[0]['Conversation']['id']; ?>"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="modal fade" id="profileModal" aria-labelledby="profileModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="profileModal">
                    User Profile of
                    <?php echo $conversation[0]['sender']['name'] ?>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="profile-details">
                    <div class="profile-image">
                        <img id="img_preview" src="<?php echo $this->webroot; ?>img/user_images/<?php echo $message['receiver']['profile_img']; ?>">
                    </div>
                    <div class="user-info">
                        <?php if ($currentUserId === $conversation[0]['sender']['id']) : ?>
                            <p><strong>Name:</strong> <?php echo $conversation[0]['receiver']['name']; ?> <span id="age"></span></p>
                            <p><strong>Gender:</strong> <?php echo $conversation[0]['receiver']['gender']; ?></p>
                            <p id="birthdate"><strong>Birthdate:</strong> <?php echo $conversation[0]['receiver']['birth']; ?></p>
                            <p><strong>Joined:</strong> <?php echo $conversation[0]['receiver']['created']; ?></p>
                            <p><strong>Last Login:</strong> <?php echo $conversation[0]['receiver']['last_login_time']; ?></p>
                            <p><strong>Hobby:</strong> <?php echo $conversation[0]['receiver']['hobby']; ?></p>
                        <?php else : ?>
                            <p><strong>Name:</strong> <?php echo $conversation[0]['sender']['name']; ?> <span id="age"></span></p>
                            <p><strong>Gender:</strong> <?php echo $conversation[0]['sender']['gender']; ?></p>
                            <p id="birthdate"><strong>Birthdate:</strong> <?php echo $conversation[0]['sender']['birth']; ?></p>
                            <p><strong>Joined:</strong> <?php echo $conversation[0]['sender']['created']; ?></p>
                            <p><strong>Last Login:</strong> <?php echo $conversation[0]['sender']['last_login_time']; ?></p>
                            <p><strong>Hobby:</strong> <?php echo $conversation[0]['sender']['hobby']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Html->script('/js/messages/reply_page.js'); ?>
