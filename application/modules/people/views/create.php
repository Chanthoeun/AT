<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()) { ?>
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
                <?php echo lang('form_people_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php echo form_open("people/store", 'role="form"');?>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_people_group_label', 'group');?> <br />
                            <?php echo $group;?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo lang('form_people_go_label', 'go');?> <br />
                            <?php echo $go;?>
                        </div>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_people_province_label', 'province');?> <br />
                            <?php echo $province;?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_people_khan_label', 'khan');?> <br />
                            <?php echo $khan;?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_people_sangkat_label', 'sangkat');?> <br />
                            <?php echo $sangkat;?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_people_phum_label', 'phum');?> <br />
                            <?php echo $phum;?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo lang('form_people_name_label', 'name');?> <br />
                            <?php echo form_input($name);?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo lang('form_people_organization_label', 'organization');?> <br />
                            <?php echo form_input($organization);?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo lang('form_people_position_label', 'position');?> <br />
                            <?php echo form_input($position);?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo lang('form_people_telephone_label', 'telephone');?> <br />
                            <?php echo form_input($telephone);?>
                        </div>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php echo lang('form_people_email_label', 'email');?> <br />
                            <?php echo form_input($email);?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php echo lang('form_people_social_label', 'social');?> <br />
                            <?php echo form_input($social);?>
                        </div>
                    </div>
                </div> 
                
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo lang('btn_submit_label') ?></button>
                        <?php echo btn_cancel('people') ?>
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
    $('#province').change(function(){
        var form_data = {
            pid : $('#province').val(),
            label: 'khan'
        }
        
        $('#sangkat').prop('selectedIndex',0);
        $('#phum').prop('selectedIndex',0);
        
        $.ajax({
            url: "<?php echo base_url('locations/get-ajax');?>",
            type: 'POST',
            data: form_data,
            success: function(msg){
                $('#khan').html(msg);
            }
        });
        
        return false;
    });
    
    $('#khan').change(function(){
        var form_data = {
            pid : $('#khan').val(),
            label: 'sangkat'
        }
        
        $('#phum').prop('selectedIndex',0);
        
        $.ajax({
            url: "<?php echo base_url('locations/get-ajax');?>",
            type: 'POST',
            data: form_data,
            success: function(msg){
                $('#sangkat').html(msg);
            }
        });
        
        return false;
    });
    
    $('#sangkat').change(function(){
        var form_data = {
            pid : $('#sangkat').val(),
            label: 'phum'
        }
        
        $.ajax({
            url: "<?php echo base_url('locations/get-ajax');?>",
            type: 'POST',
            data: form_data,
            success: function(msg){
                $('#phum').html(msg);
            }
        });
        
        return false;
    });
</script>