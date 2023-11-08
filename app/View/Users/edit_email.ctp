<?php $this->layout = 'default'; ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8"><br>
        <?php echo $this->Session->flash(); ?>
        <div class="card mt-2">
            <div class="card-header">
                <h2>Edit User Email</h2>
            </div>
            <div class="card-body">
                <form action="/messageboard/users/update_email" method="post">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                <?php if (!$userData['User']['profile_img']) : ?>
                                    <img id="img_preview" src="<?php echo $this->webroot; ?>img/empty_img.png" style="max-width: 300px; max-height: 200px;">
                                <?php else : ?>
                                    <img id="img_preview" src="<?php echo $this->webroot; ?>img/user_images/<?php echo $userData['User']['profile_img'] ?>" style="max-width: 300px; max-height: 200px;">
                                <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group mb-3">
                                    <input class="form-control" type="file" id="profile_img" name="data[User][profile_img]" accept=".jpg, .gif, .png" disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Name</span>
                                    <input type="text" class="form-control" value="<?php echo $userData['User']['name']?>" id="name" name="data[User][name]" autocomplete="off" disabled>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Email</span>
                                    <input type="text" class="form-control" value="<?php echo $userData['User']['email']?>" id="email" autocomplete="off" name="data[User][email]">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Birthdate</span>
                                    <input type="text" class="form-control" value="<?php echo $userData['User']['birth']?>" id="datepicker" autocomplete="off" name="data[User][birth]" disabled>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="gender" style="padding-right:20px;">Gender</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="data[User][gender]" id="male" value="Male" <?php if ($userData['User']['gender'] === 'Male') echo 'checked'; ?> disabled>
                                        <label class="form-check-label" for="male" value="Male">Male</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="data[User][gender]" id="female" value="Female" <?php if ($userData['User']['gender'] === 'Female') echo 'checked'; ?> disabled>
                                        <label class="form-check-label" for="female" value="Female">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <span class="input-group-text">Hobby</span>
                                    <textarea class="form-control" id="hobby" autocomplete="off" name="data[User][hobby]" disabled><?php echo $userData['User']['hobby']?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" id="btnUpdate">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
