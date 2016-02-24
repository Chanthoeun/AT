<?php if(isset($ads_data) && !empty($ads_data)){ ?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
        <?php $i = 1; $j = 0; ?>
    <ol class="carousel-indicators">
        <?php 
            foreach($ads_data as $slide){
                if($slide->lslug == 'slide'){
        ?>
        <li data-target="#myCarousel" data-slide-to="<?php echo $j; ?>" <?php echo $j == 0 ? 'class="active"' : ''; ?>></li>
        <?php        
                $j += 1;
                }
            }
        ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php 
            foreach($ads_data as $slide){
                if($slide->lslug == 'slide'){
                    $image = get_uploaded_file($slide->item, './assets/uploaded');
                    if($i == 1){
                        echo '<div class="item active">'.
                                anchor(empty($slide->website) ? base_url($image) : prep_url($slide->website),
                                       img(array('src' => base_url($image), 'alt' => $slide->company)),
                                       'target="_blank" class="ads-slide"'
                                        ). 
                             '</div>';
                    } else {
                        echo '<div class="item">'.
                                anchor(empty($slide->website) ? base_url($image) : prep_url($slide->website),
                                       img(array('src' => base_url($image), 'alt' => $slide->company)),
                                       'target="_blank" class="ads-slide"'
                                        ). 
                             '</div>';
                    }
                    $i += 1;
                }
            }
        ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div><!-- end Slideshow -->
<?php } ?>