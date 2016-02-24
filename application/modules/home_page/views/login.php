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
    <div class="col-md-8 col-lg-8">
        <h3 class="page-header hidden-xs"><?php echo lang('home_menu_login').' ('.lang('home_login_member').')'; ?></h3>
        <h4 class="page-header visible-xs"><?php echo lang('home_menu_login').' ('.lang('home_login_member').')'; ?></h4>
        <?php if($message != FALSE){ ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong><?php echo $message;?></strong>
        </div>
        <?php } ?>
        
        <?php echo form_open(current_url(), 'role="form" class="form-horizontal"');?>
            <div class="form-group">
                <?php echo lang('home_login_username', 'identity', 'col-sm-3 col-md-3 col-lg-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($identity); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo lang('home_login_password', 'password', 'col-sm-3 col-md-3 col-lg-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo form_password($password); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <div class="checkbox">
                    <label>
                        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                        <?php echo lang('home_login_remember'); ?>
                    </label>
                  </div>
                </div>
            </div>
        
            <div class="col-sm-offset-3 col-sm-9">
                <?php echo generate_captcha_image(ENVIRONMENT == 'development' ? 'http://localhost.agritoday.com/' : 'http://www.agritoday.com/'); ?>
            </div>
            <br>
            <div class="form-group">
                <?php echo lang('home_signup_captcha', 'captcha', 'col-sm-3 col-md-3 col-lg-3 control-label');?> <br />
                <div class="col-sm-9">
                    <?php echo form_input($captcha);?>
                </div>
            </div>
        
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <?php echo form_submit('submit', lang('home_login_submit_btn'), 'class="btn btn-lg btn-primary"');?>
                </div>
            </div>
      <?php echo form_close();?>
    </div><!-- end login form -->
    
    <div class="col-md-4 col-lg-4">
        <h3 class="page-header"><?php echo lang('home_login_note'); ?></h3>
        <p><?php echo lang('home_login_note_username'); ?></p>
        <p><?php echo lang('home_login_note_password'); ?></p>
        <p><?php echo lang('home_login_note_remember'); ?></p>
    </div>
</section><!-- end Content -->

<?php if(isset($ads_bottom)): ?>
<section class="row">
    <div class="col-lg-12 ads-bottom">
        <?php echo $ads_bottom; ?>
    </div>
</section>
<?php endif; ?>