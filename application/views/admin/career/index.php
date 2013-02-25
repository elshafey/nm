<ul>
    <li>
        <a href="<?php echo site_url('admin/career/create') ?>"><?php echo lang('careers_form_create_page_title') ?></a>
        <a style="float: right" href="<?php echo site_url('admin/careers-main') ?>">
            <?php echo lang('careers_main_page_txt') ?>
        </a>
    </li>
    <li>
        <table id="list2"></table>
        <div id="pager2"></div>
    </li>
</ul>
<?php build_grid(array('job_code','job_title_en-us', 'job_title_ar-eg'), 'careers', json_encode($responce)) ?>
