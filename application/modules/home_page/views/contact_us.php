<div class="row">
        <section class="col-lg-12">
            <article role="article" class="contact" itemscope itemtype="http://schema.org/Organization">
                <h1><i class="fa fa-phone"></i> <?php echo lang('contact_us_menu_label'); ?></h1>
                <ul>
                    <li>
                        <ul>
                            <li>
                                <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                                    <span><i class="fa fa-home"></i> <?php echo lang('address_label'); ?></span>
                                    <strong itemprop="streetAddress"><?php echo lang('contact_address_label'); ?></strong> <strong itemprop="addressLocality"><?php echo lang('contact_city_label'); ?></strong> <strong itemprop="postalCode">12357</strong>
                                </p>
                                <p>
                                    <span><i class="fa fa-phone"></i> <?php echo lang('telephone_label'); ?></span>
                                    <strong itemprop="telephone"><?php echo lang('contact_telephone_label'); ?></strong>
                                </p>
                                <p>
                                    <span><i class="fa fa-envelope"></i> <?php echo lang('email_label'); ?></span>
                                    <strong itemprop="email"><?php echo lang('contact_email_label'); ?></strong>
                                </p>
                            </li>
                            <li>
                                <p>
                                    <span><?php echo lang('map_label'); ?></span>
                                     <?php 
                echo $map['js'];
                echo $map['html'];
            ?>
                                </p>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <p>
                            <?php echo lang('contact_text_label'); ?>
                        </p>
                        <?php echo form_open(current_url()) ?>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user fa-fw text-success"></i></div>
                                    <?php echo form_input($name); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone fa-fw text-success"></i></div>
                                    <?php echo form_input($telephone); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope fa-fw text-success"></i></div>
                                    <?php echo form_input($email); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo form_textarea($comment); ?>
                            </div>

                            <div class="form-group">
                                 <?php echo generate_captcha_image(ENVIRONMENT == 'development' ? 'http://localhost.agritoday.com//' : 'http://www.agritoday.com/'); ?>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-lock fa-fw text-success"></i></div>
                                    <?php echo form_input($captcha); ?>
                                </div>
                            </div>
                             <button type="submit" class="btn btn-success btn-block"><i class="fa fa-send fa-fw"></i> Send</button>
                             <?php echo form_close(); ?>
                    </li>
                </ul>
            </article>
        </section><!-- content -->                  
    </div>