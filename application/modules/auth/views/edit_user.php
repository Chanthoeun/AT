<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
        <h3 class="page-header"><i class="fa fa-pencil-square-o text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-pencil-square-o text-primary"> <?php echo $title; ?></i></h1>
        <?php } ?>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <?php echo view_breadcrumb(); ?>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('edit_user_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <div class="col-lg-4">
                    <?php echo form_open(uri_string(), 'role="form"');?>
                        <?php if($user->username != 'administrator'){ ?>
                        <div class="form-group">
                            <?php echo lang('edit_user_username_label', 'username');?> <br />
                            <?php echo form_input($username);?>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <?php echo lang('edit_user_email_label', 'email');?> <br />
                            <?php echo form_input($email);?>
                        </div>

                        <div class="form-group">
                            <?php echo lang('edit_user_password_label', 'password');?> <br />
                            <?php echo form_input($password);?>
                        </div>

                        <div class="form-group">
                            <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?> <br />
                            <?php echo form_input($password_confirm);?>
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo lang('btn_submit_label') ?></button>
                        <?php echo btn_cancel($user_group == 1 ? 'auth' : 'auth/members') ?>
                    <?php echo form_close();?>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>