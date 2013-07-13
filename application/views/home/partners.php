<?php if ($page) { ?>
    <div class="page-brief">
        <?php echo $page['page_content'][get_locale()] ?>
    </div>
<?php } ?>
<?php if ($partners['content']) { ?>
    <h1 class="inside-title"><?php echo lang('home_partners_content') ?></h1>
    <?php foreach ($partners['content'] as $key => $value) { ?>
        <div class="partner<?php if ($key == 0) { ?> partner-first<? } ?>">
            <div class="partner-frame">
                <img height="111" width="134" src="<?php echo base_url() . $value['path'] ?>" alt="<?php echo $value['alt'] ?>" title="<?php echo $value['title'] ?>" />
            </div>
            <div class="partner-name" style="clear: both"><?php echo $value['name'][get_locale()] ?></div>
        </div>
    <? } ?>

    <?php if ($partners['business']) { ?>
        <div class="h-line"></div>
    <?php } ?>
<?php } ?>
<?php if ($partners['business']) { ?>
    <h1 class="inside-title"><?php echo lang('home_partners_business') ?></h1>
    <?php foreach ($partners['business'] as $key => $value) { ?>
        <div class="partner<?php if ($key == 0) { ?> partner-first<? } ?>">
            <div class="partner-frame">
                <img height="111" width="134" src="<?php echo base_url() . $value['path'] ?>" alt="<?php echo $value['alt'] ?>" title="<?php echo $value['title'] ?>" />
            </div>
            <div class="partner-name" style="clear: both"><?php echo $value['name'][get_locale()] ?></div>
        </div>
    <? } ?>
<?php } ?>