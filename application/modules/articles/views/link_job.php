<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()) { ?>
        <h3 class="page-header"><i class="fa fa-link text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-link text-primary"> <?php echo $title; ?></i></h1>
        <?php } ?>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <?php echo view_breadcrumb(); ?>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        <!-- search form -->
        <?php echo form_open(current_url(), 'class="form-inline" role="form"'); ?>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><?php echo lang('search_caption_label'); ?></div>
                    <?php echo $category; ?>
                </div>
            </div>
            <?php if ($this->agent->is_mobile()) { ?>
            <button type="submit" class="btn btn-primary btn-block visible-xs"><i class="fa fa-search fa-fw fa-lg"></i><?php echo lang('search_caption_label'); ?></button>
            <?php } else { ?>
            <button type="submit" class="btn btn-primary hidden-xs"><i class="fa fa-search fa-fw fa-lg"></i></button>
            <?php } ?>
        <?php echo form_close(); ?>
        <br>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('index_job_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">                
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if(isset($jobs) && $jobs != FALSE){ ?>
                <?php echo form_open('articles/save-link-job', 'class="form-inline" role="form"', array('articleId' => $article->id)); ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo lang('check_th'); ?></th>
                                <th><?php echo lang('index_job_title_th');?></th>
                                <th><?php echo lang('index_job_company_th');?></th>
                                <th><?php echo lang('index_job_post_th');?></th>
                                <th><?php echo lang('index_job_expired_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jobs as $job):?>
                            <tr>
                                <td class="text-center"><?php echo form_checkbox('jid[]', $job->id, set_checkbox('jid[]', $job->id)); ?></td>
                                <td><?php echo anchor('jobs/view/'.$job->id, $job->title, array('target' => '_blank'));?></td>
                                <td><?php echo $job->company;?></td>
                                <td><?php echo date('Y-m-d', $job->created_at);?></td>
                                <td><?php echo $job->expire_date; ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-link fa-fw"></i> <?php echo lang('link_btn') ?></button>
                <?php echo btn_cancel('articles/view/'.$article->id) ?>
                <?php echo form_close(); ?>
                
                <?php }else{ ?>
                <div class="alert alert-info"><?php echo lang('no_record_label');?></div>
                <?php } ?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>