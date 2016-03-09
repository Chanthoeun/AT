<ul>
    <li <?php echo isset($menu_about_us) && $menu_about_us == TRUE ? 'class="active"' : ''; ?>><a href="<?php echo site_url('about-us'); ?>" title="<?php echo lang('about_us_menu_label'); ?>"><i class="fa fa-user fa-fw fa-lg"></i> <span class="hidden-xs"><?php echo lang('about_us_menu_label'); ?></span></a></li>
    <li <?php echo isset($menu_contact_us) && $menu_contact_us == TRUE ? 'class="active"' : ''; ?>><a href="<?php echo site_url('contact-us'); ?>" title="<?php echo lang('contact_us_menu_label'); ?>"><i class="fa fa-envelope fa-fw fa-lg"></i> <span class="hidden-xs"><?php echo lang('contact_us_menu_label'); ?></span></a></li>
    <li <?php echo isset($menu_agribook) && $menu_agribook == TRUE ? 'class="active"' : ''; ?>><a href="<?php echo site_url('agribook'); ?>" title="<?php echo lang('agribook_menu_label'); ?>"><i class="fa fa-book fa-fw fa-lg"></i> <span class="hidden-xs"><?php echo lang('agribook_menu_label'); ?></span></a></li>
    <?php if (!$this->ion_auth->logged_in()){ ?>
    <li<?php echo isset($menu_register) && $menu_register == TRUE ? 'class="active"' : ''; ?>><a href="<?php echo site_url('register'); ?>" title="<?php echo lang('register_menu_label'); ?>"><i class="fa fa-user-plus fa-fw fa-lg"></i> <span class="hidden-xs"><?php echo lang('register_menu_label'); ?></span></a></li>
    <li><a href="<?php echo site_url('auth/login'); ?>" title="<?php echo lang('login_menu_label'); ?>"><i class="fa fa-sign-in fa-fw fa-lg"></i> <span class="hidden-xs"><?php echo lang('login_menu_label'); ?></span></a></li>
    <?php 
    } 
    else
    {
        if($this->ion_auth->is_admin())
        {
  ?>
    <li><a href="<?php echo site_url('control'); ?>" title="<?php echo lang('access_account_menu_label').' ('.  strtoupper($this->session->userdata('identity')).')'; ?>" target="_blank"><i class="fa fa-user fa-fw fa-lg"></i> <span class="hidden-xs"><?php echo lang('access_account_menu_label').' ('.  strtoupper($this->session->userdata('identity')).')'; ?></span></a></li>
    <?php
        }
        else
        {
  ?>
    <li><a href="<?php echo site_url('members'); ?>" title="<?php echo lang('access_account_menu_label').' ('.  strtoupper($this->session->userdata('identity')).')'; ?>" target="_blank"><i class="fa fa-user fa-fw fa-lg"></i> <span class="hidden-xs"><?php echo lang('access_account_menu_label').' ('.  strtoupper($this->session->userdata('identity')).')'; ?></span></a></li>
    <?php
        }
  ?>
    <li><a href="<?php echo site_url('auth/logout'); ?>" title="<?php echo lang('logout_menu_lable'); ?>"><i class="fa fa-sign-out fa-fw fa-lg"></i> <span class="hidden-xs"><?php echo lang('logout_menu_lable'); ?></span></a></li>
    <?php
    }
  ?>
</ul>