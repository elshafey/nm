<form method="POST">
    <ul>
        <?php $form->renderFields(array('page_title','page_content','page_url','page_order','is_active'));  ?>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
            <a href="<?php echo site_url() . 'admin/'.$controller ?>" class="cancel_link" value=""><?php echo lang("global_btn_cancel"); ?></a>
        </li>
    </ul>
</form>