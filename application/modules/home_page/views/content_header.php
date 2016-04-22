<section class="content-header">
    <section class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="heading">
                    <?php 
            switch ($this->uri->segment(1))
            {
               case 'news':  
                   echo '<i class="icon-news"></i> '.$title;
                   break;
               case 'techniques':  
                   echo '<i class="icon-technique"></i> '.$title;
                   break;
               case 'publications':  
                   echo '<i class="icon-publication"></i> '.$title;
                   break;
               case 'product-sale-rent':  
                   echo '<i class="icon-market"></i> '.$title;
                   break;
               case 'land-sale-rent':  
                   echo '<i class="icon-sale"></i> '.$title;
                   break;
               case 'job': 
               case 'filter-location':
               case 'job-detail':
                   echo '<i class="icon-job"></i> '.$title;
                   break;
               case 'video':  
                   echo '<i class="icon-video"></i> '.$title;
                   break;
               case 'expert':  
                   echo '<i class="icon-expertise"></i> '.$title;
                   break;
               case 'health':  
                   echo '<i class="fa fa-medkit"></i> '.$title;
                   break;
            }
         ?>
                    <span id="group"><i class="fa fa-align-justify"></i><span class="hidden-xs"> ជ្រើស​រើស​ក្រុម</span></span>
                </h3>
                <div class="content-body">
                 <?php 
           switch ($this->uri->segment(1))
           {
               case 'news':
                   foreach ($categories as $category)
                    {
                        if($category->parent_id == FALSE)
                        {
                            echo ' <div class="item"><a href="'.site_url('news/'.$category->id).'"><h4 class="item-title">'.$category->caption.' (<span>'.$category->article_count.'</span>)</h4></a><ul>';
                            foreach ($categories as $item)
                            {
                                if($item->parent_id != FALSE && $item->parent_id == $category->id)
                                {
                             ?>
                                                             <li <?php echo $checkId != FALSE && $checkId == $item->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('news/'.$item->id); ?>"><?php echo $item->caption.' (<span>'.$item->article_count.'</span>)'; ?></a></li>
                                                          <?php
                                }
                            }
                            echo '</ul></div>';
                        }
                    }
                   break;
                   
                case 'techniques':
                   foreach ($categories as $category)
                    {
                        if($category->parent_id == FALSE)
                        {
                            echo ' <div class="item"><a href="'.site_url('techniques/'.$category->id).'"><h4 class="item-title">'.$category->caption.' (<span>'.$category->article_count.'</span>)</h4></a><ul>';
                            foreach ($categories as $item)
                            {
                                if($item->parent_id != FALSE && $item->parent_id == $category->id)
                                {
                             ?>
                                                             <li <?php echo $checkId != FALSE && $checkId == $item->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('techniques/'.$item->id); ?>"><?php echo $item->caption.' (<span>'.$item->article_count.'</span>)'; ?></a></li>
                                                          <?php
                                }
                            }
                            echo '</ul></div>';
                        }
                    }
                    break;
                    
                case 'publications':
                   foreach ($categories as $category)
                    {
                        if($category->parent_id == FALSE)
                        {
                            echo ' <div class="item"><a href="'.site_url('publications/'.$category->id).'"><h4 class="item-title">'.$category->caption.' (<span>'.$category->article_count.'</span>)</h4></a><ul>';
                            foreach ($categories as $item)
                            {
                                if($item->parent_id != FALSE && $item->parent_id == $category->id)
                                {
                             ?>
                                                             <li <?php echo $checkId != FALSE && $checkId == $item->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('publications/'.$item->id); ?>"><?php echo $item->caption.' (<span>'.$item->article_count.'</span>)'; ?></a></li>
                                                          <?php
                                }
                            }
                            echo '</ul></div>';
                        }
                    }
                   break;
                   
                case 'product-sale-rent':
                   foreach ($categories as $category)
                    {
                        if($category->parent_id == FALSE)
                        {
                            echo ' <div class="item"><a href="'.site_url('product-sale-rent/'.$category->id).'"><h4 class="item-title">'.$category->caption.' (<span>'.$category->product_count.'</span>)</h4></a><ul>';
                            foreach ($categories as $item)
                            {
                                if($item->parent_id != FALSE && $item->parent_id == $category->id)
                                {
                             ?>
                                                             <li <?php echo $checkId != FALSE && $checkId == $item->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('product-sale-rent/'.$item->id); ?>"><?php echo $item->caption.' (<span>'.$item->product_count.'</span>)'; ?></a></li>
                                                          <?php
                                }
                            }
                            echo '</ul></div>';
                        }
                    }
                   break;
                   
                case 'land-sale-rent':
                    echo ' <ul class="ul-inline">';
                    foreach ($categories as $item)
                    {
                        ?>
                                                     <li <?php echo $checkId != FALSE && $checkId == $item->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('land-sale-rent/'.$item->id); ?>"><?php echo $item->caption.' (<span>'.$item->land_count.'</span>)'; ?></a></li>
                                                    <?php
                    }
                    echo '</ul>';
                   break;
                   
               case 'job':
               case 'filter-location':
               case 'job-detail':
                   $jobCount = 0;
                   foreach ($categories as $category)
                    {
                       if($jobCount == 0)
                        {
                            echo ' <div class="item"><ul>';
                        }
                        ?>
                                                     <li <?php echo $checkId != FALSE && $checkId == $category->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('job/'.$category->id); ?>"><?php echo $category->caption.' (<span>'.$category->job_count.'</span>)'; ?></a></li>
                                                     <?php
                        $jobCount += 1;
                        if($jobCount == 20)
                        {
                            echo '</ul></div>';
                            $jobCount = 0;
                        }
                    }
                   break;
                        
                case 'video':
                   foreach ($categories as $category)
                    {
                        if($category->parent_id == FALSE)
                        {
                            echo ' <div class="item"><a href="'.site_url('video/'.$category->id).'"><h4 class="item-title">'.$category->caption.' (<span>'.$category->video_count.'</span>)</h4></a><ul>';
                            foreach ($categories as $item)
                            {
                                if($item->parent_id != FALSE && $item->parent_id == $category->id)
                                {
                             ?>
                                                             <li <?php echo $checkId != FALSE && $checkId == $item->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('video/'.$item->id); ?>"><?php echo $item->caption.' (<span>'.$item->video_count.'</span>)'; ?></a></li>
                                                          <?php
                                }
                            }
                            echo '</ul></div>';
                        }
                    }
                   break;
                   
                case 'expert':
                   foreach ($categories as $category)
                    {
                        if($category->$category_type == TRUE)
                        {
                            if($category->parent_id == FALSE)
                            {
                                echo ' <div class="item"><a href="'.site_url('expert/'.$category->id).'"><h4 class="item-title">'.$category->caption.'</h4></a><ul>';
                                foreach ($categories as $item)
                                {
                                    if($item->parent_id != FALSE && $item->parent_id == $category->id)
                                    {
                                 ?>
                                                                 <li <?php echo $checkId != FALSE && $checkId == $item->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('expert/'.$item->id); ?>"><?php echo $item->caption ?></a></li>
                                                              <?php
                                    }
                                }
                                echo '</ul></div>';
                            }
                        }
                    }
                   break;
               case 'health':
                   foreach ($categories as $category)
                    {
                        if($category->parent_id == FALSE)
                        {
                            echo ' <div class="item"><a href="'.site_url('health/'.$category->id).'"><h4 class="item-title">'.$category->caption.' (<span>'.$category->article_count.'</span>)</h4></a><ul>';
                            foreach ($categories as $item)
                            {
                                if($item->parent_id != FALSE && $item->parent_id == $category->id)
                                {
                             ?>
                                                             <li <?php echo $checkId != FALSE && $checkId == $item->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('health/'.$item->id); ?>"><?php echo $item->caption.' (<span>'.$item->article_count.'</span>)'; ?></a></li>
                                                          <?php
                                }
                            }
                            echo '</ul></div>';
                        }
                    }
                   break;
           }
           
        ?>
                </div>
            </div>
        </div>
</section>
    
</section>

<?php if($advertises != FALSE): ?>
<section class="container">
    <div class="row">
        <div class="col-lg-12">
                <?php $ad_header = search_array($advertises, 'layout', 'ក្បាល​ទំព័រ 1140 x 100'); ?>
                <div class="ads-horizontal">
                        <?php if($ad_header == FALSE): ?>
                        <a href="<?php echo site_url('contact-us'); ?>">
                            <img src="<?php echo get_image('ads-top-1140x100.png') ?>" />
                        </a>
                        <?php else: ?>
                        <a href="<?php echo $ad_header['link']; ?>" target="_blank" <?php echo $ad_header['class']; ?>>
                            <img src="<?php echo base_url(get_uploaded_file($ad_header['banner'])); ?>" />
                        </a>
                        <?php endif; ?>
                </div>
        </div>
    </div>
</section>
<?php endif; ?>
