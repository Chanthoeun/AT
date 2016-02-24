<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
        <h3 class="page-header"><i class="fa fa-map-marker text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-map-marker text-primary"> <?php echo $title; ?></i></h1>
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
                <?php echo lang('index_location_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if($locations != FALSE){ ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo lang('id_th'); ?></th>
                                <th><?php echo lang('index_location_caption_th');?></th>
                                <th><?php echo lang('index_location_caption_en_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_location_parent_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_location_area_code_th');?></th>
                                <th><?php echo lang('index_location_latlng_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_location_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($locations as $location):?>
                            <tr>
                                <td class="text-center"><?php echo $location->id;?></td>
                                <td><?php echo anchor(site_url('locations/'.$location->id), $location->caption);?></td>
                                <td><?php echo $location->caption_en;?></td>
                                <td class="text-center"><?php echo $location->parent_id == 0 ? 'None' : $location->parent;?></td>
                                <td class="text-center"><?php echo $location->area_code;?></td>
                                <td><?php echo $location->latlng == FALSE ? '' : anchor('https://maps.google.com/?q='.$location->latlng, $location->latlng, array('target' => '_blank'));?></td>
                                <td class="text-center"><?php echo link_edit("locations/edit/".$location->id);?> | <?php echo link_delete('locations/destroy/'.$location->id); ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ ?>
                <div class="alert alert-info"><?php echo lang('no_record_label');?></div>
                <?php } ?>
                <p><?php echo link_add('locations/create/'.$this->uri->segment(2), lang('index_location_create_link'), array('class' => 'btn btn-primary'));?></p>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>