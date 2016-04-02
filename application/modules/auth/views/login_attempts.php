<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
        <h3 class="page-header"><i class="fa fa-lock text-primary"> <?php echo $title; ?></i></h3>
        <?php }else{ ?>
        <h1 class="page-header"><i class="fa fa-lock text-primary"> <?php echo $title; ?></i></h1>
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
                <?php echo lang('login_attempt_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if($login_attempts != FALSE){ ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center hidden-xs"><?php echo lang('id_th');?></th>
                                <th><?php echo lang('login_attempt_ip_address_th');?></th>
                                <th><?php echo lang('login_attempt_login_th');?></th>
                                <th><?php echo lang('login_attempt_time_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($login_attempts as $login_attempt):?>
                            <tr>
                                <td class="text-center hidden-xs"><?php echo $login_attempt->id;?></td>
                                <td><?php echo $login_attempt->ip_address;?></td>
                                <td><?php echo $login_attempt->login;?></td>
                                <td><?php echo date('Y-m-d H:i:s A', $login_attempt->time); ?></td>
                                <td class="text-center"><?php echo link_delete('auth/del-login-attempt/'.$login_attempt->id);?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
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