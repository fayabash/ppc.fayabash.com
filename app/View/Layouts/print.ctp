<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php echo $this->Html->charset(); ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            
        <?php echo $this->fetch('meta'); ?>

        <title>
            <?php echo $title_for_layout; ?>
        </title>

        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array(
            'vendor/twitter/bootstrap.min',
            'vendor/fontawesome/font-awesome.min',
            'vendor/chosen/chosen.css',
            'vendor/3xw/fonts-path-fix',
            'vendor/3xw/cake',
            'vendor/3xw/helpers',
            'admin/print'
        ));

        echo $this->fetch('css');
        ?>

    </head>
    <body>
        <div id="container" >

            <div id="content" class="container">
                <?php
                echo $this->Session->flash();
                echo $this->fetch('content');
                echo $this->element('sql_dump');
                ?>
            </div>



        </div>

        <?php echo $this->fetch('script'); ?>


    </body>
</html>