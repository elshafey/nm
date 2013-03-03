<?php load_grid_files() ?>
<?php if($this->uri->segment(3)=='edit'){ ?>
<ul>
    <li class="section_title"><?php echo lang($controller.'_manage_downloads') ?></li>
    <li>&nbsp;</li>
    <li>
        <a href="<?php echo site_url('admin/'.$controller.'/add_download/'.$id) ?>"><?php echo lang($controller.'_downloads_form_create_page_title') ?></a>
    </li>
    <li>
        <table id="list2"></table>
        <div id="pager2"></div>
    </li>
    <li>&nbsp;</li>
    <li class="section_title"><?php echo lang($controller.'_manage_page_content') ?></li>
</ul>
<?php build_grid(array('name_en-us', 'name_ar-eg'), 'downloads','','2','admin/'.$controller.'/downloads/'.$id,false) ?>
<?php } ?>
<form method="POST">
    <ul>
        <?php $form->renderFields();  ?>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
            <a href="<?php echo site_url() . 'admin/'.$controller ?>" class="cancel_link" value=""><?php echo lang("global_btn_cancel"); ?></a>
        </li>
    </ul>
</form>