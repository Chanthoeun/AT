<div class="row">    
        <section class="col-lg-12">
            <div class="content">
                <ul class="news">
                    <?php 
           $adsCount = 0;
           foreach ($articles as $article):
               if($adsCount == 4):
                   $adsCount = 0;
        ?>
                    <li>
                        <a href="#">
                            <img src="<?php echo get_image('ads-360x470.png'); ?>" />
                        </a>
                    </li>
                  <?php endif; ?>
                    <li>
                        <figure>
                            <a href="<?php echo site_url('view/'.$article->slug.'-'.$article->id); ?>">
                                <img src="<?php echo base_url(get_uploaded_file($article->picture)) ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                            </a>
                            <figcaption>
                                <h3><a href="<?php echo site_url('view/'.$article->slug.'-'.$article->id); ?>"><?php echo $article->title; ?></a></h3>
                                <p class="brief"><?php echo character_limiter($article->detail, 190); ?></p>
                                <p class="source"> <?php echo lang('source_label').' '. get_source($article->source); ?> <br><span>27 May 2015</span></p>
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