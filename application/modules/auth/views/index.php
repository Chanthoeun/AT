<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
        <h3 class="page-header"><i class="fa fa-user text-primary"> <?php echo $title; ?></i></h3>
        <?php }else{ ?>
        <h1 class="page-header"><i class="fa fa-user text-primary"> <?php echo $title; ?></i></h1>
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
                <?php echo lang('index_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if($users != FALSE){ ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center hidden-xs"><?php echo lang('id_th');?></th>
                                <th><?php echo lang('index_username_th');?></th>
                                <th><?php echo lang('index_email_th');?></th>
                                <th><?php echo lang('index_groups_th');?></th>
                                <th><?php echo lang('index_status_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user):?>
                            <tr>
                                <td class="text-center hidden-xs"><?php echo $user->id;?></td>
                                <td><?php echo $user->username;?></td>
                                <td><?php echo $user->email;?></td>
                                <td>
                                    <?php foreach ($user->groups as $group):?>
                                        <?php 
                        echo anchor("groups/edit/".$group->id, $group->name);
                    ?><br />
                                    <?php endforeach?>
                                </td>
                                <td>
                                    <?php 
                    if($user->active == TRUE)
                    {
                        echo anchor("auth/deactivate/".$user->id, '<i class="fa fa-check fa-fw"></i> '.lang('index_active_link'));
                    }
                    else
                    {
                        echo anchor("auth/activate/". $user->id, '<i class="fa fa-times fa-fw text-danger"></i> '.lang('index_inactive_link'));
                    }
                 ?>
                                </td>
                                <td class="text-center"><?php echo link_edit("auth/edit-user/".$user->id);?> <?php if($user->username != 'administrator'){ echo ' | '.link_delete('auth/del-user/'.$user->id); } ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ ?>
                <div class="alert alert-info"><?php echo lang('no_record_label');?></div>
                <?php } ?>
                <p><?php echo link_add('auth/create-user', lang('index_create_user_link'), array('class' => 'btn btn-primary'));?> | <?php echo link_add('groups/create', lang('index_create_group_link'), array('class' => 'btn btn-success'));?></p>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>