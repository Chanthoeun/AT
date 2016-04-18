<div class="content">
        <div class="content-left">
            <div class="search">
                <h3 id="search-toggle">
                    <?php echo $title; ?>
                </h3>
                <fieldset class="search-form">
                     <?php if($message != FALSE){ ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <strong><?php echo $message;?></strong>
                    </div>
                    <?php } ?>
                    
                    <?php echo form_open(current_url(), array('role' => 'form')); ?>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <?php echo lang('form_search_title_label', 'search_title'); ?>
                                    <?php echo form_input($search_title); ?>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <?php echo lang('form_search_type_label', 'search_type'); ?>
                                    <?php echo $search_type; ?>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3" id="job">
                                <div class="form-group">
                                    <?php echo lang('form_search_province_label', 'province'); ?>
                                    <?php echo $province; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="location">
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <?php echo lang('form_search_province_label', 'province'); ?>
                                    <?php echo $province; ?>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <?php echo lang('form_search_khan_label', 'khan'); ?>
                                    <?php echo $khan; ?>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <?php echo lang('form_search_sangkat_label', 'sangkat'); ?>
                                    <?php echo $sangkat; ?>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <?php echo lang('form_search_phum_label', 'phum'); ?>
                                    <?php echo $phum; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fa fa-search"></i>
                                    <?php echo lang('form_search_btn'); ?>
                                </button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </fieldset>
            </div>

            <div class="search-result">
                <h3 class="search-result-title"><?php echo sprintf(lang('home_search_result_found'), isset($get_result) && $get_result != FALSE ? count($get_result) : 0) ?></h3>
                <?php if(isset($get_result) && $get_result != FALSE): ?>
                <ul>
                    <?php 
            switch ($get_searchType)
            {
                case 2:
                foreach ($get_result as $result):
         ?>
                    <li>
                        <a href="<?php echo site_url('product-detail/'.$result->id); ?>">
                            <figure class="clearfix">
                                <div class="img-box">
                                    <img src="<?php echo base_url(get_uploaded_file($result->file)); ?>" alt="<?php echo $result->title ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                                </div>

                                <figcaption>
                                    <h4 class="title">
                                        <?php 
                      echo highlight_phrase($result->title, $get_searchTitle, '<span style="color: red;">', '</span>'); 
                      if($product->discount != FALSE && $product->end_date >= date('Y-m-d'))
                      {
                          echo "<span class='price'>".  get_discount_price($result->price, $result->discount)."</span>";
                      }
                      else
                      {
                          echo "<span class='price'>".$result->price."</span>";
                      }
                                  
                  ?> 
                                    </h4>
                                    <p><?php echo character_limiter($result->description, 190); ?></p>
                                </figcaption>
                            </figure>
                        </a>
                    </li><!-- Item -->
                    <?php
                    endforeach;
                    break;
                case 3:
                    foreach ($get_result as $result):
         ?>
                    <li>
                        <a href="<?php echo site_url('land-detail/'.$result->id); ?>">
                            <figure class="clearfix">
                                <div class="img-box">
                                    <img src="<?php echo base_url(get_uploaded_file($result->file)); ?>" alt="<?php echo $result->title ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                                </div>

                                <figcaption>
                                    <h4 class="title"><?php echo highlight_phrase($result->title, $get_searchTitle, '<span style="color: red;">', '</span>'). ' <span class="price">'.$result->price.'</span>' ?></h4>
                                    <p><?php echo character_limiter($result->description, 190); ?></p>
                                </figcaption>
                            </figure>
                        </a>
                    </li><!-- Item -->
                    <?php
                    endforeach;
                    break;
                case 4:
                    foreach ($get_result as $result):
         ?>
                    <li>
                        <a href="<?php echo site_url('job-detail/'.$result->id); ?>">
                            <figure class="clearfix">
                                <div class="img-box">
                                    <img src="<?php echo base_url(get_uploaded_file($result->logo)); ?>" alt="<?php echo $result->title ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                                </div>

                                <figcaption>
                                    <h4 class="title"><?php echo highlight_phrase($result->title, $get_searchTitle, '<span style="color: red;">', '</span>').' <span class="close-date">'.$result->expire_date.'</span>' ?></h4>
                                    <p><?php echo character_limiter($result->description, 190); ?></p>
                                </figcaption>
                            </figure>
                        </a>
                    </li><!-- Item -->
                    <?php
                    endforeach;
                    break;
                case 5:
                    foreach ($get_result as $result):
         ?>
                    <li>
                        <a href="<?php echo site_url('view/'.$result->id); ?>">
                            <figure class="clearfix">
                                <div class="img-box">
                                    <img src="<?php echo base_url(get_uploaded_file($result->file)); ?>" alt="<?php echo $result->title ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                                </div>

                                <figcaption>
                                    <h4 class="title"><?php echo highlight_phrase($result->title, $get_searchTitle, '<span style="color: red;">', '</span>') ?></h4>
                                    <p><?php echo character_limiter($result->detail, 190); ?></p>
                                </figcaption>
                            </figure>
                        </a>
                    </li><!-- Item -->
                    <?php
                    endforeach;
                    break;
                default:
                    foreach ($get_result as $result):
         ?>
                    <li>
                        <a href="<?php echo site_url('view/'.$result->id); ?>">
                            <figure class="clearfix">
                                <div class="img-box">
                                    <img src="<?php echo base_url(get_uploaded_file($result->picture)); ?>" alt="<?php echo $result->title ?>" onerror="this.src='<?php echo get_image('no-image.png'); ?>'" />
                                </div>

                                <figcaption>
                                    <h4 class="title"><?php echo highlight_phrase($result->title, $get_searchTitle, '<span style="color: red;">', '</span>') ?></h4>
                                    <p><?php echo character_limiter($result->detail, 190); ?></p>
                                </figcaption>
                            </figure>
                        </a>
                    </li><!-- Item -->
                    <?php
                    endforeach;
                    break;
            }
         ?>
                </ul>
                <?php else: ?>
                <div class="alert alert-danger" role="alert"><?php echo lang('home_search_result_not_found'); ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="content-right">
            <ul class="ads">
                <li><a href="<?php echo site_url('contact-us'); ?>"><img src="<?php echo get_image('ads-detail-273x379.png'); ?>" /></a></li>
                <li><a href="<?php echo site_url('contact-us'); ?>"><img src="<?php echo get_image('ads-detail-273x379.png'); ?>" /></a></li>
                <li><a href="<?php echo site_url('contact-us'); ?>"><img src="<?php echo get_image('ads-detail-273x379.png'); ?>" /></a></li>
            </ul>
        </div>
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