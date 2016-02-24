<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()) { ?>
        <h3 class="page-header"><i class="fa fa-film text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-film text-primary"> <?php echo $title; ?></i></h1>
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
                <?php echo lang('index_video_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if($videos != FALSE){ ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo lang('id_th'); ?></th>
                                <th><?php echo lang('index_video_title_th');?></th>
                                <th><?php echo lang('index_video_publish_th');?></th>
                                <th><?php echo lang('index_video_category_th');?></th>
                                <th><?php echo lang('index_video_source_th');?></th>
                                <th><?php echo lang('view_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_video_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($videos as $video):?>
                            <tr>
                                <td class="text-center"><?php echo $video->id;?></td>
                                <td><?php echo anchor('videos/view/'.$video->id, $video->title);?></td>
                                <td><?php echo $video->published_at;?></td>
                                <td><?php echo $video->catcaption;?></td>
                                <td><?php echo $video->source;?></td>
                                <td><?php echo $video->view;?></td>
                                <td class="text-center">
                                    <?php echo link_edit("videos/edit/".$video->id);?> | 
                                    <?php echo link_delete('videos/destroy/'.$video->id); ?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ ?>
                <div class="alert alert-info"><?php echo lang('no_record_label');?></div>
                <?php } ?>
                <p><?php echo link_add('videos/create', lang('index_video_create_link'), array('class' => 'btn btn-primary'));?></p>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>