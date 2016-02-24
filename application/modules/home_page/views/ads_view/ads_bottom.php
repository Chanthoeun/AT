<?php 
    if(isset($ads_data) && !empty($ads_data)){
        foreach ($ads_data as $bottom){
            if($bottom->lslug == 'bottom'){
                $image = get_uploaded_file($bottom->item, './assets/uploaded');
                echo anchor(
                    empty($bottom->website) ? base_url($image) : prep_url($bottom->website),
                    img(array('src' => base_url($image), 'class' => 'img-thumbnail', 'alt' => $bottom->company, 'width' => '850', 'height' => '100'))
                );
            }
        }
    }
?>