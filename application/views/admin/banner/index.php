<ul>
    <li>
        <a href="<?php echo site_url('admin/banner/create') ?>"><?php echo lang('banner_form_create_page_title') ?></a>
    </li>
    <?php if ($responce) { ?>
        <li>
            <table class="images_grid">
                <thead>
                    <tr>
                        <td width="180"><?php echo lang('banner_grid_preview') ?></td>
                        <td width="180"><?php echo lang('banner_alt') ?></td>
                        <td width="180"><?php echo lang('banner_title') ?></td>
                        <td width="180"><?php echo lang('banner_page_order') ?></td>
                        <td width="180"><?php echo lang('banner_is_active') ?></td>
                        <td width="180">&nbsp;</td>
                        <td width="180">&nbsp;</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($responce as $banner) { ?>
                        <tr>
                            <td class="image_preview"><img src="<?php echo base_url().page_thumb($banner['path']); ?>"></td>
                            <td><?php echo $banner['alt'] ?></td>
                            <td><?php echo $banner['title'] ?></td>
                            <td class="image_order">
                                <?php echo $banner['page_order'] ?>
                            </td>
                            <td><?php echo $banner['is_active'] ?></td>
                            <td><?php echo $banner['edit'] ?></td>
                            <td><?php echo $banner['delete'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </li>
    <?php } ?>
</ul>