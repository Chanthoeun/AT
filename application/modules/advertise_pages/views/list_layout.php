<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
        <h3 class="page-header"><i class="fa fa-file text-primary"> <?php echo $title; ?></i> </h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-file text-primary"> <?php echo $title; ?></i> </h1>
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
                <?php echo lang('index_advertise_layout_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if($layouts != FALSE){ ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo lang('id_th'); ?></th>
                                <th><?php echo lang('index_advertise_layout_caption_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_advertise_layout_amount_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_advertise_layout_width_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_advertise_layout_height_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_advertise_layout_price_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_advertise_layout_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($layouts as $advertise_layout):?>
                            <tr>
                                <td class="text-center"><?php echo $advertise_layout->id;?></td>
                                <td><?php echo $advertise_layout->layout;?></td>
                                <td class="text-center"><?php echo $advertise_layout->amount;?></td>
                                <td class="text-center"><?php echo $advertise_layout->width.' px';?></td>
                                <td class="text-center"><?php echo $advertise_layout->height.' px';?></td>
                                <td class="text-center"><?php echo '$ '.$advertise_layout->price.'​ / ខែ';?></td>
                                <td class="text-center"><?php echo link_edit("advertise-pages/edit-layout/".$advertise_layout->id);?> | <?php echo link_delete('advertise-pages/del-layout/'.$advertise_layout->id); ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ ?>
                <div class="alert alert-info"><?php echo lang('no_record_label');?></div>
                <?php } ?>
                <p><?php echo link_add('advertise-pages/add-layout/'.$page->id, lang('form_advertise_page_add_layout_heading'), array('class' => 'btn btn-primary'));?></p>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>