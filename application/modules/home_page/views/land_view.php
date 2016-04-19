<div class="content backgroun-white">
    <div class="content-left">
        <div class="market-detail" itemscope itemtype="http://schema.org/Product">
            <h1 class="title" itemprop="name"><?php echo $land->title; ?></h1>
            
            <div class="market-heading">    
                <div class="img-box">
                    <img itemprop="image" src="<?php echo base_url(get_uploaded_file($land->file)); ?>"  alt="<?php echo $land->title; ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                </div><!-- product image-->

                <div class="market-info">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><strong><?php echo lang('land_type_label'); ?></strong></td>
                                    <td><?php echo $land->catcaption; ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo lang('land_price_label'); ?></strong></td>
                                    <td itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        <meta itemprop="priceCurrency" content="USD" />
                                        <p class="price" itemprop="price"><?php echo $land->price; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo lang('land_address_label'); ?></strong></td>
                                    <td><?php echo $location;?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- product info-->
                    
                    <?php if(isset($seller) && $seller != FALSE): ?>
                    <h3 class="sub-title"><?php echo lang('land_contact_label'); ?></h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><strong><?php echo lang('land_seller_label'); ?></strong></td>
                                    <td><?php echo $seller->name != FALSE ? $seller->name : 'AgriToday'; ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo lang('land_telephone_label'); ?></strong></td>
                                    <td><?php echo $seller->telephone != FALSE ? click_to_call($seller->telephone) : click_to_call('012336382, 069336382'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>

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
                <h3><?php echo lang('land_description_label'); ?></h3>
                <div itemprop="description"><?php echo $land->description; ?></div>
            </div>

            <?php if(isset($pictures) && $pictures != FALSE): ?>
            <div class="market-gallery">
                <h3 class="sub-title"><?php echo lang('land_picture_label'); ?></h3>
                <ul>
                    <?php foreach ($pictures as $picture):  ?>
                    <li>
                        <a href="<?php echo base_url(get_uploaded_file($picture->file)); ?>" class="color-box">
                            <img src="<?php echo base_url(get_uploaded_file($picture->file)); ?>" alt="<?php echo $land->title; ?>" onerror="this.src='<?php echo get_image('no-image.png') ?>'" />
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if(isset($map) && $map != FALSE): ?>
            <div class="content">
                <h3 class="sub-title"><?php echo lang('land_location_label'); ?></h3>
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
            <h4><?php echo sprintf(lang('like_label'), lang('like_land_label')); ?></h4>
            <div class="fb-page" data-href="https://www.facebook.com/agritoday.magazine/" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/agritoday.magazine/"><a href="https://www.facebook.com/agritoday.magazine/">គ្រប់​យ៉ាង​អំពី​កសិកម្ម</a></blockquote></div></div>
        </div>
        <?php if($advertises != FALSE): ?>
        <ul class="ads">
            <?php 
            $ad_content_1 = search_array($advertises, 'layout', 'ខាង​ស្តាំ​ទំព័រ 273 x 379 1');
            if($ad_content_1 != FALSE):
        ?>
            <li><a href="<?php echo $ad_content_1['link']; ?>" target="_blank" <?php echo $ad_content_1['class']; ?>><img src="<?php echo base_url(get_uploaded_file($ad_content_1['banner'])); ?>" /></a></li>
            <?php endif; ?>

            <?php 
            $ad_content_2 = search_array($advertises, 'layout', 'ខាង​ស្តាំ​ទំព័រ 273 x 379 2');
            if($ad_content_2 != FALSE):
        ?>
            <li><a href="<?php echo $ad_content_2['link']; ?>" target="_blank" <?php echo $ad_content_2['class']; ?>><img src="<?php echo base_url(get_uploaded_file($ad_content_2['banner'])); ?>" /></a></li>
            <?php endif; ?>

            <?php 
            $ad_content_3 = search_array($advertises, 'layout', 'ខាង​ស្តាំ​ទំព័រ 273 x 379 3');
            if($ad_content_3 != FALSE):
        ?>
            <li><a href="<?php echo $ad_content_3['link']; ?>" target="_blank" <?php echo $ad_content_3['class']; ?>><img src="<?php echo base_url(get_uploaded_file($ad_content_3['banner'])); ?>" /></a></li>
            <?php endif; ?>

            <?php 
            $ad_content_4 = search_array($advertises, 'layout', 'ខាង​ស្តាំ​ទំព័រ 273 x 379 4');
            if($ad_content_4 != FALSE):
        ?>
            <li><a href="<?php echo $ad_content_4['link']; ?>" target="_blank" <?php echo $ad_content_4['class']; ?>><img src="<?php echo base_url(get_uploaded_file($ad_content_4['banner'])); ?>" /></a></li>
            <?php endif; ?>

            <?php 
            $ad_content_5 = search_array($advertises, 'layout', 'ខាង​ស្តាំ​ទំព័រ 273 x 379 5');
            if($ad_content_5 != FALSE):
        ?>
            <li><a href="<?php echo $ad_content_5['link']; ?>" target="_blank" <?php echo $ad_content_5['class']; ?>><img src="<?php echo base_url(get_uploaded_file($ad_content_5['banner'])); ?>" /></a></li>
            <?php endif; ?>
            <li><a href="<?php echo site_url('contact-us'); ?>"><img src="<?php echo get_image('ads-detail-273x379.png'); ?>" /></a></li>
        </ul>
    <?php else: ?>
        <ul class="ads">
            <li><a href="<?php echo site_url('contact-us'); ?>"><img src="<?php echo get_image('ads-detail-273x379.png'); ?>" /></a></li>
        </ul>
    <?php endif; ?>
    </div><!-- content-right -->
    
    <?php if(isset($similar_lands) && $similar_lands != FALSE): ?>
    <div class="clearfix"></div>
                            
    <a href="<?php echo site_url('land-sale-rent/'.$land->category_id); ?>"><h3 class="a-title"><?php echo lang('land_similar_label'); ?> <span class="title-line">&nbsp;</span></h3></a>
        <ul class="real-estate">
            <?php foreach ($similar_lands as $similar_land): ?>
            <li>
                <a href="<?php echo site_url('land-detail/'.$similar_land->id); ?>">
                        <figure>
                            <div class="img-box">
                                    <?php echo image_thumb(get_uploaded_file($similar_land->file), 210, 320, array('alt' => $similar_land->title, 'onerror' => "this.src='".  get_image('no-image.png')."'")) ?>
                                    <p><?php echo $similar_land->title; ?></p>
                            </div>
                            <figcaption>
                                <p class="price"><?php echo $similar_land->price ?></p>
                                <?php 
                $getLoc = explode('/', $similar_land->location_id);
                $province = Modules::run('locations/get', $getLoc[0]);
             ?>
                                <p class="location"><?php echo $province->caption; ?></p>
                                <p class="type"><?php echo rent_or_sale($similar_land->category_id); ?></p>
                            </figcaption>
                        </figure>
                    </a>
            </li> <!-- end item -->
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
