<div class="news-section">
    <div class="job-code">
        <span><?php echo lang('home_career_job_code') ?></span>
        <?php echo $item['job_code'] ?>
    </div>
    <span class="job-description">
        <?php echo lang('home_career_job_description') ?>
    </span>
    <?php echo $item['job_description'][get_locale()] ?>
</div>
