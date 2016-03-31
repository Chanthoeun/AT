<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
            <img src="<?php echo base_url('logo.png'); ?>" alt="AgriToday Logo"  style="margin-top: 40px;"/>
        </div>
        <div class="col-md-4 col-md-offset-4">
            
            <div class="login-panel panel panel-default" style="margin-top: 5px;">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-user-plus"></i> <?php echo $title;?></h3>
                </div>
                <div class="panel-body">
                    <?php echo form_open(current_url(), 'role="form"');?>
                        <fieldset>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
                                    <?php echo form_input($username);?>
                                  </div>
                            </div>
                            <div class="form-group">
                                 <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></div>
                                    <?php echo form_input($email);?>
                                  </div>
                            </div>
                            <div class="form-group">
                                 <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>
                                    <?php echo form_input($password);?>
                                  </div>
                            </div>
                            <div class="form-group">
                                 <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>
                                    <?php echo form_input($password_confirm);?>
                                  </div>
                            </div>
                            
                            <div class="form-group">
                                 <?php echo generate_captcha_image(ENVIRONMENT == 'development' ? 'http://localhost.agritoday.com//' : 'http://www.agritoday.com/'); ?>
                            </div>
                            
                            <div class="form-group">
                                 <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-lock fa-fw"></i></div>
                                    <?php echo form_input($captcha);?>
                                  </div>
                            </div>
                            
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-lg btn-success btn-block">
                                <i class="fa fa-floppy-o fa-fw"></i>
                                <?php echo lang('register_btn'); ?>
                            </button>
                            <?php echo btn_cancel(site_url(), 'btn btn-lg btn-danger btn-block');?>
                        </fieldset>
                    <?php echo form_close();?>
                </div>
                <?php if($message != FALSE): ?>
                <div class="panel-footer">
                    
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <strong><?php echo $message;?></strong>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>