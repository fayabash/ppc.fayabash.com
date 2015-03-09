<h2>Nos tables simple de la semaine:</h2>
<?php foreach ($simples as $table): ?>
    
    <?php 
    $date = date('d', strtotime($table[0]['Pitch']['start']));
    $start = date('H:i', strtotime($table[0]['Pitch']['start']));
    $end = date('H:i', strtotime($table[0]['Pitch']['end']));
    ?>

    <div class="jumbotron">
        <?php
        echo $this->Form->create('Pitch',array(
            'action' => 'sumup'
        ));
        echo $this->Form->input('start',array('value' => $table[0]['Pitch']['start'], 'type' => 'hidden'));
        echo $this->Form->input('end',array('value' => $table[0]['Pitch']['end'], 'type' => 'hidden'));
        echo $this->Form->input('type',array('value' => 'pitch', 'type' => 'hidden'));
        ?>
        <h3>Mercredi <?php echo $date; ?> de <?php echo $start; ?> à <?php echo $end; ?></h3>
        <p>Il reste encore <?php echo count($table); ?> table(s) disponible(s)</p>
        <p><?php echo $table[0]['Pitch']['description']; ?></p>
        <p>
            <button class="btn btn-success btn-lg" type="submit">Réserver</button>
        </p>
        <?php echo $this->Form->end(); ?>
    </div>

<?php endforeach; ?>

<?php 
if (count($simples) == 0) {
    echo $this->Html->tag('p', 'Il n\'y a plus de table disponible pour cette semaine :/ Next week ? :)', array('class' => 'alert alert-warning'));
}
?>




<h2>Les tournois de la semaine:</h2>
<?php foreach ($tournaments as $table): ?>

    <?php 
    $date = date('d', strtotime($table['Pitch']['start']));
    $start = date('H:i', strtotime($table['Pitch']['start']));
    $end = date('H:i', strtotime($table['Pitch']['end']));
    ?>

    <div class="jumbotron">
        <?php
        echo $this->Form->create('Pitch',array(
            'action' => 'sumup'
        ));
        echo $this->Form->input('start',array('value' => $table['Pitch']['start'], 'type' => 'hidden'));
        echo $this->Form->input('end',array('value' => $table['Pitch']['end'], 'type' => 'hidden'));
        echo $this->Form->input('type',array('value' => 'tournament', 'type' => 'hidden'));
        ?>
        <h3>Mercredi <?php echo $date; ?> de <?php echo $start; ?> à <?php echo $end; ?></h3>
        <p>Il reste encore <?php echo count($table['Pitch']['user_left']); ?> place(s) disponible(s)</p>
        <p><?php echo $table['Pitch']['description']; ?></p>
        <p>
            <button class="btn btn-success btn-lg" type="submit">Réserver</button>
        </p>
        <?php echo $this->Form->end(); ?>
    </div>
<?php endforeach; ?>

<?php 
if (count($tournaments) == 0) {
    echo $this->Html->tag('p', 'Il n\'y a plus de de tournois cette semaine :/ Next week ? :)', array('class' => 'alert alert-warning'));
}
?>