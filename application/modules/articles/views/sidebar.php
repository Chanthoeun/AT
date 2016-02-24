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
                <a <?php echo isset($dashboad_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('articles/view/'.$article->id); ?>"><i class="fa fa-dashboard fa-fw"></i> <?php echo lang('dashboard_menu_label'); ?></a>
            </li>

            <li>
                <a <?php echo isset($add_document_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('library/create/'.$article->id.'/1'); ?>"><i class="fa fa-file-pdf-o fa-fw"></i> <?php echo lang('document_menu_label'); ?></a>
            </li>
            
            <li>
                <a <?php echo isset($add_audio_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('library/create/'.$article->id.'/2'); ?>"><i class="fa fa-music fa-fw"></i> <?php echo lang('audio_menu_label'); ?></a>
            </li>
            
            <li>
                <a <?php echo isset($add_video_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('library/create/'.$article->id.'/3'); ?>"><i class="fa fa-film fa-fw"></i> <?php echo lang('video_menu_label'); ?></a>
            </li>
            
            <li>
                <a <?php echo isset($detail_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('articles/details/'.$article->id); ?>"><i class="fa fa-pencil-square fa-fw"></i> <?php echo lang('description_menu_label'); ?></a>
            </li>
            
            <li>
                <a <?php echo isset($link_library_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('articles/link-library/'.$article->id); ?>"><i class="fa fa-link fa-fw"></i> <?php echo lang('article_link_library_menu_label'); ?></a>
            </li>
            
            <li>
                <a <?php echo isset($link_product_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('articles/link-product/'.$article->id); ?>"><i class="fa fa-link fa-fw"></i> <?php echo lang('article_link_product_menu_label'); ?></a>
            </li>
            
            <li>
                <a <?php echo isset($link_real_estate_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('articles/link-real-estate/'.$article->id); ?>"><i class="fa fa-link fa-fw"></i> <?php echo lang('article_link_real_estate_menu_label'); ?></a>
            </li>
            
            <li>
                <a <?php echo isset($link_job_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('articles/link-job/'.$article->id); ?>"><i class="fa fa-link fa-fw"></i> <?php echo lang('article_link_job_menu_label'); ?></a>
            </li>
            
            <li>
                <a <?php echo isset($link_people_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('articles/link-people/'.$article->id); ?>"><i class="fa fa-link fa-fw"></i> <?php echo lang('article_link_people_menu_label'); ?></a>
            </li>
            
            <li>
                <a <?php echo isset($link_agribook_menu)? 'class="active"' : ''; ?> href="<?php echo site_url('articles/link-agribook/'.$article->id); ?>"><i class="fa fa-link fa-fw"></i> <?php echo lang('article_link_agribook_menu_label'); ?></a>
            </li>
            
            <li>
                <a href="<?php echo site_url('articles'); ?>"><i class="fa fa-mail-reply-all fa-fw"></i> <?php echo lang('back_menu_label'); ?></a>
            </li>
            <li>
                <a href="<?php echo site_url(); ?>" target="_blank"><i class="fa fa-eye"></i> <?php echo lang('visit_site_menu_label'); ?></a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->