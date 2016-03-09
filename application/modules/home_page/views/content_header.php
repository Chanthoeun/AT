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
                   echo '<i class="icon-job"></i> '.$title;
                   break;
               case 'video':  
                   echo '<i class="icon-video"></i> '.$title;
                   break;
               case 'expert':  
                   echo '<i class="icon-expertise"></i> '.$title;
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
                        if($category->$category_type == TRUE)
                        {
                            if($category->parent_id == FALSE)
                            {
                                echo ' <div class="item"><h4 class="item-title">'.$category->caption.'</h4><ul>';
                                foreach ($categories as $item)
                                {
                                    if($item->parent_id != FALSE && $item->parent_id == $category->id)
                                    {
                                 ?>
                                                                 <li <?php echo $checkId != FALSE && $checkId == $item->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('news/'.$item->id); ?>"><?php echo $item->caption ?></a></li>
                                                              <?php
                                    }
                                }
                                echo '</ul></div>';
                            }
                        }
                    }
                   break;
                   
                case 'techniques':
                   foreach ($categories as $category)
                    {
                        if($category->$category_type == TRUE)
                        {
                            if($category->parent_id == FALSE)
                            {
                                echo ' <div class="item"><h4 class="item-title">'.$category->caption.'</h4><ul>';
                                foreach ($categories as $item)
                                {
                                    if($item->parent_id != FALSE && $item->parent_id == $category->id)
                                    {
                                 ?>
                                                                 <li <?php echo $checkId != FALSE && $checkId == $item->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('techniques/'.$item->id); ?>"><?php echo $item->caption ?></a></li>
                                                              <?php
                                    }
                                }
                                echo '</ul></div>';
                            }
                        }
                    }
                    break;
                    
                case 'publications':
                   foreach ($categories as $category)
                    {
                        if($category->$category_type == TRUE)
                        {
                            if($category->parent_id == FALSE)
                            {
                                echo ' <div class="item"><h4 class="item-title">'.$category->caption.'</h4><ul>';
                                foreach ($categories as $item)
                                {
                                    if($item->parent_id != FALSE && $item->parent_id == $category->id)
                                    {
                                 ?>
                                                                 <li <?php echo $checkId != FALSE && $checkId == $item->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('publications/'.$item->id); ?>"><?php echo $item->caption ?></a></li>
                                                              <?php
                                    }
                                }
                                echo '</ul></div>';
                            }
                        }
                    }
                   break;
                   
                case 'product-sale-rent':
                   foreach ($categories as $category)
                    {
                        if($category->$category_type == TRUE)
                        {
                            if($category->parent_id == FALSE)
                            {
                                echo ' <div class="item"><h4 class="item-title">'.$category->caption.'</h4><ul>';
                                foreach ($categories as $item)
                                {
                                    if($item->parent_id != FALSE && $item->parent_id == $category->id)
                                    {
                                 ?>
                                                                 <li <?php echo $checkId != FALSE && $checkId == $item->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('product-sale-rent/'.$item->id); ?>"><?php echo $item->caption ?></a></li>
                                                              <?php
                                    }
                                }
                                echo '</ul></div>';
                            }
                        }
                    }
                   break;
                   
                case 'land-sale-rent':
                   foreach ($categories as $category)
                    {
                        if($category->$category_type == TRUE)
                        {
                            if($category->parent_id == FALSE)
                            {
                                echo ' <ul class="ul-inline">';
                                foreach ($categories as $item)
                                {
                                    if($item->parent_id != FALSE && $item->parent_id == $category->id)
                                    {
                                 ?>
                                                                 <li <?php echo $checkId != FALSE && $checkId == $item->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('land-sale-rent/'.$item->id); ?>"><?php echo $item->caption ?></a></li>
                                                              <?php
                                    }
                                }
                                echo '</ul>';
                            }
                        }
                    }
                   break;
                   
                case 'job':
                   foreach ($categories as $category)
                    {
                        if($category->$category_type == TRUE)
                        {
                            if($category->parent_id == FALSE)
                            {
                                echo ' <div class="item"><h4 class="item-title">'.$category->caption.'</h4><ul>';
                                foreach ($categories as $item)
                                {
                                    if($item->parent_id != FALSE && $item->parent_id == $category->id)
                                    {
                                 ?>
                                                                 <li <?php echo $checkId != FALSE && $checkId == $item->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('job/'.$item->id); ?>"><?php echo $item->caption ?></a></li>
                                                              <?php
                                    }
                                }
                                echo '</ul></div>';
                            }
                        }
                    }
                   break;
                   
                case 'video':
                   foreach ($categories as $category)
                    {
                        if($category->$category_type == TRUE)
                        {
                            if($category->parent_id == FALSE)
                            {
                                echo ' <div class="item"><h4 class="item-title">'.$category->caption.'</h4><ul>';
                                foreach ($categories as $item)
                                {
                                    if($item->parent_id != FALSE && $item->parent_id == $category->id)
                                    {
                                 ?>
                                                                 <li <?php echo $checkId != FALSE && $checkId == $item->id ? 'class="active"' : ''; ?>><a href="<?php echo site_url('video/'.$item->id); ?>"><?php echo $item->caption ?></a></li>
                                                              <?php
                                    }
                                }
                                echo '</ul></div>';
                            }
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
                                echo ' <div class="item"><h4 class="item-title">'.$category->caption.'</h4><ul>';
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
           }
           
        ?>
                </div>
            </div>
        </div>
</section>
    
</section>

<section class="container">
    <div class="row">
        <div class="ads-horizontal">
            <a href="#">
                <img src="<?php echo get_image('ads1120x100.png') ?>" />
            </a>
        </div>
    </div>
</section>
