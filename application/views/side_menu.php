
<div class="bar-title" style="margin-top: 0px;">
    <a href="<?php echo get_routed_url(Urls::URL_PREFIX_PUBLISHING_SOLUTIONS) ?>"><span><?php echo lang('home_publishing_solutions') ?></span></a>
</div>
<?php if ($publishing_solutions) { ?>
    <ul>
        <?php foreach ($publishing_solutions as $key => $value) { ?>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_PUBLISHING_SOLUTIONS . $value['id']) ?>"><?php echo $value['name'][get_locale()] ?></a></li>
        <?php } ?>
    </ul> 
<?php } ?>

<div class="bar-title" style="margin-top: 0px;">
    <a href="<?php echo get_routed_url(Urls::URL_PREFIX_EDUCATIONAL_SOLUTIONS) ?>"><span><?php echo lang('home_educational_solutions') ?></span></a>
</div>
<?php if ($educational_solutions) { ?>
    <ul>
        <?php foreach ($educational_solutions as $key => $value) { ?>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_EDUCATIONAL_SOLUTIONS . $value['id']) ?>"><?php echo $value['name'][get_locale()] ?></a></li>
        <?php } ?>
    </ul> 
<?php } ?>

<div class="bar-title" style="margin-top: 0px;">
    <a href="<?php echo get_routed_url(Urls::URL_PREFIX_DIGITAL_SOLUTIONS) ?>"><span><?php echo lang('home_digital_solutions') ?></span></a>
</div>
<?php if ($digital_solutions) { ?>
    <ul>
        <?php foreach ($digital_solutions as $key => $value) { ?>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_DIGITAL_SOLUTIONS . $value['id']) ?>"><?php echo $value['name'][get_locale()] ?></a></li>
        <?php } ?>
    </ul> 
<?php } ?>

<div class="bar-title" style="margin-top: 0px;">
    <a href="<?php echo get_routed_url(Urls::URL_PREFIX_CUSTOM_SOLUTIONS) ?>"><span><?php echo lang('home_custom_solutions') ?></span></a>
</div>
        <?php if ($custom_solutions) { ?>
    <ul>
        <?php foreach ($custom_solutions as $key => $value) { ?>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_CUSTOM_SOLUTIONS . $value['id']) ?>"><?php echo $value['name'][get_locale()] ?></a></li>
        <?php } ?>
    </ul> 
<?php } ?>

<img src="<?php echo base_url() ?>layout/images/for-limited-time-img.jpg" width="162" height="174" />