<?php if (isset($item['img']) && $item['img']) { ?>
    <div class="full-img">
        <img src="<?php echo base_url() . $item['img'] ?>" alt="<?php echo $item['img_alt'] ?>" title="<?php echo $item['img_title'] ?>" />
    </div>
<?php } ?>
<div class="news-section">
    <?php echo $item['page_content'][get_locale()] ?>
</div>

<?php if (isset($item['pdf']) && $item['pdf'][get_locale()]) { ?>
<div style="margin-top: 15px;">
        <a href="<?php echo base_url() . $item['pdf'][get_locale()] ?>" class="download-pdf"></a>    
    </div>
<?php } ?>
