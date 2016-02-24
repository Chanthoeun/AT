<?php 
    if(isset($ads_data) && !empty($ads_data)){
        foreach ($ads_data as $right){
            if($right->lslug == 'right'){
                $image = get_uploaded_file($right->item, './assets/uploaded');
                echo anchor(
                    empty($right->website) ? base_url($image) : prep_url($right->website),
                    img(array('src' => base_url($image), 'class' => 'img-thumbnail img-responsive', 'alt' => $right->company, 'width' => '200', 'height' => '200')),
                        'class="ads-right" target="_blank"'
                );
            }
        }
    }
?>