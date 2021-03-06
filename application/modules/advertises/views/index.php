<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
        <h3 class="page-header"><i class="fa fa-list text-primary"> <?php echo $title; ?></i> </h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-list text-primary"> <?php echo $title; ?></i> </h1>
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
                <?php echo sprintf(lang('index_advertise_subheading'), $title); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if($advertises != FALSE){ ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo lang('id_th'); ?></th>
                                <th><?php echo lang('index_advertise_advertiser_th');?></th>
                                <th class="text-center"><?php echo lang('index_advertise_page_th');?></th>
                                <th class="text-center"><?php echo lang('index_advertise_layout_th');?></th>
                                <th class="text-center"><?php echo lang('index_advertise_price_th');?></th>
                                <th class="text-center"><?php echo lang('index_advertise_discount_th');?></th>
                                <th class="text-center"><?php echo lang('index_advertise_start_date_th');?></th>
                                <th class="text-center"><?php echo lang('index_advertise_end_date_th');?></th>
                                <th class="text-center"><?php echo lang('index_advertise_statue_th');?></th>
                                <th class="text-center"><?php echo lang('index_advertise_payment_th');?></th>
                                <th class="text-center"><?php echo lang('index_advertise_payment_type_th');?></th>
                                <th class="text-center"><?php echo lang('index_advertise_link_th');?></th>
                                <th class="text-center"><?php echo lang('index_advertise_banner_th');?></th>
                                <th class="text-center"><?php echo lang('index_advertise_day_remain_th');?></th>
                                <th class="text-center"><?php echo lang('index_advertise_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($advertises as $advertise):?>
                            <tr <?php echo day_remain_alert($advertise->day_remains); ?>>
                                <td class="text-center"><?php echo $advertise->id;?></td>
                                <td><?php echo anchor('advertisers/view/'.$advertise->advertiser_id, $advertise->advertiser);?></td>
                                <td class="text-center"><?php echo $advertise->page;?></td>
                                <td class="text-center"><?php echo $advertise->layout;?></td>
                                <td class="text-center"><?php echo $advertise->price.' $';?></td>
                                <td class="text-center"><?php echo $advertise->discount.' %';?></td>
                                <td class="text-center"><?php echo $advertise->start_date;?></td>
                                <td class="text-center"><?php echo $advertise->end_date;?></td>
                                <td class="text-center"><?php echo $advertise->status == 1 ? anchor('advertises/status/'.$advertise->id, '<i class="fa fa-check fa-lg text-success"> '.lang('index_advertise_activated_th').'</i>', array('onClick' => "return confirm('តើ​អ្នក​ចង់​បញ្ឈប់​ដំណើរ​ការ​".lang('index_advertise_heading')."នេះ?')")) : anchor('advertises/status/'.$advertise->id, '<i class="fa fa-times fa-lg text-danger"> '.lang('index_advertise_deactivated_th').'</i>', array('onClick' => "return confirm('តើ​អ្នក​ចង់​ដំណើរ​ការ​".lang('index_advertise_heading')."នេះឡើងវិញ?')"));?></td>
                                <td class="text-center"><?php echo $advertise->payment == 1 ? anchor('advertises/payment/'.$advertise->id, lang('index_advertise_paid_th'), array('onClick' => "return confirm('តើ​".lang('index_advertise_heading')."នេះមិនទាន់​បាន​បង់​ប្រាក់​ទេ?')")) : anchor('advertises/payment/'.$advertise->id, lang('index_advertise_unpaid_th'), array('onClick' => "return confirm('តើ​".lang('index_advertise_heading')."នេះបាន​បង់​ប្រាក់​រួច​ហើយ?')"));?></td>
                                <td class="text-center"><?php echo $advertise->payment_type == 1 ? anchor('advertises/payment-type/'.$advertise->id, lang('index_advertise_monthly_payment_th'), array('onClick' => "return confirm('តើ​អ្នក​ចង់​ផ្លាស់​ប្តូរ​ប្រព័ន្ធបង់​ប្រាក់​ប្រចាំខែទៅជា​ប្រព័ន្ធបង់​សរុបវិញ?')")) : anchor('advertises/payment-type/'.$advertise->id, lang('index_advertise_hold_payment_th'), array('onClick' => "return confirm('តើ​អ្នក​ចង់​ផ្លាសប្តូរ​ប្រព័ន្ធ​បង់​ប្រាក់​សរុបទៅ​ជាប្រព័ន្ធ​បង់​ប្រាក់​ជា​ប្រចាំ​ខែវិញ?')"));?></td>
                                <td class="text-center"><?php echo anchor(prep_url($advertise->link), 'ភ្ជាប់ទៅកាន់', array('target' => '_blank'));?></td>
                                <td class="text-center"><?php echo anchor(base_url(get_uploaded_file($advertise->banner)), 'មើល​រូបភាព', array('target' => '_blank', 'class' => 'color-box'));?></td>
                                <td class="text-center"><?php echo $advertise->day_remains;?></td>
                                <td class="text-center"><?php echo link_edit("advertises/edit/".$advertise->id);?> | <?php echo link_delete('advertises/destroy/'.$advertise->id); ?></td>
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