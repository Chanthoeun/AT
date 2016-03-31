<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a <?php echo isset($dashboad_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('members/'.$user->id); ?>"><i class="fa fa-dashboard fa-fw"></i> <?php echo lang('dashboard_menu_label'); ?></a>
            </li>
            <?php if($this->session->userdata('user_group') == 'Administrators'): ?>
            <li <?php echo isset($product_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> <?php echo lang('product_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($product_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('products/create/'.$user->id); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($product_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('products/'.$user->id); ?>"><i class="fa fa-shopping-cart fa-fw"></i> <?php echo lang('product_menu'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <li <?php echo isset($real_estate_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-building fa-fw"></i> <?php echo lang('real_estate_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($real_estate_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('real-estates/create/'.$user->id); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($real_estate_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('real-estates/'.$user->id); ?>"><i class="fa fa-building fa-fw"></i> <?php echo lang('sale_menu'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <?php 
        else:
            switch ($this->session->userdata('member_group'))
            {
                case 1:
     ?>
            <li <?php echo isset($real_estate_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-building fa-fw"></i> <?php echo lang('real_estate_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($real_estate_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('real-estates/create/'.$user->id); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($real_estate_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('real-estates/'.$user->id); ?>"><i class="fa fa-building fa-fw"></i> <?php echo lang('sale_menu'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <?php
                    break;
                case 4:
     ?>
            <li <?php echo isset($product_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> <?php echo lang('product_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($product_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('products/create/'.$user->id); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($product_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('products/'.$user->id); ?>"><i class="fa fa-shopping-cart fa-fw"></i> <?php echo lang('product_menu'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <li <?php echo isset($real_estate_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-building fa-fw"></i> <?php echo lang('real_estate_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($real_estate_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('real-estates/create/'.$user->id); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($real_estate_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('real-estates/'.$user->id); ?>"><i class="fa fa-building fa-fw"></i> <?php echo lang('sale_menu'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <?php
                    break;
                case 6:
     ?>
            <li <?php echo isset($real_estate_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-building fa-fw"></i> <?php echo lang('real_estate_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($real_estate_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('real-estates/create/'.$user->id); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($real_estate_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('real-estates/'.$user->id); ?>"><i class="fa fa-building fa-fw"></i> <?php echo lang('sale_menu'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <?php
                    break;
                case 8:
     ?>
            <li <?php echo isset($real_estate_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-building fa-fw"></i> <?php echo lang('real_estate_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($real_estate_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('real-estates/create/'.$user->id); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($real_estate_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('real-estates/'.$user->id); ?>"><i class="fa fa-building fa-fw"></i> <?php echo lang('sale_menu'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <?php
                    break;
            }
     ?>
            
            <?php endif; ?>
            <li>
                <a href="<?php echo site_url(); ?>" target="_blank"><i class="fa fa-eye"></i> <?php echo lang('visit_site_menu_label'); ?></a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->