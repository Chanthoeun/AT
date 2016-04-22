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
<div class="row">
    <div class="col-lg-6">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="col-lg-3 warning"><?php echo lang('view_video_cateogry_th');?></td>
                        <td><?php echo $video->catcaption;?></td>
                    </tr>
                    <tr>
                        <td class="col-lg-3 warning"><?php echo lang('view_video_published_at_th');?></td>
                        <td><?php echo $video->published_at;?></td>
                    </tr>
                    <tr>
                    <td class="col-lg-1 success"><strong><?php echo lang('index_video_action_th'); ?></strong></td>
                    <td class="col-lg-6">
                        <?php echo link_edit('videos/edit/'.$video->id). ' | '. link_delete('videos/destroy/'.$video->id); ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- /.table -->
        <h3 class="page-header"><?php echo lang('view_video_description_label'); ?></h3>
        <p class="text-justify"><?php echo $video->detail; ?></p>
        
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><?php echo lang('view_video_thum_label'); ?></h3>
                
                <?php echo img(array('src' => base_url(get_uploaded_file($video->picture)), 'class' => 'img-thumbnail img-responsive', 'onerror' => "this.src='".  get_image('no-image.png')."'")); ?>
            </div>
        </div>
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
        <?php if($message != FALSE){ ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong><?php echo $message;?></strong>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header" style="margin-top: 0;"><?php echo lang('view_video_thumbnail_update'); ?></h3>
                <?php echo form_open_multipart(current_url(), 'role="form" class="form-inline"', $video_id); ?>
                <div class="form-group">
                    <?php echo form_upload($thumbs);?>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-refresh fa-fw fa-lg"></i> <?php echo lang('view_thumbnail_upload_btn') ?></button>
                <?php echo form_close(); ?>
            </div>
        </div>
        <br/>
        
        <h3 class="page-header"><?php echo lang('view_video_label'); ?></h3>
        
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=1534352553487668";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script><!-- end facebook API -->
        
        <div class="embed-responsive-16by9">
            <?php echo get_video($video->file); ?>
        </div>
    </div>
</div>