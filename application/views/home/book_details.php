<img width="177" align="left" height="" class="book-image" src="<?php echo base_url() . $book['img'] ?>">

<div class="book-title"><?php echo $book['title'][get_locale()] ?></div>
<div class="book-pages"><?php echo $book['pages_count'] ?> <?php echo lang('home_book_pages') ?></div>
<div class="book-code">ISBN: <?php echo $book['isbn'] ?></div>
<div class="book-code"><?php echo lang('home_book_author') ?>: <?php echo $book['author'][get_locale()] ?></div>
<div class="book-code"><?php echo lang('home_book_category') ?>: <?php echo $book['SubCategories']['Categories']['name'][get_locale()] ?></div>
<div class="book-code"><?php echo lang('home_book_subcategory') ?>: <?php echo $book['SubCategories']['name'][get_locale()] ?></div>
<div class="book-code"><?php echo lang('home_book_subcategory2') ?>: <?php echo $book['SubCategories2']['name'][get_locale()] ?></div>
<!--<div class="book-rate"><img width="79" height="14" src="images/book-rate.png"></div>-->
<div class="book-code">

    <a id="share_lnk" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(site_url('home/preview_book/' . $book['id'])) ?>">
        <img style="height: 24px" src="<?php echo base_url() . 'layout/images/share.jpeg' ?>" />
    </a>
</div>
<div class="book-code">
    <a href="<?php echo base_url() . $book['preview'] ?>" class="download-pdf"></a>
</div>
<div class="news-section">
    <?php echo $book['brief_description'][get_locale()] ?>
</div>

<div class="book-component-place">
    <script type='text/javascript' src='http://www.scribd.com/javascripts/view.js'></script>
    <script language="javascript" type="text/javascript">
        $(document).ready(function() {
            var scribd_doc = scribd.Document.getDoc(<?php echo $book['doc_id'] ?>, '<?php echo $book['access_key'] ?>');

            var oniPaperReady = function() {
                scribd_doc.api.setZoom(1);
            }

            scribd_doc.addParam('height', 600);
            scribd_doc.addParam('public', true);
            scribd_doc.write('embedded_resume');
            scribd_doc.addEventListener('iPaperReady', oniPaperReady);



        });
    </script>
    <div id="embedded_resume"></div>
</div>     
<script>
    $('#share_lnk').click(function(e) {
        e.preventDefault()
        window.open($(this).attr('href'), 'Share On Your Timeline', 'top=200,left=300,height=200,width=500,modal=yes,alwaysRaised=yes')
    });
</script>