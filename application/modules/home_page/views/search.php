<?php $this->load->view('search_box'); ?>

<?php $this->load->view('slideshow'); ?>

<?php echo view_breadcrumb('<ol class="breadcrumb">', '</ol>', '<i class="fa fa-home fa-fw"></i>ទំព័រដើម'); ?>

<?php if(isset($ads_midle)): ?>
<section class="row">
    <div class="col-lg-12 ads-bottom">
        <?php echo $ads_midle; ?>
    </div>
</section>
<?php endif; ?>

<section class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-search fa-fw"></i> <?php echo $search_result; ?></h3>
        <?php if(isset($result_articles) && !empty($result_articles)){ ?>
        
        <?php 
            foreach ($result_articles as $article){
        ?>
        <div class="news">
            <h3 class="caption"><a href="<?php echo site_url('view/'.$article->id); ?>"><?php echo $article->title; ?></a></h3>
            <div class="news-detail">
                <?php $image = get_uploaded_file($article->picture); ?>
                <a href="<?php echo site_url('view/'.$article->id); ?>">
                    <img src="<?php echo $image != FALSE ? base_url($image) : get_image('no-image.png') ?>" alt="<?php echo $article->pcaption; ?>" />
                </a>
                <div class="description">
                    <span><?php echo date('l, d F Y', strtotime($article->published_on)); ?></span>
                    <p><?php echo word_limiter($article->detail, 10); ?></p>
                </div>
            </div>
        </div><!-- end new item -->
        <?php
            }
        ?>
        <?php } ?>
    
        <?php if(isset($result_products) && !empty($result_products)){ ?>
            <?php foreach ($result_products as $buy_sell){ ?>
                <div class="news">
                    <h3 class="caption"><a href="<?php echo site_url('classified-detail/'.$buy_sell->id); ?>"><?php echo $buy_sell->title; ?></a></h3>
                    <div class="news-detail">
                        <?php $image = get_uploaded_file($buy_sell->file); ?>
                        <a href="<?php echo site_url('classified-detail/'.$buy_sell->id); ?>">
                            <img src="<?php echo $image != FALSE ? base_url($image) : get_image('no-image.png') ?>" alt="<?php echo $buy_sell->title; ?>" />
                        </a>
                        <div class="description">
                            <span><?php echo date('l, d F Y', time($buy_sell->created_at)); ?></span>
                            <p><?php echo word_limiter($buy_sell->description, 20); ?></p>
                        </div>
                    </div>
                </div><!-- end new item -->
            <?php } ?>
        <?php } ?>
    
        <?php if(isset($result_real_estates) && !empty($result_real_estates)){ ?>
            <?php foreach ($result_real_estates as $real_estate){ ?>
                <div class="news">
                    <h3 class="caption"><a href="<?php echo site_url('real-estate-detail/'.$real_estate->id); ?>"><?php echo $real_estate->title; ?></a></h3>
                    <div class="news-detail">
                        <?php $image = get_uploaded_file($real_estate->file); ?>
                        <a href="<?php echo site_url('real-estate-detail/'.$real_estate->id); ?>">
                            <img src="<?php echo $image != FALSE ? base_url($image) : get_image('no-image.png') ?>" alt="<?php echo $real_estate->title; ?>" />
                        </a>
                        <div class="description">
                            <span><?php echo date('l, d F Y', time($real_estate->created_at)); ?></span>
                            <p><?php echo word_limiter($real_estate->description, 20); ?></p>
                        </div>
                    </div>
                </div><!-- end new item -->
            <?php } ?>
        <?php } ?> 
    </div>
</section><!-- end Content -->