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
        <?php if(isset($is_request_proposal)&&$is_request_proposal){ ?>
        <li>
            <?php echo lang('home_request_proposal_department', 'department') ?>
            <select name="department" >
                <option value=""><?php echo lang('global_select') ?></option>
                <option value="marketting"><?php echo lang('home_request_proposal_marketting') ?></option>
                <option value="rights"><?php echo lang('home_request_proposal_rights') ?></option>
                <option value="publishing"><?php echo lang('home_request_proposal_publishing') ?></option>
                <option value="customer_service"><?php echo lang('home_request_proposal_customer_service') ?></option>
                <option value="sales"><?php echo lang('home_request_proposal_sales') ?></option>
            </select>
            <span class="star">*</span>
            <?php echo form_error('email') ?>
        </li>
        <?php } ?>
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
