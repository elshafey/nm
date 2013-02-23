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
<script>
    if($('#category').val()==''){
        $('#li_parent_id').hide();
    }
    $('#category').change(function(){
        if($('#category').val()==''){
            $('#li_parent_id').slideUp();
        }else{
            if($('#li_parent_id').not(':visible')){
                $('#li_parent_id').slideDown();
            }
            $.get('<?php echo site_url('admin/book/get_subcategories/') ?>/'+$(this).val(),function(data){
                $('#li_parent_id').html($(data).html());
            });
            
        }
    })
</script>