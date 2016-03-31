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
                <?php echo lang('index_article_detail_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php echo form_open_multipart(current_url(), 'role="form"');?>
                <div class="col-lg-12">
                    <div class="form-group">
                        <?php echo lang('form_article_detail_title_label', 'title');?> <br />

                        <?php echo form_input($detail_title);?>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <?php echo lang('form_article_detail_desc_label', 'desc');?> <br />
                        <?php echo form_textarea($desc);?>
                        <script>
                CKEDITOR.replace('desc', {height: 400} );
            </script>
                    </div>
                </div>

                <h4 class="page-header"><i class="fa fa-picture-o fa-fw"></i> <?php echo lang('form_article_add_picture_label');?></h4>

                <div class="col-lg-6">
                    <div class="form-group">
                        <?php echo lang('form_article_detail_pcaption_label', 'caption');?> <br />
                        <?php echo form_input($caption); ?>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="form-group">
                        <?php echo lang('form_article_detail_picture_label', 'files');?> <br />
                        <?php echo form_upload(array('name'=> 'picture', 'accept' => 'image/*')); ?>
                    </div>
                </div>

                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo lang('btn_submit_label') ?></button>
                    <?php echo btn_cancel('articles/details/'.$article->id) ?>
                </div>
                <?php echo form_close();?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>