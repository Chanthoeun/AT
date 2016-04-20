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
                <?php echo lang('form_agribook_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php echo form_open_multipart("agribooks/store", 'role="form"', $members);?>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_agribook_member_type_label', 'member_type');?> <br />
                            <?php echo $member_type;?>
                        </div>
                    </div>
                    
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_agribook_parent_label', 'parent');?> <br />
                            <?php echo $parent;?>
                        </div>
                    </div>
                    
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_agribook_make_as_parent_label', 'set_parent');?> <br />
                            <?php echo form_checkbox($set_parent).lang('form_agribook_validation_make_as_parent_label');?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_agribook_group_label', 'group');?> <br />
                            <?php echo $group;?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo lang('form_agribook_name_label', 'name');?> <br />
                            <?php echo form_input($name);?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo lang('form_agribook_name_en_label', 'name_en');?> <br />
                            <?php echo form_input($name_en);?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_agribook_contact_person_label', 'contact_person');?> <br />
                            <?php echo form_input($contact_person);?>
                        </div>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <?php echo lang('form_agribook_address_label', 'address');?> <br />
                            <?php echo form_input($address);?>
                        </div>
                    </div>
                    
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_agribook_province_label', 'province');?> <br />
                            <?php echo $province;?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_agribook_khan_label', 'khan');?> <br />
                            <?php echo $khan;?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_agribook_sangkat_label', 'sangkat');?> <br />
                            <?php echo $sangkat;?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_agribook_phum_label', 'phum');?> <br />
                            <?php echo $phum;?>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="form-group">
                            <?php echo lang('form_agribook_pobox_label', 'pobox');?> <br />
                            <?php echo form_input($pobox);?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_agribook_telephone_label', 'telephone');?> <br />
                            <?php echo form_input($telephone);?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_agribook_fax_label', 'fax');?> <br />
                            <?php echo form_input($fax);?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_agribook_email_label', 'email');?> <br />
                            <?php echo form_input($email);?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_agribook_website_label', 'website');?> <br />
                            <?php echo form_input($website);?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_agribook_social_label', 'social');?> <br />
                            <?php echo form_input($social);?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_agribook_logo_label', 'logo');?> <br />
                            <?php echo form_upload($picture);?>
                        </div>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo lang('form_agribook_profile_label', 'profile');?> <br />
                            <?php echo form_textarea($profile);?>
                            <script>
                CKEDITOR.replace( 'profile', {height: 250} );
            </script>
                        </div>
                    </div>
                </div> 
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                             <script type="text/javascript">
                    var centreGot = false;
             </script>
                            <?php echo lang('form_agribook_map_label', 'latlng');?> <br />
                            <?php 
                echo $map['js'];
                echo $map['html'];
             ?>
                            <?php echo form_input($latlng);?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary" onclick="<?php echo lang('location_alert_label');?>"><i class="fa fa-save fa-fw"></i> <?php echo lang('btn_submit_label') ?></button>
                        <?php echo btn_cancel('agribooks') ?>
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