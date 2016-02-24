<?php 
    if(isset($ads_data) && !empty($ads_data)){
        foreach ($ads_data as $data){
            if($data->lslug == 'none'){
                $image = get_uploaded_file($data->item, './assets/uploaded');
                echo anchor(
                            empty($data->website) ? base_url($image) : prep_url($data->website), 
                            image_thumb($image, 178, 120, array('alt' => $data->company)),
                            'class="box" target="_blank"'
                            );
            }
        }
    }
?>