<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()) { ?>
        <h3 class="page-header"><i class="fa fa-link text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-link text-primary"> <?php echo $title; ?></i></h1>
        <?php } ?>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <?php echo view_breadcrumb(); ?>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <!-- search form -->
        <?php echo form_open(current_url(), 'class="form-inline" role="form"'); ?>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><?php echo lang('search_caption_label'); ?></div>
                    <?php echo $group; ?>
                </div>
            </div>
            <?php if ($this->agent->is_mobile()) { ?>
            <button type="submit" class="btn btn-primary btn-block visible-xs"><i class="fa fa-search fa-fw fa-lg"></i><?php echo lang('search_caption_label'); ?></button>
            <?php } else { ?>
            <button type="submit" class="btn btn-primary hidden-xs"><i class="fa fa-search fa-fw fa-lg"></i></button>
            <?php } ?>
        <?php echo form_close(); ?>
        <br>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('index_article_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">                
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if(isset($libraries) && $libraries != FALSE){ ?>
                <?php echo form_open('articles/save-link-library', 'class="form-inline" role="form"', array('articleId' => $article->id)); ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="col-lg-1 text-center"><?php echo lang('check_th'); ?></th>
                                <th><?php echo lang('link_title_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('link_preview_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($libraries as $library):?>
                            <tr>
                                <td class="text-center"><?php echo form_checkbox('lid[]', $library->id, set_checkbox('lid[]', $library->id)); ?></td>
                                <td><?php echo anchor(base_url(get_uploaded_file($library->picture)), $library->caption, 'class="color-box"');?></td>
                                <td class="text-center"><?php echo valid_url($library->file) == TRUE ? anchor(prep_url($library->file), lang('view_open_th'), 'target="_blank"') : anchor(base_url(get_uploaded_file($library->file)), lang('view_open_th'), array('download' => $library->caption, 'target' => '_blank'));?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-link fa-fw"></i> <?php echo lang('link_btn') ?></button>
                    <?php echo btn_cancel('articles/view/'.$article->id) ?>
                <?php echo form_close(); ?>
                
                <?php }else{ ?>
                <div class="alert alert-info"><?php echo lang('no_record_label');?></div>
                <?php } ?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>