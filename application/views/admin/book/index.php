<ul>
    <li class="section_title"><?php echo lang('books_section_title') ?></li>
    <form method="GET" action="">
        <ul>
            <li>
                <?php echo lang('home_book_title', 'title') ?>
                <input type="text" class="txtbox" name="title" value="<?php echo set_value('title') ?>"
            </li>
            <li>
                <?php echo lang('home_book_author', 'author') ?>
                <input type="text" class="txtbox" name="author" value="<?php echo set_value('author') ?>"
            </li>
            <li>
                <?php echo lang('home_book_isbn', 'isbn') ?>
                <input type="text" class="txtbox" name="isbn" value="<?php echo set_value('isbn') ?>"
            </li>
            <li>
                <?php echo lang('home_book_category', 'category') ?>
                <select name="category" id="category" >
                    <option value=""><?php echo lang('global_all') ?></option>
                    <?php foreach ($categories as $value) { ?>
                        <option value="<?php echo $value['id'] ?>" <?php echo set_select('category', $value['id']) ?>><?php echo $value['name'][get_locale()] ?></option>
                    <?php } ?>
                </select>
            </li>
            <li id="subcategory_area">
                <?php $this->load->view('home/_subcategories') ?>
            </li>
            <li id="subcategory2_area">
                <?php $this->load->view('home/_subcategories2') ?>
            </li>
            <li class="btns">
                <input type="submit" value="<?php echo lang('home_btn_search') ?>" />
            </li>
        </ul>
    </form>
    <script>
        $('#category').change(function() {
            if ($(this).val() === '') {
                $('#subcategory_area').slideUp();
                $('#subcategory_area').html('');
            } else {
                $.post('<?php echo site_url() . 'home/get_subcategories' ?>/' + $(this).val(), function(data) {
                    $('#subcategory_area').slideDown();
                    $('#subcategory_area').html(data);
                });
            }
        });
        $('#subcategory').live('change', function() {
            if ($(this).val() === '') {
                $('#subcategory2_area').slideUp();
                $('#subcategory2_area').html('');
            } else {
                $.post('<?php echo site_url() . 'home/get_subcategories2' ?>/' + $(this).val(), function(data) {
                    $('#subcategory2_area').slideDown();
                    $('#subcategory2_area').html(data);
                });
            }
        });
    </script>
    <li>
        <a href="<?php echo site_url('admin/book/create') ?>"><?php echo lang('book_form_create_page_title') ?></a>
    </li>
    <li>
        <table id="list1"></table>
        <div id="pager1"></div>
    </li>
    <li class="excell-icon">
        <a href="<?php echo base_url().'admin/book/export?'.  convert_post_to_get($_GET) ?>">
            <img src="<?php echo base_url() . 'layout/images/Excel-icon.png' ?>" />
        </a>
    </li>
    <li class="section_title"><?php echo lang('books_import') ?></li>
    <form method="POST" action="<?php echo base_url().'admin/book/import'?>" enctype="multipart/form-data">
        <ul>
            <li>
                <?php echo lang('books_import_select',' ') ?>
                <input type="file" class="txtbox" name="file" />
            </li>
            <li class="btns">
                <input type="submit" value="<?php echo lang('books_import_upload') ?>"/>
            </li>
        </ul>
    </form>
    <li>&nbsp;</li>
    <li>&nbsp;</li>
    <li class="section_title"><?php echo lang('subcategories2_section_title') ?></li>
    <li>
        <a href="<?php echo site_url('admin/subcategory2/create') ?>"><?php echo lang('subcategory2_form_create_page_title') ?></a>
    </li>
    <li>
        <table id="list4"></table>
        <div id="pager4"></div>
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
<?php build_grid(array('title_en-us', 'title_ar-eg', 'subcategory2_name', 'subcategory_name', 'category_name', 'is_latest_release', 'is_most_popular'), 'books', '', '1', 'admin/book/books_list/') ?>
<?php build_grid(array('name_en-us', 'name_ar-eg',), 'subcategories2', '', '4', 'admin/book/subcategories2_list/') ?>
<?php build_grid(array('name_en-us', 'name_ar-eg',), 'subcategories', '', '2', 'admin/book/subcategories_list/') ?>
<?php build_grid(array('name_en-us', 'name_ar-eg'), 'categories', '', '3', 'admin/book/categories_list/') ?>