<div id="<?php if($is_internal){ ?>top-menu-inside<?php }else{?>top-menu<?php }?>">
    <div class="header-left"></div>
    <div class="header-middle">
        <ul id="menu">
            <li>
                <a href="javascript:"><?php echo lang('home_menu_aboutus') ?></a>
                <ul class="sub-menu noJS">
                    <?php foreach ($aboutus as $value) { ?>
                        <li>
                            <a href="<?php echo get_routed_url(Urls::URL_PREFIX_ABOUTUS_PAGE . $value['id']) ?>"><?php echo $value['page_title'][get_locale()] ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li class="menu-separator">|</li>
            <li>
                <a href="javascript:"><?php echo lang('home_menu_affiliated_companies') ?></a>
                <ul class="sub-menu noJS">
                    <?php foreach ($affiliated_companies as $value) { ?>
                        <li>
                            <a href="<?php echo get_routed_url(Urls::URL_PREFIX_AFFILIATED_COMPANIES . $value['id']) ?>"><?php echo $value['page_title'][get_locale()] ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li class="menu-separator">|</li>
            <li>
                <a href="javascript:"><?php echo lang('home_menu_achievements') ?></a>
                <ul class="sub-menu noJS">
                    <?php foreach ($achievements as $value) { ?>
                        <li>
                            <a href="<?php echo get_routed_url(Urls::URL_PREFIX_ACHIEVEMENTS . $value['id']) ?>"><?php echo $value['page_title'][get_locale()] ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li class="menu-separator">|</li>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_PORTFOLIO) ?>"><?php echo lang('home_menu_portfolio') ?></a></li>
            <li class="menu-separator">|</li>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_PARTNERS) ?>"><?php echo lang('home_menu_partners') ?></a></li>
            <li class="menu-separator">|</li>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_DOWNLOADS) ?>"><?php echo lang('home_menu_downloads') ?></a></li>
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
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_CAREERS) ?>"><?php echo lang('home_menu_careers') ?></a></li>
            <li class="menu-separator">|</li>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_FAQS) ?>"><?php echo lang('home_menu_faqs') ?></a></li>
            <li class="menu-separator">|</li>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_CONTACT_US) ?>"><?php echo lang('home_menu_contact_us'); ?></a></li>
        </ul>
    </div>
    <div class="header-right"></div>
</div>
