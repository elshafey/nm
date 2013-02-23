<ul>
    <li class="section_title"><?php echo lang('books_section_title') ?></li>
    <li>
        <a href="<?php echo site_url('admin/book/create') ?>"><?php echo lang('book_form_create_page_title') ?></a>
    </li>
    <li>
        <table id="list1"></table>
        <div id="pager1"></div>
    </li>
    <li>&nbsp;</li>
    <li>&nbsp;</li>
    <li class="section_title"><?php echo lang('subcategories_section_title') ?></li>
    <li>
        <a href="<?php echo site_url('admin/subcategory/create') ?>"><?php echo lang('subcategory_form_create_page_title') ?></a>
    </li>
    <li>
        <table id="list2"></table>
        <div id="pager2"></div>
    </li>
    <li>&nbsp;</li>
    <li>&nbsp;</li>
    <li class="section_title"><?php echo lang('categories_section_title') ?></li>
    <li>
        <a href="<?php echo site_url('admin/category/create') ?>"><?php echo lang('category_form_create_page_title') ?></a>
    </li>
    <li>
        <table id="list3"></table>
        <div id="pager3"></div>
    </li>
    <li>&nbsp;</li>
    <li>&nbsp;</li>
</ul>

<?php build_grid(array('title_en-us', 'title_ar-eg','subcategory_name','category_name'), 'books', '','1','admin/book/books_list/',false) ?>
<?php build_grid(array('name_en-us', 'name_ar-eg','category_name'), 'subcategories', '','2','admin/book/subcategories_list/',false) ?>
<?php build_grid(array('name_en-us', 'name_ar-eg'), 'categories', '','3','admin/book/categories_list/',false) ?>