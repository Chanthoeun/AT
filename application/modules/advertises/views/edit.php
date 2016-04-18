<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
        <h3 class="page-header"><i class="fa fa-plus-square-o text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-plus-square-o text-primary"> <?php echo $title; ?></i></h1>
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
                <?php echo lang('form_advertise_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                
                <?php echo form_open_multipart("advertises/modify", 'role="form"', $advertise_id);?>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_advertise_page_label', 'page');?> <br />
                            <?php echo $page;?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_advertise_layout_label', 'layout');?> <br />
                            <?php echo $layout;?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_advertise_price_label', 'price');?> <br />
                            <div class="input-group date">
                                <?php echo form_input($price);?>
                                <div class="input-group-addon">$/ខែ</div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_advertise_discount_label', 'discount');?> <br />
                            <div class="input-group">
                                <?php echo form_input($discount);?>
                                <div class="input-group-addon">%</div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_advertise_start_date_label', 'start_date');?> <br />
                            <div class="input-group date">
                                <?php echo form_input($start_date);?>
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_advertise_end_date_label', 'advertiser');?> <br />
                            <div class="input-group date">
                                <?php echo form_input($end_date);?>
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php echo lang('form_advertise_link_label', 'link');?> <br />
                            <?php echo form_input($link);?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_advertise_banner_label', 'banner');?> <br />
                            <?php echo form_upload($banner);?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header" style="margin-top: 0;"><?php echo lang('form_advertise_payment_type_label', 'payment_type');?></h4>
                        <div class="checkbox">
                            <label>
                                <?php echo form_checkbox($payment_type).' បង់​ប្រចាំ​ខែ';?> <br><br>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo lang('btn_submit_label') ?></button>
                        <?php echo btn_cancel('advertisers/view/'.$advertise->advertiser_id); ?>
                    </div>
                </div>
                <?php echo form_close();?>
                
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<script src="https://code.jquery.com/jquery-1.12.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $('#page').change(function(){
        var form_data = {
            pid : $('#page').val()
        }
        
        $.ajax({
            url: "<?php echo base_url('advertises/get-layout');?>",
            type: 'POST',
            data: form_data,
            success: function(msg){
                $('#layout').html(msg);
            }
        });
        
        return false;
    });
    
    $('#layout').change(function(){
        var form_data = {
            lid : $('#layout').val()
        }
        
        $.ajax({
            url: "<?php echo base_url('advertises/get-price');?>",
            type: 'POST',
            data: form_data,
            success: function(msg){
                $('#price').val(msg);
            }
        });
        
        return false;
    });
</script>