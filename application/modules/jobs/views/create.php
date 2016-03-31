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
                <?php echo lang('form_job_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php echo form_open_multipart("jobs/store", 'role="form"');?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo lang('form_job_title_label', 'title');?> <br />
                            <?php echo form_input($job_title);?>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_job_category_label', 'category');?> <br />
                            <?php echo $category;?>
                        </div>
                    </div>
                    
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_job_location_label', 'category');?> <br />
                            <?php echo $location;?>
                        </div>
                    </div>
                    
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_job_salary_label', 'close_date');?> <br />
                            <div class="input-group date">
                                <?php echo form_input($salary);?>
                                <div class="input-group-addon"><i class="fa fa-dollar fa-fw"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_job_expire_label', 'close_date');?> <br />
                            <div class="input-group date">
                                <?php echo form_input($close_date);?>
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <?php echo lang('form_job_company_label', 'company');?> <br />
                            <?php echo form_input($company);?>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_job_logo_label', 'logo');?> <br />
                            <?php echo form_upload($logo);?>
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo form_checkbox($agripos).' '.lang('from_job_agri_pos_label', 'agripos');?>
                        </div>
                    </div>
                    
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('from_job_agri_cat_label', 'agricat');?> <br />
                            <?php echo $agricat;?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo lang('form_job_description_label', 'description');?> <br />
                            <?php echo form_textarea($description);?>
                            <script>
                                CKEDITOR.replace( 'description', {height: 150} );
                            </script>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo lang('form_job_requirement_label', 'requirement');?> <br />
                            <?php echo form_textarea($requirement);?>
                            <script>
                                CKEDITOR.replace( 'requirement', {height: 400} );
                            </script>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo lang('form_job_apply_label', 'apply');?> <br />
                            <?php echo form_textarea($apply);?>
                            <script>
                                CKEDITOR.replace( 'apply', {height: 150} );
                            </script>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo lang('form_job_fb_label', 'fb');?> <br />
                            <?php echo form_textarea($fb);?>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo form_checkbox($fbp).' '.lang('form_job_fbp_label', 'fbp'); ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo lang('btn_submit_label') ?></button>
                        <?php echo btn_cancel('jobs') ?>
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