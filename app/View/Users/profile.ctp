<?php $this->layout = 'default'; ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8"><br>
        <div class="card mt-2">
            <div class="card-header">
                <h2>User Profile</h2>
            </div>
            <div class="card-body">
            <?php echo $this->Session->flash(); ?>
            <form>
                <div class="container">
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php
                            if (!$userData['User']['profile_img']) : ?>
                                <img id="img_preview" src="<?php echo $this->webroot; ?>img/empty_img.png" style="max-width: 300px; max-height: 200px;">
                            <?php else : ?>
                                <img id="img_preview" src="<?php echo $this->webroot; ?>img/user_images/<?php echo $userData['User']['profile_img'] ?>" style="max-width: 300px; max-height: 200px;">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="<?php echo $userData['User']['name']?>" id="name" readonly style="border:none;">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color:transparent;border:none;">Gender :</span>
                            <input type="text" class="form-control" value="<?php echo $userData['User']['gender']?>" id="gender" readonly style="border:none;">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color:transparent;border:none;">Birthdate :</span>
                            <?php if(!empty($userData['User']['birth'])) : ?>
                                <input type="text" class="form-control" value="<?php echo date('F j, Y', strtotime($userData['User']['birth']))?>" id="birthdate" readonly style="border:none;">
                            <?php else : ?>
                                <input type="text" class="form-control" value="" id="birthdate" readonly style="border:none;">
                            <?php endif; ?>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color:transparent;border:none;">Joined : </span>
                            <input type="text" class="form-control" value="<?php echo date('F j, Y ga', strtotime($userData['User']['created']))?>" id="created_at" readonly style="border:none;">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="background-color:transparent;border:none;">Last Login :</span>
                            <input type="text" class="form-control" value="<?php echo date('F j, Y ga', strtotime($userData['User']['last_login_time']))?>" id="last_login_time" readonly style="border:none;">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <span class="input-group-text" style="background-color:transparent;border:none;">Hobby :</span>
                                <textarea class="form-control" id="hobby" autocomplete="off" name="data[User][hobby]" readonly style="border:none;"><?php echo $userData['User']['hobby']?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<?php echo $this->Html->script('/js/users/profile.js');?>
