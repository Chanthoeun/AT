<header class="header">
    <?php $this->load->view('top_menu'); ?>

    <section class="container">
        <section class="row">
            <div class="col-sm-3 col-md-3 col-lg-3">
                <a href="<?php echo site_url(); ?>" class="logo">
                    <img src="<?php echo get_image('logo-white.png') ?>" alt="Agritoday Magazine" width="260" height="70" class="img-responsive"/>
                </a>
            </div><!-- End Logo -->    
            <div class="col-sm-9 col-md-9 col-lg-9 hidden-xs">
                <?php 
                    if(isset($ads_header))
                    { 
                        echo $ads_header;         
                    } 
                    else
                    {
                        echo anchor(
                                site_url('contact-us'), 
                                img(array('src' => get_image('top-banner.jpg'), 'alt' => 'Top Advertising', 'class' => 'img-responsive'))
                                );
                    }
                ?>
                <br>
            </div>
        </section><!-- End Header -->

        <div class="navbar navbar-default hidden-xs">
            <ul class="nav navbar-nav">
                <li <?php echo isset($menu_news) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                    <a href="<?php echo site_url('news'); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-bullhorn fa-fw"></i> <?php echo lang('home_menu_news'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($categories as $category)
                            {
                                if($category->type == 0 && $category->parent_id != 0)
                                {
                                    echo '<li>'.anchor(site_url('news/'.$category->id), $category->caption).'</li>';
                                    echo '<li class="divider"></li>';
                                }
                            }
                        ?>
                        <li><a href="<?php echo site_url('news'); ?>"><?php echo lang('home_more'); ?></a></li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li <?php echo isset($menu_technique) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                    <a href="<?php echo site_url('technique'); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-search fa-fw"></i> <?php echo lang('home_menu_technique'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($categories as $category)
                            {
                                if($category->type == 0 && $category->parent_id != 0)
                                {
                                    echo '<li>'.anchor(site_url('technique/'.$category->id), $category->caption).'</li>';
                                    echo '<li class="divider"></li>';
                                }
                            }
                        ?>
                        <li><a href="<?php echo site_url('technique'); ?>"><?php echo lang('home_more'); ?></a></li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li <?php echo isset($menu_problem) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                    <a href="<?php echo site_url('problem-solutions'); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-legal fa-fw"></i> <?php echo lang('home_menu_problem'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($categories as $category)
                            {
                                if($category->type == 0 && $category->parent_id != 0)
                                {
                                    echo '<li>'.anchor(site_url('problem-solutions/'.$category->id), $category->caption).'</li>';
                                    echo '<li class="divider"></li>';
                                }
                            }
                        ?>
                        <li><a href="<?php echo site_url('problem-solutions'); ?>"><?php echo lang('home_more'); ?></a></li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li <?php echo isset($menu_policy_regulation) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                    <a href="<?php echo site_url('policy-regulation'); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-book fa-fw"></i> <?php echo lang('home_menu_policy_regulation'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($categories as $category)
                            {
                                if($category->type == 0 && $category->parent_id != 0)
                                {
                                    echo '<li>'.anchor(site_url('policy-regulation/'.$category->id), $category->caption).'</li>';
                                    echo '<li class="divider"></li>';
                                }
                            }
                        ?>
                        <li><a href="<?php echo site_url('policy-regulation'); ?>"><?php echo lang('home_more'); ?></a></li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li <?php echo isset($menu_book) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                    <a href="<?php echo site_url('books'); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-file-pdf-o fa-fw"></i> <?php echo lang('home_menu_book'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($categories as $category)
                            {
                                if($category->type == 0 && $category->parent_id != 0)
                                {
                                    echo '<li>'.anchor(site_url('books/'.$category->id), $category->caption).'</li>';
                                    echo '<li class="divider"></li>';
                                }
                            }
                        ?>
                        <li><a href="<?php echo site_url('books'); ?>"><?php echo lang('home_more'); ?></a></li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li <?php echo isset($menu_buy_sell) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                    <a href="<?php echo site_url('buy-sell'); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-shopping-cart fa-fw"></i> <?php echo lang('home_menu_buy_sell'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($categories as $category)
                            {
                                if($category->type == 1 && $category->parent_id == 3)
                                {
                                    echo '<li>'.anchor(site_url('buy-sell/'.$category->id), $category->caption).'</li>';
                                    echo '<li class="divider"></li>';
                                }
                            }
                        ?>
                    </ul>
                </li>
                <li class="divider"></li>
                <li <?php echo isset($menu_real_estate) ? 'class="dropdown active"' : 'class="dropdown"'; ?>>
                    <a href="<?php echo site_url('real-estate'); ?>" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-building fa-fw"></i> <?php echo lang('home_menu_real_estate'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                            foreach ($categories as $category)
                            {
                                if($category->type == 1 && $category->parent_id == 4)
                                {
                                    echo '<li>'.anchor(site_url('real-estate/'.$category->id), $category->caption).'</li>';
                                    echo '<li class="divider"></li>';
                                }
                            }
                        ?>
                    </ul>
                </li>
            </ul>
        </div><!-- end menu -->
    </section>
</header>