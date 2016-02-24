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
    <div class="col-sm-9 col-md-9 col-lg-9">
        <h3 class="page-header"><i class="fa fa-envelope-o"></i> <?php echo lang('home_contact_info'); ?></h3>
        <ul class="fa-ul">
            <li><i class="fa-li fa fa-map-marker fa-fw fa-lg"></i> <?php echo lang('home_contact_address') ?></li>
<!--            <li><i class="fa-li fa fa-phone fa-fw fa-lg"></i> <?php echo lang('home_contact_telephone') ?></li>-->
            <li><i class="fa-li fa fa-envelope fa-fw fa-lg"></i> <?php echo lang('home_contact_email') ?></li>
            <li><i class="fa-li fa fa-globe fa-fw fa-lg"></i> <?php echo lang('home_contact_website') ?></li>
        </ul>
        <br><br>
        <h3 class="page-header"><i class="fa fa-comment-o"></i> <?php echo lang('home_contact_questiong'); ?></h3>
        
        <?php if($message != FALSE){ ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong><?php echo $message;?></strong>
        </div>
        <?php } ?>
        
        <?php echo form_open('home/contact-us', 'role="form"'); ?>
        <div class="col-lg-12">
            <div class="form-group">
                <?php echo lang('home_contact_fullname_label', 'name');?> <br />
                <?php echo form_input($name);?>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?php echo lang('home_contact_email_lable', 'email');?> <br />
                <?php echo form_input($email);?>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?php echo lang('home_contact_telephone_label', 'telephone');?> <br />
                <?php echo form_input($telephone);?>
            </div>
        </div>
        
        <div class="col-lg-12">
            <div class="form-group">
                <?php echo lang('home_contact_subject_label', 'subject');?> <br />
                <?php echo form_input($subject);?>
            </div>
        </div>
        
        <div class="col-lg-12">
            <div class="form-group">
                <?php echo lang('home_contact_comment_label', 'comment');?> <br />
                <?php echo form_textarea($comment);?>
            </div>
        </div>
        
        <div class="col-lg-12">
            <?php echo generate_captcha_image(ENVIRONMENT == 'development' ? 'http://localhost.agritoday.com//' : 'http://www.agritoday.com/'); ?>
        </div>
        
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?php echo lang('home_signup_captcha', 'captcha');?> <br />
                <?php echo form_input($captcha);?>
            </div>
        </div>
        
        <div class="col-lg-12">
            <button type="submit" style="margin: 10px 0; padding: 5px 40px; font-size: 22px;" class="btn btn-primary"><strong><i class="fa fa-send"></i> <?php echo lang('home_contact_send_btn') ?></strong></button>
        </div>        
        <?php echo form_close(); ?>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3">
        <?php 
            if(isset($ads_right)) 
            {
                echo $ads_right;
            }
            else
            {
                echo anchor(
                        site_url('home/contact-us'),
                        img(array('src' => get_image('right-banner.png'), 'alt'=>'Right Advertising', 'class' => 'img-thumbnail img-responsive'))
                        );
            }
        ?>
    </div>
</section><!-- end Content -->
<?php if(isset($ads_bottom)): ?>
<section class="row">
    <div class="col-lg-12 ads-bottom">
        <?php echo $ads_bottom; ?>
    </div>
</section>
<?php endif; ?>