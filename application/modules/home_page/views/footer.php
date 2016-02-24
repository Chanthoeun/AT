<footer class="footer">
    <section class="container">
        <section class="row">
            <div class="col-sm-4 col-md-4 col-lg-4">
                <h4 class="sub-header"><?php echo lang('home_footer_info'); ?></h4>
                <ul class="fa-ul">
                    <li><a href="<?php echo site_url('about-us'); ?>"><i class="fa fa-home fa-fw fa-lg"></i> <?php echo lang('home_menu_about_us'); ?></a></li>
                    <li><a href="<?php echo site_url('contact-us'); ?>"><i class="fa fa-envelope fa-fw fa-lg"></i> <?php echo lang('home_menu_contact_us'); ?></a></li>
                    <li><a href="<?php echo site_url('policy'); ?>"><i class="fa fa-legal fa-fw fa-lg"></i> <?php echo lang('home_footer_policy'); ?></a></li>
                    <li><a href="<?php echo site_url('condition'); ?>"><i class="fa fa-anchor fa-fw fa-lg"></i> <?php echo lang('home_footer_condition'); ?></a></li>
                </ul>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <h4 class="sub-header"><?php echo lang('home_footer_member'); ?></h4>
                <ul class="fa-ul">
                    <li><a href="<?php echo site_url('signup'); ?>"><i class="fa fa-user fa-fw fa-lg"></i> <?php echo lang('home_menu_signup'); ?></a></li>
                    <li><a href="<?php echo site_url('login'); ?>"><i class="fa fa-sign-in fa-fw fa-lg"></i> <?php echo lang('home_menu_login'); ?></a></li>
                </ul>
            </div>
            
            <div class="col-sm-4 col-md-4 col-lg-4">
                <h4 class="sub-header"><?php echo lang('home_footer_social'); ?></h4>
                <div class="fb-page" data-href="https://www.facebook.com/agritoday.magazine" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/agritoday.magazine"><a href="https://www.facebook.com/agritoday.magazine">AgriToday</a></blockquote></div></div>
            </div>
        </section>
    </section>
    <section class="gray-color">
        <div class="container rights text-right">
            &copy; <?php echo date('Y') > 2015 ? '2015 - '.date('Y') : date('Y'); ?> AgriToday. All Rights Reserved.
        </div>
    </section>
</footer>