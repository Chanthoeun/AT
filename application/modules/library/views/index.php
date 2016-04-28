<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
        <h3 class="page-header"><i class="fa fa-book text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-book text-primary"> <?php echo $title; ?></i></h1>
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
                <?php echo lang('index_library_subheading'); ?>
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
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo lang('id_th'); ?></th>
                                <th><?php echo lang('index_library_name_th');?></th>
                                <th><?php echo lang('index_library_group_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_library_download_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('view_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_library_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($libraries as $library):?>
                            <tr>
                                <td class="text-center"><?php echo $library->id;?></td>
                                <td><?php echo anchor(base_url(get_uploaded_file($library->picture)), $library->caption, 'class="color-box"');?></td>
                                <td><?php echo $library->group;?></td>
                                <td class="text-center"><?php echo valid_url($library->file) == TRUE ? anchor(prep_url($library->file), lang('index_library_view_video_th'), array('target' => '_blank')) : anchor(base_url(get_uploaded_file($library->file)), lang('index_library_download_th'), array('download' => $library->caption));?></td>
                                <td class="text-center"><?php echo $library->view;?></td>
                                <td class="text-center"><?php echo link_edit("library/edit/".$library->id);?> | <?php echo link_delete('library/destroy/'.$library->id); ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ ?>
                <div class="alert alert-info"><?php echo lang('no_record_label');?></div>
                <?php } ?>
                <p><?php echo link_add('library/create/'.$this->uri->segment(2), lang('index_library_create_link'), array('class' => 'btn btn-primary'));?></p>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>