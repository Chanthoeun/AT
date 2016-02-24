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
            <!-- Dashboard -->
            <li>
                <a <?php echo isset($dashboad_menu) ? 'class="active"' : ''; ?> href="<?php echo home_url(); ?>"><i class="fa fa-dashboard fa-fw"></i> <?php echo lang('dashboard_menu_label'); ?></a>
            </li>
            
            <!-- Account Management -->
            <li <?php echo isset($account_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-user fa-fw"></i> <?php echo lang('admin_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($user_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('auth/create-user'); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_user_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($user_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('auth'); ?>"><i class="fa fa-user fa-fw"></i> <?php echo lang('user_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($member_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('auth/members'); ?>"><i class="fa fa-user fa-fw"></i> <?php echo lang('member_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($group_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('groups'); ?>"><i class="fa fa-users fa-fw"></i> <?php echo lang('group_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($member_type_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('member_type'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo lang('member_type_menu_label'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <!-- Setting -->
            <li <?php echo isset($setting_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-cog fa-fw"></i> <?php echo lang('setting_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($location_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('locations'); ?>"><i class="fa fa-map-marker fa-fw"></i> <?php echo lang('location_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($category_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('categories'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo lang('category_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($people_groups_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('people-groups'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo lang('people_group_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($government_organization_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('government-organization'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo lang('government_organization_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($agribook_groups_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('agribook-group'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo lang('agribook_group_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($article_type_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('article-types'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo lang('article_type_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($library_groups_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('library-groups'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo lang('library_group_menu_label'); ?></a>
                    </li>
			
                    <li>
                        <a <?php echo isset($system_log_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('system_log'); ?>"><i class="fa fa-wrench fa-fw"></i> <?php echo lang('system_log_label'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <!-- Library -->
            <li <?php echo isset($library_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-book fa-fw"></i> <?php echo lang('library_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($library_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('library/create'); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($library_recently_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('library'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo sprintf(lang('recently_post_menu_label'), 'ឯកសារ'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($library_search_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('library/search'); ?>"><i class="fa fa-search fa-fw"></i> <?php echo lang('search_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($library_filter_group_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('library/filter-by-group'); ?>"><i class="fa fa-filter fa-fw"></i> <?php echo lang('fillter_by_group_menu_label'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <!-- Article Management -->
            <li <?php echo isset($article_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-file-text fa-fw"></i> <?php echo lang('article_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($article_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('articles/create'); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($article_recently_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('articles'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo sprintf(lang('recently_post_menu_label'), 'អត្ថបទ'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($search_article_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('articles/search'); ?>"><i class="fa fa-search fa-fw"></i> <?php echo lang('search_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($article_filter_type_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('articles/filter-by_type'); ?>"><i class="fa fa-filter fa-fw"></i> <?php echo lang('fillter_by_article_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($article_filter_category_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('articles/filter-by-category'); ?>"><i class="fa fa-filter fa-fw"></i> <?php echo lang('filter_by_category_menu_label'); ?></a>
                    </li>
                    
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <!-- Product -->
            <li <?php echo isset($product_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> <?php echo lang('product_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($product_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('products/list-all'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo sprintf(lang('recently_post_menu_label'), 'សម្ភារៈ និង​កសិផល'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($product_search_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('products/search'); ?>"><i class="fa fa-search fa-fw"></i> <?php echo lang('search_menu_label'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <!-- Real Estate -->
            <li <?php echo isset($real_estate_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-building fa-fw"></i> <?php echo lang('real_estate_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($real_estate_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('real-estates/create'); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($real_estate_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('real-estates/list-all'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo sprintf(lang('recently_post_menu_label'), 'ស្រែ​ ចំការ កសិដ្ឋាន'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($real_estate_search_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('real-estates/search'); ?>"><i class="fa fa-search fa-fw"></i> <?php echo lang('search_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($real_estate_filter_location_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('real-estates/filter-by-location'); ?>"><i class="fa fa-filter fa-fw"></i> <?php echo lang('agribook_fillter_by_location_menu_label'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <!-- Video -->
            <li <?php echo isset($video_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-film fa-fw"></i> <?php echo lang('video_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($video_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('videos/create'); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($video_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('videos'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo sprintf(lang('recently_post_menu_label'), 'វីដេអូ'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($video_search_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('videos/search'); ?>"><i class="fa fa-search fa-fw"></i> <?php echo lang('search_menu_label'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <!-- Job -->
            <li <?php echo isset($job_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-search fa-fw"></i> <?php echo lang('job_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($job_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('jobs/create'); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($job_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('jobs'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo sprintf(lang('recently_post_menu_label'), 'ការងារ'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($job_expired_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('jobs/expired'); ?>"><i class="fa fa-clock-o fa-fw"></i> <?php echo lang('expired_menu_label'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($job_search_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('jobs/search'); ?>"><i class="fa fa-search fa-fw"></i> <?php echo lang('search_menu_label'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <!-- People -->
            <li <?php echo isset($people_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-group fa-fw"></i> <?php echo lang('people_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($people_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('people/create'); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($people_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('people'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo sprintf(lang('recently_post_menu_label'), lang('people_menu_label')); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($people_search_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('people/search'); ?>"><i class="fa fa-search fa-fw"></i> <?php echo lang('search_menu_label'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <!-- Agribook -->
            <li <?php echo isset($agribook_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-book fa-fw"></i> <?php echo lang('agribook_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($agribook_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('agribooks/create'); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($agribook_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('agribooks'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo sprintf(lang('recently_post_menu_label'), lang('organization_label')); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($agribook_search_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('agribooks/search'); ?>"><i class="fa fa-search fa-fw"></i> <?php echo lang('search_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($agribook_filter_location_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('agribooks/filter-by-location'); ?>"><i class="fa fa-filter fa-fw"></i> <?php echo lang('agribook_fillter_by_location_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($agribook_filter_group_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('agribooks/filter-by-group'); ?>"><i class="fa fa-filter fa-fw"></i> <?php echo lang('agribook_filter_by_group_menu_label'); ?></a>
                    </li>
                    
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <!-- Question & Answer -->
            <li <?php echo isset($question_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-comments-o fa-fw"></i> <?php echo lang('question_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($question_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('questions/create'); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($question_recently_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('questions'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo sprintf(lang('recently_post_menu_label'), lang('question_menu_label')); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($question_search_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('questions/search'); ?>"><i class="fa fa-search fa-fw"></i> <?php echo lang('search_menu_label'); ?></a>
                    </li>
                    
                    <li>
                        <a <?php echo isset($question_filter_group_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('questions/filter-by-group'); ?>"><i class="fa fa-filter fa-fw"></i> <?php echo lang('fillter_by_group_menu_label'); ?></a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            
            <li <?php echo isset($advertise_group_menu) ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-bullhorn fa-fw"></i> <?php echo lang('advertise_menu_label'); ?><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a <?php echo isset($advertise_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('advertise/create'); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($advertise_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('advertise'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo sprintf(lang('recently_post_menu_label'), lang('advertise_menu_label')); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($advertise_expired_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('advertise/expired'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo lang('advertise_expired_menu_label'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($advertise_will_expire_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('advertise/will-expire'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo lang('advertise_will_expire_menu_label'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($advertise_paid_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('advertise/paid'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo lang('advertise_paid_menu_label'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($advertise_unpaid_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('advertise/unpaid'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo lang('advertise_unpaid_menu_label'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($advertise_deactivated_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('advertise/deactivated'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo lang('advertise_deactivated_menu_label'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($page_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('pages'); ?>"><i class="fa fa-copy fa-fw"></i> <?php echo lang('page_menu_label'); ?></a>
                    </li>
                    <li>
                        <a <?php echo isset($layout_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('layouts'); ?>"><i class="fa fa-file fa-fw"></i> <?php echo lang('layout_menu_label'); ?></a>
                    </li>
                    <li <?php echo isset($advertisor_group_menu) ? 'class="active"' : ''; ?>>
                        <a href="#"><i class="fa fa-group fa-fw"></i> <?php echo lang('advertisor_menu_label'); ?> <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a <?php echo isset($advertisor_create_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('advertisors/create'); ?>"><i class="fa fa-plus-square fa-fw"></i> <?php echo lang('create_menu_label'); ?></a>
                            </li>

                            <li>
                                <a <?php echo isset($advertisor_recently_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('advertisors'); ?>"><i class="fa fa-list fa-fw"></i> <?php echo sprintf(lang('recently_post_menu_label'), lang('advertisor_menu_label')); ?></a>
                            </li>

                            <li>
                                <a <?php echo isset($advertisor_search_menu) ? 'class="active"' : ''; ?> href="<?php echo site_url('advertisors/search'); ?>"><i class="fa fa-search fa-fw"></i> <?php echo lang('search_menu_label'); ?></a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="<?php echo site_url(); ?>" target="_blank"><i class="fa fa-eye"></i> <?php echo lang('visit_site_menu_label'); ?></a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->