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
                <a class="navbar-brand visible-xs" href="#">មីនុយ</a>
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
                    <li <?php echo isset($menu_expert) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('expert'); ?>"><?php echo lang('meet_expert_label'); ?></a></li>
                </ul>

<!--                <ul class="nav navbar-nav visible-xs">
                    <li <?php echo isset($menu_news) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"><?php echo lang('news_label'); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php 
                foreach ($categories as $art){
                    if($art->article == TRUE && $art->parent_id != FALSE)
                    {
                        echo ' <li '.$checkId != FALSE && $checkId == $art->id ? 'class="active"' : ''.'><a href="'.site_url('news/'.$art->id).'"><i class="fa fa-angle-double-right fa-fw"></i> '.$art->caption.'</a></li>';
                    }
                }
             ?>
                            <li><a href="<?php echo site_url('news'); ?>"><i class="fa fa-angle-double-right fa-fw"></i> <?php echo lang('other_label'); ?></a></li>
                        </ul>
                    </li>
                    <li <?php echo isset($menu_technique) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"><?php echo lang('techniques_label'); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                             <?php 
                foreach ($categories as $tech){
                    if($tech->article == TRUE && $tech->parent_id != FALSE)
                    {
                        echo ' <li '.$checkId != FALSE && $checkId == $tech->id ? 'class="active"' : ''.'><a href="'.site_url('techniques/'.$tech->id).'"><i class="fa fa-angle-double-right fa-fw"></i> '.$tech->caption.'</a></li>';
                    }
                }
             ?>
                            <li><a href="<?php echo site_url('techniques'); ?>"><i class="fa fa-angle-double-right fa-fw"></i> <?php echo lang('other_label'); ?></a></li>
                        </ul>
                    </li>
                    <li <?php echo isset($menu_pubish) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"><?php echo lang('publish_label'); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                             <?php 
                foreach ($categories as $pub){
                    if($pub->article == TRUE && $pub->parent_id != FALSE)
                    {
                        echo ' <li '.$checkId != FALSE && $checkId == $pub->id ? 'class="active"' : ''.'><a href="'.site_url('publications/'.$pub->id).'"><i class="fa fa-angle-double-right fa-fw"></i> '.$pub->caption.'</a></li>';
                    }
                }
             ?>
                            <li><a href="<?php echo site_url('publications'); ?>"><i class="fa fa-angle-double-right fa-fw"></i> <?php echo lang('other_label'); ?></a></li>
                        </ul>
                    </li>

                    <li <?php echo isset($menu_product) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"><?php echo lang('sale_rent_product_label'); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php 
                foreach ($categories as $pro){
                    if($pro->market == TRUE && $pro->parent_id != FALSE)
                    {
                        echo ' <li '.$checkId != FALSE && $checkId == $pro->id ? 'class="active"' : ''.'><a href="'.site_url('sale-rent-product/'.$pro->id).'"><i class="fa fa-angle-double-right fa-fw"></i> '.$pro->caption.'</a></li>';
                    }
                }
             ?>
                            <li><a href="<?php echo site_url('sale-rent-product'); ?>"><i class="fa fa-angle-double-right fa-fw"></i> <?php echo lang('other_label'); ?></a></li>
                        </ul>
                    </li>

                    <li <?php echo isset($menu_land) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"><?php echo lang('sale_rent_land_label'); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php 
                foreach ($categories as $land){
                    if($land->real_estate == TRUE && $land->parent_id != FALSE)
                    {
                        echo ' <li '.$checkId != FALSE && $checkId == $lad->id ? 'class="active"' : ''.'><a href="'.site_url('sale-rent-land/'.$land->id).'"><i class="fa fa-angle-double-right fa-fw"></i> '.$land->caption.'</a></li>';
                    }
                }
             ?>
                            <li><a href="<?php echo site_url('sale-rent-land'); ?>"><i class="fa fa-angle-double-right fa-fw"></i> <?php echo lang('other_label'); ?></a></li>
                        </ul>
                    </li>
                    
                    <li <?php echo isset($menu_job) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"><?php echo lang('job_label'); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                           <?php 
                foreach ($categories as $j){
                    if($j->job == TRUE && $j->parent_id != FALSE)
                    {
                        echo ' <li '.$checkId != FALSE && $checkId == $j->id ? 'class="active"' : ''.'><a href="'.site_url('jobs/'.$j->id).'"><i class="fa fa-angle-double-right fa-fw"></i> '.$j->caption.'</a></li>';
                    }
                }
             ?>
                            <li><a href="<?php echo site_url('jobs'); ?>"><i class="fa fa-angle-double-right fa-fw"></i> <?php echo lang('all_label'); ?></a></li>
                        </ul>
                    </li>

                    <li <?php echo isset($menu_video) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"><?php echo lang('video_label'); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                           <?php 
                foreach ($categories as $vid){
                    if($vid->article == TRUE && $vid->parent_id != FALSE)
                    {
                        echo ' <li '.$checkId != FALSE && $checkId == $vid->id ? 'class="active"' : ''.'><a href="'.site_url('videos/'.$vid->id).'"><i class="fa fa-angle-double-right fa-fw"></i> '.$vid->caption.'</a></li>';
                    }
                }
             ?>
                            <li><a href="<?php echo site_url('videos'); ?>"><i class="fa fa-angle-double-right fa-fw"></i> <?php echo lang('other_label'); ?></a></li>
                        </ul>
                    </li>
                    
                    <li <?php echo isset($menu_expert) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"><?php echo lang('meet_expert_label'); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php 
                foreach ($categories as $exp){
                    if($exp->article == TRUE && $exp->parent_id != FALSE)
                    {
                        echo ' <li '.$checkId != FALSE && $checkId == $exp->id ? 'class="active"' : ''.'><a href="'.site_url('experts/'.$exp->id).'"><i class="fa fa-angle-double-right fa-fw"></i> '.$exp->caption.'</a></li>';
                    }
                }
             ?>
                            <li><a href="<?php echo site_url('experts'); ?>"><i class="fa fa-angle-double-right fa-fw"></i> <?php echo lang('other_label'); ?></a></li>
                        </ul>
                    </li>
                </ul>-->
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav><!-- menu -->