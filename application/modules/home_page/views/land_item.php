<div class="row">    
        <section class="col-lg-12">
            <div class="content">
                <ul class="real-estate">
                        <?php 
             $adsCount = 0;
             foreach ($realestates as $realestate): 
                if($adsCount == 4):
                   $adsCount = 0;
          ?>
                        <li>
                            <a href="<?php echo site_url('contact-us'); ?>">
                                <figure>
                                    <img src="<?php echo get_image('ads-land-370x316.png'); ?>" />
                                </figure>
                            </a>
                        </li>
                      <?php endif; ?>
                        <li>
                            <a href="<?php echo site_url('land-detail/'.$realestate->id); ?>">
                                    <figure>
                                        <div class="img-box">
                                                <?php echo image_thumb(get_uploaded_file($realestate->file), 210, 320, array('alt' => $realestate->title, 'onerror' => "this.src='".  get_image('no-image.png')."'")) ?>
                                        </div>
                                        <figcaption>
                                            <p class="price"><?php echo $realestate->price ?></p>
                                            <?php 
                       $getLoc = explode('/', $realestate->location_id);
                       $province = Modules::run('locations/get', $getLoc[0]);
                    ?>
                                            <p class="location"><?php echo $province->caption; ?></p>
                                            <p class="type"><?php echo rent_or_sale($realestate->category_id); ?></p>
                                        </figcaption>
                                    </figure>
                                </a>
                            </li> <!-- end item -->
                        <?php
               $adsCount += 1;
               endforeach;
             ?>
                    </ul><!-- items -->

                <nav class="pagination-align">
                    <?php echo $pagination; ?>
                </nav>

            </div>

        </section><!-- content --> 
    </div>