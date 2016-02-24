<?php 
    if(isset($ads_data) && !empty($ads_data)){
        foreach($ads_data as $ads){
            if($ads->lslug == 'header'){
                $image = get_uploaded_file($ads->item, './assets/uploaded');
                echo anchor(empty($ads->website) ? base_url($image) : prep_url($ads->website), image_thumb($image, 100, 850, array('alt' => $ads->company, 'class' => 'img-responsive')), 'title="'.$ads->company.'"');
            }
        }
    }
?>