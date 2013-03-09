<ul>
    <li class="title"><span><?php echo lang('site_name') ?></span></li>
    <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_ABOUTUS_PAGE . $aboutus[0]['id']) ?>"><?php echo lang('home_menu_aboutus') ?></a></li>
    <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_ACHIEVEMENTS) ?>"><?php echo lang('home_menu_achievements') ?></a></li>
    <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_PORTFOLIO) ?>"><?php echo lang('home_menu_portfolio') ?></a></li>
    <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_PARTNERS) ?>"><?php echo lang('home_menu_partners') ?></a></li>
    <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_DOWNLOADS) ?>"><?php echo lang('home_menu_downloads') ?></a></li>
    <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_NEWS_LIST) ?>">Media Center</a></li>
    <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_CAREERS) ?>"><?php echo lang('home_menu_careers') ?></a></li>
    <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_FAQS) ?>"><?php echo lang('home_menu_faqs') ?></a></li>
    <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_CONTACT_US) ?>"><?php echo lang('home_menu_contact_us'); ?></a></li>
</ul>

<ul>
    <?php if ($publishing_solutions) { ?>
        <li class="title"><span>Navigation</span></li>
        <li class="sub-title"><?php echo lang('home_publishing_solutions') ?></li>
        <?php foreach ($publishing_solutions as $key => $value) { ?>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_PUBLISHING_SOLUTIONS . $value['id']) ?>"><?php echo $value['name'][get_locale()] ?></a></li>
        <?php } ?>
    <?php } ?>
    <?php if ($educational_solutions) { ?>
        <li class="sub-title"><?php echo lang('home_educational_solutions') ?></li>
        <?php foreach ($educational_solutions as $key => $value) { ?>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_EDUCATIONAL_SOLUTIONS . $value['id']) ?>"><?php echo $value['name'][get_locale()] ?></a></li>
        <?php } ?>
    <?php } ?>
</ul>
<?php if ($digital_solutions) { ?>
    <ul>        	
        <li class="sub-title"><?php echo lang('home_digital_solutions') ?></li>
        <?php foreach ($digital_solutions as $key => $value) { ?>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_DIGITAL_SOLUTIONS.$value['id']) ?>"><?php echo $value['name'][get_locale()] ?></a></li>
        <?php } ?>

        <li class="sub-title">Custom Solutions</li>
    </ul>
<?php } ?>
<ul>
    <li class="title"><span>Languages</span></li>
    <li><a href="">English</a></li>
    <li><a href="">Arabic</a></li>            

    <li class="sub-title" style="margin-top: 25px;">Search</li>
    <li><a href="<?php echo site_url('home/advanced_search') ?>"><?php echo lang('home_menu_advances_search') ?></a></li>

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