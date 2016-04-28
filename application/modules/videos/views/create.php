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
                <?php echo lang('form_video_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php echo form_open("videos/store", 'role="form"');?>
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="form-group">
                            <?php echo lang('form_video_source_label', 'source');?> <br />
                            <?php echo form_input($source);?>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3">
                        <div class="form-group">
                            <?php echo lang('form_video_category_label', 'category');?> <br />
                            <?php echo $category;?>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3">
                        <div class="form-group">
                            <?php echo lang('form_video_publish_label', 'publish');?> <br />
                            <div class="input-group date">
                                <?php echo form_input($publish);?>
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php echo lang('form_video_title_label', 'title');?> <br />
                            <?php echo form_input($video_title);?>
                        </div>
                    </div>
                    
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_video_keyword_label', 'keyword');?> <br />
                            <?php echo form_input($keyword);?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo lang('form_video_detail_label', 'detail');?> <br />
                            <?php echo form_textarea($detail);?>
                            <script>
                    CKEDITOR.replace( 'detail', {height: 400} );
                </script>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo lang('form_video_fb_label', 'fb');?> <br />
                            <?php echo form_textarea($fb);?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo form_checkbox($fbp).' '.lang('form_video_fbp_label', 'fbp'); ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo lang('btn_submit_label') ?></button>
                        <?php echo btn_cancel('videos') ?>
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