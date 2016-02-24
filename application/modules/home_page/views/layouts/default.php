<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php echo $this->template->print_meta(); ?>
        <title class="title"><?php echo $this->template->print_title(); ?></title>
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
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-57674511-1', 'auto');
            ga('send', 'pageview');
        </script>
        
    </head>

    <body>
        <!-- Header page -->
        <?php echo $header; ?>
        <section class="container">
            <section class="row">
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <?php echo $sidebar; ?>
                </div><!-- end sidebar -->
                
                <div class="col-sm-9 col-md-9 col-lg-9">
                    <?php echo $content;?>
                </div><!-- end content -->
            </section>
        </section><!-- end body -->
        
        <!-- Footer -->
        <?php echo $footer; ?>
        
        <?php echo $this->template->print_js(); ?>
        
        <?php echo $this->template->print_jquery(); ?>
        
        <?php echo $this->template->print_script(); ?>
        
        <!-- Facebook API -->
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=1534352553487668";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script><!-- end facebook API -->
        
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54a358ff74914370" async="async"></script>
    </body>
</html>