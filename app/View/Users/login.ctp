<?php $this->layout = 'default'; ?>
<br><br>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <?php echo $this->Session->flash(); ?>
        <div class="card">
            <div class="card-header text-center" style="background-color: #008080;">
                <h3 style="color: #fff;">Login</h3>
            </div>
            <div class="card-body">
                <form action="/messageboard/Users/login" method="post" id="login_form">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                        <input type="text" class="form-control" placeholder="Email" id="email" name="data[User][email]" autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Password</span>
                        <input type="password" class="form-control" placeholder="Password" id="password" name="data[User][password]">
                    </div>
                    <div class="input-group mb-3 text-center">
                        <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="<?= $this->Html->url(['controller' => 'Users', 'action' => 'register']) ?>">Register</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
    </div>
</div>
<?php echo $this->Html->script('/js/users/login.js');?>
