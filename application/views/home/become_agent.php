<form method="POST">
    <ul>
        <li>
            <?php if ($page) { ?>
                <?php echo $page['page_content'][get_locale()] ?>
            <?php } ?>
        </li>
        <li>
            <?php echo lang('home_contact_us_full_name', 'full_name') ?>
            <input class="txtbox" type="text" value="<?php echo set_value('full_name') ?>" name="full_name" />
            <span class="star">*</span>
            <?php echo form_error('full_name') ?>
        </li>
        <li>
            <?php echo lang('home_contact_us_company', 'company') ?>
            <input class="txtbox" type="text" value="<?php echo set_value('company') ?>" name="company" />
        </li>
        <li>
            <?php echo lang('home_contact_us_tel', 'tel') ?>
            <input class="txtbox" type="text" value="<?php echo set_value('tel') ?>" name="tel" />
        </li>
        <li>
            <?php echo lang('home_contact_us_email', 'email') ?>
            <input class="txtbox" type="text" value="<?php echo set_value('email') ?>" name="email" />
            <span class="star">*</span>
            <?php echo form_error('email') ?>
        </li>
        <li>
            <label>&nbsp;</label>
            <span class="capatcha-span">
                <?php echo lang('home_contact_us_capatch_hint') ?><br>
                <img src="<?php echo site_url() . 'capatch.jpg' ?>" />
                <input class="txtbox" type="text" maxlength="6" style="width: 70px;" value="" name="security_code" />
                <span class="star">*</span>
                <?php echo form_error('security_code') ?>
            </span>
        </li>
        <li>
            <?php echo lang('home_contact_us_comment', 'comment') ?>
            <textarea name="comment" ><?php echo set_value('comment') ?></textarea>
            <span class="star">*</span>
            <?php echo form_error('comment') ?>
        </li>
        <li class="btns">
            <input type="submit" value="<?php echo lang('home_btn_send') ?>" />
        </li>
    </ul>
</form>
