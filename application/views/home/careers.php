<div class="news-section">
    <?php if ($page) { ?>
        <div class="page-brief">
            <?php echo $page['page_content'][get_locale()] ?>
        </div>
    <?php } ?>
    <?php if ($list) { ?>
        <?php foreach ($list as $item) { ?>
            <a class="news-title" href="<?php echo get_routed_url(Urls::URL_PREFIX_CAREERS_DETAILS . $item['id']) ?>">
                <?php echo $item['job_title'][get_locale()] ?>
            </a>
            <p>
                <?php echo sub_string_from_start($item['job_description'][get_locale()], 200) ?>
                <a class="more" href="<?php echo get_routed_url(Urls::URL_PREFIX_CAREERS_DETAILS . $item['id']) ?>">
                    <?php echo lang('global_more') ?>
                </a>
            </p>
            <div class="h-line"></div>
        <?php } ?>
    <?php } else { ?>
        <?php echo lang('home_no_data_available') ?>
    <?php } ?>
</div>
<div>
    <h1><?php echo lang('home_careers_apply_title') ?></h1>
    <div>
        <?php echo lang('home_careers_apply_brief') ?>
    </div>
    <br>
    <form method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <h2><?php echo lang('home_careers_apply_interest_title') ?></h2>
                
                <ul class="interests">
                    <?php foreach (lang('home_careers_apply_interests') as $k => $value) { ?>
                        <li>
                            <input class="chkbox" type="checkbox" name="interests[<?php echo $k ?>]" value="<?php echo $value ?>" <?php echo  set_checkbox('interests', $value ) ?> id="<?php echo "interests_$k" ?>" />
                            <label class="chkbox_lbl" for="<?php echo "interests_$k" ?>"><?php echo $value ?></label>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li>
                <?php echo lang('home_careers_apply_name', 'name') ?>
                <input class="txtbox" type="text" value="<?php echo set_value('name') ?>" name="name" />
                <span class="star">*</span>
                <?php echo form_error('name') ?>
            </li>
            <li>
                <?php echo lang('home_careers_apply_mobile', 'mobile') ?>
                <input class="txtbox" type="text" value="<?php echo set_value('mobile') ?>" name="mobile" />
                <span class="star">*</span>
                <?php echo form_error('mobile') ?>
            </li>
            <li>
                <?php echo lang('home_careers_apply_home_number', 'home_number') ?>
                <input class="txtbox" type="text" value="<?php echo set_value('home_number') ?>" name="home_number" />
            </li>
            <li>
                <?php echo lang('home_careers_apply_email', 'email') ?>
                <input class="txtbox" type="text" value="<?php echo set_value('email') ?>" name="email" />
                <span class="star">*</span>
                <?php echo form_error('email') ?>
            </li>
            <li>
                <?php echo lang('home_careers_apply_birthday', 'birthday') ?>
                <input class="txtbox" type="text" value="<?php echo set_value('birthday') ?>" name="birthday" />
                <span class="star">*</span>
                <?php echo form_error('birthday') ?>
            </li>
            <li>
                <?php echo lang('home_careers_apply_nationality', 'nationality') ?>
                <input class="txtbox" type="text" value="<?php echo set_value('nationality') ?>" name="nationality" />
                <span class="star">*</span>
                <?php echo form_error('nationality') ?>
            </li>
            <li>
                <?php echo lang('home_careers_apply_military', 'military') ?>
                <input class="txtbox" type="text" value="<?php echo set_value('military') ?>" name="military" />
                <span class="star">*</span>
                <?php echo form_error('military') ?>
            </li>
            <li>
                <?php echo lang('home_careers_apply_marital', 'marital') ?>
                <input class="txtbox" type="text" value="<?php echo set_value('marital') ?>" name="marital" />
                <span class="star">*</span>
                <?php echo form_error('marital') ?>
            </li>
            <li>
                <?php echo lang('home_careers_apply_position', 'position') ?>
                <input class="txtbox" type="text" value="<?php echo set_value('position') ?>" name="position" />
            </li>
            <li>
                <?php echo lang('home_careers_apply_employer', 'employer') ?>
                <input class="txtbox" type="text" value="<?php echo set_value('employer') ?>" name="employer" />
            </li>
            <li>
                <?php echo lang('home_careers_apply_start_date', 'start_date') ?>
                <input class="txtbox" type="text" value="<?php echo set_value('start_date') ?>" name="start_date" />
            </li>
            <li>
                <?php echo lang('home_careers_cv_file', 'cv_file') ?>
                <input type="file" name="cv_file"  value="<?php echo set_value('start_date') ?>" >
                <?php echo form_error('cv_file') ?>
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
                <?php echo lang('home_careers_apply_brief_description', 'brief_description') ?>
                <textarea name="brief_description" ><?php echo set_value('brief_description') ?></textarea>
                <span class="star">*</span>
                <?php echo form_error('brief_description') ?>
            </li>
            <li class="btns">
                <input type="submit" value="<?php echo lang('home_btn_send') ?>" />
            </li>
        </ul>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('input[type="hidden"]').remove();
    });
</script>
