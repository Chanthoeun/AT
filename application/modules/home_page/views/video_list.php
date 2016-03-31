<div class="content">
    <ul class="video">
        <?php 
        $adsCount = 0;
        foreach ($videos as $video):
           if($adsCount == 4):
              $adsCount = 0;
    ?>
            <li>
                <a href="#">
                    <img src="<?php echo get_image('ads-video-370x260.png'); ?>" />
                </a>
            </li>
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