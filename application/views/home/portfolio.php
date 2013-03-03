<div class="news-section">
    <div class="page-brief">
        <?php echo $page['page_content'][get_locale()] ?>
    </div>
    <?php if ($portfolios) { ?>
        <ul class="portfolio-list">
        <?php foreach ($portfolios as $item) { ?>
        
            <li> 
                <a class="photo" style="background-repeat: no-repeat;background-image: url('<?php echo base_url() . page_thumb($item['img']) ?>')" href="<?php echo get_routed_url(Urls::URL_PREFIX_PORTFOLIO_DETAILS . $item['id']) ?>">
                </a>
                <div class="portfolio-item">
                    <?php echo sub_string_from_start($item['page_content'][get_locale()], 80) ?>
                    <a class="read-more"href="<?php echo get_routed_url(Urls::URL_PREFIX_PORTFOLIO_DETAILS . $item['id']) ?>">
                        <?php echo lang('global_more') ?>
                    </a>
                </div>
            </li>
        <?php } ?>
        </ul>
    <?php } ?>
</div>