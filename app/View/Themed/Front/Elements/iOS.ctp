<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />

<link rel="apple-touch-icon" href="<?php echo $this->Html->url('/img/iOS/'); ?>logo_57x57.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $this->Html->url('/img/iOS/'); ?>logo_72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $this->Html->url('/img/iOS/'); ?>logo_114x114.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $this->Html->url('/img/iOS/'); ?>logo_144x144.png">

<!-- iPhone -->
<link href="<?php echo $this->Html->url('/img/iOS/'); ?>startup_320x460.png"
      media="(device-width: 320px) and (device-height: 480px)
      and (-webkit-device-pixel-ratio: 1)"
      rel="apple-touch-startup-image">
<!-- iPhone (Retina) -->
<link href="<?php echo $this->Html->url('/img/iOS/'); ?>startup_640x920.png"
      media="(device-width: 320px) and (device-height: 480px)
      and (-webkit-device-pixel-ratio: 2)"
      rel="apple-touch-startup-image">
<!-- iPhone 5 -->
<link href="<?php echo $this->Html->url('/img/iOS/'); ?>startup_640x1096.png"
      media="(device-width: 320px) and (device-height: 568px)
      and (-webkit-device-pixel-ratio: 2)"
      rel="apple-touch-startup-image">
<!-- iPad (portrait) -->
<link href="<?php echo $this->Html->url('/img/iOS/'); ?>startup_768x1004.png"
      media="(device-width: 768px) and (device-height: 1024px)
      and (orientation: portrait)
      and (-webkit-device-pixel-ratio: 1)"
      rel="apple-touch-startup-image">
<!-- iPad (landscape) -->
<link href="<?php echo $this->Html->url('/img/iOS/'); ?>startup_748x1024.png"
      media="(device-width: 768px) and (device-height: 1024px)
      and (orientation: landscape)
      and (-webkit-device-pixel-ratio: 1)"
      rel="apple-touch-startup-image">
<!-- iPad (Retina, portrait) -->
<link href="<?php echo $this->Html->url('/img/iOS/'); ?>startup_1536x2008.png"
      media="(device-width: 768px) and (device-height: 1024px)
      and (orientation: portrait)
      and (-webkit-device-pixel-ratio: 2)"
      rel="apple-touch-startup-image">
<!-- iPad (Retina, landscape) -->
<link href="<?php echo $this->Html->url('/img/iOS/'); ?>startup_1496x2048.png"
      media="(device-width: 768px) and (device-height: 1024px)
      and (orientation: landscape)
      and (-webkit-device-pixel-ratio: 2)"
      rel="apple-touch-startup-image">

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<script type="text/javascript">
    (function(document,navigator,standalone) {
        // prevents links from apps from oppening in mobile safari
        // this javascript must be the first script in your <head>
        if ((standalone in navigator) && navigator[standalone]) {
            var curnode, location=document.location, stop=/^(a|html)$/i;
            document.addEventListener('click', function(e) {
                curnode=e.target;
                while (!(stop).test(curnode.nodeName)) {
                    curnode=curnode.parentNode;
                }
                // Condidions to do this only on links to your own app
                // if you want all links, use if('href' in curnode) instead.
                if('href' in curnode && ( curnode.href.indexOf('http') || ~curnode.href.indexOf(location.host) ) ) {
                    e.preventDefault();
                    location.href = curnode.href;
                }
            },false);
        }
    })(document,window.navigator,'standalone');
</script>