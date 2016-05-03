<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()) { ?>
        <h3 class="page-header"><i class="fa fa-pencil-square-o text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-pencil-square-o text-primary"> <?php echo $title; ?></i></h1>
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
                <?php echo lang('form_cagetory_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <div class="col-lg-4">
                    <?php echo form_open("categories/modify", 'role="form"', $category_id);?>
                    <div class="form-group">
                        <?php echo lang('form_cagetory_parent_label', 'parent');?> <br />

                        <?php echo $parent;?>
                    </div>

                    <div class="form-group">
                        <?php echo lang('form_cagetory_caption_label', 'caption');?> <br />
                        <?php echo form_input($caption);?>
                    </div>

                    <h4 class="page-header"><?php echo lang('form_cagetory_type_label'); ?></h4>
                    <ul class="list-inline">
                        <li>
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox($article).' '.  lang('form_cagetory_article_label');?> 
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox($market).' '.  lang('form_cagetory_market_label');?> 
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox($real_estate).' '.  lang('form_cagetory_real_estate_label');?> 
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox($job).' '.  lang('form_cagetory_job_label');?> 
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox($document).' '.  lang('form_cagetory_document_label');?> 
                                </label>
                            </div>
                        </li>
                    </ul>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo lang('btn_submit_label') ?></button>
                        <?php echo btn_cancel($category->parent_id == FALSE ? 'categories' : 'categories/'.$category->parent_id) ?>
                    <?php echo form_close();?>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>


