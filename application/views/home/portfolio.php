<div class="news-section">
    <div class="page-brief">
        <?php echo $page['page_content'][get_locale()] ?>
    </div>
    <?php if ($portfolios) { ?>
        <ul class="portfolio-list">
            <?php foreach ($portfolios as $item) { ?>

                <li> 
                    <a class="news-title" href="<?php echo get_routed_url(Urls::URL_PREFIX_PORTFOLIO_DETAILS . $item['id']) ?>">
                        <?php echo $item['page_title'][get_locale()] ?>
                    </a>
                    <div style="margin-top: 5px;">
                        <div class="news-thumbnail">
                            <img src="<?php echo base_url() . page_thumb($item['img']) ?>" />
                        </div>
                        <p>
                            <?php echo sub_string_from_start($item['page_content'][get_locale()], 275) ?>
                            <a class="more" href="<?php echo get_routed_url(Urls::URL_PREFIX_PORTFOLIO_DETAILS . $item['id']) ?>">
                                <?php echo lang('global_more') ?>
                            </a>
                        </p>
                    </div>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>
<?php if (isset($pagination)) { ?>
    <div id="pagination">
        <?php echo $pagination ?>
    </div>
<?php } ?>