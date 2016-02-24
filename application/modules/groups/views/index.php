<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
        <h3 class="page-header"><i class="fa fa-users text-primary"> <?php echo $title; ?></i></h3>
        <?php } else{ ?>
        <h1 class="page-header"><i class="fa fa-users text-primary"> <?php echo $title; ?></i></h1>
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
                <?php echo lang('index_group_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if($groups != FALSE){ ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="col-lg-1 text-center hidden-xs"><?php echo lang('id_th'); ?></th>
                                <th><?php echo lang('index_group_name_th');?></th>
                                <th><?php echo lang('index_group_des_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_group_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($groups as $group):?>
                            <tr>
                                <td class="text-center hidden-xs"><?php echo $group->id;?></td>
                                <td><?php echo $group->name;?></td>
                                <td><?php echo $group->description;?></td>
                                <td class="text-center"><?php echo link_edit("groups/edit/".$group->id);?> <?php if($group->name != 'admin'){ echo ' | '.link_delete('groups/destroy/'.$group->id); } ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ ?>
                <div class="alert alert-info"><?php echo lang('no_record_label');?></div>
                <?php } ?>
                <p><?php echo link_add('groups/create', lang('index_group_create_link'), array('class' => 'btn btn-primary'));?></p>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>