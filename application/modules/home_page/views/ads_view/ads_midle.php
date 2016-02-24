<?php 
    if(isset($ads_data) && !empty($ads_data)){
        foreach ($ads_data as $midle){
            if($midle->lslug == 'midle'){
                $image = get_uploaded_file($midle->item, './assets/uploaded');
                echo anchor(
                    empty($midle->website) ? base_url($image) : prep_url($midle->website),
                    img(array('src' => base_url($image), 'class' => 'img-thumbnail img-responsive', 'alt' => $midle->company, 'width' => '850', 'height' => '100')),
                        'target="_blank"'
                );
            }
        }
    }
?>