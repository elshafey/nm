<?php if (isset($subcategories2) && $subcategories2) { ?>
    <?php echo lang('home_book_subcategory2', 'subcategory2') ?>
    <select name="subcategory2" id="subcategory2" >
        <option value=""><?php echo lang('global_all') ?></option>
        <?php foreach ($subcategories2 as $value) { ?>
            <option value="<?php echo $value['id'] ?>" <?php echo set_select('subcategory2', $value['id']) ?>><?php echo $value['name'][get_locale()] ?></option>
        <?php } ?>
    </select>
<?php } ?>
