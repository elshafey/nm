
<div id="top-menu">
    <div class="header-left"></div>
    <div class="header-middle">
        <ul id="menu">
            <li>
                <a href="javascript:">About Us</a>
                <ul class="sub-menu noJS">
                    <?php foreach ($aboutus as $value) { ?>
                        <li>
                            <a href="<?php echo get_routed_url(Urls::URL_PREFIX_ABOUTUS_PAGE . $value['id']) ?>"><?php echo $value['page_title'][get_locale()] ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li class="menu-separator">|</li>
            <li><a href="">Achievements</a></li>
            <li class="menu-separator">|</li>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_PORTFOLIO) ?>">Portfolio</a></li>
            <li class="menu-separator">|</li>
            <li><a href="">Partners</a></li>
            <li class="menu-separator">|</li>
            <li><a href="">Download</a></li>
            <li class="menu-separator">|</li>
            <li><a href="javascript:">Media Center</a>
                <ul class="sub-menu noJS">
                    <li>
                        <a href="<?php echo get_routed_url(Urls::URL_PREFIX_NEWS_LIST) ?>"><?php echo lang('home_menu_media_center_news') ?></a>
                    </li>
                    <li>
                        <a href="<?php echo get_routed_url(Urls::URL_PREFIX_EVENTS_LIST) ?>"><?php echo lang('home_menu_media_center_events') ?></a>
                    </li>
                    <li>
                        <a href="<?php echo get_routed_url(Urls::URL_PREFIX_PRESS_LIST) ?>"><?php echo lang('home_menu_media_center_press_release') ?></a>
                    </li>
                </ul>
            </li>
            <li class="menu-separator">|</li>
            <li><a href="">Careers</a></li>
            <li class="menu-separator">|</li>
            <li><a href="">FAQ</a></li>
            <li class="menu-separator">|</li>
            <li><a href="">Contacts Us</a></li>
        </ul>
    </div>
    <div class="header-right"></div>
</div>
