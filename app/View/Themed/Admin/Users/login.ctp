<?php $this->Html->css('admin/login',null,array('inline' => FALSE)); ?>
<?php $this->Html->script('admin/login',array('inline' => FALSE)); ?>
<div class="container">
    <div class="login-container">
        <div id="output"></div>
        <div class="avatar"></div>
        <div class="form-box">
            <?php echo $this->Form->create('User'); ?>
            <input name="data[User][email]" class="form-control" maxlength="255" type="email" id="UserEmail" required="required" placeholder="email">
            <input name="data[User][password]" class="form-control" type="password" id="UserPassword" required="required" placeholder="password">
            <button class="btn btn-info btn-block login" type="submit">Login</button>
            <?php echo $this->Form->end();?>
        </div>
    </div>

</div>