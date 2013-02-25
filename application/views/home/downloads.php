<h1 class="page-title"><?php echo $page_title ?></h1>

<div class="news-section">
    <?php if ($page) { ?>
        <div class="page-brief">
            <?php echo $page['page_content'][get_locale()] ?>
        </div>
    <?php } ?>
    <?php if ($downloads) { ?>
        <?php foreach ($downloads as $download) { ?>
            <ul class="downloads">
                <li>
                    <span class="pdf-icon">
                        <img src="<?php echo base_url() ?>layout/images/pdficon.gif" >
                    </span>
                    <a target="_blank" href="<?php echo  base_url() . $download['path'] ?>" ><?php echo $download['name'][get_locale()] ?></a>
                </li>
            </ul>
        <?php } ?>
    <?php }else{ ?>
    <?php echo lang('home_no_data_available') ?>
    <?php } ?>
</div>