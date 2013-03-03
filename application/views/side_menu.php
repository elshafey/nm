<?php if ($publishing_solutions) { ?>
    <div class="bar-title" style="margin-top: 0px;"><span><?php echo lang('home_publishing_solutions') ?></span></div>
    <ul>
        <?php foreach ($publishing_solutions as $key => $value) { ?>
        <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_PUBLISHING_SOLUTIONS.$value['id']) ?>"><?php echo $value['name'][get_locale()] ?></a></li>
        <?php } ?>
    </ul> 
<?php } ?>
<?php if ($educational_solutions) { ?>
    <div class="bar-title" style="margin-top: 0px;"><span><?php echo lang('home_educational_solutions') ?></span></div>
    <ul>
        <?php foreach ($educational_solutions as $key => $value) { ?>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_EDUCATIONAL_SOLUTIONS.$value['id']) ?>"><?php echo $value['name'][get_locale()] ?></a></li>
        <?php } ?>
    </ul> 
<?php } ?>
<?php if ($digital_solutions) { ?>
    <div class="bar-title" style="margin-top: 0px;"><span><?php echo lang('home_digital_solutions') ?></span></div>
    <ul>
        <?php foreach ($digital_solutions as $key => $value) { ?>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_DIGITAL_SOLUTIONS.$value['id']) ?>"><?php echo $value['name'][get_locale()] ?></a></li>
        <?php } ?>
    </ul> 
<?php } ?>

<div class="bar-title"><span>Custom Solutions</span></div>

<img src="<?php echo base_url() ?>layout/images/for-limited-time-img.jpg" width="162" height="174" />