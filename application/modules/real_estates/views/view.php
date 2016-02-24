<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
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
                    <td class="col-lg-6"> <?php echo $real_estate->catcaption; ?></td>
                </tr>
                <tr>
                    <td class="col-lg-1 success"><strong><?php echo lang('view_title_label'); ?></strong></td>
                    <td class="col-lg-6"><?php echo $real_estate->title; ?></td>
                </tr>
                <tr>
                    <td class="col-lg-1 success"><strong><?php echo lang('view_price_label'); ?></strong></td>
                    <td class="col-lg-6"><i class="fa fa-dollar text-danger" > <?php echo $real_estate->price; ?></i> </td>
                </tr>
                <tr>
                    <td class="col-lg-1 success"><strong><?php echo lang('view_address_label'); ?></strong></td>
                    <td class="col-lg-6"><?php echo $real_estate->address.' /  '. $location; ?></td>
                </tr>
                <tr>
                    <td class="col-lg-1 success"><strong><?php echo lang('view_status_label'); ?></strong></td>
                    <td class="col-lg-6"><?php echo $real_estate->status == 1 ? anchor('real_estates/sold/'.$real_estate->id, '<i class="fa fa-times text-danger"> លុក​រួច​ហើយ</i>') : anchor('real_estates/sold/'.$real_estate->id.'/1', '<i class="fa fa-check text-success"> មិនទាន់​លុក</i>'); ?></td>
                </tr>
                <tr>
                    <td class="col-lg-1 success"><strong><?php echo lang('view_action_label'); ?></strong></td>
                    <td class="col-lg-6">
                        <?php echo link_edit('real-estates/edit/'.$real_estate->id). ' | '. link_delete('real-estates/destroy/'.$real_estate->id); ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <h4 class="page-header"><?php echo lang('view_detail_label'); ?></h4>
        <p><?php echo $real_estate->description; ?></p>
        
        <?php if($real_estate->map != FALSE): ?>
        <h4 class="page-header"><?php echo lang('view_location_label'); ?></h4>
        <div class="thumbnail">
            <?php 
                echo $map['js'];
                echo $map['html'];
            ?>
        </div>
        <?php endif; ?>
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">        
        <h3 class="page-header" style="margin-top: 0;"><?php echo lang('view_picture_upload_label'); ?></h3>
        <div class="row">
            <div class="col-lg-12">
                <?php echo form_open_multipart(current_url(), 'role="form" class="form-inline"', $real_estate_id); ?>
                    <div class="form-group">
                        <?php echo lang('form_real_estate_picture_label', 'picture', 'label-control');?> <br />
                        <?php echo form_upload($picture);?>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-upload fa-fw fa-lg"></i> <?php echo lang('form_real_estate_submit_btn') ?></button>
                <?php echo form_close(); ?>
            </div>
        </div>
        <?php if($medias != FALSE): ?>
        <h3 class="page-header"><?php echo lang('view_picture_label'); ?></h3>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline">
                    <?php 
                        foreach ($medias as $media){
                            $picture = get_uploaded_file($media->file);

                    ?>
                    <li class="text-center"><?php echo anchor(base_url($picture), image_thumb($picture, 160, 200, array('class' => 'img-thumbnail', 'alt' => $real_estate->title)), 'class="color-box"'); ?><br> <?php echo link_delete('real_estates/delete-media/'.$media->id) ?></li>
                    <?php
                        } 
                    ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>