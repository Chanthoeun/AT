<div class="content">
                <?php 
            $adsCount = 0;
            foreach ($jobs as $job):
               if($adsCount == 4):
                  $adsCount = 0;
        ?>
                <li>
                    <a href="#">
                        <img src="<?php echo get_image('ads350x340.png'); ?>" />
                    </a>
                </li>
              <?php endif; ?>
                 <div class="job">
                        <h4 class="job-title">
                            <a href="<?php echo site_url('job-detail/'.url_title($job->title).'-'.$job->id); ?>"><?php echo $job->title; ?></a>
                        </h4>
                        <ul class="job-detail list-inline">
                            <li><i class="fa fa-building"></i> <a href="#"><?php echo $job->company; ?></a></li>
                            <li><i class="fa fa-map-marker"></i> <a href="location.html">Phnom Penh</a></li>
                            <li><i class="fa fa-dollar"></i> 1528.00</li>
                            <li><i class="fa fa-clock-o"></i> Close Date: 30-11-2015</li>
                        </ul>
                        <p class="hidden-xs">F.U.G.I offer high quality investment solutions, by bringing the latest technologies, retaining high talented people with high integrity, and producing…</p>
                    </div><!-- end job content -->
                <?php
            //$adsCount += 1;
            endforeach;
        ?>

        <nav class="pagination-align">
            <?php echo $pagination; ?>
        </nav>

    </div>