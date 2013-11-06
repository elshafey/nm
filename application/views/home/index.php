<div class="about-us">
    <div class="about-us-left">
        <a id="vedio" href="#?w=420" rel="popup_name" class="poplight" style="font-size: 112% !important;">
            <img src="<?php echo base_url() . $home_page['video_image'] ?>" alt="" width="228"/>
        </a>
<!--        <div class="home-title"><?php echo $home_page['page_title'][get_locale()] ?></div>-->
    </div>
    <div class="about-us-right">
        <?php echo $home_page['page_content'][get_locale()] ?>
    </div>

    <div class="clear"></div>

    <div class="home-news">
        <div class="news-home-title"><?php echo lang('home_menu_media_center_news') ?></div>
        <?php foreach ($news as $item) { ?>
            <?php $url=get_routed_url(Urls::URL_PREFIX_NEWS_DETAILS . $item['id']) ?>
            <div class="news-box">
                <?php if (isset($item['img']) && $item['img']) { ?>
                        <!--<img class="news-img" width="73" src="<?php echo base_url() . page_thumb($item['img']) ?>" title="<?php echo $item['img_title'] ?>" alt="<?php echo $item['img_alt'] ?>" />-->
                    <div class="news-thumbnail">
                        <a href="<?php echo $url ?>" >
                            <img src="<?php echo base_url() . page_thumb($item['img']) ?>" title="<?php echo $item['img_title'] ?>" alt="<?php echo $item['img_alt'] ?>" />
                        </a>
                    </div>
                <?php } ?>
                <a href="<?php echo $url ?>" class="title"><?php echo $item['page_title'][get_locale()] ?></a>
                <p>
                    <?php echo sub_string_from_start($item['page_content'][get_locale()], 90) ?>
                    <a class="more" href="<?php echo $url ?>">
                        <?php echo lang('global_more') ?>
                    </a>
                </p>
            </div> 
        <?php } ?>
    </div>

    <div class="clear"></div>

    <div class="home-media-title"><span>Latest Releases</span></div>
    <div class="home-media">
        <div class="image_carousel">
            <div id="latest">
                <?php foreach ($latest_release as $value) { ?>
                    <div class="carousel-image-container-0">
                        <a href="<?php echo get_routed_url(Urls::URL_PREFIX_BOOK.$value['id']) ?>" class="carousel-image-container-1">
                            <span class="carousel-image-container-2" >
                                <img class="carousel-image-item"src="<?php echo base_url() . ($value['img']) ?>"  title="<?php echo $value['img_title'] ?>" alt="<?php echo $value['img_alt'] ?>" />
                            </span>
                        </a>
                        <p class="carousel-image-info">
                            <?php echo $value['title'][get_locale()] ?><br/>
                            <?php echo $value['pages_count'] ?> Pages
                        </p>
                    </div>
                <?php } ?>
            </div>
            <div class="clearfix"></div>
            <a class="prev" id="latest_prev" href="#"><span>prev</span></a>
            <a class="next" id="latest_next" href="#"><span>next</span></a>
        </div>
    </div>

    <div class="home-media-title"><span>Most Popular</span></div>
    <div class="home-media">
        <div class="image_carousel">
            <div id="popular">
                <?php foreach ($most_popular as $value) { ?>
                    <div class="carousel-image-container-0">
                        <a href="<?php echo get_routed_url(Urls::URL_PREFIX_BOOK.$value['id']) ?>" class="carousel-image-container-1">
                            <div class="carousel-image-container-2" >
                                <img class="carousel-image-item"src="<?php echo base_url() . ($value['img']) ?>"  title="<?php echo $value['img_title'] ?>" alt="<?php echo $value['img_alt'] ?>" />
                            </div>
                        </a>
                        <p class="carousel-image-info">
                            <?php echo $value['title'][get_locale()] ?><br/>
                            <?php echo $value['pages_count'] ?> Pages
                        </p>
                    </div>
                <?php } ?>
            </div>
            <div class="clearfix"></div>
            <a class="prev" id="popular_prev" href="#"><span>prev</span></a>
            <a class="next" id="popular_next" href="#"><span>next</span></a>
        </div>
    </div>

</div>
<div id="popup_name" class="popup_block">   
    <iframe id="vedio_iframe" width="420" height="315" src="<?php echo $home_page['video_path']; ?>" frameborder="0"></iframe>
</div> 
<script type="text/javascript">
    $(document).ready(function() {
        
        $('#vedio').click(function(){
            $('#vedio_iframe').attr('src', '<?php echo $home_page['video_path']; ?>');
        });
        
        $('.close_popup').live('click', function(){
            $('#vedio_iframe').attr('src', '');
        });
    });
</script>