<script type="text/javascript" src="<?php echo base_url() ?>ckfinder/ckfinder.js"></script>
<form method="POST">
    <ul>
        <?php $form->renderFields(); ?>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
            <a href="<?php echo site_url() . 'admin/'.$cancel ?>" class="cancel_link" value=""><?php echo lang("global_btn_cancel"); ?></a>
        </li>
    </ul>
</form>

<?php if($type=='aboutus'||$type=='achievements'||$type=='affiliated_companies'){ ?>
<script>
    $('#li_routed').hide();
    $('#li_meta_title').hide();
    $('#li_meta_keywords').hide();
    $('#li_meta_description').hide();
</script>
<?php } ?>
