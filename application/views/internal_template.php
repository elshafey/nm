<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php echo print_meta_data($url, isset($page_title) ? $page_title : lang('page_title')) ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>layout/css/nahdet-misr.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>layout/css/coolMenu.css"/>
        <?php echo $_styles ?>

        <script src="<?php echo base_url(); ?>layout/js/jquery/jquery-1.7.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>layout/js/content.js" type="text/javascript"></script>
        <?php echo $_scripts ?>
    </head>

    <body>
        <div id="upper-header"></div>
        <div id="wrapper">
            <a href="<?php echo base_url() ?>">
                <div class="logo-inside"></div>
            </a>
            <a href="<?php echo base_url() ?>" class="arabic-link arabic-link-inside"></a>
            <div class="social-network-inside" id="social-network">
                <a class="facebook" href=""></a>
                <a class="twitter" href=""></a>
                <a class="linkedin" href=""></a>
                <a class="youtube" href=""></a>
            </div>
            <div class="clear"></div>
            <?php $this->load->view('top-menu', array('is_internal' => true)) ?>
            <div class="clear"></div>
            <div class="inside-banner">
                <img width="907" height="137" src="<?php echo base_url(); ?>layout/images/inside-banner.png" >
            </div>
            <div class="clear"></div>

            <div id="search-box-inside">
                <div class="search-left"></div>
                <div class="search-middle">
                    <div class="search-middle-title">Search Products</div>
                    <form action="<?php echo site_url('home/quick_search') ?>">
                        <input id="quick_search" type="text" value="<?php echo set_value('q') ?>" class="search-box" name="q" />
                    </form>
                    <a class="advanced-search" href="<?php echo site_url('home/advanced_search') ?>"><?php echo lang('home_menu_advances_search') ?></a>
                </div>
                <div class="search-right"></div>
            </div>

            <div class="clear"></div>

            <div id="content" class="content-inside">
                <div class="left">
                    <?php $this->load->view('side_menu') ?>
                </div>
                <div class="right">
                    <?php echo top_side_link() ?>
                    <div class="navigator">
                        <span class="main-item"><a href="<?php echo base_url() ?>">Home Page</a></span>
                        <?php echo implode('', $navigator) ?>
                    </div>
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