<?php 
$unit= 50;
?>
<style>
    .minutes-30{ min-height: <?php echo $unit; ?>px; }
    .minutes-60{ min-height: <?php echo 2*$unit; ?>px; }
    .minutes-90{ min-height: <?php echo 3*$unit; ?>px; }
    .minutes-120{ min-height: <?php echo 4*$unit; ?>px; }
    .minutes-150{ min-height: <?php echo 5*$unit; ?>px; }
    .minutes-180{ min-height: <?php echo 6*$unit; ?>px; }
    
    .cell-container { position: relative; width: 100%; clear: both; border-collapse: collapse; }
    .cell{ position: absolute; width: 20%; border: 1px solid gray; border-collapse: collapse; }
    .cell-inner { padding: 5px; } 
    
    .table-a { left: 20%; }
    .table-b { left: 40%; }
    .table-c { left: 60%; }
    .table-d { left: 80%; }
    
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
<div class="cell-container" style="height:50px;">
    
    <div class="cell minutes-30">
        <div class="cell-inner">
            Heures
        </div>
    </div>
    
    <div class="cell table-a minutes-30">
        <div class="cell-inner">
            Table A
        </div>
    </div>
    
    <div class="cell table-b minutes-30">
        <div class="cell-inner">
            Table B
        </div>
    </div>
    
    <div class="cell table-c minutes-30">
        <div class="cell-inner">
            Table C
        </div>
    </div>
    
    <div class="cell table-d minutes-30">
        <div class="cell-inner">
            Table D
        </div>
    </div>
    
</div>
<div class="cell-container" style="height:600px;">
    <?php for( $i = 0; $i < 12; $i++ ): ?>
        <?php
        $top = $i * $unit;
        $classes = ' cell minutes-30';
        $start = date('H:i',strtotime('2015-01-01 18:00:00') + ( 1800 * $i));
        $end = date('H:i',strtotime('2015-01-01 18:00:00') + ( 1800 * ( $i + 1)));
        ?>
        <div class="<?php echo $classes; ?>" style="top: <?php echo $top; ?>px;">
            <div class="cell-inner">
                    <?php echo 'De '.$start.' à '.$end; ?>
            </div>
        </div>
    <?php endfor; ?>
    
    <?php foreach ($pitches as $key => $p): ?>
        <?php
        $day = date('y-m-d', strtotime($p['Pitch']['start']));
        $day = strtotime($day) + 3600 * 18;
        $top = (( strtotime($p['Pitch']['start']) - $day ) / ( 60 * 30 )) * $unit;
        $delayInMinutes = ( strtotime($p['Pitch']['end']) - strtotime($p['Pitch']['start']) ) / 60;
        if( $delayInMinutes == -1410 ){
            $delayInMinutes = 30;
        }
        $classes = ' cell minutes-' . $delayInMinutes.' '. Inflector::slug(strtolower($p['Pitch']['title']), '-');
        ?>

        <div class="<?php echo $classes; ?>" style="top: <?php echo $top; ?>px;">
            <div class="cell-inner">
                <?php foreach ($p['User'] as $user): ?>
                    <?php echo $this->Html->tag('div', /*$user['firstname'] . ' ' . $user['lastname'] . ' ' .*/ $user['username'] /*. ' ' . $user['mobile']*/, array('class' => 'tag')); ?>
                <?php endforeach; ?>
            </div>
        </div>

    <?php endforeach; ?>
</div>
<div></div>
<?php
//debug($pitches);
?>