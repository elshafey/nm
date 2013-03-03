<div class="news-section">
    <?php if ($list) { ?>
    <?php $count=  count($list) ?>
        <?php foreach ($list as $k=>$item) { ?>
            <a class="news-title" href="<?php echo get_routed_url(Urls::URL_PREFIX_NEWS_DETAILS . $item['id']) ?>">
                <?php echo $item['page_title'][get_locale()] ?>
            </a>
            <p>
                <?php echo sub_string_from_start($item['page_content'][get_locale()], 200) ?>
                <a class="more" href="<?php echo get_routed_url(Urls::URL_PREFIX_NEWS_DETAILS . $item['id']) ?>">
                    <?php echo lang('global_more') ?>
                </a>
            </p>
            <?php if($count>$k+1){ ?>
            <div class="h-line"></div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
</div>
