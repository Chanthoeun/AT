<div class="row">    
        <section class="col-lg-12">
            <div class="content">
                <ul class="news">
                    <?php 
           $adsCount = 0;
           $position = 1;
           foreach ($articles as $article):
               if($adsCount == 4):
                   $adsCount = 0;
                   $ad_content = search_array($advertises, 'layout', 'ព័ត៌មាន 370 x 480 '.$position);
                   if($ad_content == FALSE)
                   {               
        ?>
                    <li>
                        <a href="<?php echo site_url('contact-us'); ?>">
                            <img src="<?php echo get_image('ads-article-370x480.png'); ?>" />
                        </a>
                    </li>
                  <?php
                   }
                   else
                   {
        ?>
                    <li>
                        <a href="<?php echo $ad_content['link']; ?>" target="_blank" <?php echo $ad_content['class']; ?>>
                            <img src="<?php echo base_url(get_uploaded_file($ad_content['banner'])); ?>" />
                        </a>
                    </li>  
                  <?php
                   }
                   $position += 1;
        ?>
                    
                  <?php endif; ?>
                    <li>
                        <figure>
                            <a href="<?php echo site_url('view/'.$article->id); ?>">
                                <img src="<?php echo base_url(get_uploaded_file($article->picture)); ?>" alt="<?php echo $article->title ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                            </a>
                            <figcaption>
                                <h3><a href="<?php echo site_url('view/'.$article->id); ?>"><?php echo $article->title; ?></a></h3>
                                <p class="brief"><?php echo character_limiter($article->detail, 190); ?></p>
                                <p class="source"> <?php echo lang('source_label').' '. get_source($article->source); ?> <br><span><?php echo date('d M Y', strtotime($article->published_on)); ?></span></p>
                            </figcaption>
                        </figure>
                    </li><!-- end news -->
                  <?php
           $adsCount += 1;
           endforeach;
        ?>
                </ul>

                <nav class="pagination-align">
                    <?php echo $pagination; ?>
                </nav>

            </div>

        </section><!-- content --> 
    </div>