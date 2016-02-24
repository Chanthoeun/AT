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
            if($agribook->logo != FALSE)
            {
                echo image_thumb(get_uploaded_file($agribook->logo), 200, 200, array('class' => 'thumbnail', 'alt' => $agribook->name, 'onerror' => get_image('no-image.png')));
            }
        ?>
    </div>
    <div class="col-lg-10">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_group_label'); ?> </strong></td>
                        <td class="col-lg-6"> <?php echo $agribook->group; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_name_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $agribook->name; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_name_en_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $agribook->name_en; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_contact_person_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $agribook->contact_person; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_address_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $agribook->address.' '.$location.' '.lang('view_agribook_pobox_label').':'.$agribook->pobox; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_telephone_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo str_replace(',', ' / ', $agribook->telephone); ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_fax_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo str_replace(',', ' / ', $agribook->fax); ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_email_label'); ?></strong></td>
                        <td class="col-lg-6"> 
                            <?php 
                                $email = str_replace(',', ';', $agribook->email);
                                echo mailto($email, str_replace(',', ' / ', $agribook->email))
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_website_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $agribook->website == FALSE ? FALSE : anchor(prep_url($agribook->website), $agribook->website, array('target' => '_blank')); ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_social_label'); ?> </strong></td>
                        <td class="col-lg-6">
                            <?php 
                                $socials = explode(', ', $agribook->social_media);
                                foreach ($socials as $social)
                                {
                                    echo anchor(prep_url($social), get_social_icon($social), array('target' => '_blank')).' ';
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('index_agribook_status_th'); ?></strong></td>
                        <td class="col-lg-6">
                            <?php echo $agribook->status == 1 ? anchor('agribooks/deactivate/'.$agribook->id, '<i class="fa fa-check fa-lg text-success"> ដំណើរ​ការ</i>', array('onClick' => "return confirm('តើ​អ្នក​ចង់​បញ្ឈប់​ដំណើរ​ការ​".lang('index_agribook_heading')."នេះ?')")) : anchor('agribooks/activate/'.$agribook->id, '<i class="fa fa-times fa-lg text-danger"> មិន​ដំណើរ​ការ</i>', array('onClick' => "return confirm('តើ​អ្នក​ចង់​អោយ​".lang('index_agribook_heading')."នេះ​ដំណើរ​ការ​ឡើង​វិញ​?')"));?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('index_agribook_action_th'); ?></strong></td>
                        <td class="col-lg-6">
                            <?php echo link_edit('agribooks/edit/'.$agribook->id). ' | '. link_delete('agribooks/destroy/'.$agribook->id); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <h3 class="page-header"><?php echo lang('view_agribook_profile_label'); ?></h3>
        <p>
            <?php
               echo $agribook->profile;
            ?>
        </p>
        
        <?php if($map != FALSE): ?>
        <h3 class="page-header"><?php echo lang('view_agribook_location_label'); ?></h3>
        <div class="thumbnail">
            <?php 
                echo $map['js'];
                echo $map['html'];
            ?>
        </div>
        <?php endif; ?>
    </div>
    <!-- /.col-lg-12 -->
</div>