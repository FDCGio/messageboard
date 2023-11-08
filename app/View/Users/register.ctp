<?php echo $this->Html->css('cake.generic'); ?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <?php echo $this->Session->flash(); ?>
        <div class="card mt-4">
            <div class="card-header">
                <h2>Registration</h2>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' => 'add'))); ?>
                <div class="form-group">
                    <?php echo $this->Form->input('name', array('class' => 'form-control', 'autocomplete' => 'off', 'label' => 'Name')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('email', array('class' => 'form-control', 'autocomplete' => 'off', 'label' => 'Email')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('password', array('type' => 'password', 'class' => 'form-control', 'label' => 'Password')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('password_confirmation', array(
                        'type' => 'password',
                        'class' => 'form-control',
                        'label' => 'Confirm password',
                    )); ?>
                    <?= $this->Form->label('alert', '', ['id' => 'error_msg']) ?>
                </div>
                
                <button type="submit" class="btn btn-primary" id="btnRegister">Register</button>
                
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
<?php echo $this->Html->script('/js/users/register.js'); ?>
