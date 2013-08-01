<?php if ($books) { ?>
    <ul class="advanced-search-result">
        <?php $count = count($books) ?>
        <?php foreach ($books as $k => $book) { ?>
            <li>
                <a class="result-title" href="<?php echo get_routed_url(Urls::URL_PREFIX_BOOK . $book['id']) ?>">
                    <?php echo $book['title'][get_locale()] ?>
                </a>
                <div style="margin-top: 5px;">
                    <?php if ($book['img']) { ?>
                        <img class="news-img" width="73" src="<?php echo base_url() . page_thumb($book['img']) ?>" title="<?php echo $book['img_title'] ?>" alt="<?php echo $book['img_alt'] ?>" />
                    <?php } ?>
                    <p>
                        <?php echo sub_string_from_start($book['brief_description'][get_locale()], 100) ?>
                        <a class="read-more" href="<?php echo get_routed_url(Urls::URL_PREFIX_BOOK . $book['id']) ?>"><?php echo lang('global_more') ?></a>
                    </p>
                </div>   
                <?php if ($count > $k + 1) { ?>
                    <div class="h-line" style="margin-bottom: 0px;border-bottom: none"></div>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
<?php } else { ?>
    <?php echo lang('home_search_no_result') ?>
<?php } ?>
