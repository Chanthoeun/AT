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
<div class="alert alert-warning" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <strong><?php echo $message;?></strong>
</div>
<?php } ?>

<div class="row">
    <div class="col-lg-6">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="col-lg-3 warning"><?php echo lang('view_article_cateogry_th');?></td>
                        <td><?php echo $article->catcaption;?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-3 warning"><?php echo lang('view_article_type_th');?></td>
                        <td><?php echo $article->artcaption;?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-3 warning"><?php echo lang('view_article_location_label');?></td>
                        <td><?php echo isset($location) && $location != FALSE ? $location : FALSE;?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-3 warning"><?php echo lang('view_article_published_on_th');?></td>
                        <td><?php echo $article->published_on;?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-3 warning"><?php echo lang('view_article_source_th');?></td>
                        <td>
                            <?php 
                $source = explode(',', utf8_decode($article->source));
                echo anchor(prep_url(trim($source[1])), trim($source[0]), 'target="_blank"');
            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-lg-3 warning"><?php echo lang('index_article_action_th');?></td>
                        <td><?php echo link_edit('articles/edit/'.$article->id).' | '.link_delete('articles/destroy/'.$article->id); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.table -->
        <figure>
            <?php 
        $picture = get_uploaded_file($article->picture);
    ?>
            <img src="<?php echo base_url($picture); ?>" alt="<?php echo $article->pcaption ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
            <figcaption><?php echo $article->pcaption; ?></figcaption>
        </figure>
        <!-- /.figure -->
        <p class="text-justify"><?php echo $article->detail; ?></p>
        
        <?php if($details != FALSE){ ?>
            <?php foreach ($details as $detail){ ?>
            <?php if($detail->picture != FALSE): ?>
            <figure>
                <?php 
                    $picture = get_uploaded_file($detail->picture);
                ?>
                <img src="<?php echo base_url($picture); ?>" alt="<?php echo $detail->pcaption ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                <figcaption><?php echo $detail->pcaption; ?></figcaption>
            </figure>
            <!-- /.figure -->
            <?php endif; ?>
            <?php if($detail->title !=  FALSE): ?>
            <h4 class="page-header"><?php echo $detail->title; ?></h4>
            <?php endif; ?>
            
            <p class="text-justify"><?php echo $detail->detail; ?></p>
            <?php } ?>
        <?php } ?>
        
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
        <?php if(isset($documents) && $documents != FALSE): ?>
        <h3 class="page-header" style="margin-top: 0;"><i class="fa fa-file text-primary"> <?php echo lang('view_article_document_label'); ?></i></h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th><?php echo lang('view_caption_th');?></th>
                        <th class="col-lg-1"><?php echo lang('view_preview_th');?></th>
                        <th class="col-lg-2 text-center"><?php echo lang('view_action_th');?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($documents as $doc):?>
                    <tr>
                        <td><?php echo anchor(base_url(get_uploaded_file($doc->picture)), $doc->caption, 'class="color-box"');?></td>
                        <td><?php echo valid_url($doc->file) == TRUE ? anchor(prep_url($doc->file), lang('view_open_th'), 'target="_blank"') : anchor(base_url(get_uploaded_file($doc->file)), lang('view_open_th'), array('download' => $doc->caption, 'target' => '_blank'));?></td>
                        <td class="text-center">
                            <?php echo link_edit("library/edit/".$doc->lid.'/'.$doc->id);?> | 
                            <?php echo link_delete('article-libraries/destroy/'.$doc->id.'/'.$article->id); ?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
        
        <?php if(isset($audios) && $audios != FALSE): ?>
        <h3 class="page-header"><i class="fa fa-music text-primary"> <?php echo lang('view_article_audio_label'); ?></i></h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th><?php echo lang('view_caption_th');?></th>
                        <th class="col-lg-1"><?php echo lang('view_play_th');?></th>
                        <th class="col-lg-2 text-center"><?php echo lang('view_action_th');?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($audios as $audio):?>
                    <tr>
                        <td><?php echo anchor(base_url(get_uploaded_file($audio->picture)), $audio->caption, 'class="color-box"');?></td>
                        <td>
                            <audio controls>
                                <source src="<?php echo base_url(get_uploaded_file($audio->file)); ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </td>
                        <td class="text-center">
                            <?php echo link_edit("library/edit/".$audio->lid.'/'.$audio->id);?> | 
                            <?php echo link_delete('article-libraries/destroy/'.$audio->id.'/'.$article->id); ?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
        
        <?php if(isset($videos) && $videos != FALSE): ?>
        <h3 class="page-header"><i class="fa fa-film text-primary"> <?php echo lang('view_article_video_label'); ?></i></h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th><?php echo lang('view_caption_th');?></th>
                        <th class="col-lg-1"><?php echo lang('view_preview_th');?></th>
                        <th class="col-lg-2 text-center"><?php echo lang('view_action_th');?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($videos as $video):?>
                    <tr>
                        <td><?php echo anchor(base_url(get_uploaded_file($video->picture)), $video->caption, 'class="color-box"');?></td>
                        <td><?php echo valid_url($video->file) == TRUE ? anchor(prep_url($video->file), lang('view_open_th'), 'target="_blank"') : anchor(base_url(get_uploaded_file($video->file)), lang('view_open_th'), array('target' => '_blank'));?></td>
                        <td class="text-center">
                            <?php echo link_edit("library/edit/".$video->lid.'/'.$video->id);?> | 
                            <?php echo link_delete('article-libraries/destroy/'.$video->id.'/'.$article->id); ?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
        <?php if(isset($products) && $products != FALSE): ?>
        <h3 class="page-header"><i class="fa fa-shopping-cart text-primary"> <?php echo lang('article_link_product_menu_label'); ?></i></h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th><?php echo lang('index_product_title_th');?></th>
                        <th class="col-lg-2"><?php echo lang('index_product_price_th');?></th>
                        <th class="col-lg-2"><?php echo lang('index_product_category_th');?></th>
                        <th class="col-lg-2 text-center"><?php echo lang('view_action_th');?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product):?>
                    <tr>
                        <td><?php echo anchor('products/view/'.$product->product_id, $product->title, array('target' => '_blank'));?></td>
                        <td><?php echo $product->price;?></td>
                        <td><?php echo $product->category;?></td>
                        <td class="text-center">
                            <?php echo link_delete('article-products/destroy/'.$product->id); ?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
        
        <?php if(isset($real_estates) && $real_estates != FALSE): ?>
        <h3 class="page-header"><i class="fa fa-building text-primary"> <?php echo lang('article_link_real_estate_menu_label'); ?></i></h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th><?php echo lang('index_real_estate_title_th');?></th>
                        <th class="text-center"><?php echo lang('index_real_estate_category_th');?></th>
                        <th class="text-center"><?php echo lang('index_real_estate_price_th');?></th>
                        <th class="text-center"><?php echo lang('index_real_estate_status_th');?></th>
                        <th class="col-lg-2 text-center"><?php echo lang('index_real_estate_action_th');?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($real_estates as $real_estate):?>
                    <tr>
                        <td><?php echo anchor('real-estates/view/'.$real_estate->real_estate_id, $real_estate->title, array('target' => '_blank'));?></td>
                        <td class="text-center"><?php echo $real_estate->category;?></td>
                        <td class="text-center"><strong><?php echo '$ '.$real_estate->price;?></strong></td>
                        <td class="text-center"><?php echo $real_estate->status == 1 ? anchor('real-estates/sold/'.$real_estate->id, '<i class="fa fa-times fa-lg text-danger"> លក់​រួច​ហើយ</i>', 'title="ដាក់​ថា​មិន​ទាន់​លក់"') : anchor('real-estates/sold/'.$real_estate->id.'/1', '<i class="fa fa-check fa-lg text-success"> មិនទាន់​លក់</i>', 'title="ដាក់​ថាលក់​រួចហើយ"');?></td>
                        <td class="text-center">
                            <?php 
                                echo link_delete('article-real-estates/destroy/'.$real_estate->id);
                            ?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
        
        <?php if(isset($jobs) && $jobs != FALSE): ?>
        <h3 class="page-header"><i class="fa fa-search text-primary"> <?php echo lang('article_link_job_menu_label'); ?></i></h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th><?php echo lang('index_job_title_th');?></th>
                        <th><?php echo lang('index_job_expired_th');?></th>
                        <th><?php echo lang('index_job_company_th');?></th>
                        <th><?php echo lang('form_job_category_label');?></th>
                        <th class="col-lg-2 text-center"><?php echo lang('index_job_action_th');?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jobs as $job):?>
                    <tr>
                        <td><?php echo anchor('jobs/view/'.$job->job_id, $job->title, array('target' => '_blank'));?></td>
                        <td><?php echo $job->expire_date; ?></td>
                        <td><?php echo $job->company;?></td>
                        <td><?php echo $job->category;?></td>                
                        <td class="text-center">
                            <?php echo link_delete('article-jobs/destroy/'.$job->id); ?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
        
        <?php if(isset($people) && $people != FALSE): ?>
        <h3 class="page-header"><i class="fa fa-group text-primary"> <?php echo lang('article_link_people_menu_label'); ?></i></h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th><?php echo lang('index_people_name_th');?></th>
                        <th class="text-center"><?php echo lang('form_people_validation_position_label');?></th>
                        <th class="text-center"><?php echo lang('index_people_organization_th');?></th>
                        <th class="text-center"><?php echo lang('form_people_validation_group_label');?></th>
                        <th class="col-lg-2 text-center"><?php echo lang('index_people_action_th');?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($people as $p):?>
                    <tr>
                        <td><?php echo anchor('people/view/'.$p->people_id, $p->name, array('target' => '_blank'));?></td>
                        <td class="text-center"><?php echo $p->position;?></td>
                        <td class="text-center"><?php echo $p->organization;?></td>
                        <td class="text-center"><?php echo $p->group;?></td>
                        <td class="text-center"><?php echo link_delete('article-people/destroy/'.$p->id); ?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
        
        <?php if(isset($abs) && $abs != FALSE): ?>
        <h3 class="page-header"><i class="fa fa-book text-primary"> <?php echo lang('article_link_agribook_menu_label'); ?></i></h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th><?php echo lang('index_agribook_name_th');?></th>
                        <th class="text-center"><?php echo lang('form_agribook_validation_contact_person_label');?></th>
                        <th class="text-center"><?php echo lang('index_agribook_telephone_th');?></th>
                        <th class="text-center"><?php echo lang('form_agribook_validation_group_label');?></th>
                        <th class="col-lg-2 text-center"><?php echo lang('index_agribook_action_th');?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($abs as $ab):?>
                    <tr>
                        <td><?php echo anchor('agribooks/view/'.$ab->agribook_id, $ab->name.' | '.$ab->name_en, array('target' => '_blank'));?></td>
                        <td class="text-center"><?php echo $ab->contact_person;?></td>
                        <td class="text-center"><?php echo $ab->telephone;?></td>
                        <td class="text-center"><?php echo $ab->group ?></td>
                        <td class="text-center"><?php echo link_delete('article-agribooks/destroy/'.$ab->id); ?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>