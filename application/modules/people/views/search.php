<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()) { ?>
        <h3 class="page-header"><i class="fa fa-search text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-search text-primary"> <?php echo $title; ?></i></h1>
        <?php } ?>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <?php echo view_breadcrumb(); ?>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <!-- search form -->
        <?php echo form_open(current_url(), 'class="form-inline" role="form"'); ?>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><?php echo lang('search_caption_label'); ?></div>
                    <?php echo form_input($search); ?>
                </div>
            </div>
            <?php if ($this->agent->is_mobile()) { ?>
            <button type="submit" class="btn btn-primary btn-block visible-xs"><i class="fa fa-search fa-fw fa-lg"></i><?php echo lang('search_caption_label'); ?></button>
            <?php } else { ?>
            <button type="submit" class="btn btn-primary hidden-xs"><i class="fa fa-search fa-fw fa-lg"></i></button>
            <?php } ?>
        <?php echo form_close(); ?>
        <br>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('index_people_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">                
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if(isset($ps) && $ps != FALSE){ ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo lang('id_th'); ?></th>
                                <th><?php echo lang('index_people_name_th');?></th>
                                <th class="text-center"><?php echo lang('index_people_organization_th');?></th>
                                <th class="text-center"><?php echo lang('index_people_telephone_th');?></th>
                                <th class="text-center"><?php echo lang('index_people_email_th');?></th>
                                <th class="text-center"><?php echo lang('index_people_social_th');?></th>
                                <th class="text-center"><?php echo lang('index_people_status_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_people_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ps as $p):?>
                            <tr>
                                <td class="text-center"><?php echo $p->id;?></td>
                                <td><?php echo anchor('people/view/'.$p->id, $p->name);?></td>
                                <td class="text-center"><?php echo $p->organization;?></td>
                                <td class="text-center"><?php echo $p->telephone;?></td>
                                <td class="text-center">
                                    <?php 
                                        $email = str_replace(',', ';', $p->email);
                                        echo mailto($email, str_replace(',', ' / ', $p->email), array('title' => lang('send_email_label')));
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        $socials = explode(', ', $p->social_media);
                                        foreach ($socials as $social)
                                        {
                                            echo anchor(prep_url($social), get_social_icon($social), array('target' => '_blank')).' ';
                                        }
                                    ?>
                                </td>
                                <td class="text-center"><?php echo $p->status == 1 ? anchor('people/deactivate/'.$p->id, '<i class="fa fa-check fa-lg text-success"> ដំណើរ​ការ</i>', array('onClick' => "return confirm('តើ​អ្នក​ចង់​បញ្ឈប់​ដំណើរ​ការ​".lang('index_people_heading')."នេះ?')")) : anchor('people/activate/'.$p->id, '<i class="fa fa-times fa-lg text-danger"> មិន​ដំណើរ​ការ</i>', array('onClick' => "return confirm('តើ​អ្នក​ចង់​អោយ​".lang('index_people_heading')."នេះ​ដំណើរ​ការ​ឡើង​វិញ​?')"));?></td>
                                <td class="text-center"><?php echo link_edit("people/edit/".$p->id);?> | <?php echo link_delete('people/destroy/'.$p->id); ?></td>
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