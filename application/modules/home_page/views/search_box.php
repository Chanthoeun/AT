<?php echo form_open('search', 'role="form" class="form-search"'); ?>
    <p>
        <input type="text" name="search_title" id="search" placeholder="<?php echo lang('search_placeholder_label'); ?>" value="" />
        <button type="submit">
            <i class="fa fa-search fa-fw fa-lg"></i>
        </button>
    </p>
<?php echo form_close(); ?>