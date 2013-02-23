<div class="about-us">
    <div class="about-us-left">
        <a id="vedio" href="#?w=420" rel="popup_name" class="poplight" style="font-size: 112% !important;">
            <img src="<?php echo base_url().$home_page['video_image'] ?>" width="189" height="103" />
        </a>
        <div class="home-title"><?php echo $home_page['page_title'][get_locale()] ?></div>
    </div>
    <div class="about-us-right">
        <?php echo $home_page['page_content'][get_locale()] ?>
    </div>

    <div class="clear"></div>

    <div class="home-news">
        <div class="news-home-title">News</div>
        <?php foreach ($news as $item) { ?>
            <div class="news-box">
                <a href="<?php echo get_routed_url(Urls::URL_PREFIX_NEWS_DETAILS.$item['id']) ?>" class="title"><?php echo $item['page_title'][get_locale()] ?></a>
                <p><?php echo sub_string_from_start($item['page_content'][get_locale()], 100) ?></p>
            </div> 
        <?php } ?>
    </div>

    <div class="clear"></div>

    <div class="home-media-title"><span>Latest Releases</span></div>
    <div class="home-media"></div>

    <div class="home-media-title"><span>Most Popular</span></div>
    <div class="home-media"></div>

</div>
<div id="popup_name" class="popup_block">   
    <iframe id="vedio_iframe" width="420" height="315" src="<?php echo $home_page['video_path'];?>" frameborder="0"></iframe>
</div> 
<script type="text/javascript">
    $(document).ready(function() {
        $('#slider').nivoSlider({pauseTime:5000});
        
        $('#vedio').click(function(){
            $('#vedio_iframe').attr('src', '<?php echo $home_page['video_path'];?>');
        });
        
        $('.close_popup').live('click', function(){
            $('#vedio_iframe').attr('src', '');
        });
    });
</script>