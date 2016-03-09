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
    <div class="col-lg-2">
        <?php 
            $logo = get_uploaded_file($job->logo);
            echo anchor(base_url($logo), image_thumb($logo, 200, 200, array('class' => 'thumbnail', 'alt' => $job->title, 'onerror' => "this.src='".  get_image('no-image.png')."'")), 'class="color-box"');
        ?>
    </div>
    <!-- /.col-lg-2 -->
    
    <div class="col-lg-10">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('form_job_title_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $job->title; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('form_job_category_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $job->catcaption; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-1 success"><strong><?php echo lang('form_job_company_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $job->company; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('from_job_agri_pos_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $job->agri_position == true ? 'Yes' : 'No'; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('from_job_agri_cat_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $job->agricatcaption; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_job_post_date_label'); ?> </strong></td>
                        <td class="col-lg-6"><?php echo date('Y-m-d', $job->created_at); ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('form_job_expire_label'); ?> </strong></td>
                        <td class="col-lg-6"> <?php echo $job->expire_date; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('index_job_action_th'); ?></strong></td>
                        <td class="col-lg-6">
                            <?php echo link_edit('jobs/edit/'.$job->id). ' | '. link_delete('jobs/destroy/'.$job->id); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h3 class="page-header"><?php echo lang('form_job_description_label'); ?></h3>
        <p><?php echo $job->description; ?></p>
        
        <h3 class="page-header"><?php echo lang('form_job_requirement_label'); ?></h3>
        <p><?php echo $job->requirement; ?></p>
        
        <h3 class="page-header"><?php echo lang('form_job_apply_label'); ?></h3>
        <p><?php echo $job->apply; ?></p>
        
    </div>
    <!-- /.col-lg-10 -->
</div>