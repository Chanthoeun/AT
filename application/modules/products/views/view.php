<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()) { ?>
        <h3 class="page-header"><i class="fa fa-eye text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-eye text-primary"> <?php echo $title; ?></i></h1>
        <?php } ?>
        
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <?php echo view_breadcrumb(); ?>
    </div>
    <!-- /.col-lg-12 -->
</div>

<?php if($message != FALSE){ ?>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong><?php echo $message;?></strong>
        </div>
    </div>
</div>
<?php } ?>

<div class="row">    
    <div class="col-lg-6">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="col-lg-1 success"><strong><?php echo lang('view_category_label'); ?></strong></td>
                    <td class="col-lg-6"> <?php echo $product->catcaption; ?></td>
                </tr>
                
                <tr>
                    <td class="col-lg-1 success"><strong><?php echo lang('view_title_label'); ?></strong></td>
                    <td class="col-lg-6"> <?php echo $product->title; ?></td>
                </tr>
                
                <tr>
                    <td class="col-lg-1 success"><strong><?php echo lang('view_price_label'); ?></strong></td>
                    <td class="col-lg-6"><i class="fa fa-dollar text-danger" > <?php echo $product->price.' / '. $product->price_type; ?></i> </td>
                </tr>
                <?php if($product->discount != FALSE): ?>
                <tr>
                    <td class="col-lg-1 success"><strong><?php echo lang('view_discount_label'); ?></strong></td>
                    <td class="col-lg-6"> <?php echo $product->discount. '%'; ?></td>
                </tr>
                
                <tr>
                    <td class="col-lg-1 success"><strong><?php echo lang('view_start_label'); ?></strong></td>
                    <td class="col-lg-6"> <?php echo date('l, d F Y', strtotime($product->start_date)); ?></td>
                </tr>
                
                <tr>
                    <td class="col-lg-1 success"><strong><?php echo lang('view_end_label'); ?></strong></td>
                    <td class="col-lg-6"> <?php echo date('l, d F Y', strtotime($product->end_date));?></td>
                </tr>
                <?php endif; ?>
                
                <tr>
                    <td class="col-lg-1 success"><strong><?php echo lang('view_action_label'); ?></strong></td>
                    <td class="col-lg-6">
                        <?php echo link_edit('products/edit/'.$product->id). ' | '. link_delete('products/destroy/'.$product->id); ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <h4 class="page-header"><?php echo lang('view_description_label'); ?></h4>
        <p><?php echo $product->description; ?></p>
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
        <h3 class="page-header"><?php echo lang('view_upload_picture_label'); ?></h3>
        <div class="row">
            <div class="col-lg-12">
                <?php echo form_open_multipart(current_url(), 'role="form" class="form-inline"', $product_id); ?>
                    <div class="form-group">
                        <?php echo lang('form_product_picture_label', 'picture', 'label-control');?> <br />
                        <?php echo form_upload($picture);?>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-upload fa-fw fa-lg"></i> <?php echo 'បន្ថែម'; ?></button>
                <?php echo form_close(); ?>
            </div>
        </div>

        <?php if($pictures != FALSE): ?>
        <h3 class="page-header">Product Pictures</h3>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline">
                    <?php 
                    foreach ($pictures as $media){
                        $picture = get_uploaded_file($media->file);
                    ?>
                    <li class="text-center"><?php echo anchor(base_url($picture), image_thumb($picture, 160, 200, array('class' => 'img-thumbnail', 'alt' => $product->title)), 'class="color-box"'); ?><br><?php echo link_delete('products/delete-media/'.$media->id); ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header" style="margin-top: 0;"><?php echo lang('view_price_list_label'); ?></h3>
        <?php echo form_open('products/add-price', 'role="form" class="form"', $product_id); ?>
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <?php echo lang('form_product_price_label', 'price');?> <br />
                    <div class="input-group">
                        <div class="input-group-addon">$</div>
                        <?php echo form_input($price);?>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <?php echo lang('form_product_price_type_label', 'price_types');?> <br />
                    <?php echo form_input($price_type);?>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <?php echo lang('form_product_discount_label', 'discount');?> <br />
                    <div class="input-group">
                        <?php echo form_input($discount);?>
                        <div class="input-group-addon">%</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <?php echo lang('form_product_discount_start_label', 'start');?> <br />
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></div>
                        <?php echo form_input($start);?>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <?php echo lang('form_product_discount_end_label', 'end');?> <br />
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></div>
                        <?php echo form_input($end);?>
                    </div>
                </div>
            </div>
            
            
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-plus fa-fw fa-lg"></i> <?php echo lang('view_add_label'); ?></button>
        <?php echo form_close(); ?>
        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center"><?php echo lang('id_th'); ?></th>
                        <th><?php echo lang('view_price_label'); ?></th>
                        <th class="text-center"><?php echo lang('view_price_type_label'); ?></th>
                        <th class="text-center"><?php echo lang('view_discount_label'); ?></th>
                        <th class="text-center"><?php echo lang('view_start_label'); ?></th>
                        <th class="text-center"><?php echo lang('view_end_label'); ?></th>
                        <th class="text-center"><?php echo lang('view_price_set_label'); ?></th>
                        <th class="text-center"><?php echo lang('view_action_label'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prices as $price): ?>
                    <tr>
                        <td class="text-center"><?php echo $price->id; ?></td>
                        <td><?php echo $price->price; ?></td>
                        <td class="text-center"><?php echo $price->price_type; ?></td>
                        <td class="text-center"><?php echo $price->discount.' %'; ?></td>
                        <td class="text-center"><?php echo $price->start_date; ?></td>
                        <td class="text-center"><?php echo $price->end_date; ?></td>
                        <td class="text-center"><?php echo $price->set == 1 ? '<i class="fa fa-check text-success"> '.lang('view_price_set_label').'</i>' : anchor('products/set/'.$price->id, '<i class="fa fa-times text-danger"> '.lang('view_price_hide_label').'</i>'); ?></td>
                        <td class="text-center">
                            <?php echo link_edit('products/edit-price/'.$price->id). ' | '. link_delete('products/delete-price/'.$price->id) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>