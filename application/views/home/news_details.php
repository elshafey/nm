<?php if (isset($item['img']) && $item['img']) { ?>
    <div class="full-img">
        <img src="<?php echo base_url() . $item['img'] ?>" alt="<?php echo $item['img_alt'] ?>" title="<?php echo $item['img_title'] ?>" />
    </div>
<?php } ?>
<div class="news-section">
    <?php echo $item['page_content'][get_locale()] ?>
</div>

<?php if (isset($item['pdf']) && $item['pdf'][get_locale()]) { ?>
    <div style="margin-top: 15px;">
        <a href="<?php echo base_url() . $item['pdf'][get_locale()] ?>" class="download-pdf"></a>    
    </div>
    <?php if (isset($item['doc_id']) && $item['doc_id'][get_locale()]) { ?>
        <div class="book-component-place">
            <script type="text/javascript" src='http://www.scribd.com/javascripts/scribd_api.js'></script>
            <script language="javascript" type="text/javascript">
                $(document).ready(function() {
                    var scribd_doc = scribd.Document.getDoc(<?php echo $item['doc_id'][get_locale()] ?>, '<?php echo $item['access_key'][get_locale()] ?>');
                    var oniPaperReady = function() {
                        scribd_doc.api.setZoom(1);
                    }

                    scribd_doc.addParam('jsapi_version', 2);
                    scribd_doc.addParam('default_embed_format', 'flash');
                    scribd_doc.addParam('height', 600);
                    scribd_doc.addParam('hide_disabled_buttons', true);
                    scribd_doc.addParam('allow_share', false);
                    scribd_doc.addEventListener('docReady', oniPaperReady);
                    scribd_doc.write('embedded_resume');

                });
            </script>
            <div id="embedded_resume"></div>
        </div>
    <?php } ?>
<?php } ?>
