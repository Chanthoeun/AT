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
                <?php echo lang('form_article_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php echo form_open_multipart("articles/store", 'role="form"');?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo lang('form_article_title_label', 'title');?> <br />

                            <?php echo form_input($article_title);?>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_article_keyword_label', 'keyword');?> <br />

                            <?php echo form_input($keyword);?>
                        </div>
                    </div>
                    
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_article_type_label', 'type');?> <br />

                            <?php echo $type;?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_article_category_label', 'category');?> <br />

                            <?php echo $category;?>
                        </div>
                    </div>
                    
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_article_publish_label', 'publish');?> <br />

                            <div class="input-group date">
                                <?php echo form_input($publish);?>
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="page-header"><i class="fa fa-map-marker fa-fw"></i> <?php echo lang('index_article_location_th');?></h4>
                <div class="row">
                    
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_article_province_label', 'province');?> <br />
                            <?php echo $province;?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_article_khan_label', 'khan');?> <br />
                            <?php echo $khan;?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_article_sangkat_label', 'sangkat');?> <br />
                            <?php echo $sangkat;?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_article_phum_label', 'phum');?> <br />
                            <?php echo $phum;?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo lang('form_article_detail_label', 'detail');?> <br />
                            <?php echo form_textarea($detail);?>
                            <script>
                CKEDITOR.replace( 'detail', {height: 400, filebrowserBrowseUrl: '/assets/pgrfilemanager/PGRFileManager.php',} );
            </script>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo lang('form_article_source_label', 'source');?> <br />
                            <?php echo form_input($source);?>
                        </div>
                    </div>
                </div>

                <h4 class="page-header"><i class="fa fa-picture-o fa-fw"></i> <?php echo lang('form_article_add_picture_label');?></h4>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php echo lang('form_article_pcaption_label', 'Pcaption');?> <br />
                            <?php echo form_input($pcaption); ?>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo lang('form_article_picture_label', 'files');?> <br />
                            <?php echo form_upload(array('name'=> 'picture', 'accept' => 'image/*')); ?>
                        </div>
                    </div>
                </div>

                <h4 class="page-header"><i class="fa fa-facebook-square fa-fw"></i> <?php echo lang('form_article_fbp_label');?></h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo lang('form_article_fb_label', 'fb');?> <br />
                            <?php echo form_textarea($fb);?>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo form_checkbox($fbp).' '.lang('form_article_fbp_label', 'fbp'); ?>
                        </div>
                    </div>
                </div>
                
                <h4 class="page-header"><i class="fa fa-check fa-fw"></i> <?php echo lang('form_article_full_article_label');?></h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?php echo form_checkbox($full).' '.lang('form_article_full_label', 'full'); ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo lang('btn_submit_label') ?></button>
                        <?php echo btn_cancel('articles') ?>
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
    
    $('#type').change(function(){
        var form_data = {
            atid : $('#type').val()
        }
        
        $('#category').prop('selectedIndex',0);
        
        $.ajax({
            url: "<?php echo base_url('categories/get-ajax');?>",
            type: 'POST',
            data: form_data,
            success: function(msg){
                $('#category').html(msg);
            }
        });
        
        return false;
    });
</script>