<div class="news-section">
    <?php if ($page) { ?>
        <div class="page-brief">
            <?php echo $page['page_content'][get_locale()] ?>
        </div>
    <?php }else{ ?>
    <?php echo lang('home_no_data_available') ?>
    <?php } ?>
</div>
