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
                <?php echo lang('form_location_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php echo form_open("locations/store", 'role="form"');?>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <?php echo lang('form_location_parent_label', 'parent');?> <br />
                            <?php echo $parent;?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <?php echo lang('form_location_area_code_label', 'erea_code');?> <br />
                            <?php echo form_input($area_code);?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <?php echo lang('form_location_caption_label', 'caption');?> <br />
                            <?php echo form_input($caption);?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <?php echo lang('form_location_caption_en_label', 'caption_en');?> <br />
                            <?php echo form_input($caption_en);?>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <?php echo lang('form_location_reference_label', 'reference');?> <br />
                            <?php echo form_input($reference);?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <?php echo lang('form_location_issue_label', 'issue');?> <br />
                            <?php echo form_input($issue);?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <?php echo lang('form_location_note_label', 'note');?> <br />
                            <?php echo form_input($note);?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <?php echo lang('form_location_postal_label', 'postal');?> <br />
                            <?php echo form_input($postal);?>
                        </div>
                    </div>
                </div>
                
                <h3 class="page-header" style="margin-top: 0;"><?php echo lang('boundary_label'); ?></h3>
                <div class="row">
                    
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <?php echo lang('form_location_east_label', 'east');?> <br />
                            <?php echo form_input($east);?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <?php echo lang('form_location_west_label', 'west');?> <br />
                            <?php echo form_input($west);?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <?php echo lang('form_location_south_label', 'south');?> <br />
                            <?php echo form_input($south);?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <?php echo lang('form_location_north_label', 'north');?> <br />
                            <?php echo form_input($north);?>
                        </div>
                    </div>
                </div>
   
                <div class="form-group">
                    <?php echo lang('form_location_latlng_label', 'latlng');?> <br />
                    <?php 
                        echo $map['js'];
                        echo $map['html'];
                    ?>
                    <?php echo form_input($latlng);?>
                </div>
                
                <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo lang('btn_submit_label') ?></button>
                <?php echo btn_cancel('locations/'.$this->uri->segment(3)) ?>
                <?php echo form_close();?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>


