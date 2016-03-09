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
                    <?php echo $group; ?>
                </div>
            </div>
        <div class="form-group">
                <?php echo $go; ?>
            </div>
            <div class="form-group">
                <?php echo $province; ?>
            </div>
            <div class="form-group">
                <?php echo $khan; ?>
            </div>
            
            <div class="form-group">
                <?php echo $sangkat; ?>
            </div>
        
            <div class="form-group">
                <?php echo $phum; ?>
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
                <?php echo lang('index_people_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">                
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if(isset($people) && $people != FALSE){ ?>
                <?php echo form_open('articles/save-link-people', 'class="form-inline" role="form"', array('articleId' => $article->id)); ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo lang('check_th'); ?></th>
                                <th><?php echo lang('index_people_name_th');?></th>
                                <th class="text-center"><?php echo lang('index_people_organization_th');?></th>
                                <th class="text-center"><?php echo lang('index_people_telephone_th');?></th>
                                <th class="text-center"><?php echo lang('index_people_email_th');?></th>
                                <th class="text-center"><?php echo lang('index_people_status_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($people as $p):?>
                            <tr>
                                <td class="text-center"><?php echo form_checkbox('pid[]', $p->id, set_checkbox('pid[]', $p->id)); ?></td>
                                <td><?php echo anchor('people/view/'.$p->id, $p->name, array('target' => '_blank'));?></td>
                                <td class="text-center"><?php echo $p->organization;?></td>
                                <td class="text-center"><?php echo $p->telephone;?></td>
                                <td class="text-center">
                                    <?php 
                                        $email = str_replace(',', ';', $p->email);
                                        echo mailto($email, str_replace(',', ' / ', $p->email), array('title' => lang('send_email_label')));
                                    ?>
                                </td>
                                <td class="text-center"><?php echo $p->status == 1 ? anchor('people/deactivate/'.$p->id, '<i class="fa fa-check fa-lg text-success"> ដំណើរ​ការ</i>', array('onClick' => "return confirm('តើ​អ្នក​ចង់​បញ្ឈប់​ដំណើរ​ការ​".lang('index_people_heading')."នេះ?')")) : anchor('people/activate/'.$p->id, '<i class="fa fa-times fa-lg text-danger"> មិន​ដំណើរ​ការ</i>', array('onClick' => "return confirm('តើ​អ្នក​ចង់​អោយ​".lang('index_people_heading')."នេះ​ដំណើរ​ការ​ឡើង​វិញ​?')"));?></td>
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
<script src="https://code.jquery.com/jquery-1.12.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $('#province').change(function(){
        var form_data = {
            pid : $('#province').val(),
            label: 'khan'
        }
        
        $('#sangkat').prop('selectedIndex',0);
        $('#phum').prop('selectedIndex',0);
        
        $.ajax({
            url: "<?php echo base_url('locations/get-ajax');?>",
            type: 'POST',
            data: form_data,
            success: function(msg){
                $('#khan').html(msg);
            }
        });
        
        return false;
    });
    
    $('#khan').change(function(){
        var form_data = {
            pid : $('#khan').val(),
            label: 'sangkat'
        }
        
        $('#phum').prop('selectedIndex',0);
        
        $.ajax({
            url: "<?php echo base_url('locations/get-ajax');?>",
            type: 'POST',
            data: form_data,
            success: function(msg){
                $('#sangkat').html(msg);
            }
        });
        
        return false;
    });
    
    $('#sangkat').change(function(){
        var form_data = {
            pid : $('#sangkat').val(),
            label: 'phum'
        }
        
        $.ajax({
            url: "<?php echo base_url('locations/get-ajax');?>",
            type: 'POST',
            data: form_data,
            success: function(msg){
                $('#phum').html(msg);
            }
        });
        
        return false;
    });
</script>