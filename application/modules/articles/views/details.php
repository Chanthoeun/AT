<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()) { ?>
        <h3 class="page-header"><i class="fa fa-pencil-square text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-pencil-square text-primary"> <?php echo $title; ?></i></h1>
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
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if($details != FALSE){ ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center col-lg-1"><?php echo lang('id_th'); ?></th>
                                <th><?php echo lang('index_article_detail_title_th');?></th>
                                <th><?php echo lang('index_article_detail_desc_th');?></th>
                                <th class="col-lg-2"><?php echo lang('index_article_detail_photo_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_article_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($details as $detail):?>
                            <tr>
                                <td class="text-center col-lg-1"><?php echo $detail->id;?></td>
                                <td><?php echo $detail->title == FALSE ? 'មិនមាន​ចំណង​ជើង' : $detail->title;?></td>
                                <td><?php echo character_limiter($detail->detail, 200);?></td>
                                <td class="col-lg-2"><?php echo $detail->pcaption == FALSE ? 'មិន​មាន​រូបភាព' : anchor(base_url(get_uploaded_file($detail->picture)), character_limiter($detail->pcaption, 20), 'class="color-box" title="'.$detail->pcaption.'"');?></td>
                                <td class="text-center">
                                    <?php echo link_edit("articles/edit-detail/".$detail->id);?> | 
                                    <?php echo link_delete('articles/del-detail/'.$detail->id); ?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ ?>
                <div class="alert alert-info"><?php echo lang('no_record_label');?></div>
                <?php } ?>
                <p><?php echo link_add('articles/add-detail/'.$article->id, lang('index_article_detail_create_link'), array('class' => 'btn btn-primary'));?></p>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>