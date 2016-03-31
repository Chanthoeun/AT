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
    <?php 
      $adsCount = 0;
      foreach ($jobs as $job):
          if($adsCount == 4):
           $adsCount = 0;
  ?>
    <a href="<?php echo site_url('contact-us'); ?>" class="ads"><img src="<?php echo get_image('ads-job-846x110.png') ?>" /></a>
    <?php endif; ?>
    
    <figure class="jobs clearfix">
        <a href="<?php echo site_url('job-detail/'.$job->id); ?>"><div class="img-box"><img src="<?php echo base_url(get_uploaded_file($job->logo)) ?>" alt="<?php echo $job->title; ?>" onerror="this.src='<?php echo get_image('no-image.png') ?>'" /></div></a>
       <figcaption>
           <h3 class="job-title"><a href="<?php echo site_url('job-detail/'.$job->id); ?>"><?php echo $job->title; ?></a> <span class="job-close-date"><?php echo $job->expire_date; ?></span></h3>
            <div class="job-info">
               <ul>
                   <li><span class="job-employee"><?php echo $job->company; ?></span></li>
                   <li><span class="job-location"><?php echo $job->location ?></span></li>
                   <?php if($job->salary != FALSE): ?>
                   <li><span class="job-salary"><?php echo $job->salary ?></span></li>
                   <?php endif; ?>
               </ul>
                <a href="<?php echo site_url('job-detail/'.$job->id); ?>" class="job-view"><?php echo lang('job_view_label'); ?></a>
           </div>
       </figcaption>
   </figure><!-- end Job -->
   <?php
   $adsCount += 1;
   endforeach;
 ?>
   
   <nav class="pagination-align">
        <?php echo $pagination; ?>
    </nav>
</div><!-- Job job list-->