<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url(); ?>"><strong><i class="fa fa-home fa-lg"></i> <?php echo site_name(); ?></strong></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <?php if($this->uri->segment(1) == FALSE){ ?>
        <div class="collapse navbar-collapse navbar-ex1">
            <ul class="nav navbar-nav navbar-left visible-xs">
                <li <?php echo isset($menu_news) ? 'class="active"' : ''; ?>>
                    <a href="<?php echo site_url('news'); ?>"><i class="fa fa-bullhorn fa-fw"></i> <?php echo lang('home_menu_news'); ?></a>
                </li>
                
                <li <?php echo isset($menu_technique) ? 'class="active"' : ''; ?>>
                    <a href="<?php echo site_url('technique'); ?>" ><i class="fa fa-search fa-fw"></i> <?php echo lang('home_menu_technique'); ?></a>
                </li>
                
                <li <?php echo isset($menu_problem) ? 'class="active"' : ''; ?>>
                    <a href="<?php echo site_url('problem-solutions'); ?>"><i class="fa fa-legal fa-fw"></i> <?php echo lang('home_menu_problem'); ?></a>
                </li>
                
                <li <?php echo isset($menu_policy_regulation) ? 'class="active"' : ''; ?>>
                    <a href="<?php echo site_url('policy-regulation'); ?>"><i class="fa fa-book fa-fw"></i> <?php echo lang('home_menu_policy_regulation'); ?></a>
                </li>
                
                <li <?php echo isset($menu_training) ? 'class="active"' : ''; ?>>
                    <a href="<?php echo site_url('books'); ?>"><i class="fa fa-file-pdf-o fa-fw"></i> <?php echo lang('home_menu_book'); ?></a>
                </li>
                
                <li <?php echo isset($menu_buy_sell) ? 'class="active"' : ''; ?>>
                    <a href="<?php echo site_url('buy-sell'); ?>"><i class="fa fa-shopping-cart fa-fw"></i> <?php echo lang('home_menu_buy_sell'); ?></a>
                </li>
                
                <li <?php echo isset($menu_real_estate) ? 'class="active"' : ''; ?>>
                    <a href="<?php echo site_url('real-estate'); ?>"><i class="fa fa-building fa-fw"></i> <?php echo lang('home_menu_real_estate'); ?></a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li <?php echo isset($menu_about_us) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('about-us'); ?>"><i class="fa fa-home fa-fw"></i> <?php echo lang('home_menu_about_us'); ?></a></li>
                <li <?php echo isset($menu_contact_us) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('contact-us'); ?>"><i class="fa fa-envelope fa-fw"></i> <?php echo lang('home_menu_contact_us'); ?></a></li>
                <li <?php echo isset($menu_weather) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('weather'); ?>"><i class="fa fa-cloud fa-fw"></i> <?php echo lang('home_menu_weather'); ?></a></li>
                <li <?php echo isset($menu_signup) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('signup'); ?>"><i class="fa fa-user fa-fw"></i> <?php echo lang('home_menu_signup'); ?></a></li>
                <li <?php echo isset($menu_login) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('login'); ?>"><i class="fa fa-sign-in fa-fw"></i> <?php echo lang('home_menu_login'); ?></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
        <?php }else{ ?>
        <div class="collapse navbar-collapse navbar-ex1">
            <ul class="nav navbar-nav navbar-left visible-xs">
                <li <?php echo isset($menu_news) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                    <a href="<?php echo site_url('news'); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-bullhorn fa-fw"></i> <?php echo lang('home_menu_news'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($categories as $category)
                            {
                                if($category->type == 0 && $category->parent_id != 0)
                                {
                                    echo '<li>'.anchor(site_url('news/'.$category->id), $category->caption).'</li>';
                                    
                                }
                            }
                        ?>
                        <li><a href="<?php echo site_url('news'); ?>"><?php echo lang('home_more'); ?></a></li>
                    </ul>
                </li>
                
                <li <?php echo isset($menu_technique) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                    <a href="<?php echo site_url('technique'); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-search fa-fw"></i> <?php echo lang('home_menu_technique'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($categories as $category)
                            {
                                if($category->type == 0 && $category->parent_id != 0)
                                {
                                    echo '<li>'.anchor(site_url('technique/'.$category->id), $category->caption).'</li>';
                                    
                                }
                            }
                        ?>
                        <li><a href="<?php echo site_url('technique'); ?>"><?php echo lang('home_more'); ?></a></li>
                    </ul>
                </li>
                
                <li <?php echo isset($menu_problem) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                    <a href="<?php echo site_url('problem-solutions'); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-legal fa-fw"></i> <?php echo lang('home_menu_problem'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($categories as $category)
                            {
                                if($category->type == 0 && $category->parent_id != 0)
                                {
                                    echo '<li>'.anchor(site_url('problem-solutions/'.$category->id), $category->caption).'</li>';
                                    
                                }
                            }
                        ?>
                        <li><a href="<?php echo site_url('problem-solutions'); ?>"><?php echo lang('home_more'); ?></a></li>
                    </ul>
                </li>
                
                <li <?php echo isset($menu_policy_regulation) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                    <a href="<?php echo site_url('policy-regulation'); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-book fa-fw"></i> <?php echo lang('home_menu_policy_regulation'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($categories as $category)
                            {
                                if($category->type == 0 && $category->parent_id != 0)
                                {
                                    echo '<li>'.anchor(site_url('policy-regulation/'.$category->id), $category->caption).'</li>';
                                    
                                }
                            }
                        ?>
                        <li><a href="<?php echo site_url('policy-regulation'); ?>"><?php echo lang('home_more'); ?></a></li>
                    </ul>
                </li>
                
                <li <?php echo isset($menu_training) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                    <a href="<?php echo site_url('books'); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-file-pdf-o fa-fw"></i> <?php echo lang('home_menu_book'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($categories as $category)
                            {
                                if($category->type == 0 && $category->parent_id != 0)
                                {
                                    echo '<li>'.anchor(site_url('books/'.$category->id), $category->caption).'</li>';
                                    
                                }
                            }
                        ?>
                        <li><a href="<?php echo site_url('books'); ?>"><?php echo lang('home_more'); ?></a></li>
                    </ul>
                </li>
                
                <li <?php echo isset($menu_buy_sell) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                    <a href="<?php echo site_url('buy-sell'); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-shopping-cart fa-fw"></i> <?php echo lang('home_menu_buy_sell'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($categories as $category)
                            {
                                if($category->type == 1 && $category->parent_id == 3)
                                {
                                    echo '<li>'.anchor(site_url('buy-sell/'.$category->id), $category->caption).'</li>';
                                    
                                }
                            }
                        ?>
                    </ul>
                </li>
                
                <li <?php echo isset($menu_real_estate) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                    <a href="<?php echo site_url('real-estate'); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-building fa-fw"></i> <?php echo lang('home_menu_real_estate'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($categories as $category)
                            {
                                if($category->type == 1 && $category->parent_id == 4)
                                {
                                    echo '<li>'.anchor(site_url('real-estate/'.$category->id), $category->caption).'</li>';
                                    
                                }
                            }
                        ?>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li <?php echo isset($menu_about_us) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('about-us'); ?>"><i class="fa fa-home fa-fw"></i> <?php echo lang('home_menu_about_us'); ?></a></li>
                <li <?php echo isset($menu_contact_us) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('contact-us'); ?>"><i class="fa fa-envelope fa-fw"></i> <?php echo lang('home_menu_contact_us'); ?></a></li>
                <li <?php echo isset($menu_weather) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('weather'); ?>"><i class="fa fa-cloud fa-fw"></i> <?php echo lang('home_menu_weather'); ?></a></li>
                <li <?php echo isset($menu_signup) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('signup'); ?>"><i class="fa fa-user fa-fw"></i> <?php echo lang('home_menu_signup'); ?></a></li>
                <li <?php echo isset($menu_login) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('login'); ?>"><i class="fa fa-sign-in fa-fw"></i> <?php echo lang('home_menu_login'); ?></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
        <?php } ?>
    </div>
</nav>