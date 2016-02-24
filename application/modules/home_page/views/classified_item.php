<?php $this->load->view('search_box'); ?>

<?php $this->load->view('slideshow'); ?>

<?php echo view_breadcrumb('<ol class="breadcrumb">', '</ol>', '<i class="fa fa-home fa-fw"></i>ទំព័រដើម'); ?>

<section class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-shopping-cart text-primary"></i> <?php echo $title; ?></h3>
        <?php foreach ($classifieds as $classified): ?>
        <div class="news">
            <h3 class="caption"><a href="<?php echo site_url('classified-detail/'.$classified->id); ?>"><?php echo $classified->title; ?></a></h3>
            <div class="news-detail">
                <?php $image = get_uploaded_file($classified->file); ?>
                <a href="<?php echo site_url('classified-detail/'.$classified->id); ?>">
                    <img src="<?php echo $image != FALSE ? base_url($image) : get_image('no-image.png') ?>" alt="<?php echo $classified->title; ?>" />
                </a>
                <div class="description">
                    <span><?php echo date('l, d F Y', time($classified->created_at)); ?></span>
                    <p><?php echo word_limiter($classified->description, 20); ?></p>
                </div>
            </div>
        </div><!-- end new item -->
        <?php endforeach; ?>
        
        <div class="clearfix">
            <nav class="pull-right">
                <?php echo $pagination; ?>
            </nav><!-- end pagination -->
        </div>
    </div>
</section> 
