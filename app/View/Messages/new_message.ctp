<?php $this->layout = 'default'; ?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6"><br>
        <div class="card mt-2">
            <div class="card-header">
                <h2>New Message</h2>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post">
                                <div class="input-group mb-3">
                                    <select class="js-example-basic-single js-states form-control search" id="recipient"></select>
                                    <input type="text" hidden id="receiver_id">
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Message" id="message" style="height: 300px"></textarea>
                                    <label for="message">Message</label>
                                </div><br>
                                <button type="submit" class="btn btn-primary" id="btnSend">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php echo $this->Html->script('/js/messages/new_message.js');?>