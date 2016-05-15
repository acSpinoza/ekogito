

(function($) {
    $(document).ready(function() {
        jQuery('.sd-sharing-enabled .share-facebook a').first().attr('data-shared', jQuery('.sd-sharing-enabled .share-facebook a').last().attr('data-shared'))
        jQuery('.sd-sharing-enabled .share-twitter a').first().attr('data-shared', jQuery('.sd-sharing-enabled .share-twitter a').last().attr('data-shared'))
        
        jQuery('.sd-sharing-enabled .share-facebook a').first().attr('href', jQuery('.sd-sharing-enabled .share-facebook a').last().attr('href'))
        jQuery('.sd-sharing-enabled .share-twitter a').first().attr('href', jQuery('.sd-sharing-enabled .share-twitter a').last().attr('href'))
        
        if(jQuery('.sd-sharing-enabled .share-facebook .share-count').first().text() >= 1) { 
            jQuery('.sd-sharing-enabled .share-facebook span').first().prepend(jQuery('.sd-sharing-enabled .share-facebook .share-count').last());
        }
        if(jQuery('.sd-sharing-enabled .share-twitter .share-count').first().text() >= 1) { 
            jQuery('.sd-sharing-enabled .share-twitter span').first().prepend(jQuery('.sd-sharing-enabled .share-twitter .share-count').last());
        }
    });
})(jQuery);