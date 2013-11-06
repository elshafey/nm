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
        $('#lightbox').css('height', $(document).height() + 'px');
        $('html, body').animate({scrollTop: 0}, 0);
    });

    //Click anywhere on the page to get rid of lightbox window
    $('.lightbox-close').live('click', function() { //must use live, as the lightbox element is inserted into the DOM
        $('#lightbox').hide();
    });

});