<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title class="title"><?php echo $this->template->print_title(); ?></title>
        <?php echo $this->template->print_meta(); ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="alexaVerifyID" content="vvkOt5-ZvGV_NhEzDM3-DKOaSiQ"/>
        <link rel="alternate" href="http://agritoday.com" hreflang="km-kh" />   
        <link rel="alternate" href="http://agritoday.com" hreflang="en-kh" />       
         <link rel="shortcut icon" type="image/ico" href="<?php echo base_url('favicon.ico'); ?>" />
        
        <!--basic styles-->
        <link href='http://fonts.googleapis.com/css?family=Hanuman:400,700|Open+Sans:400,600,600italic,700,700italic,400italic' rel='stylesheet' type='text/css'>
        <?php echo $this->template->print_css(); ?>
        
        <!-- Optional Javascript -->
        <?php echo $this->template->print_js_optional(); ?>
        
        <!-- Add this to your HEAD if you want to load the apple-touch-icons from another dir than your sites' root -->
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        
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
    
        <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,'script','https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1695382914044352');
        fbq('track', "PageView");</script>
                   <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=1695382914044352&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Facebook Pixel Code -->
    </head>

    <body>
        <!-- Header page -->
        <?php echo $header; ?>
       
        <?php if(!$this->agent->is_mobile() && !isset($no_breadcrumb)): ?>
        <section class="clearfix">
            <section class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo view_breadcrumb(); ?>
                    </div>
                </div>
            </section>
        </section>
        <?php endif; ?>
        
        <?php 
        if(isset($content_header) && $content_header == TRUE)
        {
            $this->load->view('content_header');
        }
    ?>
        
        <section class="clearfix">
            <section class="container">
                <section class="row">
                        <?php if(isset($content_sidebar) && $content_sidebar == TRUE):  ?>
                        <div class="col-md-9 col-lg-9">
                            <?php echo $content;?>
                        </div><!-- end content -->

                         <div class="col-md-3 col-lg-3">
                            <?php echo $sidebar; ?>
                        </div><!-- end sidebar -->
                        <?php else: ?>
                        <div class="col-lg-12">
                            <?php echo $content;?>
                        </div><!-- end content -->
                        <?php endif; ?>
                </section>
            </section><!-- end body -->
        </section>
        
        
        <!-- Footer -->
        <?php echo $footer; ?>
        
        <?php echo $this->template->print_js(); ?>
        
        <?php echo $this->template->print_jquery(); ?>
        
        <?php echo $this->template->print_script(); ?>
    </body>
</html>