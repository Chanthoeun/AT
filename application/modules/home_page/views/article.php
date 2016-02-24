<?php $this->load->view('search_box'); ?>

<?php $this->load->view('slideshow'); ?>

<?php echo view_breadcrumb('<ol class="breadcrumb">', '</ol>', '<i class="fa fa-home fa-fw"></i>ទំព័រដើម'); ?>

<section class="row">
    <?php 
        foreach ($types as $type)
        {
            $articles = Modules::run('articles/get_many_by', array('category_id' => $cat->id, 'article_type_id' => $type->id), array('created_at' => 'desc'), 5);
            if(count($articles) > 0)
            {
    ?>
    <div class="col-sm-6 col-md-6 col-lg-6">
        <h3 class="page-header">
            <i class="fa fa-leaf fa-fw"></i> 
            <?php echo sprintf($this->lang->line('home_crop'), $type->caption); ?>
            <small class="pull-right"><a href="<?php echo site_url('more/'.$cat->id.'/'.$type->id); ?>" class="btn btn-primary"><?php echo lang('home_more'); ?></a></small>
        </h3>

        <?php 
            foreach ($articles as $article)
            {
        ?>
            
        <div class="article">
            <h4 class="caption"><a href="<?php echo site_url('view/'.$article->id); ?>"><?php echo $article->title; ?></a></h4>
            <div class="detail">
                <?php 
                    if($article->picture == FALSE)
                    {
                        echo img(array('src' => get_image('no-image.png'), 'alt' => $article->title, 'class' => 'detail-img'));
                    }
                    else
                    {
                        $image = get_uploaded_file($article->picture);
                    echo img(array('src' => base_url($image), 'alt' => $article->title, 'class' => 'detail-img'));
                    }
                ?>
                <p><?php echo word_limiter($article->detail, 10); ?></p>
            </div>
        </div><!-- end article -->
        
        <?php
            }
        ?>
        
    </div>
    <?php   
            }
        }
    ?>
    
</section> 
