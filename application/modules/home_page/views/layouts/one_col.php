<!doctype html>
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
        
        
        <style>
        html, body{
            background-color: #063501;
            height: 100%;
        }
        body{
            min-height: 100%;
        }
    </style>
        
        <!--[if lt IE 9]>
                <script src="js/respond.min.js"></script>
        <![endif]-->
        
        <!-- SEO -->
        <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "LocalBusiness",
      "name" : "<?php echo lang('site_name'); ?>",
      "description" : "<?php echo lang('site_description'); ?>",
      "url": "<?php echo site_url(); ?>",
      "logo": "<?php echo get_image('logo.png'); ?>",
      "openingHours": "Mo,Tu,We,Th,Fr 08:00-17:00 Sa 08:00-12:00",
      "address": [{
            "@type": "PostalAddress",
            "addressLocality": "<?php echo lang('contact_city_label'); ?>",
            "addressRegion": "KH",
            "postalCode":"12357",
            "streetAddress": "<?php echo lang('contact_address_label'); ?>"
                }],
      "geo": {
          "@type": "GeoCoordinates",
          "latitude": "11.525551098291315",
          "longitude": "104.94444957671158"
 		}, 			
      "contactPoint" : [
        { "@type" : "ContactPoint",
          "telephone" : "+855-12-336-382",
          "contactType" : "សេវាកម្ម​អតិថិជន Customer Service"
        } ],
      "sameAs" : [ "https://www.facebook.com/agritoday.magazine",
        "https://plus.google.com/+AgritodayMegazine",
        "https://twitter.com/agritodaynews",
        "https://www.youtube.com/c/AgritodayMegazine"]
    }
    </script>
        
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