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
                <?php echo lang('form_product_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php echo form_open("products/modify", 'role="form"', $product_id);?>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <?php echo lang('form_product_category_label', 'category');?> <br />
                            <?php echo $category;?>
                        </div>
                    </div>
                    
                    <div class="col-lg-7">
                        <div class="form-group">
                            <?php echo lang('form_product_title_label', 'title');?> <br />
                            <?php echo form_input($product_title);?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-9">
                        <div class="form-group">
                            <?php echo lang('form_product_desc_label', 'desc');?> <br />
                            <?php echo form_textarea($desc); ?>
                            <script>
                                    CKEDITOR.replace( 'desc', {height: 300} );
                            </script>   
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo lang('btn_submit_label') ?></button>
                        <?php echo btn_cancel('products/view/'.$product->id) ?>
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


