<?php 
    if(isset($ads_data) && !empty($ads_data)){
        foreach ($ads_data as $left){
            if($left->lslug == 'left'){
                $image = get_uploaded_file($left->item, './assets/uploaded');
                echo anchor(
                    empty($left->website) ? base_url($image) : prep_url($left->website),
                    img(array('src' => base_url($image), 'class' => 'img-thumbnail img-responsive', 'alt' => $left->company, 'width' => '260', 'height' => '200'))
                ).'<br><br>';
            }
        }
    }
?>