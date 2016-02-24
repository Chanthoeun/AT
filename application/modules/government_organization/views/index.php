<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()) { ?>
        <h3 class="page-header"><i class="fa fa-list text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-list text-primary"> <?php echo $title; ?></i></h1>
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
                <?php echo lang('index_go_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if(isset($gos) && $gos != FALSE){ ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo lang('id_th'); ?></th>
                                <th><?php echo lang('index_go_caption_th');?></th>
                                <th class="text-center"><?php echo lang('index_go_parent_th');?></th>
                                <th class="text-center"><?php echo lang('index_go_order_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_go_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($gos as $go):?>
                            <tr>
                                <td class="text-center"><?php echo $go->id;?></td>
                                <td><?php echo anchor('government-organization/'.$go->id, $go->caption);?></td>
                                <td class="text-center"><?php echo $go->p_caption;?></td>
                                <td class="text-center"><?php echo $go->order;?></td>
                                <td class="text-center"><?php echo link_edit("government-organization/edit/".$go->id);?> | <?php echo link_delete('government-organization/destroy/'.$go->id); ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ ?>
                <div class="alert alert-info"><?php echo lang('no_record_label');?></div>
                <?php } ?>
                <p>
                    <?php 
                        echo link_add('government-organization/create/'.$this->uri->segment(2), lang('index_go_create_link'), array('class' => 'btn btn-primary')); 
                        if($this->uri->segment(2) != FALSE)
                        {
                            echo ' | '.link_add('government-organization/add-staff/'.$this->uri->segment(2), lang('index_staff_create_link'), array('class' => 'btn btn-success'));
                        }
                    ?>
                </p>
                
                <?php if(isset($people) && $people != FALSE){ ?>
                <h3 class="page-header"><?php echo lang('staff_label'); ?></h3>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo lang('id_th'); ?></th>
                                <th><?php echo lang('index_staff_name_th');?></th>
                                <th class="text-center"><?php echo lang('index_staff_position_th');?></th>
                                <th class="text-center"><?php echo lang('index_staff_telephone_th');?></th>
                                <th class="text-center"><?php echo lang('index_staff_email_th');?></th>
                                <th class="text-center"><?php echo lang('index_staff_social_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_staff_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($people as $p):?>
                            <tr>
                                <td class="text-center"><?php echo $p->id;?></td>
                                <td><?php echo $p->name;?></td>
                                <td class="text-center"><?php echo $p->position;?></td>
                                <td class="text-center"><?php echo $p->telephone;?></td>
                                <td class="text-center">
                                    <?php 
                                        $email = str_replace(',', ';', $p->email);
                                        echo mailto($email, str_replace(',', ' / ', $p->email), array('title' => lang('send_email_label')));
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        if($p->social_media != FALSE){
                                            $socials = explode(', ', $p->social_media);
                                            foreach ($socials as $social)
                                            {
                                                echo anchor(prep_url($social), get_social_icon($social), array('target' => '_blank')).' ';
                                            }
                                        }
                                    ?>
                                </td>
                                <td class="text-center"><?php echo link_edit("government-organization/edit-staff/".$p->id);?> | <?php echo link_delete('government-organization/del-staff/'.$p->id); ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>