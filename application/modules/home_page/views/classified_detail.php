<?php $this->load->view('search_box'); ?>

<?php $this->load->view('slideshow'); ?>

<?php echo view_breadcrumb('<ol class="breadcrumb">', '</ol>', '<i class="fa fa-home fa-fw"></i>ទំព័រដើម'); ?>

<section class="row">
    <div class="col-sm-9 col-md-9 col-lg-9" itemscope itemtype="http://schema.org/Article">
        <h3 class="page-header" itemprop="name">
            <?php echo $classified->title; ?>
        </h3>
        
        <div class="release">
            <p class="pull-left"><?php echo lang('home_product_posted_at').' <strong>'.date('l, d F Y', time($classified->created_at)).'</strong>'; ?></p>
            <p class="pull-right"><span class="addthis_sharing_toolbox pull-right"></span></p>
        </div>

        <?php if($classified->file != FALSE): ?>
        <figure>
            <img src="<?php echo base_url(get_uploaded_file($classified->file)); ?>" alt="<?php echo $classified->title; ?>" />
        </figure>
        <?php endif; ?>
        
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#detail" aria-controls="home" role="tab" data-toggle="tab"><?php echo lang('home_product_desc'); ?></a></li>
                <li role="presentation"><a href="#photo" aria-controls="profile" role="tab" data-toggle="tab"><?php echo lang('home_product_photo'); ?></a></li>
                <li role="presentation"><a href="#member" aria-controls="messages" role="tab" data-toggle="tab"><?php echo lang('home_product_posted_by'); ?></a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="detail"><?php echo $classified->description; ?></div>
                <div role="tabpanel" class="tab-pane" id="photo">
                    <?php 
                        if(isset($medias) && $medias != FALSE)
                        {
                            foreach ($medias as $media){
                                if($classified->file != $media->file)
                                {
                                    $picture = get_uploaded_file($media->file);
                                    echo anchor(base_url($picture), image_thumb($picture, 160, 200, array('class' => 'img-thumbnail', 'alt' => $media->caption)), 'class="color-box"');
                                }
                            }
                        }
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="member">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="col-lg-1 success"><strong><?php echo lang('home_product_membership'); ?></strong></td>
                                <td class="col-lg-6"><i class="fa fa-map-marker" style="color: #ffcc33;"></i> <?php echo anchor('member/'.$membership->id, $membership->name, 'target="_blank"'); ?></td>
                            </tr>
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
                </div>
            </div>

        </div>
        <!-- end article -->
        
        <!-- Facebook Comment -->
        <br>
        <div class="fb-comments" data-href="<?php echo current_url(); ?>" data-numposts="5" data-colorscheme="light"></div>
    </div><!-- end content -->
    
    <div class="col-sm-3 col-md-3 col-lg-3">
        
    </div><!-- end advertise -->
</section><!-- end Content -->
