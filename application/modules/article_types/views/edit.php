<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
        <h3 class="page-header"><i class="fa fa-pencil-square-o text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-pencil-square-o  text-primary"> <?php echo $title; ?></i></h1>
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
                <?php echo lang('form_article_type_subheading'); ?>
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
                    <?php echo form_open("article-types/modify", 'role="form"', $article_type_id);?>
                        <div class="form-group">
                            <?php echo lang('form_article_type_parent_label', 'parent');?> <br />
                            <?php echo $parent;?>
                        </div>
                    
                        <div class="form-group">
                            <?php echo lang('form_article_type_caption_label', 'caption');?> <br />
                            <?php echo form_input($caption);?>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo lang('btn_submit_label') ?></button>
                        <?php echo btn_cancel($article_type->parent_id == FALSE ? 'article-types' : 'article-types/'.$article_type->parent_id) ?>
                    <?php echo form_close();?>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>