<section>
    <h2>Salut <?php echo $user['User']['username']; ?>, voici la liste de tes réservations de la semaine:</h2>
    
    <?php //debug($user);?>
    
    <?php foreach( $user['Pitch'] as $table ): ?>
    
        <?php 
        $date = date('d-m', strtotime($table['start']));
        $start = date('H:i', strtotime($table['start']));
        $end = date('H:i', strtotime($table['end']));
        ?>
    
        <div class="jumbotron">
            <h3>Mercredi <?php echo $date; ?> de <?php echo $start; ?> à <?php echo $end; ?></h3>
            <h4>
                <?php
                echo ( $table['max_user'] > 1 )? 'Participation au tournoi' : 'Location d\'une table';
                ?>
            </h4>
            <p>
                <?php
                echo $this->Form->postLink('Annuler',array('action' => 'delete', $table['id']), array('class'=>'btn btn-danger btn-lg'), 'êtes vous sur de vouloir annuler votre réservation?');
                ?>
            </p>
            <?php echo $this->Form->end(); ?>
        </div>
    <?php endforeach; ?>
    
    <?php 
    if (count($user['Pitch']) == 0) {
        echo $this->Html->tag('p', 'Vous n\'avez aucune reservation....', array('class' => 'alert alert-warning'));
    }
    ?>
    
</section>