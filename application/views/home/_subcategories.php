<?php if(isset($subcategories) &&$subcategories){ ?>
<?php echo lang('home_book_subcategory','subcategory') ?>
            <select name="subcategory" id="subcategory" >
                <option value=""><?php echo lang('global_all') ?></option>
                <?php foreach ($subcategories as $value) { ?>
                <option value="<?php echo $value['id'] ?>" <?php echo set_select('subcategory', $value['id']) ?>><?php echo $value['name'][get_locale()] ?></option>
                <?php } ?>
            </select>
<?php }else{ ?>
<script>
    $('#subcategory_area').hide();
</script>
<?php } ?>

