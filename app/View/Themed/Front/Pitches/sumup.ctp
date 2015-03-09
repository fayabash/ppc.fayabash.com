<?php
$this->Html->script(array('sumup'),array('inline'=> FALSE));
?>
<div class="jumbotron" ng-app="app" ng-controller="mainCtrl">
    <h1>Votre réservation</h1>
    <?php
    $date = date('d', strtotime($pitch['Pitch']['start']));
    $start = date('H:i', strtotime($pitch['Pitch']['start']));
    $end = date('H:i', strtotime($pitch['Pitch']['end']));
    ?>
    <?php if ($pitch['Pitch']['type'] == 'pitch'): ?>
        <h3>- Une table pour: Le mercredi <?php echo $date; ?> à <?php echo $start; ?></h3>
        <p>Confirmer les conditions de réservation: </p>
        <p ng-model="Confirm">
            <input ng-model="Confirm.one" type="checkbox" name="one"  />
            Participations de 10 CHF par session (balles et raquettes incluses), à payer sur place avent chaque session.
            <br/>

            <input ng-model="Confirm.two" type="checkbox" name="two"  />
            Il faut avoir minimum 18 ans pour accéder au D! Club, l'entrée est gratuite.
            <br/>

        </p>
    <?php else: ?>
        <h3>- Une place de tournoi pour: Le mercredi <?php echo $date; ?> à <?php echo $start; ?></h3>
        <p>Confirmer les conditions de participations:</p>
        <p ng-model="Confirm">
            <input ng-model="Confirm.one" type="checkbox" name="one"  />
            Participations de 5 CHF par tournoi (balles et raquettes incluses), à payer sur place avent chaque tournoi.
            <br/>

            <input ng-model="Confirm.two" type="checkbox" name="two"  />
            Ils faut être disponible pendant toute la durée du tournoi et avoir 18 ans.
            <br/>

        </p>
    <?php endif; ?>
    
    <?php if ($user): ?>
        <p>
            <?php
                echo $this->Html->link('Confirmer', array(
                    'controller' => 'users',
                    'action' => 'bookings',
                    'player' => TRUE
                        ), array(
                    'class' => 'btn btn-lg btn-default',
                    'ng-disabled' => '!Confirm.one || !Confirm.two'
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
                'class' => 'btn btn-lg btn-default',
                'ng-disabled' => '!Confirm.one || !Confirm.two'
            ));
            echo '  ';
            echo $this->Html->link('Se logger', array(
                'controller' => 'users',
                'action' => 'bookings',
                'player' => TRUE
                    ), array(
                'class' => 'btn btn-lg btn-default',
                'ng-disabled' => '!Confirm.one || !Confirm.two'
            ));
            ?>
        </p>
    <?php endif; ?>
</div>

