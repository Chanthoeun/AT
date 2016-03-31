<nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-menu">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand visible-xs" href="#" data-toggle="collapse" data-target="#nav-menu">មីនុយ</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="nav-menu">
                <ul class="nav navbar-nav">
                    <li <?php echo isset($menu_news) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('news'); ?>"><?php echo lang('news_label'); ?></a></li>
                    <li <?php echo isset($menu_technique) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('techniques'); ?>"><?php echo lang('techniques_label'); ?></a></li>
                    <li <?php echo isset($menu_pubish) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('publications'); ?>"><?php echo lang('publish_label'); ?></a></li>
                    <li <?php echo isset($menu_product) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('product-sale-rent'); ?>"><?php echo lang('sale_rent_product_label'); ?></a></li>
                    <li <?php echo isset($menu_land) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('land-sale-rent'); ?>"><?php echo lang('sale_rent_land_label'); ?></a></li>
                    <li <?php echo isset($menu_job) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('job'); ?>"><?php echo lang('job_label'); ?></a></li>
                    <li <?php echo isset($menu_video) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('video'); ?>"><?php echo lang('video_label'); ?></a></li>
                    <!--<li <?php echo isset($menu_expert) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('expert'); ?>"><?php echo lang('meet_expert_label'); ?></a></li>-->
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav><!-- menu -->