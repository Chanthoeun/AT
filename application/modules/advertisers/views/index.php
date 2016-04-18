<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
        <h3 class="page-header"><i class="fa fa-users text-primary"> <?php echo $title; ?></i> </h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-users text-primary"> <?php echo $title; ?></i> </h1>
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
                <?php echo lang('index_advertiser_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if($advertisers != FALSE){ ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo lang('id_th'); ?></th>
                                <th><?php echo lang('index_advertiser_name_th');?></th>
                                <th><?php echo lang('index_advertiser_address_th');?></th>
                                <th class="text-center"><?php echo lang('index_advertiser_telephone_th');?></th>
                                <th class="text-center"><?php echo lang('index_advertiser_email_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_advertiser_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($advertisers as $advertiser):?>
                            <tr>
                                <td class="text-center"><?php echo $advertiser->id;?></td>
                                <td><?php echo anchor('advertisers/view/'.$advertiser->id, $advertiser->name);?></td>
                                <td><?php echo $advertiser->address;?></td>
                                <td class="text-center"><?php echo $advertiser->telephone;?></td>
                                <td class="text-center"><?php echo $advertiser->email;?></td>
                                <td class="text-center"><?php echo link_edit("advertisers/edit/".$advertiser->id);?> | <?php echo link_delete('advertisers/destroy/'.$advertiser->id); ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ ?>
                <div class="alert alert-info"><?php echo lang('no_record_label');?></div>
                <?php } ?>
                <p><?php echo link_add('advertisers/create', lang('index_advertiser_create_link'), array('class' => 'btn btn-primary'));?></p>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>