<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
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
                <?php echo lang('form_library_subheading'); ?>
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
                    <?php echo form_open_multipart("library/store", 'role="form"', isset($articleId) && $articleId != FALSE ? $articleId : FALSE);?>
                        <div class="form-group">
                            <?php echo lang('form_library_group_label', 'group');?> <br />
                            <?php echo $group;?>
                        </div>
                    
                        <div class="form-group">
                            <?php echo lang('form_library_caption_label', 'caption');?> <br />
                            <?php echo form_input($caption);?>
                        </div>
                        
                        <div class="form-group">
                            <?php echo lang('form_library_file_label', 'document');?> <br />
                            <?php echo form_upload($document); ?>
                        </div>
                    
                        <div class="form-group">
                            <?php echo lang('form_library_url_label', 'document');?> <br />
                            <?php echo form_input($url);?>
                        </div>
                    
                        <div class="form-group">
                            <?php echo lang('form_library_picture_label', 'picture');?> <br />
                            <?php echo form_upload($picture); ?>
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo lang('btn_submit_label') ?></button>
                        <?php echo btn_cancel($this->uri->segment(3) == FALSE ? 'library' : 'articles/view/'.$this->uri->segment(3)) ?>
                    <?php echo form_close();?>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>


