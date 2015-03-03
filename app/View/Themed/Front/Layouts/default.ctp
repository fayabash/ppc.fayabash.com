<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" > <!--<![endif]-->
    <head>
        <?php echo $this->Html->charset(); ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        
        <meta name="description" content="Fondée en 1975, la maison Climatec bénéficie d’une solide expérience dans l’application de systèmes de climatisation et de ventilation destinés à des clients professionnels, tels que des architectes, ingénieurs ou industriels.">
        <meta name="keywords" content="Climatec-sa.com, climatec SA, climatec, ventilation, climatisation, installation, clim, Lausanne climatisation, Vaud climatisation">
        
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
        <meta name="author" content="3xW">
        <meta property="og:title" content="<?php echo (isset($ogTitle))? $ogTitle : ''; ?>">
        <meta property="og:description" content="<?php echo (isset($ogDescription))? $ogDescription : ''; ?>">
        <meta property="og:url" content="<?php echo (isset($ogUrl))? $ogUrl : ''; ?>">
        <meta property="og:image" content="<?php echo (isset($ogImage))? $ogImage : ''; ?>">
        
        <?php echo $this->fetch('meta'); ?>
        
        <title ng-bind="$state.current.data.pageTitle"></title>
        
        <?php
        
        $this->HtmlVersion->version = '0.0.1';
        
        echo $this->Html->meta('icon');

        echo $this->HtmlVersion->css(array(
            '/theme/Front/css/vendor.min',
            '/theme/Front/css/app.min'
        ));

        echo $this->fetch('css');
        
        echo $this->element('iOS');
        
        ?>
        
        <!-- ANGULAR HINT -->
        <base href="<?php echo $this->Html->url('/'); ?>" />
        
    </head>
    <body >
        <div id="container" ng-controller="mainCtrl" >
            
            <!--[if lt IE 8]>
                <div class="container">
                    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
                </div>
            <![endif]-->
            
            <div id="content" >
                <?php
                echo $this->Session->flash(); 
                echo $this->fetch('content');
                echo $this->element('sql_dump');
                ?>
            </div>
            
        </div>
        
        <?php
        echo $this->Html->script(array(
            'vendor.min',
            'app.min'
        ));
        ?>
         
        <!--[if lt IE 10]>
        <?php echo $this->HtmlVersion->script('/theme/Front/js/vendor/3xw/ie-lt-10'); ?>
        <![endif]-->
        <!--[if lt IE 9]>
        <?php echo $this->HtmlVersion->script('/theme/Front/js/vendor/boilerplate/html5-3.6-respond-1.1.0.min'); ?>
        <![endif]-->
        <!--[if lt IE 8]>
        <?php echo $this->HtmlVersion->script('/theme/Front/js/vendor/3xw/ie-lt-8'); ?>
        <![endif]-->
        <?php echo $this->fetch('script'); ?>
        
        <script>
            var _gaq=[['_setAccount','UA-44952673-24'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
        
    </body>
</html>