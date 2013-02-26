<a style="float: right" href="<?php echo site_url('admin/faqs') ?>">
    <?php echo lang('faqs_main_page_txt') ?>
</a>
<form method="POST" id="form">
    <ul>
        <li class="section_title">
            <?php echo lang('faqs_form_create_page_title') ?>
        </li>
        <?php $form->renderFields() ?>
        <li class="btns">
            <input type="submit" value="<?php echo lang('global_btn_save') ?>" />
        </li>
    </ul>
</form>

<?php if ($responce) { ?>
    <ul class="faqs">
        <?php foreach ($responce as $faq) { ?>
            <li>
                <table id="table_<?php echo $faq['id'] ?>">
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <div class="faq_manage">
                                <span class="info"><?php echo lang('faqs_page_order') ?></span> <span class="info-answer"><?php echo $faq['page_order'] ?> </span><span class="separator">|</span>
                                <span class="info"><?php echo lang('faqs_is_active') ?></span> <span class="info-answer"><?php echo $faq['is_active'] ?> </span><span class="separator">|</span>
                                <span class="info-answer"><?php echo $faq['edit'] ?> </span><span class="separator">|</span>
                                <span class="info-answer"><?php echo $faq['delete'] ?> </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="170"><?php echo lang('faqs_question_en-us') ?></td>
                        <td  class="question"  width="750"><?php echo $faq['question_en-us'] ?></td>
                    </tr>
                    <tr>
                        <td width="170"><?php echo lang('faqs_answer_en-us') ?></td>
                        <td width="750"><?php echo n2nl($faq['answer_en-us']) ?></td>
                    </tr>
                    <tr>
                        <td width="170"><?php echo lang('faqs_question_en-us') ?></td>
                        <td  class="question" width="750"><?php echo $faq['question_ar-eg'] ?></td>
                    </tr>
                    <tr>
                        <td width="170"><?php echo lang('faqs_answer_en-us') ?></td>
                        <td width="750"><?php echo n2nl($faq['answer_ar-eg']) ?></td>
                    </tr>
                </table>
                <form method="POST" id="form_<?php echo $faq['id'] ?>" style="display: none">

                </form>
                <script>
                    $("#form_<?php echo $faq['id'] ?>").submit(function(e){
                        e.preventDefault();
                        var form=$(this);
                        var table=$('#table_<?php echo $faq['id'] ?>');
                        $.post('<?php echo site_url('admin/faq/edit/' . $faq['id']) ?>',form.serialize() ,function(data){
                            if(data=='success'){
                                location.hash=('#table_<?php echo $faq['id'] ?>');
                                location.reload();
                            }else{
                                form.html(data);
                            }
                                    
                        });
                    })
                </script>
            </li>
        <?php } ?>
    </ul>

<?php } ?>

<script>
    $('.edit_lnk').click(function(e){
        e.preventDefault();
        var form=$('#form_'+$(this).attr('rel'));
        var table=$('#table_'+$(this).attr('rel'));
        $.post($(this).attr('href'), function(data){
            form.html(data);
            table.slideUp(200);
            form.slideDown(400);
        });
    });
</script>