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
                <div class="search-middle"></div>
                <div class="search-right"></div>
            </div>

            <div class="clear"></div>

            <div id="content" class="content-inside">
                <div class="left">
                    <?php $this->load->view('side_menu') ?>
                </div>
                <div class="right">
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
                <ul>
                    <li class="title"><span>Nahdit Misr</span></li>
                    <li><a href="">About Us</a></li>
                    <li><a href="">Achievements</a></li>
                    <li><a href="">Portfolio</a></li>
                    <li><a href="">Partners</a></li>
                    <li><a href="">Download</a></li>
                    <li><a href="">Media Center</a></li>
                    <li><a href="">Careers</a></li>
                    <li><a href="">FAQ</a></li>
                    <li><a href="">Contacts Us</a></li>
                </ul>

                <ul>
                    <li class="title"><span>Navigation</span></li>
                    <li class="sub-title">Publishing Solutions</li>
                    <li><a href="">Books</a></li>
                    <li><a href="">Magazines</a></li>
                    <li><a href="">Digital Publishing</a></li>
                    <li><a href="">Printing</a></li>
                    <li><a href="">Distribution</a></li>
                    <li><a href="">Rights & Permissions</a></li>

                    <li class="sub-title">Educational Solutions</li>
                    <li><a href="">Curriculum Development</a></li>
                    <li><a href="">Curriculum Content</a></li>
                    <li><a href="">Educational Technology</a></li>
                    <li><a href="">Educational Supplies</a></li>
                    <li><a href="">Training For Teachers</a></li>
                </ul>

                <ul>        	
                    <li class="sub-title">Digital Solutions</li>
                    <li><a href="">Digital Content</a></li>
                    <li><a href="">Animation Production</a></li>
                    <li><a href="">CD/ DVD Replication</a></li> 

                    <li class="sub-title">Custom Solutions</li>
                </ul>

                <ul>
                    <li class="title"><span>Languages</span></li>
                    <li><a href="">English</a></li>
                    <li><a href="">Arabic</a></li>            

                    <li class="sub-title" style="margin-top: 25px;">Search</li>
                    <li><a href="">Advanced Search</a></li>

                    <li class="sub-title" style="margin-top: 25px;">Our Social Pages</li>
                    <li><a href="">Facebook</a></li>
                    <li><a href="">Twitter</a></li>
                    <li><a href="">Linkedin</a></li>
                    <li><a href="">Youtube</a></li>
                </ul>

                <div class="clear"></div>

                <div class="copyrights">
                    &copy; 2013 Nadit Misr | All Rights Reserved | <a href="">Privacy Statement</a>
                </div>
            </div>
        </div>
    </body>
</html>