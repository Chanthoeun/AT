<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
        <h3 class="page-header"><i class="fa fa-building-o text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-building-o text-primary"> <?php echo $title; ?></i></h1>
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
                <?php echo lang('index_real_estate_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if(isset($real_estates) && $real_estates != FALSE){ ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo lang('id_th'); ?></th>
                                <th><?php echo lang('index_real_estate_title_th');?></th>
                                <th class="text-center"><?php echo lang('index_real_estate_category_th');?></th>
                                <th class="text-center"><?php echo lang('index_real_estate_price_th');?></th>
                                <th class="text-center"><?php echo lang('index_real_estate_status_th');?></th>
                                <th class="text-center"><?php echo lang('index_real_estate_view_th');?></th>
                                <th class="text-center"><?php echo lang('index_real_estate_user_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_real_estate_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($real_estates as $real_estate):?>
                            <tr>
                                <td class="text-center"><?php echo $real_estate->id;?></td>
                                <td><?php echo anchor('real-estates/view/'.$real_estate->id, $real_estate->title);?></td>
                                <td class="text-center"><?php echo $real_estate->catcaption;?></td>
                                <td class="text-center"><strong><?php echo '$ '.$real_estate->price;?></strong></td>
                                <td class="text-center"><?php echo $real_estate->status == 1 ? anchor('real-estates/sold/'.$real_estate->id, '<i class="fa fa-times fa-lg text-danger"> លក់​រួច​ហើយ</i>', 'title="ដាក់​ថា​មិន​ទាន់​លក់"') : anchor('real-estates/sold/'.$real_estate->id.'/1', '<i class="fa fa-check fa-lg text-success"> មិនទាន់​លក់</i>', 'title="ដាក់​ថាលក់​រួចហើយ"');?></td>
                                <td class="text-center"><?php echo $real_estate->view;?></td>
                                <td class="text-center"><?php echo  $real_estate->user_id == FALSE ? FALSE : anchor('members/'.$real_estate->user_id, $real_estate->username, 'target="_blank" title="មើលព័ត៌មានអ្នក​បង្កើត"');?></td>
                                <td class="text-center">
                                    <?php 
                                        echo link_edit('real-estates/edit/'.$real_estate->id);  
                                        echo ' | '.link_delete('real-estates/destroy/'.$real_estate->id);
                                    ?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ ?>
                <div class="alert alert-info"><?php echo lang('no_record_label');?></div>
                <?php } ?>
                
                <?php $userId = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) : FALSE; ?>
                
                <p><?php echo link_add('real-estates/create/'.$userId, lang('index_real_estate_create_link'), array('class' => 'btn btn-primary'));?></p>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>