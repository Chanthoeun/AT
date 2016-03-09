<header class="clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                        <section class="branding">
                                <a href="<?php echo site_url(); ?>">
                                    <img src="<?php echo get_image('logo.png') ?>" alt="AgriToday"/>
                                </a>
                            <h1><?php echo lang('home_meta_description'); ?></h1>
                        </section>
                </div>
                <div class="col-lg-9">
                        <section class="menu">
                            <?php echo $this->load->view('top_menu'); ?>
                            
                             <?php echo $this->load->view('search_box'); ?>
                        </section>
                </div>
                </div>
        </div>
    <?php $this->load->view('menu'); ?>
</header>