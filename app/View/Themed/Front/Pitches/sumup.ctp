<div class="jumbotron">
    <h1>Votre réservation</h1>
    <?php
    $date = date('d', strtotime($pitch['Pitch']['start']));
    $start = date('H:i', strtotime($pitch['Pitch']['start']));
    $end = date('H:i', strtotime($pitch['Pitch']['end']));
    ?>
    <?php if ($pitch['Pitch']['type'] == 'pitch'): ?>
        <h3>- Une table pour: Le mercredi <?php echo $date; ?> à <?php echo $start; ?></h3>
    <?php else: ?>
        <h3>- Une place de tournois pour: Le mercredi <?php echo $date; ?> à <?php echo $start; ?></h3>
    <?php endif; ?>
    <p> </p>

    <?php if ($user): ?>
        <p>
            <?php
                echo $this->Html->link('Confirmer', array(
                    'controller' => 'users',
                    'action' => 'bookings',
                    'player' => TRUE
                        ), array(
                    'class' => 'btn btn-lg btn-success'
                ));
                
            ?>
        </p>
    <?php else: ?>
        <p class="alert alert-warning">
            Vous n'êtes pas connecté! Veuillez, soit vous inscrire, ou vous connecter
        </p>
        <p>
            <?php
            echo $this->Html->link('S\'inscrire', array(
                'controller' => 'users',
                'action' => 'add'
                    ), array(
                'class' => 'btn btn-lg btn-primary'
            ));
            echo '  ';
            echo $this->Html->link('Se logger', array(
                'controller' => 'users',
                'action' => 'login'
                    ), array(
                'class' => 'btn btn-lg btn-primary'
            ));
            ?>
        </p>
    <?php endif; ?>
</div>

