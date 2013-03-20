<div class="news-section">
    <?php if ($list) { ?>
        <?php $count = count($list) ?>
        <?php foreach ($list as $k => $item) { ?>
            <a class="news-title" href="<?php echo get_routed_url($url_prefix . $item['id']) ?>">
                <?php echo $item['page_title'][get_locale()] ?>
            </a>
            <div style="margin-top: 5px;">
                <?php if ($item['img']) { ?>
                    <img class="news-img" width="73" src="<?php echo base_url() . page_thumb($item['img']) ?>" title="<?php echo $item['img_title'] ?>" alt="<?php echo $item['img_alt'] ?>" />
                <?php } ?>
                <p>
                    <?php echo sub_string_from_start($item['page_content'][get_locale()], 275) ?>
                    <a class="more" href="<?php echo get_routed_url($url_prefix . $item['id']) ?>">
                        <?php echo lang('global_more') ?>
                    </a>
                </p>
            </div>   
            <?php if ($count > $k + 1) { ?>
                <div class="h-line"></div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
</div>
