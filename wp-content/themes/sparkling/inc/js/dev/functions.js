// Bootstrap specific functions and styling
jQuery(document).ready(function() {

    // here for each comment reply link of WordPress
    jQuery('.comment-reply-link').addClass('btn btn-sm btn-default');

    // here for the submit button of the comment reply form
    jQuery('#submit, button[type=submit], button, html input[type=button], input[type=reset], input[type=submit]').addClass('btn btn-default');

    // Now we'll add some classes for the WordPress default widgets - let's go
    jQuery('.widget_rss ul').addClass('media-list');

    // Add Bootstrap style for drop-downs
    jQuery('.postform').addClass('form-control');

    // Add Bootstrap styling for tables
    jQuery('table#wp-calendar').addClass('table table-striped');

    jQuery('#submit, .tagcloud, button[type=submit], .comment-reply-link, .widget_rss ul, .postform, table#wp-calendar').show("fast");

});

// jQuery powered scroll to top