<?php if(isset($item['img'])){ ?>
<div class="full-img">
    <img src="<?php echo base_url().$item['img'] ?>" alt="<?php echo $item['img_alt'] ?>" title="<?php echo $item['img_title'] ?>" />
</div>
<?php } ?>
<div class="news-section">
    <?php echo $item['page_content'][get_locale()] ?>
</div>
