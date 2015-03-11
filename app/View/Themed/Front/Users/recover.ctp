<?php $this->Html->css('login',null,array('inline' => FALSE)); ?>
<div class="container">
    <div class="login-container">
        <div id="output"></div>
        <div class="avatar"></div>
        <div class="form-box">
            <?php echo $this->Form->create('User'); ?>
            <p>
                <?php echo $message; ?>
            </p>
            <input name="data[User][email]" class="form-control" maxlength="255" type="email" id="UserEmail" required="required" placeholder="email">
            <button class="btn btn-info btn-block login" type="submit">Envoyer</button>
            <?php echo $this->Form->end();?>
        </div>
    </div>

</div>