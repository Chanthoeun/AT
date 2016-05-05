<div class="content-left">
        <div class="article-box">
            <div class="article-detail" itemscope itemtype="http://schema.org/NewsArticle">
                <meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php echo site_url('view/'.$article->id); ?>"/>
                <meta itemprop="datePublished" content="<?php echo date('Y-m-d', $article->created_at); ?>"/>
                <meta itemprop="dateModified" content="<?php echo date('Y-m-d', $article->updated_at); ?>"/>
                <h3 class="new-title" itemprop="headline"><?php echo $article->title; ?></h3>
                
                <?php if($article->article_type_id == 3): ?>
                <div class="book-detail">
                        <div class="book-heading">
                                <div class="img-box" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                                        <img src="<?php echo base_url(get_uploaded_file($article->picture)); ?>" alt="<?php echo $article->title ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                                        <meta itemprop="url" content="<?php echo base_url(get_uploaded_file($article->picture)); ?>">
                                        <meta itemprop="width" content="300">
                                        <meta itemprop="height" content="200">
                                </div>
                                <div class="book-info">
                                        <div class="table-responsive">
                                             <table class="table table-bordered">
                                                     <tbody>
                                                             <tr>
                                                                     <td><strong>ប្រភេទក្រុម​ឯកសារ</strong></td>
                                                                     <td><?php echo $article->artcaption; ?></td>
                                                             </tr>
                                                             <tr>
                                                                     <td><strong>កាលបរិច្ឆេតបោះពុម្ភផ្សាយ</strong></td>
                                                                     <td><span itemprop="dateCreated"><?php echo date('d M Y', strtotime($article->published_on)); ?></span></td>
                                                             </tr>
                                                             <tr>
                                                                     <td><strong>បោះពុម្ភផ្សាយដោយ</strong></td>
                                                                     <td><span class="source" itemprop="author"><?php echo get_source($article->source); ?></span></td>
                                                             </tr>
                                                             <?php if(isset($document) && $document != FALSE): ?>
                                                             <tr>
                                                                     <td><strong><?php echo lang('download_document_label'); ?></strong></td>
                                                                     <!--<td><a <?php //echo $this->session->userdata('user_request') == TRUE ? 'href="'.base_url(get_uploaded_file($document->file)).'" download="'.$document->caption.'"' : 'href="#" class="download" data-toggle="modal" data-target="#download" data-src="'.base_url(get_uploaded_file($document->file)).'" data-name="'.$document->caption.'"' ?>><i class="fa fa-download"></i> ចុចទីនេះ</a></td>-->
                                                                     <td><?php echo anchor(base_url(get_uploaded_file($document->file)), '<i class="fa fa-download"></i> ចុចទីនេះ', array('class' => 'download', 'download' => $document->caption)); ?></td>
                                                             </tr>
                                                             <?php endif; ?>
                                                     </tbody>
                                            </table>
                                        </div>

                                         <div class="share text-center">
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
                                 }(document, 'script', 'facebook-jssdk'));
                              </script>
                                                                 <div class="fb-like" data-href="<?php echo current_url(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                                                         </li>
                                                 </ul>
                                         </div>
                                </div>
                        </div>

                        <div class="text"><?php echo $article->detail; ?></div>
                </div><!-- end detail -->
                <?php else: ?>
                <p class="date">
                        <span itemprop="dateCreated"><?php echo date('d M Y', strtotime($article->published_on)); ?></span> 
                        <span class="source" itemprop="author"><?php echo get_source($article->source); ?></span>
                </p>
                <div class="share">
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

                    <figure itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                        <img src="<?php echo base_url(get_uploaded_file($article->picture)); ?>" alt="<?php echo $article->title ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                        <meta itemprop="url" content="<?php echo base_url(get_uploaded_file($article->picture)); ?>">
                        <meta itemprop="width" content="300">
                        <meta itemprop="height" content="200">
                        <figcaption>
                                <?php echo $article->pcaption; ?>
                        </figcaption>
                    </figure>

                    <?php if(isset($audios) && $audios != FALSE): ?>
                    <fieldset>
                        <legend><i class="fa fa-bullhorn fa-fw"></i> <?php echo lang('article_audio_label'); ?></legend>
                        <?php foreach ($audios as $audio):?>
                        <audio controls>
                            <source src="<?php echo base_url(get_uploaded_file($audio->file)); ?>" type="audio/mpeg">
                            <?php echo lang('browser_not_support_label'); ?>
                        </audio>
                        <?php endforeach;?>
                    </fieldset>
                    <?php endif; ?><!-- end audio -->

                    <div class="a-detail" itemprop="description">
                        <?php 
                echo $article->detail;
                if(isset($details) && $details!= FALSE)
                {
                    foreach ($details as $detail)
                    {
                        if($detail->picture != FALSE)
                        {
           ?>
                        <figure>
                                <img src="<?php echo base_url(get_uploaded_file($detail->picture)); ?>" alt="<?php echo $detail->pcaption ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                                <figcaption>
                                    <?php echo $detail->pcaption; ?>
                                </figcaption>
                        </figure>
                        <?php     
                         }

                         if($detail->title != FALSE)
                         {
             ?>
                        <h4><?php echo $detail->title; ?></h4>     
                        <?php
                         }

                         //detail
                         echo $detail->detail;
                     }
                 }
             ?>
                        <?php if($article->full == FALSE): ?>
                        <span class="more"><?php echo get_source($article->source, FALSE, lang('read_more_label')); ?></span>
                        <?php endif; ?>
                    </div><!-- end detail -->

                    <?php if(isset($documents) && $documents != FALSE): ?>
                    <fieldset>
                        <legend><i class="fa fa-download fa-fw"></i> <?php echo lang('download_document_label'); ?></legend>
                        <?php foreach ($documents as $doc): ?>
                        <?php //echo $this->session->userdata('user_request') == TRUE ? 'href="'.base_url(get_uploaded_file($doc->file)).'" download="'.$doc->caption.'"' : 'href="#" class="download" data-toggle="modal" data-target="#download" data-src="'.base_url(get_uploaded_file($doc->file)).'" data-name="'.$doc->caption.'"' ?>
                        <a href="<?php echo base_url(get_uploaded_file($doc->file)); ?>" class="download" download="<?php echo $doc->caption; ?>" >
                                <img src="<?php echo base_url(get_uploaded_file($doc->picture)); ?>" alt="<?php echo $doc->caption ?>" onerror="this.src='<?php echo get_image('no-image.png') ?>'" />
                                        <p><?php echo $doc->caption ?></p>
                                </a>
                        <?php endforeach; ?>
                    </fieldset><!-- Download -->
                    <?php endif; ?><!-- end download document -->

                    <?php if(isset($videos) && $videos != FALSE): ?>
                    <fieldset>
                        <legend><i class="fa fa-film fa-fw"></i> <?php echo lang('watch_video_label'); ?></legend>
                        <?php foreach ($videos as $video):?>
                        <div class="thumbnail">
                                <?php echo get_video($video->file); ?>
                        </div>
                        <?php endforeach; ?>
                    </fieldset>
                    <?php endif; ?><!-- end Video -->

                    <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                        <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                            <meta itemprop="url" content="<?php echo get_image('logo.png') ?>">
                            <meta itemprop="width" content="250">
                            <meta itemprop="height" content="120">
                        </div>
                        <meta itemprop="name" content="<?php echo site_name(); ?>">
                    </div><!-- Publisher -->
                <?php endif; ?>
                    
                    <?php if($advertises != FALSE): ?>
                    <ul class="ads">
                        <?php 
                $ad_content_bottom = search_array($advertises, 'layout', 'ខាងក្រោម​ព័ត៌មាន​ 505 x 120');
                if($ad_content_bottom != FALSE):
             ?>
                        <li><a href="<?php echo $ad_content_bottom['link']; ?>" target="_blank" <?php echo $ad_content_bottom['class']; ?>><img src="<?php echo base_url(get_uploaded_file($ad_content_bottom['banner'])); ?>" /></a></li>
                        <?php endif; ?>
                    </ul><!--end ads -->
                    <?php endif; ?>
                    
                    <div class="clearfix"></div>
                    <div class="content">
                        <div class="fb-comments" data-href="<?php echo current_url(); ?>" data-numposts="5" data-width="100%"></div>
                    </div>
            </div>

            <div class="list">
                <?php if(isset($related_news) && $related_news != FALSE): ?>
                <div class="a-list">
                    <a href="<?php echo site_url('news'); ?>" class="a-heading"><h3><?php echo lang('related_news_label'); ?></h3></a>
                    <?php $firstNews = array_shift($related_news); ?>
                    <a href="<?php echo site_url('view/'.$firstNews->id); ?>">
                        <figure>
                            <img src="<?php echo base_url(get_uploaded_file($firstNews->picture)); ?>" alt="<?php echo $firstNews->title; ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                            <figcaption><?php echo $firstNews->title ?></figcaption>
                        </figure>
                    </a>
                    <ul>
                        <?php foreach ($related_news as $news): ?>
                        <li><a href="<?php echo site_url('view/'.$news->id); ?>"><?php echo $news->title; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?><!-- Related News -->
                
                <?php if($advertises != FALSE): ?>
                <ul class="a-list ads">
                    <?php 
            $ad_content_right = search_array($advertises, 'layout', 'ខាង​ស្តាំ​ព័ត៌មាន 338 x 180');
            if($ad_content_right != FALSE):
        ?>
                    <li><a href="<?php echo $ad_content_right['link']; ?>" target="_blank" <?php echo $ad_content_right['class']; ?>><img src="<?php echo base_url(get_uploaded_file($ad_content_right['banner'])); ?>" /></a></li>
                    <?php endif; ?>
                </ul><!--end ads -->
                <?php endif; ?>
                
                <?php if(isset($related_techniques) && $related_techniques != FALSE): ?>
                    <div class="a-list">
                        <a href="<?php echo site_url('techniques') ?>" class="a-heading"><h3><?php echo lang('related_technique_label'); ?></h3></a>
                        <?php $firstTechnique = array_shift($related_techniques); ?>
                        <a href="<?php echo site_url('view/'.$firstTechnique->id); ?>">
                            <figure>
                                <img src="<?php echo base_url(get_uploaded_file($firstTechnique->picture)); ?>" alt="<?php echo $firstTechnique->title; ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                                <figcaption><?php echo $firstTechnique->title ?></figcaption>
                            </figure>
                        </a>
                        <ul>
                            <?php foreach ($related_techniques as $technique): ?>
                            <li><a href="<?php echo site_url('view/'.$technique->id); ?>"><?php echo $technique->title; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?><!-- Related Technique -->
                
                <?php if(isset($people) && $people != FALSE): ?>
                    <div class="a-list">
                        <a href="#" class="a-heading"><h3><?php echo lang('related_people_label'); ?></h3></a>
                        <ul>
                            <?php foreach ($people as $p):?>

                            <li>
                                <span class="p-name"><?php echo $p->social_media == FALSE ? $p->name : anchor(prep_url($p->social_media), $p->name, array('target' => '_blank'));?></span>
                                <span class="p-position"><?php echo $p->position;?></span>
                                <span class="p-tel"><?php echo click_to_call($p->telephone);?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?><!-- Related People -->
                
                <?php if(isset($related_publications) && $related_publications != FALSE): ?>
                    <div class="a-list">
                        <a href="<?php echo site_url('publications') ?>" class="a-heading"><h3><?php echo lang('related_publication_label'); ?></h3></a>
                        <?php $firstPublication = array_shift($related_publications); ?>
                        <a href="<?php echo site_url('view/'.$firstPublication->id); ?>">
                            <figure>
                                <img src="<?php echo base_url(get_uploaded_file($firstPublication->picture)); ?>" alt="<?php echo $firstPublication->title; ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                                <figcaption><?php echo $firstPublication->title ?></figcaption>
                            </figure>
                        </a>
                        <ul>
                            <?php foreach ($related_publications as $publication): ?>
                            <li><a href="<?php echo site_url('view/'.$publication->id); ?>"><?php echo $publication->title; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?><!-- Related Publication -->
                
                 <?php if(isset($related_videos) && $related_videos != FALSE): ?>
                    <div class="a-list">
                        <a href="<?php echo site_url('video'); ?>" class="a-heading"><h3><?php echo lang('related_video_label'); ?></h3></a>
                        <?php $firstVideo = array_shift($related_videos); ?>
                        <a href="<?php echo site_url('video-detail/'.$firstVideo->id); ?>">
                            <figure>
                                <img src="<?php echo base_url(get_uploaded_file($firstVideo->picture)); ?>" alt="<?php echo $firstVideo->title; ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                                <figcaption><?php echo $firstVideo->title; ?></figcaption>
                            </figure>
                        </a>
                        <ul>
                            <?php foreach ($related_videos as $related_video):?>
                            <li><a href="<?php echo site_url('video-detail/'.$related_video->id); ?>"><?php echo $related_video->title; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?><!-- Related Video -->
            </div>
        </div>​ <!-- atricle box -->
        
        <div class="clearfix"></div>

        <?php if($check_related == TRUE): ?>
        <div class="content">
            <h3 class="a-title"><?php echo lang('related_label'); ?><span class="title-line">&nbsp;</span></h3>

            <ul class="a-connect">
                <?php if(isset($products) && $products != FALSE): ?>
                <li>
                    <div class="a-list">
                        <a href="<?php echo site_url('product-sale-rent'); ?>" class="a-heading"><h3><?php echo lang('related_product_label'); ?></h3></a>
                         <?php $firstProduct = array_shift($products); ?>
                        <a href="<?php echo site_url('product-detail/'.$firstProduct->product_id); ?>">
                            <figure>
                                <img src="<?php echo base_url(get_uploaded_file($firstProduct->file)); ?>" alt="<?php echo $firstProduct->title; ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                                <figcaption><?php echo $firstProduct->title; ?></figcaption>
                            </figure>
                        </a>
                        <ul>
                             <?php foreach ($products as $product):?>
                            <li><a href="<?php echo site_url('product-detail/'.$product->product_id); ?>"><?php echo $product->title; ?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </li>
                <?php endif; ?><!-- Related Product -->
                
                <?php if(isset($real_estates) && $real_estates != FALSE): ?>
                <li>
                    <div class="a-list">
                        <a href="<?php echo site_url('land-sale-rent'); ?>" class="a-heading"><h3><?php echo lang('related_real_estate_label'); ?></h3></a>
                         <?php $firstLand = array_shift($real_estates); ?>
                        <a href="<?php echo site_url('land-detail/'.$firstLand->real_estate_id); ?>">
                            <figure>
                                <img src="<?php echo base_url(get_uploaded_file($firstLand->file)); ?>" alt="<?php echo $firstLand->title; ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                                <figcaption><?php echo $firstLand->title; ?></figcaption>
                            </figure>
                        </a>
                        <ul>
                             <?php foreach ($real_estates as $real_estate):?>
                            <li><a href="<?php echo site_url('land-detail/'.$real_estate->real_estate_id); ?>"><?php echo $real_estate->title; ?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </li>
                <?php endif; ?><!-- Related Land -->
                
                <?php if(isset($jobs) && $jobs != FALSE): ?>
                <li>
                    <div class="a-list">
                        <a href="<?php echo site_url('job'); ?>" class="a-heading"><h3><?php echo lang('related_job_label'); ?></h3></a>
                        <ul>
                             <?php foreach ($jobs as $job):?>
                            <li><a href="<?php echo site_url('job-detail/'.$job->job_id); ?>"><?php echo $job->title; ?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </li>
                <?php endif; ?><!-- Related Job -->
                
                <?php if(isset($abs) && $abs != FALSE): ?>
                <li>
                    <div class="a-list">
                        <a href="#" class="a-heading"><h3><?php echo lang('related_organization_label'); ?></h3></a>
                        <?php $firstOrganization = array_shift($abs); ?>
                        <a href="<?php echo prep_url($firstOrganization->social_media); ?>" target="_blank">
                            <figure>
                                <img src="<?php echo base_url(get_uploaded_file($firstOrganization->logo)); ?>" alt="<?php echo $firstOrganization->name == FALSE ? $firstOrganization->name_en : $firstOrganization->name; ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                                <figcaption><?php echo $firstOrganization->name == FALSE ? $firstOrganization->name_en : $firstOrganization->name; ?></figcaption>
                            </figure>
                        </a>
                        <ul>
                             <?php foreach ($abs as $ab):?>
                            <li><a href="<?php echo prep_url($ab->social_media); ?>" target="_blank"><?php echo $ab->name == FALSE ? $ab->name_en : $ab->name; ?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </li>
                <?php endif; ?><!-- Related Organization -->
            </ul>
        </div>
        <?php endif; ?>
    </div>

<div class="content-right">
    <div class="facebook-like">
        <h4><?php echo sprintf(lang('like_label'), lang('like_artilce_label')); ?></h4>
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

<!-- Modal -->
<div class="modal fade" id="download" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('request_label'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('save-request', array('class' => 'form-horizontal')); ?>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label"><?php echo lang('request_name_label'); ?></label>
                        <div class="col-sm-10">
                            <?php echo form_input($name); ?>
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="telephone" class="col-sm-2 control-label"><?php echo lang('request_telephone_label'); ?></label>
                        <div class="col-sm-10">
                            <?php echo form_input($telephone); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label"><?php echo lang('request_email_label'); ?></label>
                        <div class="col-sm-10">
                            <?php echo form_input($email); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="comment" class="col-sm-2 control-label"><?php echo lang('request_comment_label'); ?></label>
                        <div class="col-sm-10">
                            <?php echo form_textarea($comment); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success"><i class="fa fa-send-o fa-fw"></i> <?php echo lang('request_send_btn'); ?></button>
                            <a href="#" class="btn btn-danger" id="close-btn"><i class="fa fa-times fa-fw"></i> <?php echo lang('request_close_btn'); ?></a>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div><!-- Modal -->