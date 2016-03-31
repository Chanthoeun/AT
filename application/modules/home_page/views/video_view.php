<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "VideoObject",
  "name": "<?php echo $video->title; ?>",
  "description": "<?php echo $video->detail; ?>",
  "thumbnailUrl": "<?php echo base_url(get_uploaded_file($video->picture)); ?>",
  "uploadDate": "<?php echo $video->published_at; ?>",
}
</script>

<div class="content-left">
        <div class="article-box">
            <div class="article-detail">
                <h3 class="new-title"><?php echo $video->title; ?></h3>
                <p class="date">
                    <span><?php echo date('d M Y', strtotime($video->published_at)); ?></span> 
                    <span class="source"><?php echo $video->source; ?></span>
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

                <div class="a-detail">
                    <?php echo $video->detail; ?>
                </div><!-- end detail -->

                <div class="thumbnail">
                    <?php echo get_video($video->file); ?>
                </div>
                
                <ul class="ads">
                    <li><a href="<?php echo site_url('contact-us'); ?>"><img src="<?php echo get_image('ads-detail-505x120.png'); ?>" /></a></li>
                </ul><!--end ads -->

            </div><!-- atricle Detail -->

            <div class="list">
                <?php if(isset($related_videos) && $related_videos != FALSE): ?>
                    <div class="a-list">
                        <a href="<?php echo site_url('video'); ?>" class="a-heading"><h3><?php echo lang('related_video_label'); ?></h3></a>
                        <?php $firstVideo = array_shift($related_videos); ?>
                        <a href="<?php echo site_url('video-detail/'.$firstVideo->id); ?>">
                            <figure>
                                <img src="<?php echo base_url(get_uploaded_file($firstVideo->picture)); ?>" alt="<?php echo $firstVideo->title; ?>" onerror="this.src='<?php echo get_image('no-image'); ?>'" />
                                <figcaption><?php echo $firstVideo->title; ?></figcaption>
                            </figure>
                        </a>
                        <ul>
                            <?php foreach ($related_videos as $related_video):?>
                            <li><a href="<?php echo site_url('video-detail/'.$related_video->id); ?>"><?php echo $related_video->title; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?><!-- Related Publication -->
                
                <ul class="a-list ads">
                    <li><a href="<?php echo site_url('contact-us'); ?>"><img src="<?php echo get_image('ads-detail-338x180.png'); ?>" /></a></li>
                </ul><!--end ads -->
                
                <?php if(isset($related_news) && $related_news != FALSE): ?>
                <div class="a-list">
                    <a href="<?php echo site_url('news'); ?>" class="a-heading"><h3><?php echo lang('related_news_label'); ?></h3></a>
                    <?php $firstNews = array_shift($related_news); ?>
                    <a href="<?php echo site_url('view/'.$firstNews->id); ?>">
                        <figure>
                            <img src="<?php echo base_url(get_uploaded_file($firstNews->picture)); ?>" alt="<?php echo $firstNews->title; ?>" onerror="this.src='<?php echo get_image('no-image'); ?>'" />
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
            </div>
        </div>​ <!-- atricle box -->
    </div>
<div class="content-right">
    <ul class="ads">
        <li><a href="<?php echo site_url('contact-us'); ?>"><img src="<?php echo get_image('ads-detail-273x379.png'); ?>" /></a></li>
        <li><a href="<?php echo site_url('contact-us'); ?>"><img src="<?php echo get_image('ads-detail-273x379.png'); ?>" /></a></li>
        <li><a href="<?php echo site_url('contact-us'); ?>"><img src="<?php echo get_image('ads-detail-273x379.png'); ?>" /></a></li>
    </ul>
</div><!-- content-right -->
