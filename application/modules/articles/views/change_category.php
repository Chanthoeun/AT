<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()) { ?>
        <h3 class="page-header"><i class="fa fa-refresh text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-refresh text-primary"> <?php echo $title; ?></i></h1>
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
                    <?php echo $category; ?>
                </div>
            </div>
            <?php if ($this->agent->is_mobile()) { ?>
            <button type="submit" class="btn btn-primary btn-block visible-xs"><i class="fa fa-search fa-fw fa-lg"></i> <?php echo lang('search_caption_label'); ?></button>
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
                <?php if(isset($articles) && $articles != FALSE){ ?>
                <?php echo form_open('articles/update-category', 'class="form-inline" role="form"', isset($category_id) && $category_id != FALSE ? $category_id : ''); ?>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><?php echo lang('change_cat_change_label'); ?></div>
                        <?php echo $category_update; ?>
                    </div>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo lang('check_th'); ?></th>
                                <th><?php echo lang('index_article_title_th');?></th>
                                <th><?php echo lang('index_article_publish_th');?></th>
                                <th><?php echo lang('index_article_type_th');?></th>
                                <th><?php echo lang('index_article_category_th');?></th>
                                <th><?php echo lang('index_article_source_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $article):?>
                            <tr>
                                <td class="text-center"><?php echo form_checkbox('art_id[]', $article->id, set_checkbox('art_id[]', $article->id)); ?></td>
                                <td><?php echo anchor('articles/view/'.$article->id, $article->title, array('title' => lang('index_article_preview_link'), 'target' => '_blank'));?></td>
                                <td><?php echo $article->published_on;?></td>
                                <td><?php echo $article->artcaption;?></td>
                                <td><?php echo $article->catcaption;?></td>
                                <td><?php echo get_source($article->source, '_blank') ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                    
                    <button type="submit" class="btn btn-primary"><i class="fa fa-refresh fa-fw"></i> <?php echo lang('change_cat_btn') ?></button>
                    <?php echo btn_cancel('articles') ?>
                <?php echo form_close(); ?>
                </div>
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
