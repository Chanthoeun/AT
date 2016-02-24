<?php $this->load->view('search_box'); ?>

<?php $this->load->view('slideshow'); ?>

<?php echo view_breadcrumb('<ol class="breadcrumb">', '</ol>', '<i class="fa fa-home fa-fw"></i>ទំព័រដើម'); ?>

<section class="row">
    <div class="col-sm-9 col-md-9 col-lg-9" itemscope itemtype="http://schema.org/Article">
        <h3 class="page-header" itemprop="name">
            <?php echo $article->title; ?>
        </h3>
        
        <?php 
            if($article->source != ''){
                $source = explode(',', utf8_decode($article->source));
        ?>
        <div class="release">
            <p class="pull-left"><?php echo count($source) > 1 ? anchor(prep_url(trim($source[1])), '<strong itemprop="author">'.$source[0].'</strong>', 'target="_blank"').' on <strong>'.date('l, d F Y', strtotime($article->published_on)).'</strong>' : '<strong>'.date('l, d F Y', strtotime($article->published_on)).'</strong>'; ?></p>
            <p class="pull-right"><span class="addthis_sharing_toolbox pull-right"></span></p>
        </div>
        <?php } ?>

        <?php if($article->picture != FALSE): ?>
        <figure>
            <img src="<?php echo base_url(get_uploaded_file($article->picture)); ?>" alt="<?php echo $article->title; ?>" />
            <figcaption><?php echo $article->pcaption; ?></figcaption>
        </figure>
        <?php endif; ?>
        <p>
            <?php echo $article->detail; ?>
            <?php 
                if(isset($source)){
                    if(count($source) > 1)
                    {
                        echo anchor(prep_url(trim($source[1])), '<strong>'.$this->lang->line('home_read_more').'</strong>', array('class' => 'btn btn-primary', 'target' => '_blank')); 
                    }
                    else
                    {
                        if(valid_url($source[0]) == TRUE)
                        {
                            echo anchor(prep_url(trim($source[0])), '<strong>'.$this->lang->line('home_read_more').'</strong>', array('class' => 'btn btn-primary', 'target' => '_blank')); 
                        }
                    }
                    
                }
            ?>
        </p>
        
        <?php 
            $p = 1; $d = 1; $a = 1; $v = 1;
            foreach ($article_medias as $media)
            {
                if($media->type == 1)
                {
                    if($p == 1)
                    {
                       echo '<h4 class="page-header"><i class="fa fa-image fa-lg"></i> <strong>'.$this->lang->line('home_picture').'</strong></h4>'; 
                    }
                    $picture = get_uploaded_file($media->file);
                    
                    echo anchor(
                            base_url($picture),
                            image_thumb($picture, 200, 200, array('class' => 'img-thumbnail img-responsive')),
                            'class="color-box"'
                            );
                    $p += 1;
                    
                }
                else if($media->type == 2)
                {
                    if($d == 1)
                    {
                       echo '<h4 class="page-header"><i class="fa fa-file fa-lg"></i> <strong>'.$this->lang->line('home_document').'</strong></h4>'; 
                    }
                    echo anchor(base_url(get_uploaded_file($media->file)), '<i class="fa fa-download fa-lg"></i> <strong>'. $this->lang->line('home_document_download').' '.$media->caption.'</strong>   ');
                    $d += 1;
                }
                else if($media->type == 3)
                {
                    if($a == 1)
                    {
                       echo '<h4 class="page-header"><i class="fa fa-music fa-lg"></i> <strong>'.$this->lang->line('home_audio').'</strong></h4>'; 
                    }
                    $file = get_uploaded_file($media->file);
                    $ext = end(explode('.', $media->file));
                    echo $ext == 'mp3' ?  '<audio controls><source src="'.base_url($file).'" type="audio/mpeg"></audio>  ' : '<audio controls><source src="'.base_url($file).'" type="audio/wav"></audio>  ';
                    $a += 1;
                }
                else if($media->type == 4)
                {
                    if($v == 1)
                    {
                       echo '<h4 class="page-header"><i class="fa fa-youtube-play fa-lg"></i> <strong>'.$this->lang->line('home_video').'</strong></h4>'; 
                    }
                    echo '<div class="embed-responsive embed-responsive-16by9">'.youtube_embed($media->file, 600, 500, FALSE, FALSE, TRUE). '</div>';
                    $v += 1;
                }
            }
        ?>        
        <!-- end article -->
        <?php if(isset($related_articles) && $related_articles != FALSE){ ?>
        <h3 class="page-header">
            <i class="fa fa-leaf"></i>
            <?php echo lang('home_relate_articles'); ?>
        </h3>
        <ul class="fa-ul">
            <?php 
                foreach ($related_articles as $related_article)
                {
                    if($related_article->id != $article->id)
                    {
            ?>
            <li><i class="fa-li fa fa-check-square"></i><a href="<?php echo site_url('view/'.$related_article->id); ?>"><?php echo $related_article->title ?></a></li>
            <?php
                    }
                }
            ?>
        </ul>
        <?php } ?>
        <!-- Facebook Comment -->
        <br>
        <div class="fb-comments" data-href="<?php echo current_url(); ?>" data-numposts="5" data-colorscheme="light"></div>
    </div><!-- end content -->
    
    <div class="col-sm-3 col-md-3 col-lg-3">
        <h3 class="page-header"><?php echo lang('home_product_fit'); ?></h3>
        <?php foreach($product_articles as $product): ?>
        <figure class="related_image">
            <a href="<?php echo site_url('classified-detail/'.$product->classified_id); ?>">
                <?php $image = get_uploaded_file($product->file) != NULL ? base_url(get_uploaded_file($product->file)) : get_image('no-image.png'); ?>
                <img src="<?php echo $image; ?>" alt="<?php echo $product->title; ?>">
            </a>
            <figcaption><?php echo $product->title; ?></figcaption>
        </figure>
        <?php endforeach; ?>
    </div><!-- end advertise -->
</section><!-- end Content -->
