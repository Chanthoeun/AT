<?php $this->load->view('search_box'); ?>

<?php $this->load->view('slideshow'); ?>

<?php echo view_breadcrumb('<ol class="breadcrumb">', '</ol>', '<i class="fa fa-home fa-fw"></i>ទំព័រដើម'); ?>

<?php if(isset($ads_midle)): ?>
<section class="row">
    <div class="col-lg-12 ads-bottom">
        <?php echo $ads_midle; ?>
    </div>
</section>
<?php endif; ?>

<section class="row">
    <div class="col-lg-12">
        <h3 class="page-header hidden-xs"><i class="fa fa-cloud fa-fw"></i> <?php echo lang('home_menu_weather'); ?></h3>
        <h4 class="page-header visible-xs"><i class="fa fa-cloud fa-fw"></i> <?php echo lang('home_menu_weather'); ?></h4>
        
        <div class="thumbnail">
            <a href="http://www.accuweather.com/en/kh/phnom-penh/49785/weather-forecast/49785" class="aw-widget-legal">
            <!--
            By accessing and/or using this code snippet, you agree to AccuWeather’s terms and conditions (in English) which can be found at http://www.accuweather.com/en/free-weather-widgets/terms and AccuWeather’s Privacy Statement (in English) which can be found at http://www.accuweather.com/en/privacy.
            -->
            </a><div id="awtd1418174418039" class="aw-widget-36hour"  data-locationkey="" data-unit="c" data-language="en-us" data-useip="true" data-uid="awtd1418174418039" data-editlocation="true"></div><script type="text/javascript" src="http://oap.accuweather.com/launch.js"></script>
        </div>
    </div><!-- end company -->
</section><!-- end Content -->

<?php if(isset($ads_bottom)): ?>
<section class="row">
    <div class="col-lg-12 ads-bottom">
        <?php echo $ads_bottom; ?>
    </div>
</section>
<?php endif; ?>