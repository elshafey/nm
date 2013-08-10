
<div class="bar-title" style="margin-top: 0px;">
    <a href="<?php echo get_routed_url(Urls::URL_PREFIX_PUBLISHING_SOLUTIONS) ?>"><span><?php echo lang('home_publishing_solutions') ?></span></a>
</div>
<?php if ($publishing_solutions) { ?>
    <ul>
        <?php foreach ($publishing_solutions as $key => $value) { ?>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_PUBLISHING_SOLUTIONS . $value['id']) ?>"><?php echo $value['name'][get_locale()] ?></a></li>
        <?php } ?>
    </ul> 
<?php } ?>

<div class="bar-title" style="margin-top: 0px;">
    <a href="<?php echo get_routed_url(Urls::URL_PREFIX_EDUCATIONAL_SOLUTIONS) ?>"><span><?php echo lang('home_educational_solutions') ?></span></a>
</div>
<?php if ($educational_solutions) { ?>
    <ul>
        <?php foreach ($educational_solutions as $key => $value) { ?>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_EDUCATIONAL_SOLUTIONS . $value['id']) ?>"><?php echo $value['name'][get_locale()] ?></a></li>
        <?php } ?>
    </ul> 
<?php } ?>

<div class="bar-title" style="margin-top: 0px;">
    <a href="<?php echo get_routed_url(Urls::URL_PREFIX_DIGITAL_SOLUTIONS) ?>"><span><?php echo lang('home_digital_solutions') ?></span></a>
</div>
<?php if ($digital_solutions) { ?>
    <ul>
        <?php foreach ($digital_solutions as $key => $value) { ?>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_DIGITAL_SOLUTIONS . $value['id']) ?>"><?php echo $value['name'][get_locale()] ?></a></li>
        <?php } ?>
    </ul> 
<?php } ?>

<div class="bar-title" style="margin-top: 0px;">
    <a href="<?php echo get_routed_url(Urls::URL_PREFIX_CUSTOM_SOLUTIONS) ?>"><span><?php echo lang('home_custom_solutions') ?></span></a>
</div>
<?php if ($custom_solutions) { ?>
    <ul>
        <?php foreach ($custom_solutions as $key => $value) { ?>
            <li><a href="<?php echo get_routed_url(Urls::URL_PREFIX_CUSTOM_SOLUTIONS . $value['id']) ?>"><?php echo $value['name'][get_locale()] ?></a></li>
        <?php } ?>
    </ul> 
<?php } ?>
<?php if($side_banner){ ?>
<a href="<?php echo base_url().$side_banner['ajax_banner'] ?>" class="lightbox_trigger">
    <img src="<?php echo base_url().$side_banner['side_banner'] ?>" width="162" height="174" />
</a>
<?php }else{?>
<a href="<?php echo base_url() ?>layout/images/for-limited-time-img.jpg" class="lightbox_trigger">
    <img src="<?php echo base_url() ?>layout/images/for-limited-time-img.jpg" width="162" height="174" />
</a>
<?php } ?>
<script>
    jQuery(document).ready(function($) {

        $('.lightbox_trigger').click(function(e) {

            //prevent default action (hyperlink)
            e.preventDefault();

            //Get clicked link href
            var image_href = $(this).attr("href");

            /* 	
             If the lightbox window HTML already exists in document, 
             change the img src to to match the href of whatever link was clicked
             
             If the lightbox window HTML doesn't exists, create it and insert it.
             (This will only happen the first time around)
             */

            if ($('#lightbox').length > 0) { // #lightbox exists

                //place href as img src value
                $('#lightbox_content').html(
                        '<div class="lightbox-close"></div>' +
                        '<div style="clear:both"></div>' +
                        '<img src="' + image_href + '" width="500" />'
            );

                //show lightbox window - you could use .show('fast') for a transition
                $('#lightbox').show();
            }

            else { //#lightbox does not exist - create and insert (runs 1st time only)

                //create HTML markup for lightbox window
                var lightbox =
                        '<div id="lightbox">' +
                        '<div id="lightbox_content">' + //insert clicked link's href into img src
                        '<div class="lightbox-close"></div>' +
                        '<div style="clear:both"></div>' +
                        '<img src="' + image_href + '" width="500" />' +
                        '</div>' +
                        '</div>';

                //insert lightbox HTML into page
                $('body').append(lightbox);
            }
            $('#lightbox').css('height',$(document).height()+'px');
            $('html, body').animate({ scrollTop: 0 }, 0);
        });

        //Click anywhere on the page to get rid of lightbox window
        $('.lightbox-close').live('click', function() { //must use live, as the lightbox element is inserted into the DOM
            $('#lightbox').hide();
        });

    });
</script>