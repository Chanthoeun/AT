<!doctype html>
<html lang="en">
    <head> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php echo $this->template->print_meta(); ?>

        <title><?php echo $this->template->print_title(); ?></title>
        <link rel="shortcut icon" type="image/ico" href="<?php echo base_url('favicon.ico'); ?>" />
        
        <!-- Add this to your HEAD if you want to load the apple-touch-icons from another dir than your sites' root -->
        <link rel="apple-touch-icon" href="<?php echo base_url('apple-touch-icon-iphone-60x60-precomposed.png'); ?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('apple-touch-icon-ipad-76x76-precomposed.png'); ?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('apple-touch-icon-iphone-retina-120x120-precomposed.png'); ?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('apple-touch-icon-ipad-retina-152x152-precomposed.png'); ?>">
        
        <!--basic styles-->
        <link href='http://fonts.googleapis.com/css?family=Hanuman:400,700|Open+Sans:400,600,600italic,700,700italic,400italic' rel='stylesheet' type='text/css'>
        <?php echo $this->template->print_css(); ?>

        <!-- Optional Javascript -->
        <?php echo $this->template->print_js_optional(); ?>
        <!--[if lt IE 9]>
                <script src="js/respond.min.js"></script>
        <![endif]-->
        
        <!-- Google Analytics -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-57674511-1', 'auto');
            ga('send', 'pageview');

        </script>
    </head>
    <body id="home">        
        <?php echo $content;?>

        <?php echo $this->template->print_js(); ?>

        <?php echo $this->template->print_jquery(); ?>
    </body> 
</html>