<div class="job-sidebar">
    <?php if(isset($locations) && $locations != FALSE): ?>
    <div class="job-item">
        <h4 class="job-item-title" data-toggle="collapse" data-target="#job-location"><i class="fa fa-map-marker fa-fw"></i> <?php echo lang('job_location_label'); ?></h4>
           <ul id="job-location">
               <?php foreach ($locations as $location): ?>
                       <?php if($this->uri->segment(1) == 'filter-location'): ?>
                        <li <?php echo $this->uri->segment(2) == $location->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('filter-location/'.$location->id); ?>"><?php echo $location->caption.' (<span>'.$location->job_count.'</span>)'; ?></a></li>
                       <?php else: ?>
                        <li><a href="<?php echo site_url('filter-location/'.$location->id); ?>"><?php echo $location->caption.' (<span>'.$location->job_count.'</span>)'; ?></a></li>
                    <?php endif; ?>
               <?php endforeach; ?>
           </ul>
       </div>
    <?php endif; ?>
</div><!-- Job Sidebar-->

<div class="job-list">
    <div class="job-detail" itemscope itemtype="http://schema.org/JobPosting">
        <meta itemprop="specialCommitments" content="VeteranCommit" />
           <div class="job-detail-info">
               <div class="img-box"><img src="<?php echo base_url(get_uploaded_file($job->logo)); ?>" alt="<?php echo $job->company; ?>" onerror="this.src='<?php echo get_image('no-image.png') ?>'" /></div>
               <h4><span itemprop="title"><?php echo $job->title; ?></span> <small>with</small> <span itemprop="industry"><?php echo $job->company; ?></span></h4>
                <div class="share">
                    <ul>
                        <li>
                            <a href="https://twitter.com/share" class="twitter-share-button" data-via="agritodaynews">Tweet</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                        </li>
                        <li>
                            <!-- Place this tag in your head or just before your close body tag. -->
                            <script src="https://apis.google.com/js/platform.js" async defer></script>

                            <!-- Place this tag where you want the share button to render. -->
                            <div class="g-plus" data-action="share" data-annotation="none"></div>
                        </li>
                        <li>
                            <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=443032809216230";
                fjs.parentNode.insertBefore(js, fjs);
              }(document, 'script', 'facebook-jssdk'));</script>
                            <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/"></div>
                        </li>
                        <li>
                            <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
                            <script type="IN/Share" data-url="https://github.com/tmort/Socialite"></script>
                        </li>

                    </ul>
                </div>
           </div>

           <div class="job-detail-section">
               <h4><?php echo lang('job_description_label'); ?></h4>
               <p itemprop="description"><?php echo $job->description; ?></p>
           </div>

           <div class="job-detail-section">
               <h4><?php echo lang('job_position_label'); ?></h4>
               <ul>
                   <li><span class="job-location" itemprop="jobLocation" itemscope itemtype="http://schema.org/Place"><?php echo $job->location ?></span></li>
                   <li><span class="job-category" itemprop="occupationalCategory"><?php echo $job->catcaption; ?></span></li>
                   <?php if($job->agricatcaption): ?>
                   <li><span class="job-agri"><?php echo $job->agricatcaption; ?></span></li>
                   <?php endif; ?>
                   <?php if($job->salary): ?>
                   <li><span class="job-salary" itemprop="salaryCurrency"><?php echo $job->salary; ?></span></li>
                   <?php endif; ?>
               </ul>
           </div>

           <div class="job-detail-section">
               <h4><?php echo lang('job_requirement_label'); ?></h4>
               <p itemprop="responsibilities"><?php echo $job->requirement; ?></p>
           </div>

           <div class="job-detail-section">
               <h4><?php echo lang('job_apply_label'); ?></h4>
               <?php echo $job->apply; ?>
           </div>

           <div class="job-detail-section">
               <h4><?php echo lang('job_close_date_label'); ?></h4>
               <?php echo $job->expire_date; ?>
           </div>
       </div>
</div><!-- Job job list-->