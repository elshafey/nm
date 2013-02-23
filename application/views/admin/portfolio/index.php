<ul>
    <li>
        <a href="<?php echo site_url('admin/portfolio/create') ?>"><?php echo lang('portfolios_form_create_page_title') ?></a>
        <a style="float: right" href="<?php echo site_url('admin/portfolio-main') ?>">
            <?php echo lang('portfolios_main_page_txt') ?>
        </a>
    </li>
    <li>
        <table id="list2"></table>
        <div id="pager2"></div>
    </li>
</ul>
<?php build_grid(array('page_title_en-us', 'page_title_ar-eg'), 'portfolios', json_encode($responce)) ?>
