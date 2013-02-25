<ul>
    <li>
        <a href="<?php echo site_url('admin/download/create') ?>"><?php echo lang('downloads_form_create_page_title') ?></a>
        <a style="float: right" href="<?php echo site_url('admin/downloads-main') ?>">
            <?php echo lang('downloads_main_page_txt') ?>
        </a>
    </li>
    <li>
        <table id="list2"></table>
        <div id="pager2"></div>
    </li>
</ul>
<?php build_grid(array('name_en-us', 'name_ar-eg'), 'downloads', json_encode($responce)) ?>
