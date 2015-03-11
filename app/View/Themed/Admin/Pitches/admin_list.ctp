<style>
    .tag{
        display: inline-block;
        background: #3754db;
        color: white;
        border-radius: 4px;
        padding: 5px;
        margin-bottom: 5px;
        margin-right: 5px;
    }
</style>

<section>
    <h2>Liste des Réservations:</h2>
    <table cellpadding="0" cellspacing="0" class="table">
        <?php
        
        $count = 0;
        
        foreach( $picthes as $pitch ):
            $time = date('H:i', strtotime($pitch['Pitch']['start']));
        ?>
        <tr>
            <td><?php echo $time; ?></td>
            <td><?php echo $pitch['Pitch']['title']; ?></td>
            <td>Nombre: <?php echo count($pitch['User']); ?> sur <?php echo $pitch['Pitch']['max_user']; ?></td>
            <td>
                <?php
                foreach( $pitch['User'] as $user ){
                    echo $this->Html->tag('div', $user['firstname'].' '. $user['lastname'].' '.$user['username'],array('class' => 'tag'));
                    $count++;
                }
                ?>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
    
    <h3>Total des réservations: <?php echo $count; ?></h3>
    
</section>