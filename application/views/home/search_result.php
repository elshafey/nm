<?php if ($books) { ?>
    <ul class="advanced-search-result">
        <?php $count = count($books) ?>
        <?php foreach ($books as $k => $book) { ?>
            <li>
        <!--                <a class="result-title" href="<?php echo get_routed_url(Urls::URL_PREFIX_BOOK . $book['id']) ?>">
                <?php echo $book['title'][get_locale()] ?>
                </a>-->
                <div style="">
                    <?php if ($book['img']) { ?>
                        <div class="news-thumbnail">
                            <img  style="height: auto" src="<?php echo base_url() . page_thumb($book['img']) ?>" title="<?php echo $book['img_title'] ?>" alt="<?php echo $book['img_alt'] ?>" />
                        </div>
                        <!--<img class="news-img" width="73" src="<?php echo base_url() . page_thumb($book['img']) ?>" title="<?php echo $book['img_title'] ?>" alt="<?php echo $book['img_alt'] ?>" />-->
                    <?php } ?>
                    <a class="news-title"href="<?php echo get_routed_url(Urls::URL_PREFIX_BOOK . $book['id']) ?>"><?php echo $book['title'][get_locale()] ?></a>
                    <div class="book-code" style="color: #272727;margin-top: 8px;">ISBN: <?php echo $book['isbn'] ?></div>
                    <div class="book-code" style="color: #272727"><?php echo lang('home_book_author') ?>: <?php echo $book['author'][get_locale()] ?></div>
                </div>   
                <div class="h-line" style="margin-bottom: 0px;border-bottom: none"></div>
            </li>
        <?php } ?>
    </ul>
    <div id="pagination">
        <?php if (isset($pagination) && $pagination) { ?>
            <?php echo $pagination ?>
        <?php } ?>
    </div>
    <script>
        var q='?<?php echo convert_post_to_get() ?>';
        $('#pagination a').each(function(e){
            $(this).attr('href',$(this).attr('href')+q);
        });
    </script>

<?php } else { ?>
    <?php echo lang('home_search_no_result') ?>
<?php } ?>
