<script type="text/javascript" src="<?php echo base_url() ?>ckfinder/ckfinder.js"></script>
<form method="POST">
    <ul>
        <?php $form->renderFields();  ?>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
            <a href="<?php echo site_url() . 'admin/aboutus' ?>" class="cancel_link" value=""><?php echo lang("global_btn_cancel"); ?></a>
        </li>
    </ul>
</form>