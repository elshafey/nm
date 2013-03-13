<ul>
    <li>
        <a href="<?php echo site_url('admin/'.$controller.'/create') ?>">
            <?php echo lang($controller.'_form_create_page_title') ?>
        </a>
        <a style="float: right" href="<?php echo site_url('admin/staticpage/edit/'.$controller) ?>">
            <?php echo lang($controller.'_main_page_txt') ?>
        </a>
    </li>
    <li>
        <table id="list2"></table>
        <div id="pager2"></div>
    </li>
</ul>
<?php build_grid(array('name_en-us', 'name_ar-eg'), $controller, json_encode($responce)) ?>
