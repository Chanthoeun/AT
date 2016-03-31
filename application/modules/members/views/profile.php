<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()) { ?>
        <h3 class="page-header text-uppercase"><i class="fa fa-user text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header text-uppercase"><i class="fa fa-user text-primary"> <?php echo $title; ?></i></h1>
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
    <div class="col-lg-6 col-md-6">
        <h3 class="page-header" style="margin-top: 5px;"><?php echo lang('view_account_information_label'); ?></h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('index_username_th'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $user->username; ?></td>
                    </tr>

                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('index_email_th'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $user->email.' '.link_edit('members/edit-email/'.$user->id); ?></td>
                    </tr>

                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('create_user_password_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo link_edit('members/edit-password/'.$user->id); ?></td>
                    </tr>

                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('index_status_th'); ?></strong></td>
                        <td class="col-lg-6"><?php echo $user->active == 1 ? lang('index_active_link') : lang('index_inactive_link'); ?></td>
                    </tr>

                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_account_joined_label'); ?> </strong></td>
                        <td class="col-lg-6"> <?php echo date('Y-m-d H:i:s A', $user->created_on); ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_account_last_login_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo date('Y-m-d H:i:s A', $user->last_login); ?></td>
                    </tr>

                    <?php if(isset($people) && $people == FALSE): ?>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('index_action_th'); ?> </strong></td>
                        <td class="col-lg-6"><?php echo link_edit('members/update-profile/'.$user->id, lang('update_profile_label')); ?></td>
                    </tr>
                    <?php endif; ?>
                    
                </tbody>
            </table>
        </div>
        <?php if(isset($people) && $people != FALSE): ?>
        <h3 class="page-header"><?php echo lang('view_account_profile_label'); ?></h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_people_group_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $people->group; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_people_name_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $people->name; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_people_organization_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $people->organization; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_people_position_label'); ?> </strong></td>
                        <td class="col-lg-6"><?php echo $people->position; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_people_telephone_label'); ?> </strong></td>
                        <td class="col-lg-6"><?php echo str_replace(',', ' / ', $people->telephone); ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_people_social_label'); ?> </strong></td>
                        <td class="col-lg-6">
                            <?php 
                if($people->social_media != FALSE)
                {
                    $socials = explode(', ', $people->social_media);
                    foreach ($socials as $social)
                    {
                        echo anchor(prep_url($social), get_social_icon($social), array('target' => '_blank')).' ';
                    }
                }
            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('index_action_th'); ?> </strong></td>
                        <td class="col-lg-6"><?php echo link_edit('members/update-profile/'.$user->id, lang('update_profile_label')); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <!-- /.col-lg-6 -->
    <?php if(isset($organization) && $organization != FALSE): ?>
    <div class="col-lg-6 col-md-6">
        <h3 class="page-header" style="margin-top: 5px;"><?php echo lang('view_organization_profile_label'); ?></h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_group_label'); ?> </strong></td>
                        <td class="col-lg-6"> <?php echo $organization->group; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_name_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $organization->name; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_name_en_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $organization->name_en; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_contact_person_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $organization->contact_person; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_address_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $organization->address.' '.$location.' '.lang('view_agribook_pobox_label').':'.$organization->pobox; ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_telephone_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo str_replace(',', ' / ', $organization->telephone); ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_fax_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo str_replace(',', ' / ', $organization->fax); ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_email_label'); ?></strong></td>
                        <td class="col-lg-6"> 
                            <?php 
                                $email = str_replace(',', ';', $organization->email);
                                echo mailto($email, str_replace(',', ' / ', $organization->email))
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_website_label'); ?></strong></td>
                        <td class="col-lg-6"> <?php echo $organization->website == FALSE ? FALSE : anchor(prep_url($organization->website), $organization->website, array('target' => '_blank')); ?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('view_agribook_social_label'); ?> </strong></td>
                        <td class="col-lg-6">
                            <?php 
                                if($organization->social_media != FALSE)
                                {
                                    $socials = explode(', ', $organization->social_media);
                                    foreach ($socials as $social)
                                    {
                                        echo anchor(prep_url($social), get_social_icon($social), array('target' => '_blank')).' ';
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('index_agribook_status_th'); ?></strong></td>
                        <td class="col-lg-6">
                            <?php echo $organization->status == 1 ? anchor('agribooks/deactivate/'.$organization->id, '<i class="fa fa-check fa-lg text-success"> ដំណើរ​ការ</i>', array('onClick' => "return confirm('តើ​អ្នក​ចង់​បញ្ឈប់​ដំណើរ​ការ​".lang('index_agribook_heading')."នេះ?')")) : anchor('agribooks/activate/'.$organization->id, '<i class="fa fa-times fa-lg text-danger"> មិន​ដំណើរ​ការ</i>', array('onClick' => "return confirm('តើ​អ្នក​ចង់​អោយ​".lang('index_agribook_heading')."នេះ​ដំណើរ​ការ​ឡើង​វិញ​?')"));?>
                        </td>
                    </tr>
                    <?php if($checkLogin == 'admin'): ?>
                    <tr>
                        <td class="col-lg-2 success"><strong><?php echo lang('index_agribook_action_th'); ?></strong></td>
                        <td class="col-lg-6">
                            <?php echo link_edit('agribooks/edit/'.$organization->id). ' | '. link_delete('agribooks/destroy/'.$organization->id); ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php if(isset($organization) && $organization != FALSE): ?>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><?php echo lang('view_agribook_profile_label'); ?></h3>
        <p>
            <?php
               echo $organization->profile;
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
</div>
<?php endif; ?>
