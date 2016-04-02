<footer>
            <div class="container">
                <section class="row">
                    <div class="col-lg-4 footer-list">
                        <!--<h3><?php echo lang('footer_information_label'); ?></h3>-->
                        <ul>
                            <li><a href="<?php echo site_url('about-us'); ?>"><?php echo lang('about_us_menu_label'); ?></a></li>
                            <!--<li><a href="<?php echo site_url('privacy'); ?>"><?php echo lang('footer_policy_label'); ?></a></li>-->
                            <!--<li><a href="<?php echo site_url('term'); ?>"><?php echo lang('footer_condition_label'); ?></a></li>-->
                            <li><a href="<?php echo site_url('contact-us'); ?>"><?php echo lang('contact_us_menu_label'); ?></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 footer-list">
<!--                        <h3><?php echo lang('footer_account_label'); ?></h3>-->
                        <ul>
                            <?php if (!$this->ion_auth->logged_in()){ ?>
                            <li><a href="<?php echo site_url('auth/login'); ?>"><?php echo lang('login_menu_label'); ?></a></li>
                            <li><a href="<?php echo site_url('register'); ?>"><?php echo lang('register_menu_label'); ?></a></li>
                            <?php 
                } 
                else
                {
                    if($this->ion_auth->is_admin())
                    {
             ?>
                            <li><a href="<?php echo site_url('control'); ?>"><?php echo lang('access_account_menu_label').' ('.  strtoupper($this->session->userdata('identity')).')'; ?></a></li>
                            <?php
                    }
                    else
                    {
             ?>
                            <li><a href="<?php echo site_url('members'); ?>"><?php echo lang('access_account_menu_label').' ('.  strtoupper($this->session->userdata('identity')).')'; ?></a></li>
                            <?php
                    }
             ?>
                            <li><a href="<?php echo site_url('auth/logout'); ?>"><?php echo lang('logout_menu_lable'); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col-lg-4 footer-list">
                        <!--<h3><?php echo lang('footer_join_us_label'); ?></h3>-->
                        <ul class="social-media">
                            <li><a href="https://www.facebook.com/agritoday.magazine" target="_blank" title="Facebook"><i class="fa fa-facebook-square"></i></a></li>
                            <li><a href="https://plus.google.com/+AgritodayMegazine" target="_blank" title="Google+"><i class="fa fa-google-plus-square"></i></a></li>
                            <li><a href="https://twitter.com/agritodaynews" target="_blank" title="Twitter"><i class="fa fa-twitter-square"></i></a></li>
                            <li><a href="https://www.youtube.com/c/AgritodayMegazine" target="_blank" title="Youtube"><i class="fa fa-youtube-square"></i></a></li>
                            <li><a href="https://www.linkedin.com/company/agritoday" target="_blank"><i class="fa fa-linkedin-square" title="Linkedin"></i></a></li>
                        </ul>
                    </div>
                </section>
            </div>
            
            <p class="copyright">&copy; <?php echo date('Y') == '2015' ? date('Y') : '2015 - '.date('Y'). ' '.lang('copyrights_label'); ?></p>
        </footer><!-- footer -->