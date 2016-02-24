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
        <?php if($message != FALSE){ ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong><?php echo $message;?></strong>
        </div>
        <?php } ?>
    </div>
    <div class="col-md-6 col-lg-6 right-border">
        <h3 class="page-header hidden-xs"><?php echo lang('home_signup_company'); ?></h3>
        <h4 class="page-header visible-xs"><?php echo lang('home_signup_company'); ?></h4>
        
        <?php echo form_open('signup-company', 'role="form"');?> 
        <h4 class="page-header hidden-xs"><?php echo lang('home_signup_company_account_information'); ?></h4>

            <div class="form-group">
                <?php echo lang('form_company_username_label', 'username');?> <br />
                <?php echo form_input($username);?>
            </div>

            <div class="form-group">
                <?php echo lang('form_company_email_label', 'email');?> <br />
                <?php echo form_input($email);?>
            </div>

            <div class="form-group">
                <?php echo lang('form_company_password_label', 'password');?> <br />
                <?php echo form_password($password);?>
            </div>

            <div class="form-group">
                <?php echo lang('form_company_cpassword_label', 'cpassword');?> <br />
                <?php echo form_password($cpassword);?>
            </div>

            <h4 class="page-header"><?php echo lang('home_signup_company_information'); ?></h4>

            <div class="form-group">
                <?php echo lang('form_company_name_label', 'name');?> <br />
                <?php echo form_input($name);?>
            </div>
            
            <div>
                <?php echo generate_captcha_image(ENVIRONMENT == 'development' ? 'http://localhost.agritoday.com/' : 'http://www.agritoday.com/'); ?>
            </div>
            <div class="form-group">
                <?php echo lang('home_signup_captcha', 'captcha');?> <br />
                <?php echo form_input($captcha);?>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><strong><?php echo lang('form_company_submit_btn') ?></strong></button>
            <br>
        <?php echo form_close();?>
    </div><!-- end login form -->
    
    <div class="col-md-6 col-lg-6">
        <hr class="visible-xs"/>
        <h3 class="page-header hidden-xs"><?php echo lang('home_signup_personal'); ?></h3>
        <h4 class="page-header visible-xs"><?php echo lang('home_signup_personal'); ?></h4>
        
        <?php echo form_open("signup-personal", 'role="form"');?>
            <h4 class="page-header hidden-xs"><?php echo lang('home_signup_company_account_information'); ?></h4>
            
            <div class="form-group">
                <?php echo lang('form_personal_username_label', 'username');?> <br />
                <?php echo form_input($username);?>
            </div>
            
            <div class="form-group">
                <?php echo lang('form_personal_email_label', 'email');?> <br />
                <?php echo form_input($email);?>
            </div>

            <div class="form-group">
                <?php echo lang('form_personal_password_label', 'password');?> <br />
                <?php echo form_password($password);?>
            </div>


            <div class="form-group">
                <?php echo lang('form_personal_cpassword_label', 'cpassword');?> <br />
                <?php echo form_password($cpassword);?>
            </div>
            
            <h4 class="page-header"><?php echo lang('home_signup_personal_information'); ?></h4>
            <div class="form-group">
                <?php echo lang('form_personal_fullname_label', 'fullname');?> <br />
                <?php echo form_input($fullname);?>
            </div>
            
            <div>
                <?php echo generate_captcha_image(ENVIRONMENT == 'development' ? 'http://localhost.agritoday.com/' : 'http://www.agritoday.com/'); ?>
            </div>
            <div class="form-group">
                <?php echo lang('home_signup_captcha', 'captcha');?> <br />
                <?php echo form_input($captcha);?>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block"><strong><?php echo lang('form_personal_submit_btn') ?></strong></button>
            <br>
        <?php echo form_close();?>
    </div>
</section><!-- end Content -->

<?php if(isset($ads_bottom)): ?>
<section class="row">
    <div class="col-lg-12 ads-bottom">
        <?php echo $ads_bottom; ?>
    </div>
</section>
<?php endif; ?>