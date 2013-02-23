<h1 class="page-title"><?php echo $page_title ?></h1>

<div class="news-section">
    <div class="page-brief">
        <?php echo $page['page_content'][get_locale()] ?>
    </div>
    <?php if ($portfolios) { ?>
        <?php foreach ($portfolios as $item) { ?>
            <div class="img-box">
                <a href="<?php echo get_routed_url(Urls::URL_PREFIX_PORTFOLIO_DETAILS . $item['id']) ?>" >
                    <img width="90" src="<?php echo base_url() . page_thumb($item['img']) ?>" alt="<?php echo $item['img_alt'] ?>" title="<?php echo $item['img_title'] ?>" />
                </a>
            </div>
            <div class="txt-box">
                <p>
                    <?php echo sub_string_from_start($item['page_content'][get_locale()], 100) ?>
                    <a class="more" href="<?php echo get_routed_url(Urls::URL_PREFIX_PORTFOLIO_DETAILS . $item['id']) ?>">
                        <?php echo lang('global_more') ?>
                    </a>
                </p>
            </div>
            <div class="news-separator"></div>
        <?php } ?>
    <?php } ?>
</div>