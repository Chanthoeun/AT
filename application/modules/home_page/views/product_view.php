<div class="content backgroun-white">
    <div class="content-left">
        <div class="market-detail" itemscope itemtype="http://schema.org/Product">
            <h1 class="title" itemprop="name"><?php echo $product->title; ?></h1>
            
            <div class="market-heading">    
                <div class="img-box">
                    <img itemprop="image" src="<?php echo base_url(get_uploaded_file($product->file)); ?>"  alt="<?php echo $product->title; ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                </div><!-- product image-->

                <div class="market-info">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><strong><?php echo lang('product_type_label'); ?></strong></td>
                                    <td><?php echo $product->catcaption; ?></td>
                                </tr>
                                 <?php if($product->discount != FALSE && $product->end_date >= date('Y-m-d')): ?>
                                <tr>
                                    <td><strong><?php echo lang('product_discount_label'); ?></strong></td>
                                    <td><p class="discount"><?php echo $product->discount; ?></p></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo lang('product_price_label'); ?></strong></td>
                                    <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        <meta itemprop="priceCurrency" content="USD" />
                                        <p class="price"><strong itemprop="price"><?php echo get_discount_price($product->price, $product->discount).'/'.$product->price_type; ?></strong> <span><?php echo $product->price.'/'.$product->price_type; ?></span></p>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td><strong><?php echo lang('product_discount_start_label'); ?></strong></td>
                                    <td><?php echo date('l, d F Y', strtotime($product->start_date)); ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo lang('product_discount_end_label'); ?></strong></td>
                                    <td><time itemprop="priceValidUntil" datetime="<?php echo $product->end_date; ?>"><?php echo date('l, d F Y', strtotime($product->end_date)); ?></time></td>
                                </tr>
                                <?php else: ?>
                                <tr>
                                    <td><strong><?php echo lang('product_price_label'); ?></strong></td>
                                    <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        <meta itemprop="priceCurrency" content="USD" />
                                        <p class="price" itemprop="price"><?php echo $product->price.'/'.$product->price_type; ?></p>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div><!-- product info-->

                    <h3 class="sub-title"><?php echo lang('product_contact_label'); ?></h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><strong><?php echo lang('product_seller_label'); ?></strong></td>
                                    <td><a href="<?php echo site_url('orgainzation/'.$company->agribook_id); ?>"><?php echo $company->name == FALSE ? $company->name_en : $company->name; ?></a></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo lang('product_seller_address_label'); ?></strong></td>
                                    <td><?php echo $company->address.' '.$location;?></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo lang('product_seller_telephone_label'); ?></strong></td>
                                    <td><?php echo click_to_call($company->telephone); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="share">
                        <h3><?php echo lang('share_label'); ?></h3>
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
                                <div class="fb-like" data-href="<?php echo current_url(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> 

            <div class="text">
                <h3><?php echo lang('product_description_label'); ?></h3>
                <div itemprop="description"><?php echo $product->description; ?></div>
            </div>

            <?php if(isset($pictures) && $pictures != FALSE): ?>
            <div class="market-gallery">
                <h3 class="sub-title"><?php echo lang('product_picture_label'); ?></h3>
                <ul>
                    <?php foreach ($pictures as $picture):  ?>
                    <li>
                        <a href="<?php echo base_url(get_uploaded_file($picture->file)); ?>" class="color-box">
                            <img src="<?php echo base_url(get_uploaded_file($picture->file)); ?>" alt="<?php echo $product->title; ?>" onerror="this.src='<?php echo get_image('no-image.png') ?>'" />
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if(isset($map) && $map != FALSE): ?>
            <div class="content">
                <h3 class="sub-title"><?php echo lang('product_seller_location_label'); ?></h3>
                <div class="thumbnail">
                        <?php 
              echo $map['js'];
              echo $map['html'];
           ?>
                </div>
            </div>
            <?php endif; ?>
        </div><!-- end detail -->
    </div>
    
    <div class="content-right">
        <div class="facebook-like">
            <h4><?php echo sprintf(lang('like_label'), lang('like_product_label')); ?></h4>
            <div class="fb-page" data-href="https://www.facebook.com/agritoday.magazine/" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/agritoday.magazine/"><a href="https://www.facebook.com/agritoday.magazine/">គ្រប់​យ៉ាង​អំពី​កសិកម្ម</a></blockquote></div></div>
        </div>
        <?php if($advertises != FALSE): ?>
        <ul class="ads">
            <?php 
            $ad_content_1 = search_array($advertises, 'layout', 'ខាង​ស្តាំ​ទំព័រ 273 x 379 1');
            if($ad_content_1 != FALSE):
        ?>
            <li><a href="<?php echo $ad_content_1['link']; ?>" target="_blank"><img src="<?php echo base_url(get_uploaded_file($ad_content_1['banner'])); ?>" /></a></li>
            <?php endif; ?>

            <?php 
            $ad_content_2 = search_array($advertises, 'layout', 'ខាង​ស្តាំ​ទំព័រ 273 x 379 2');
            if($ad_content_2 != FALSE):
        ?>
            <li><a href="<?php echo $ad_content_2['link']; ?>" target="_blank"><img src="<?php echo base_url(get_uploaded_file($ad_content_2['banner'])); ?>" /></a></li>
            <?php endif; ?>

            <?php 
            $ad_content_3 = search_array($advertises, 'layout', 'ខាង​ស្តាំ​ទំព័រ 273 x 379 3');
            if($ad_content_3 != FALSE):
        ?>
            <li><a href="<?php echo $ad_content_3['link']; ?>" target="_blank"><img src="<?php echo base_url(get_uploaded_file($ad_content_3['banner'])); ?>" /></a></li>
            <?php endif; ?>

            <?php 
            $ad_content_4 = search_array($advertises, 'layout', 'ខាង​ស្តាំ​ទំព័រ 273 x 379 4');
            if($ad_content_4 != FALSE):
        ?>
            <li><a href="<?php echo $ad_content_4['link']; ?>" target="_blank"><img src="<?php echo base_url(get_uploaded_file($ad_content_4['banner'])); ?>" /></a></li>
            <?php endif; ?>

            <?php 
            $ad_content_5 = search_array($advertises, 'layout', 'ខាង​ស្តាំ​ទំព័រ 273 x 379 5');
            if($ad_content_5 != FALSE):
        ?>
            <li><a href="<?php echo $ad_content_5['link']; ?>" target="_blank"><img src="<?php echo base_url(get_uploaded_file($ad_content_5['banner'])); ?>" /></a></li>
            <?php endif; ?>
            <li><a href="<?php echo $ad_content_5['link']; ?>" target="_blank"><img src="<?php echo base_url(get_uploaded_file($ad_content_5['banner'])); ?>" /></a></li>
        </ul>
     <?php else: ?>
        <ul class="ads">
            <li><a href="<?php echo site_url('contact-us'); ?>"><img src="<?php echo get_image('ads-detail-273x379.png'); ?>" /></a></li>
        </ul>
    <?php endif; ?>
    </div><!-- content-right -->
    
    <?php if(isset($similar_products) && $similar_products != FALSE): ?>
    <div class="clearfix"></div>
                            
    <a href="<?php echo site_url('product-sale-rent/'.$product->category_id); ?>"><h3 class="a-title"><?php echo lang('similar_product_label'); ?> <span class="title-line">&nbsp;</span></h3></a>

        <ul class="market">
            <?php foreach ($similar_products as $similar_product): ?>
            <li>
                <a href="<?php echo site_url('product-detail/'.$similar_product->id); ?>">
                    <figure>
                        <div class="img-box">
                            <img src="<?php echo base_url(get_uploaded_file($similar_product->file)); ?>" alt="<?php echo $similar_product->title; ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                        </div>
                        <figcaption>
                            <p class="title"><?php echo $similar_product->title; ?></p>
                            <?php if($similar_product->discount != FALSE && $similar_product->end_date >= date('Y-m-d')){ ?>
                            <p class="price"><?php echo get_discount_price($similar_product->price, $similar_product->discount).' / '.$similar_product->price_type; ?> <span><?php echo $similar_product->price.' / '.$similar_product->price_type; ?></span></p>
                            <p class="discount"><?php echo $similar_product->discount; ?></p>
                            <?php }else{ ?>
                            <p class="price"><?php echo $similar_product->price; ?></p>
                            <?php } ?>
                        </figcaption>
                    </figure>
                </a>
            </li> <!-- end item -->
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
