<section>
    <?php
    echo $this->Form->create('Pitch');
    echo $this->Form->input('start',array('class' => 'form-control','timeFormat' => '24'));
    echo $this->Form->input('end', array('class'=>'form-control','timeFormat' => '24'));
    echo $this->Form->input('description', array('class'=>'form-control'));
    echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-success'));
    echo $this->Form->end();
    ?>
</section>