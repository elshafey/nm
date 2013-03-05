<form method="POST">
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
        <li class="btns">
            <input type="submit" value="<?php echo lang('home_btn_search') ?>" />
        </li>
    </ul>
</form>
<script>
    $('#category').change(function(){
        if($(this).val()==''){
            $('#subcategory_area').slideUp();
            $('#subcategory_area').html('');
        }else{
            $.post('<?php echo site_url() . 'home/get_subcategories' ?>/'+$(this).val(),function(data){
                $('#subcategory_area').slideDown();
                $('#subcategory_area').html(data);
            });
        }
    })
</script>
<?php if(isset($books)){ ?>
<?php $this->load->view('home/search_result') ?>
<?php } ?>
