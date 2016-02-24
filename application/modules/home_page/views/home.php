<header class="visible-xs">
    <?php $this->load->view('top_menu'); ?>
</header>

<section class="container">
    <section class="row">
        <div class="col-sm-3 col-md-3 col-lg-3">
            <a href="<?php echo site_url(); ?>">
                <img src="<?php echo get_image('logo-white.png') ?>" alt="Agritoday Magazine" width="260" height="70" class="img-responsive"/>
            </a>
        </div>
        <div class="col-sm-9 col-md-9 col-lg-9">
            <ol class="breadcrumb hidden-xs  pull-right">
                <li><a href="<?php echo site_url('about-us'); ?>"><i class="fa fa-home fa-fw fa-lg"></i> <?php echo lang('home_menu_about_us'); ?></a></li>
                <li><a href="<?php echo site_url('contact-us'); ?>"><i class="fa fa-envelope fa-fw fa-lg"></i> <?php echo lang('home_menu_contact_us'); ?></a></li>
                <li><a href="<?php echo site_url('weather'); ?>"><i class="fa fa-cloud fa-fw"></i> <?php echo lang('home_menu_weather'); ?></a></li>
                <li><a href="<?php echo site_url('signup'); ?>"><i class="fa fa-user fa-fw fa-lg"></i> <?php echo lang('home_menu_signup'); ?></a></li>
                <li><a href="<?php echo site_url('login'); ?>"><i class="fa fa-sign-in fa-fw fa-lg"></i> <?php echo lang('home_menu_login'); ?></a></li>
            </ol>
        </div>
    </section><!-- end header -->

    <hr/>

    <section class="row">
        <div class="col-lg-12 text-center">
            <?php 
                foreach ($items as $item)
                {
                    $image = get_uploaded_file($item->photo);
                    echo anchor(
                            $item->type == 0 ? site_url('article/'.$item->id) : site_url('classified/'.'-'.$item->id), 
                            image_thumb($image, 178, 120, array('alt' => $item->caption)).
                            '<span class="caption"><strong>'.$item->caption.'</strong></span>',
                            'class="box"'
                            );
                }
            ?>
        </div>
    </section>
</section>

<footer class="container text-center">
    <hr>
    <ol class="breadcrumb hidden-xs">
        <li><a href="<?php echo site_url('news'); ?>"><i class="fa fa-bullhorn fa-fw"></i> <?php echo lang('home_menu_news'); ?></a></li>
        <li><a href="<?php echo site_url('technique'); ?>"><i class="fa fa-search fa-fw"></i> <?php echo lang('home_menu_technique'); ?></a></li>        
        <li><a href="<?php echo site_url('problem-solutions'); ?>"><i class="fa fa-legal fa-fw"></i> <?php echo lang('home_menu_problem'); ?></a></li>
        <li><a href="<?php echo site_url('policy-regulation'); ?>"><i class="fa fa-book fa-fw"></i> <?php echo lang('home_menu_policy_regulation'); ?></a></li>
        <li><a href="<?php echo site_url('training'); ?>"><i class="fa fa-graduation-cap fa-fw"></i> <?php echo lang('home_menu_training'); ?></a></li>
        <li><a href="<?php echo site_url('buy-sell'); ?>"><i class="fa fa-shopping-cart fa-fw"></i> <?php echo lang('home_menu_buy_sell'); ?></a></li>
        <li><a href="<?php echo site_url('real-estate'); ?>"><i class="fa fa-building fa-fw"></i> <?php echo lang('home_menu_real_estate'); ?></a></li>
    </ol>

    <p class="rights pull-right">&copy; <?php echo date('Y') > 2015 ? '2015 - '.date('Y') : date('Y'); ?> AgriToday. All Rights Reserved.</p>
</footer>