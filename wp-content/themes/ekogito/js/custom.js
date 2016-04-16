/**
 * File custom.js.
 *
 * JS Customization
 */
( function($) {
	console.log('loaded');
    	$(function() {
      $('.attachment-post-thumbnail').addClass('uk-overlay-scale');
    });
    $(".brd").remove();
    $(document).ready( function () {
    $('.embedly-card').load( function () {
        $('this').contents().find(".brd").css("display","none");
    });
});
} )(jQuery);