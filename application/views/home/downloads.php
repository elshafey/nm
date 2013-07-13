<div class="news-section">
    <?php if ($page) { ?>
        <div class="page-brief">
            <?php echo $page['page_content'][get_locale()] ?>
        </div>
    <?php } ?>
    <?php if ($downloads) { ?>
        <?php foreach ($downloads as $download) { ?>
            <ul class="downloaded-items">
                <li>
                    <a href="<?php echo  base_url() . $download['path'] ?>" class="download-pdf"></a>
                    <a target="_blank" class="download-item" href="<?php echo  base_url() . $download['path'] ?>" ><?php echo $download['name'][get_locale()] ?></a>
                    <br>
                    <span><?php echo $download['description'][get_locale()] ?></span>
                </li>
            </ul>
        <?php } ?>
    <?php } ?>
</div>