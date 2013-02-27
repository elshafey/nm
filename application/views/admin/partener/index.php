<ul>
    <li>
        <a href="<?php echo site_url('admin/partener/create') ?>"><?php echo lang('parteners_form_create_page_title') ?></a>
    </li>
    <?php if ($responce) { ?>
        <li>
            <table class="images_grid">
                <thead>
                    <tr>
                        <td width="180"><?php echo lang('parteners_grid_preview') ?></td>
                        <td width="180"><?php echo lang('parteners_name_en-us') ?></td>
                        <td width="180"><?php echo lang('parteners_name_ar-eg') ?></td>
                        <td width="180"><?php echo lang('parteners_type') ?></td>
                        <td width="180"><?php echo lang('parteners_page_order') ?></td>
                        <td width="180"><?php echo lang('parteners_is_active') ?></td>
                        <td width="180">&nbsp;</td>
                        <td width="180">&nbsp;</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($responce as $partener) { ?>
                        <tr>
                            <td class="image_preview"><img src="<?php echo base_url().page_thumb($partener['path']); ?>"></td>
                            <td><?php echo $partener['name_en-us'] ?></td>
                            <td><?php echo $partener['name_ar-eg'] ?></td>
                            <td><?php echo $partener['type']==1? lang('parteners_content'):lang('parteners_business') ?></td>
                            <td class="image_order">
                                <?php echo $partener['page_order'] ?>
                            </td>
                            <td><?php echo $partener['is_active'] ?></td>
                            <td><?php echo $partener['edit'] ?></td>
                            <td><?php echo $partener['delete'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </li>
    <?php } ?>
</ul>