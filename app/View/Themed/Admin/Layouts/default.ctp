<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php echo $this->Html->charset(); ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <meta name="description" content="">
        <meta name="keywords" content="">

        <meta name="viewport" content="width=device-width">

        <meta name="og:title" content="">
        <meta name="og:description" content="">
        <meta name="og:image" content="">

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
            'admin/theme'
        ));

        echo $this->fetch('css');
        ?>

    </head>
    <body>
        <div id="container" >

            <!--[if lt IE 8]>
                <div class="container">
                    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
                </div>
            <![endif]-->

            <?php echo $this->element('header_admin'); ?>

            <div id="content" class="container">
                <?php
                echo $this->Session->flash();
                echo $this->fetch('content');
                echo $this->element('sql_dump');
                ?>
            </div>



        </div>

        <?php
        echo $this->Html->script(array(
            'vendor/jquery/jquery-1.10.1.min',
            'vendor/jquery/plugins/chosen.jquery.min',
            'vendor/twitter/bootstrap.min',
            'vendor/greensock/TweenLite.min',
            'vendor/tinymce/tinymce.min',
            'admin/app'
        ));
        ?>

        <!--[if lt IE 10]>
        <?php echo $this->Html->script('vendor/3xw/ie-lt-10'); ?>
        <![endif]-->
        <!--[if lt IE 9]>
        <?php echo $this->Html->script('vendor/boilerplate/html5-3.6-respond-1.1.0.min'); ?>
        <![endif]-->
        <!--[if lt IE 8]>
        <?php echo $this->Html->script('vendor/3xw/ie-lt-8'); ?>
        <![endif]-->
        <?php echo $this->fetch('script'); ?>

        <script>

            // tinymce
            tinymce.init({
                relative_urls: false,
                remove_script_host: false,
                convert_urls: true,
                selector: "textarea",
                theme: "modern",
                //menubar : false,
                plugins: ["image", "link", "table", "media", "paste", "code"],
                link_list: "<?php echo $this->Html->url(array('controller' => 'attachments', 'action' => 'list', 'no-image', 'admin' => TRUE)); ?>",
                image_class_list: [
                    {title: 'Responsive', value: 'img-responsive'},
                    {title: 'None', value: ''}
                ],
                image_list: "<?php echo $this->Html->url(array('controller' => 'attachments', 'action' => 'list', 'admin' => TRUE)); ?>",
                image_dimensions: false
            });

            $(document).ready(function() {
                $("select[multiple]").chosen({
                    width: '100%'
                });
            });

            var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
            (function(d, t) {
                var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
                g.src = '//www.google-analytics.com/ga.js';
                s.parentNode.insertBefore(g, s)
            }(document, 'script'));
        </script>

    </body>
</html>