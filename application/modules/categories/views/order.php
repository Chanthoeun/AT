<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()) { ?>
        <h3 class="page-header"><i class="fa fa-list-ol text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-list-ol text-primary"> <?php echo $title; ?></i></h1>
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
                <?php echo lang('sortable_category_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <?php if($message != FALSE){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                
                <div id="orderResult">
                    <?php 
               echo get_ol_sortable_list(prepareList($categories)); 
         ?>
                </div>
                <?php echo form_button(array('name' => 'save', 'id' => 'save', 'class' => 'btn btn-primary'), '<i class="fa fa-save fa-fw"></i> '.lang('btn_submit_label')); ?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<script src="https://code.jquery.com/jquery-1.12.0.min.js" type="text/javascript"></script>
<script>
$(function(){
    $('#save').click(function(){
        oSortable = $('.sortable').nestedSortable('toArray');
        $('#orderResult').slideUp(function(){
            $.post('<?php echo site_url('categories/order-ajax'); ?>', {sortable: oSortable}, function(data){
                //$('#orderResult').html(data);
                $('#orderResult').slideDown();
            });
        });
    });
});
</script>


