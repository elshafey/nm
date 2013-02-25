<script type="text/javascript" src="<?php echo base_url() ?>ckfinder/ckfinder.js"></script>
<form method="POST">
    <ul>
        <?php $form->renderFields(); ?>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
            <a href="<?php echo site_url() . 'admin/book' ?>" class="cancel_link" value=""><?php echo lang("global_btn_cancel"); ?></a>
        </li>
    </ul>
</form>
<?php if($type=='home'){ ?>
<script>
    $('#li_routed').hide();
</script>
<?php }elseif($type=='portfolio'){ ?>
<script>
    $('#type').val('portfolio');
    $('#video_path').val('portfolio');
    $('#video_image').val('portfolio');
    $('#li_video_path').hide();
    $('#li_video_image').hide();
</script>
<?php }elseif($type=='career'){ ?>
<script>
    $('#type').val('career');
    $('#video_path').val('career');
    $('#video_image').val('career');
    $('#li_video_path').hide();
    $('#li_video_image').hide();
</script>
<?php }elseif($type=='downloads'){ ?>
<script>
    $('#type').val('downloads');
    $('#video_path').val('downloads');
    $('#video_image').val('downloads');
    $('#li_video_path').hide();
    $('#li_video_image').hide();
</script>
<?php } ?>
