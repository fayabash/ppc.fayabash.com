<div class="pitches form">
<?php echo $this->Form->create('Pitch'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Pitch'); ?></legend>
	<?php
		echo $this->Form->input('title', array('class'=>'form-control'));
		echo $this->Form->input('description', array('class'=>'form-control'));
		echo $this->Form->input('start', array('class'=>'form-control','timeFormat' => '24'));
		echo $this->Form->input('end', array('class'=>'form-control','timeFormat' => '24'));
		echo $this->Form->input('max_user', array('class'=>'form-control','value' => '1'));
		//echo $this->Form->input('User', array('class'=>'form-control'));
	?>
	</fieldset>
        <hr>
<?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-success')); ?>
<?php echo $this->Form->end(); ?>
</div>
