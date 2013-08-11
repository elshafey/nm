<div class="news-section">
    <?php if ($page) { ?>
        <div class="page-brief">
            <?php echo $page['page_content'][get_locale()] ?>
        </div>
    <?php } ?>
    <?php if ($downloads) { ?>
        <?php $count = count($downloads) ?>
        <ul class="downloaded-items">
            <?php foreach ($downloads as $k => $download) { ?>

                <li>
                    <div>
                        <a href="<?php echo base_url() . $download['path'] ?>" class="download-pdf"></a>    
                    </div>
                    <div>
                        <a target="_blank" class="news-title" href="<?php echo base_url() . $download['path'] ?>" ><?php echo $download['name'][get_locale()] ?></a>
                        <br>
                        <span><?php echo $download['description'][get_locale()] ?></span>
                    </div>
                </li>
                <?php if ($count > $k + 1) { ?>
                <div class="h-line" style="margin-bottom: 10px"></div>
                <?php } ?>

            <?php } ?>
        </ul>
    <?php } ?>
</div>