<div class="row">    
        <section class="col-lg-12">
            <div class="content">
                <ul class="market">
                    <?php 
            $adsCount = 0;
            foreach ($products as $product): 
                if($adsCount == 4):
                   $adsCount = 0;
         ?>
                    <li>
                        <a href="<?php echo site_url('contact-us'); ?>">
                            <figure>
                                <img src="<?php echo get_image('ads-product-370x347.png'); ?>" />
                            </figure>
                        </a>
                    </li>
                  <?php endif; ?>
                        <li>
                            <a href="<?php echo site_url('product-detail/'.$product->id); ?>">
                                <figure>
                                    <div class="img-box">
                                        <img src="<?php echo base_url(get_uploaded_file($product->file)); ?>" alt="<?php echo $product->title; ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                                    </div>
                                    <figcaption>
                                        <p class="title"><?php echo $product->title; ?></p>
                                        <?php if($product->discount != FALSE && $product->end_date >= date('Y-m-d')){ ?>
                                        <p class="price"><?php echo get_discount_price($product->price, $product->discount).' / '.$product->price_type; ?> <span><?php echo $product->price.' / '.$product->price_type; ?></span></p>
                                        <p class="discount"><?php echo $product->discount; ?></p>
                                        <?php }else{ ?>
                                        <p class="price"><?php echo $product->price; ?></p>
                                        <?php } ?>
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