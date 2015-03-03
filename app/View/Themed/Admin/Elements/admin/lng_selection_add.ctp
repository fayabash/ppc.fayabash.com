<?php
$languages = Configure::read('Config.languages');
$language = Configure::read('Config.language');

$this->Html->script(array( 'vendor/jquery/plugins/jquery.regex.selector' ),array( 'inline' => false ));
$this->Html->script(array( 'admin/elements/lng-selection-add' ),array( 'inline' => false ));
$this->Html->scriptBlock('var languages = '.  json_encode($languages).'; var language = "'.$language.'";', array('inline' => false));

?>
<ul id="element-admin-lng-selection-add" class="nav nav-tabs">
  <?php for( $i = 0; $i < count( $languages ); $i++ ): ?>
    <li class="<?php echo ( $languages[$i] == $language )? 'active': ''; ?>"><a href="#"><?php echo $languages[$i]; ?></a></li>
  <?php endfor; ?>
</ul>
<div style="height: 30px;" ></div>