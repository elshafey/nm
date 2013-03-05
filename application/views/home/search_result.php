<?php if ($books) { ?>
    <ul class="advanced-search-result">
        <?php foreach ($books as $book) { ?>
            <li>
                <a class="result-title" href="<?php echo get_routed_url(Urls::URL_PREFIX_BOOK . $book['id']) ?>">
                    <?php echo $book['title'][get_locale()] ?>
                </a>
                <div class="result-desc">
                    <?php echo sub_string_from_start($book['brief_description'][get_locale()], 100) ?>
                    <a class="read-more" href="<?php echo get_routed_url(Urls::URL_PREFIX_BOOK . $book['id']) ?>"><?php echo lang('global_more') ?></a>
                </div>
            </li>
        <?php } ?>
    </ul>
<?php }else{ ?>
<?php echo lang('home_search_no_result') ?>
<?php } ?>
