<div class="row">
    <div class="col-lg-12">
        <?php if ($this->agent->is_mobile()){ ?>
        <h3 class="page-header"><i class="fa fa-search text-primary"> <?php echo $title; ?></i></h3>
        <?php } else { ?>
        <h1 class="page-header"><i class="fa fa-search text-primary"> <?php echo $title; ?></i></h1>
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
                    <?php echo form_input($search); ?>
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
                <?php echo lang('index_product_subheading'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">                
                <?php if($message != FALSE){ ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong><?php echo $message;?></strong>
                </div>
                <?php } ?>
                <?php if(isset($products) && $products != FALSE){ ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th class="col-lg-1 text-center hidden-xs"><?php echo lang('id_th'); ?></th>
                                <th><?php echo lang('index_product_title_th');?></th>
                                <th class="col-lg-1 text-center hidden-xs"><?php echo lang('index_product_category_th');?></th>
                                <th class="col-lg-1 text-center hidden-xs"><?php echo lang('index_product_price_th');?></th>
                                <th class="col-lg-1 text-center hidden-xs"><?php echo lang('index_product_discount_th');?></th>
                                <th class="col-lg-1 text-center hidden-xs"><?php echo lang('index_product_view_th');?></th>
                                <th class="col-lg-1 text-center"><?php echo lang('index_product_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product):?>
                            <tr>
                                <td class="text-center hidden-xs"><?php echo $product->id;?></td>
                                <td><?php echo anchor('products/view/'.$product->id, $product->title);?></td>
                                <td class="text-center hidden-xs"><?php echo $product->catcaption;?></td>
                                <td class="text-center hidden-xs"><strong><?php echo '$ '.$product->price;?></strong></td>
                                <td class="text-center hidden-xs"><?php echo $product->discount != FALSE ? $product->discount.' %' : 'None';?></td>
                                <td class="text-center hidden-xs"><?php echo $product->view;?></td>
                                <td class="text-center">
                                    <?php 
                                        echo link_edit('products/edit/'.$product->id).' | '.link_delete('products/destroy/'.$product->id);
                                    ?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
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