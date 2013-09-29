<img width="177" align="left" height="" class="book-image" src="<?php echo base_url() . $book['img'] ?>">

<div class="book-title"><?php echo $book['title'][get_locale()] ?></div>
<div class="book-pages"><?php echo $book['pages_count'] ?> <?php echo lang('home_book_pages') ?></div>
<div class="book-code">ISBN: <?php echo $book['isbn'] ?></div>
<div class="book-code"><?php echo lang('home_book_author') ?>: <?php echo $book['author'][get_locale()] ?></div>
<div class="book-code"><?php echo lang('home_book_category') ?>: <?php echo $book['SubCategories']['Categories']['name'][get_locale()] ?></div>
<div class="book-code"><?php echo lang('home_book_subcategory') ?>: <?php echo $book['SubCategories']['name'][get_locale()] ?></div>
<div class="book-code"><?php echo lang('home_book_subcategory2') ?>: <?php echo $book['SubCategories2']['name'][get_locale()] ?></div>
<div class="book-code">                     
    <div style="float: left;margin-bottom: 10px;margin-left: 36px;height: 105px">
        <div id="fb_share_1" style="margin-top: 1px;">
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id))
                        return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=373086796047717";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>                                

            <div class="fb-like" data-href="<?php echo (site_url('home/preview_book/' . $book['id'])) ?>" data-send="true" data-layout="box_count" data-width="100" data-show-faces="true"></div>
        </div>                            
    </div>
    <div >
        <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>                              
        <div style="clear: both;margin-bottom: 5px;">
            <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
            <div>
                <a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical" data-url="<?php echo (site_url('home/preview_book/' . $book['id'])) ?>" data-counturl="<?php echo (site_url('home/preview_book/' . $book['id'])) ?>" data-text="<?php echo $book['title'][get_locale()] ?>" data-related="NahdetMisr">Tweet</a>
            </div>
        </div>

        <script type="text/javascript" src="http://platform.linkedin.com/in.js"></script>
        <script type="in/share" data-url="<?php echo (site_url('home/preview_book/' . $book['id'])) ?>" data-counter="top"></script>
    </div>
    <!-- Place this tag where you want the +1 button to render -->
    <div class="g-plusone" data-size="tall" data-href="<?php echo (site_url('home/preview_book/' . $book['id'])) ?>"></div>

    <!-- Place this render call where appropriate -->
    <script type="text/javascript">
        (function() {
            var po = document.createElement('script');
            po.type = 'text/javascript';
            po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(po, s);
        })();
    </script>
</div>
<?php if ($book['preview'] && file_exists($book['preview'])) { ?>
    <div class="book-code book-download">
        <?php echo lang('home_book_download') ?>:<a href="<?php echo base_url() . $book['preview'] ?>" class="download-pdf"></a>
    </div>
<?php
} else {
    $book['doc_id'] = '171634108';
    $book['access_key'] = 'key-1apwbm7vy7h3a5ol1g63';
}
?>

<div class="news-section">
<?php echo $book['brief_description'][get_locale()] ?>
</div>

<div class="book-component-place">
    <script type="text/javascript" src='http://www.scribd.com/javascripts/scribd_api.js'></script>
    <script language="javascript" type="text/javascript">
        $(document).ready(function() {
            var scribd_doc = scribd.Document.getDoc(<?php echo $book['doc_id'] ?>, '<?php echo $book['access_key'] ?>');
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
