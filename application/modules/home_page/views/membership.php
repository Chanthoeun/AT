<?php $this->load->view('search_box'); ?>

<?php $this->load->view('slideshow'); ?>

<?php echo view_breadcrumb('<ol class="breadcrumb">', '</ol>', '<i class="fa fa-home fa-fw"></i>ទំព័រដើម'); ?>

<section class="row">
    <div class="col-sm-9 col-md-9 col-lg-9" itemscope itemtype="http://schema.org/Article">
        <h3 class="page-header" itemprop="name">
            <?php echo $membership->name; ?>
        </h3>
        
        <div class="row">
            <div class="col-lg-3">
                <?php 
                    $logo = get_uploaded_file($membership->image);
                    if($logo == NULL)
                    {
                        echo img(array('src' => get_image('no-image.png'), 'class' => 'img-thumbnail img-responsive'));
                    }
                    else{
                        echo image_thumb($logo, 200, 200, array('class' => 'thumbnail', 'alt' => $membership->name));
                    }
                ?>
            </div>
            
            <div class="col-lg-9">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="col-lg-1 success"><strong><?php echo lang('home_product_address'); ?></strong></td>
                            <td class="col-lg-6"><i class="fa fa-map-marker" style="color: #ffcc33;"></i> <?php echo $membership->address; ?></td>
                        </tr>
                        <tr>
                            <td class="col-lg-1 success"><strong><?php echo lang('home_product_telephone'); ?></strong></td>
                            <td class="col-lg-6"><i class="fa fa-phone" style="color: #ffcc33;"></i> <?php echo $membership->telephone; ?></td>
                        </tr>
                        <?php if($membership->fax != FALSE): ?>
                        <tr>
                            <td class="col-lg-1 success"><strong><?php echo lang('home_product_fax'); ?></strong></td>
                            <td class="col-lg-6"><i class="fa fa-fax" style="color: #ffcc33;"></i> <?php echo $membership->fax; ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if($membership->email != FALSE): ?>
                        <tr>
                            <td class="col-lg-1 success"><strong><?php echo lang('home_product_email'); ?></strong></td>
                            <td class="col-lg-6"><i class="fa fa-envelope" style="color: #ffcc33;"></i> <?php echo $membership->email; ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if($membership->website != FALSE): ?>
                        <tr>
                            <td class="col-lg-1 success"><strong><?php echo lang('home_product_website'); ?></strong></td>
                            <td class="col-lg-6"><i class="fa fa-globe" style="color: #ffcc33;"></i> <?php echo anchor(prep_url(trim($membership->website)), $membership->website, 'target="_blank"'); ?></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <?php if($membership->desc != FALSE): ?>
        <h4 class="page-header"><?php echo lang('home_product_member_profile'); ?></h4>
        <p><?php echo $membership->desc; ?></p>
        <?php endif; ?>

        <?php if(isset($map) && $map != FALSE): ?>
        <h4 class="page-header"><?php echo lang('home_product_location'); ?></h4>
        <div class="thumbnail">
            <?php 
                echo $map['js'];
                echo $map['html'];
            ?>
        </div>
        <?php endif; ?>
        
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#product" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-shopping-cart text-primary"></i> <?php echo lang('home_membership_product'); ?></a></li>
                <li role="presentation"><a href="#realestate" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-building text-primary"></i> <?php echo lang('home_membership_real_estate'); ?></a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="product">
                    <?php if(isset($classifieds) && $classifieds != FALSE){ ?>
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
                    <?php }else{ ?>
                        <h4 class="text-danger"><?php echo lang('home_memebership_no_item'); ?></h4>
                    <?php } ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="realestate">
                    <?php if(isset($realestates) && $realestates != FALSE){ ?>
                        <?php foreach ($realestates as $realestate): ?>
                        <div class="news">
                            <h3 class="caption"><a href="<?php echo site_url('real-estate-detail/'.$realestate->id); ?>"><?php echo $realestate->title; ?></a></h3>
                            <div class="news-detail">
                                <?php $image = get_uploaded_file($realestate->file); ?>
                                <a href="<?php echo site_url('real-estate-detail/'.$realestate->id); ?>">
                                    <img src="<?php echo $image != FALSE ? base_url($image) : get_image('no-image.png') ?>" alt="<?php echo $realestate->title; ?>" />
                                </a>
                                <div class="description">
                                    <span><?php echo date('l, d F Y', time($realestate->created_at)); ?></span>
                                    <p><?php echo word_limiter($realestate->description, 20); ?></p>
                                </div>
                            </div>
                        </div><!-- end new item -->
                        <?php endforeach; ?>
                    <?php }else{ ?>
                        <h4 class="text-danger"><?php echo lang('home_memebership_no_item'); ?></h4>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div><!-- end content -->
    
    <div class="col-sm-3 col-md-3 col-lg-3">
        
    </div><!-- end advertise -->
</section><!-- end Content -->
