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
                </section>
            </div>
        </div>
</div>

<section class="clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="gallery">
                        <li>
                            <a href="<?php echo site_url('news'); ?>">
                                <i class="icon-news"></i>
                                <p><?php echo lang('news_label'); ?></p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('techniques'); ?>">
                                <i class="icon-technique"></i>
                                <p><?php echo lang('techniques_label'); ?></p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('publications'); ?>">
                                <i class="icon-publication"></i>
                                <p><?php echo lang('publish_label'); ?></p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('product-sale-rent'); ?>">
                                <i class="icon-market"></i>
                                <p><?php echo lang('sale_rent_product_label'); ?></p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('land-sale-rent'); ?>">
                                <i class="icon-sale"></i>
                                <p><?php echo lang('sale_rent_land_label'); ?></p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('job'); ?>">
                                <i class="icon-job"></i>
                                <p><?php echo lang('job_label'); ?></p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('video'); ?>">
                                <i class="icon-video"></i>
                                <p><?php echo lang('video_label'); ?></p>
                            </a>
                        </li>
                        <!--<li>
                            <a href="<?php echo site_url('experts'); ?>">
                                <i class="icon-expertise"></i>
                                <p><?php echo lang('meet_expert_label'); ?></p>
                            </a>
                        </li>
                        <li>
                            <a href="farmers.html">
                                <i class="flaticon-farm"></i>
                                <p>កសិដ្ឋាន​ជោគជ័យ</p>
                            </a>
                        </li>
                        <li>
                            <a href="training.html">
                                <i class="flaticon-training"></i>
                                <p>ការបង្រៀន​វគ្គខ្លី</p>
                            </a>
                        </li>
                        <li>
                            <a href="visit.html">
                                <i class="flaticon-visit"></i>
                                <p>ដំណើរទស្សនកិច្ច</p>
                            </a>
                        </li>
                        <li>
                            <a href="question.html">
                                <i class="flaticon-question"></i>
                                <p>សំណួរ​ និងចម្លើយ</p>
                            </a>
                        </li>-->
                    </ul>
                </div><!-- content -->
            </div>
        </div>
    </section><!-- content -->
    
    <footer class="container">
        <p class="copyright">&copy; <?php echo date('Y') == '2015' ? date('Y') : '2015 - '.date('Y'). ' '.lang('copyrights_label'); ?> </p>
        <!--<p class="credit">Font generated by <a href="http://www.flaticon.com">flaticon.com</a> under <a href="http://creativecommons.org/licenses/by/3.0/">CC BY</a>. The authors are: <a href="http://www.danielbruce.se">Daniel Bruce</a>, <a href="http://www.freepik.com">Freepik</a>, <a href="http://puppetscientists.com">Puppets</a>, <a href="http://handdrawngoods.com">Hand Drawn Goods</a>.</p>-->
    </footer>