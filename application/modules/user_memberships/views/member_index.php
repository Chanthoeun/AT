<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
        <h3 class="page-header"><i class="fa fa-user text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
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
                <?php echo lang('index_user_membership_user_subheading'); ?>
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
                                <th class="col-lg-1"><?php echo lang('index_user_membership_id_th'); ?></th>
                                <th><?php echo lang('index_user_membership_username_th');?></th>
                                <th><?php echo lang('index_user_membership_email_th');?></th>
                                <th><?php echo lang('index_user_membership_status_th');?></th>
                                <th><?php echo lang('index_user_membership_last_login_th');?></th>
                                <th class="col-lg-1 text-center"><?php echo lang('index_user_membership_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user):?>
                            <tr>
                                <td><?php echo $user->id;?></td>
                                <td><?php echo $user->username;?></td>
                                <td><?php echo $user->email;?></td>
                                <td><?php echo $user->active == 1 ? '<i class="fa fa-check text-success"> Activated</i>' : '<i class="fa fa-check text-danger"> Deactivated</i>';?></td>
                                <td><?php echo date('Y-m-d H:i:s A', time($user->last_login));?></td>
                                <td class="text-center">
                                    <?php 
                                        echo link_edit('user_memberships/member/edit/'.$user->id, 'Edit', array('title' => 'Edit User'));
                                    ?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ ?>
                <div class="alert alert-info">No Records in database!</div>
                <?php } ?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>