<div class="news-section">
    <?php if ($faqs) { ?>
        <?php foreach ($faqs as $key => $faq) { ?>
            <p class="news-title" >
                <?php echo $faq['question'][get_locale()] ?>
            </p>
            <p style="margin-top: 5px;">
                <?php echo more_less_str(n2nl($faq['answer'][get_locale()])) ?>
            </p>
            <div class="h-line"></div>
        <?php } ?>
        <script type="text/javascript">
            $('.see_more').click(function(){
                $(this).parent().hide();
                $(this).parent().next('.mored').show();
            });
            $('.see_less').click(function(){
                $(this).parent().hide();
                $(this).parent().prev('.lessed').show();
            })
        </script>
    <?php } else { ?>
        <?php echo lang('home_no_data_available') ?>
    <?php } ?>
</div>