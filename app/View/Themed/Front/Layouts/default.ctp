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
        
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="author" content="3xW">
        <meta property="og:title" content="<?php echo (isset($ogTitle))? $ogTitle : ''; ?>">
        <meta property="og:description" content="<?php echo (isset($ogDescription))? $ogDescription : ''; ?>">
        <meta property="og:url" content="<?php echo (isset($ogUrl))? $ogUrl : ''; ?>">
        <meta property="og:image" content="<?php echo (isset($ogImage))? $ogImage : ''; ?>">
        
        <?php echo $this->fetch('meta'); ?>
        
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        
        <?php
        
        $this->HtmlVersion->version = '0.0.1';
        
        echo $this->Html->meta('icon');

        echo $this->HtmlVersion->css(array(
            'vendor/twitter/bootstrap.min',
            'vendor/fontawesome/font-awesome.min',
            //'vendor/daneden/animate.css', // http://daneden.github.io/animate.css/
            //'vendor/h5bp/effeckt.css', // http://h5bp.github.io/Effeckt.css/
            //'vendor/IanLunn/hover.css', // http://ianlunn.github.io/Hover/
            //'vendor/yairEO/fancyInput.css', // http://dropthebit.com/demos/fancy_input/fancyInput.html
            'vendor/3xw/fonts-path-fix',
            'vendor/3xw/cake',
            'vendor/3xw/helpers',
            'theme'
        ));

        echo $this->fetch('css');
        
        echo $this->element('iOS');
        
        ?>
    </head>
    <body>
        <div id="container" >
            
            <!--[if lt IE 8]>
                <div class="container">
                    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
                </div>
            <![endif]-->
            
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
            'vendor/twitter/bootstrap.min',
            'app'
        ));
        ?>
         
        <!--[if lt IE 10]>
        <?php echo $this->HtmlVersion->script('vendor/3xw/ie-lt-10'); ?>
        <![endif]-->
        <!--[if lt IE 9]>
        <?php echo $this->HtmlVersion->script('vendor/boilerplate/html5-3.6-respond-1.1.0.min'); ?>
        <![endif]-->
        <!--[if lt IE 8]>
        <?php echo $this->HtmlVersion->script('vendor/3xw/ie-lt-8'); ?>
        <![endif]-->
        <?php echo $this->fetch('script'); ?>
        
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
        
    </body>
</html>