<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php echo print_meta_data($url, isset($page_title) ? $page_title : lang('page_title')) ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>layout/css/nahdet-misr.<?php echo get_locale() ?>.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>layout/css/coolMenu.<?php echo get_locale() ?>.css"/>
        <?php echo $_styles ?>
        
        <link rel="icon" type="image/jpg" href="<?php echo base_url() ?>layout/images/favicon.jpg"></link>
        
        <script src="<?php echo base_url(); ?>layout/js/jquery/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>layout/js/jquery/jquery.carouFredSel-6.2.0-packed.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>layout/js/jquery/jquery.mousewheel.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>layout/js/jquery/jquery.touchSwipe.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>layout/js/jquery/jquery.transit.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>layout/js/jquery/jquery.ba-throttle-debounce.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>layout/js/content.js" type="text/javascript"></script>
        <?php echo $_scripts ?>
    </head>

    <body>
        <div id="upper-header"></div>
        <div id="wrapper">
            <div id="social-network">
                <a href="https://www.facebook.com/nahdetmisrgroup?ref=hl" class="facebook"></a>
                <a href="https://twitter.com/NahdetMisrgroup" class="twitter"></a>
                <!--<a href="" class="linkedin"></a>-->
                <a href="http://www.youtube.com/nahdetmisrgroup" class="youtube"></a>
            </div>
            <?php if(get_locale()=='en-us'){ ?>
            <span class="arabic-link" lang="ar-eg"></span>
            <?php }else{ ?>
            <span class="arabic-link"  lang="en-us" ></span>
            <?php } ?>

            <div class="clear"></div>
            <?php $this->load->view('top-menu', array('is_internal' => false)) ?>
            <div class="clear"></div>
            <div id="logo-banner">
                <a class="nahdit-mist-group-logo"></a>
                <div class="banner  theme-default">
                    <div id="slider" class="nivoSlider">
                        <?php foreach ($banners as $banner) { ?>
                            <a href="<?php echo $banner['link'] ?>">
                                <img src="<?php echo base_url() . $banner['path'][get_locale()] ?>" title="<?php echo $banner['title'][get_locale()] ?>" alt="<?php echo $banner['alt'][get_locale()] ?>" width="660" height="300" />
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="clear"></div>

            <div id="search-box">
                <div class="search-left"></div>
                <div class="search-middle">
                    <div class="search-middle-title"><?php echo lang('home_btn_search') ?></div>
                    <form action="<?php echo site_url('home/quick_search') ?>">
                        <input id="quick_search" type="text" value="<?php echo set_value('q') ?>" class="search-box" name="q" />
                    </form>
                    <span class="search-separator">|</span>
                    <a class="advanced-search" href="<?php echo site_url('home/advanced_search') ?>"><?php echo lang('home_menu_advances_search') ?></a>
                </div>
                <div class="search-right"></div>
            </div>

            <div class="clear"></div>

            <div id="content">
                <div class="left">
                    <?php $this->load->view('side_menu') ?>
                </div>
                <div class="right">
                    <?php echo $content ?>
                </div>
            </div>

        </div>
        <div class="clear"></div>

        <div id="footer">
            <div class="wrapper">
                <?php $this->load->view('footer_navigation') ?>
            </div>
        </div>
    </body>
</html>