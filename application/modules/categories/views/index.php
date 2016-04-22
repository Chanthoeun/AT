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
                <?php echo lang('index_cagetory_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if($categories != FALSE){ ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo lang('id_th'); ?></th>
                                <th><?php echo lang('index_cagetory_caption_th');?></th>
                                <th class="text-center"><?php echo lang('index_cagetory_parent_th');?></th>
                                <th class="text-center"><?php echo lang('index_cagetory_article_th');?></th>
                                <th class="text-center"><?php echo lang('index_cagetory_market_th');?></th>
                                <th class="text-center"><?php echo lang('index_cagetory_real_estate_th');?></th>
                                <th class="text-center"><?php echo lang('index_cagetory_job_th');?></th>
                                <th class="text-center"><?php echo lang('index_cagetory_order_th');?></th>
                                <th class="text-center"><?php echo lang('index_cagetory_status_th');?></th>
                                <th class="col-lg-2 text-center"><?php echo lang('index_cagetory_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $category):?>
                            <tr>
                                <td class="text-center"><?php echo $category->id;?></td>
                                <td><?php echo anchor('categories/'.$category->id, $category->caption);?></td>
                                <td class="text-center"><?php echo $category->p_caption;?></td>
                                <td class="text-center"><?php echo $category->article == 1 ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';?></td>
                                <td class="text-center"><?php echo $category->market == 1 ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';?></td>
                                <td class="text-center"><?php echo $category->real_estate == 1 ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';?></td>
                                <td class="text-center"><?php echo $category->job == 1 ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';?></td>
                                <td class="text-center"><?php echo $category->order;?></td>
                                <td class="text-center"><?php echo $category->status == 1 ? anchor('categories/deactivate/'.$category->id, '<i class="fa fa-check fa-lg text-success"> ដំណើរ​ការ</i>', array('onClick' => "return confirm('តើ​អ្នក​ចង់​បញ្ឈប់​ដំណើរ​ការ​ក្រុម​អត្ថ​បទ​នេះ?')")) : anchor('categories/activate/'.$category->id, '<i class="fa fa-times fa-lg text-danger"> មិន​ដំណើរ​ការ</i>', array('onClick' => "return confirm('តើ​អ្នក​ចង់​អោយ​ក្រុម​​អត្ថបទ​នេះ​ដំណើរ​ការ​ឡើង​វិញ​?')"));?></td>
                                <td class="text-center"><?php echo link_edit("categories/edit/".$category->id);?> | <?php echo link_delete('categories/destroy/'.$category->id); ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ ?>
                <div class="alert alert-info"><?php echo lang('no_record_label');?></div>
                <?php } ?>
                <p><?php echo link_add('categories/create/'.$this->uri->segment(2), lang('index_cagetory_create_link'), array('class' => 'btn btn-primary'));?> | <?php echo anchor('categories/reorder', '<i class="fa fa-list-ol"></i> Re-order', array('class' => 'btn btn-primary')); ?></p>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>