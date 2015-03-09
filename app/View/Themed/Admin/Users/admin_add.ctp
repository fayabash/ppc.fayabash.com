<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Admin Add User'); ?></legend>
        <?php
        echo $this->Form->input('email', array('class' => 'form-control'));
        echo $this->Form->input('password', array('class' => 'form-control'));
        echo $this->Form->input('score', array('class' => 'form-control','value' => '0', 'type' => 'hidden'));
        echo $this->Form->input('username', array('class' => 'form-control'));
        echo $this->Form->input('firstname',array('class' => 'form-control','placeholder' => 'votre prénom','label' => 'Prénom', 'required' => 'required'));
        echo $this->Form->input('lastname',array('class' => 'form-control','placeholder' => 'votre nom','label' => 'Nom', 'required' => 'required'));
        echo $this->Form->input('mobile',array('class' => 'form-control','placeholder' => 'votre portable','label' => 'Téléphone mobile', 'required' => 'required'));
        echo $this->Form->input('role_id', array('class' => 'form-control'));
        ?>
    </fieldset>
    <hr>
    <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-success')); ?>
    <?php echo $this->Form->end(); ?>
</div>
