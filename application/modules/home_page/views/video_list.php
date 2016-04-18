<div class="content">
    <ul class="video">
        <?php 
        $adsCount = 0;
        $position = 1;
        foreach ($videos as $video):
           if($adsCount == 4):
              $adsCount = 0;
              $ad_content = search_array($advertises, 'layout', 'វិដេអូ 370 x 260 '.$position);
              if($ad_content == FALSE)
              { 
    ?>
            <li>
                <a href="<?php echo site_url('contact-us'); ?>">
                    <img src="<?php echo get_image('ads-video-370x260.png'); ?>" />
                </a>
            </li>
          <?php
           }
           else
           {
    ?>
            <li>
                <a href="<?php echo $ad_content['link']; ?>" target="_blank">
                    <img src="<?php echo base_url(get_uploaded_file($ad_content['banner'])); ?>" />
                </a>
            </li>
        <?php
              }
              $position += 1;
    ?>
            
          <?php endif; ?>
            <li>
                <a href="<?php echo site_url('video-detail/'.$video->id); ?>">
                        <figure>
                            <img src="<?php echo base_url(get_uploaded_file($video->picture)) ?>" alt="<?php echo $video->title; ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                            <figcaption>
                                    <?php echo $video->title; ?>
                            </figcaption>
                        </figure>
                    </a>
                </li> <!-- end video -->
            <?php
        $adsCount += 1;
        endforeach;
    ?>
    </ul>
                

        <nav class="pagination-align">
            <?php echo $pagination; ?>
        </nav>

    </div>