<?php
$this->Html->script(array('add'),array('inline'=> FALSE));
?>
<div class="jumbotron" ng-app="app" ng-controller="mainCtrl">
    <h1>Changement de mot de passe</h1>
    <div ng-model="User">
        <?php
        echo $this->Form->create('User');
        echo $this->Form->input('password',array('class' => 'form-control'));
        echo $this->Form->input('password_confirm',array('class' => 'form-control','type' => 'password', 'required' => 'required'));
        
        ?>
        
        
        <p></p>
        <button class="btn btn-default btn-lg" type="submit">Changer</button>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

