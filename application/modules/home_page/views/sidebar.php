<div class="list-group hidden-xs">
    <h4 class="title-headding">
        <i class="fa fa-mail-forward"></i> 
        <?php echo lang('home_sidebar_crop'); ?>
    </h4>
    <?php 
        foreach($categories as $category){ 
            if($category->parent_id == 1)
            {
                if(isset($cat) && $cat != FALSE && $cat->id == $category->id)
                {
                    echo anchor(site_url('article/'.$category->id), '<i class="fa fa-leaf fa-fw"></i> '.$category->caption, array('class' => 'list-group-item active'));
                }
                else
                {
                    echo anchor(site_url('article/'.$category->id), '<i class="fa fa-leaf fa-fw"></i> '.$category->caption, array('class' => 'list-group-item'));
                }
            }
        }
    ?>
    
</div>

<div class="list-group hidden-xs">
    <h4 class="title-headding">
        <i class="fa fa-mail-forward"></i> 
        <?php echo lang('home_sidebar_animal'); ?>
    </h4>
    <?php 
        foreach($categories as $category){ 
            if($category->parent_id == 2)
            {
                if(isset($cat) && $cat != FALSE && $cat->id == $category->id)
                {
                    echo anchor(site_url('article/'.$category->id), '<i class="fa fa-leaf fa-fw"></i> '.$category->caption, array('class' => 'list-group-item active'));
                }
                else
                {
                    echo anchor(site_url('article/'.$category->id), '<i class="fa fa-leaf fa-fw"></i> '.$category->caption, array('class' => 'list-group-item'));
                }
                
            }
        }
    ?>
</div>

<section class="row visible-xs">
    <div class="col-xs-6">
        <div class="dropdown">
            <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                <i class="fa fa-mail-forward"></i> 
                <?php echo lang('home_sidebar_crop'); ?>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <?php 
                    foreach($categories as $category){ 
                        if($category->parent_id == 1)
                        {
                ?>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url('article/'.$category->id); ?>"><?php echo $category->caption; ?></a></li>
                <?php
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="dropdown">
            <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                <i class="fa fa-mail-forward"></i> 
                <?php echo lang('home_sidebar_animal'); ?>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <?php 
                    foreach($categories as $category){ 
                        if($category->parent_id == 2)
                        {
                ?>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url('article/'.$category->id); ?>"><?php echo $category->caption; ?></a></li>
                <?php
                            
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
    <br><br>
</section>

<div class="hidden-xs">
    <?php 
        if(isset($ads_left))
        {
            echo $ads_left;
        }
        else
        {
            echo anchor(
                    site_url('contact-us'),
                    img(array('src' => get_image('left-banner.png'), 'alt' => 'Left Advertising', 'class' => 'img-thumbnail img-responsive'))
                    ).'<br><br>';
        }
    ?>
</div>