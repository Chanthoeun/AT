<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()) { ?>
        <h3 class="page-header"><i class="fa fa-plus-square-o text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-plus-square-o text-primary"> <?php echo $title; ?></i></h1>
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
                <?php echo lang('edit_member_profile_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php echo form_open(current_url(), 'role="form"');?>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <?php echo lang('form_member_name_label', 'name');?> <br />
                            <?php echo form_input($name);?>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="form-group">
                            <?php echo lang('form_member_organization_label', 'organization');?> <br />
                            <?php echo form_input($organization);?>
                        </div>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo lang('form_member_position_label', 'position');?> <br />
                            <?php echo form_input($position);?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo lang('form_member_telephone_label', 'telephone');?> <br />
                            <?php echo form_input($telephone);?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php echo lang('form_member_social_label', 'social');?> <br />
                            <?php echo form_input($social);?>
                        </div>
                    </div>
                </div> 
                
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo lang('btn_submit_label') ?></button>
                        <?php echo btn_cancel('members/'.$user->id) ?>
                    </div>
                </div>
                    
                <?php echo form_close();?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>