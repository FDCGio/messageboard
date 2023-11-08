<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10"><br>
        <div class="card">
            <div class="card-header">
                <h2>Messages List</h2>
            </div>
                <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                    <div class="container">
                        <div class="row">
                            <form id="messageForm">
                                <div class="col-md-12" id="conversation">
                                    <?php if (empty($conversations)) : ?>
                                        <div style="text-align: center; background-color:#f2f2f2; text-align: center;padding: 10px;font-weight: bold;color: #777;">No new messages</div>
                                    <?php else : ?>
                                        <?php foreach ($conversations as $conversation): ?>
                                            <div class="card">
                                                <div class="card-header">
                                                    <?php
                                                        if ($currentUserId == $conversation['Message'][0]['sender_id']) {
                                                            echo '<div><strong>' . $conversation['User2']['name'] . '</strong></div>';
                                                        } else {
                                                            echo '<strong>' . $conversation['User1']['name'] . '</strong>';
                                                        }
                                                    ?>
                                                </div>
                                                <div class="card-body">
                                                    <?php if (!empty($conversation['User1']['profile_img'])): ?>
                                                        <?php if ($conversation['User2']['id'] === $currentUserId): ?>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <?php $latestMessage = end($conversation['Message']); ?>
                                                                    <img id="img_preview" src="<?php echo $this->webroot . 'img/user_images/' . $conversation['User1']['profile_img']; ?>" style="width: 80px; height: 80px;">
                                                                </div>
                                                                <div class="col-md-10" style="opacity:0.7;">
                                                                    <?php echo $latestMessage['message_text']; ?>
                                                                </div>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <img id="img_preview" src="<?php echo $this->webroot . 'img/user_images/' . $conversation['User2']['profile_img']; ?>" style="width: 80px; height: 80px;">
                                                                </div>
                                                                <div class="col-md-10" style="opacity:0.7;">
                                                                    <?php $latestMessage = end($conversation['Message']); ?>
                                                                    <?php echo $latestMessage['message_text']; ?>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php else: ?>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <img id="img_preview" src="<?php echo $this->webroot; ?>img/empty_img.png" style="width: 80px; height: 80px;">
                                                            </div>
                                                            <div class="col-md-10" style="opacity:0.7;">
                                                                <?php $latestMessage = end($conversation['Message']); ?>
                                                                <?php echo $latestMessage['message_text']; ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="timestamp" style="float:right;">
                                                        <button class="btn btn-success btn-sm btnReply" type="button" data-conversation_id="<?php echo end($conversation['Message'])['conversation_id']; ?>" id="btnReply">Reply</button>
                                                        <button class="btn btn-danger btn-sm btnDelete" type="button" data-conversation_id="<?php echo end($conversation['Message'])['conversation_id']; ?>" id="btnReply">Delete Conversation</button>
                                                        <?php echo date('Y/m/d h:i', strtotime(end($conversation['Message'])['created'])) ?>
                                                    </div>
                                                </div>
                                                <div style="clear: both;"></div>
                                            </div>
                                            <br>
                                        <?php endforeach; ?>
                                    <?php endif;?> 
                                </div>
                                <?php if($hasMore === true): ?>
                                    <div class="show_more" style="text-align: center;">
                                        <a href="#" id="btnShow">Show More</a>
                                    </div>
                                <?php else :?>
                                    <div class="show_more" style="text-align: center;">
                                        <a href="#" id="btnShow" hidden>Show More</a>
                                    </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
<?php echo $this->Html->script('/js/messages/message_list.js');?>
