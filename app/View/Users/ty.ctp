<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <?php echo $this->Session->flash(); ?><br>
        <h1>Thank you for registering</h1>
        <a href="<?= $this->Html->url(['controller' => 'users', 'action' => 'profile']) ?>">Back to Homepage</a>
    </div>
    <div class="col-md-1">

    </div>
</div>