/**
 * File custom.js.
 *
 * JS Customization
 */
( function($) {
	console.log('loaded');
        $(function(){
        $('.attachment-post-thumbnail').addClass('uk-overlay-scale');
    });
    $(".brd").remove();
    $(document).ready( function () {
    $('.embedly-card').load( function () {
        $('this').contents().find(".brd").css("display","none");
    });
});
} )(jQuery);


jQuery(window).scroll(function (event) {
    if(jQuery(window).scrollTop() !== 0 ){
        jQuery('.sticky-navbar').addClass('uk-active-js');
        jQuery('.sticky-navbar').removeClass('uk-inactive-js');
        jQuery('.uk-navbar-toggle').removeClass('uk-contrast');
    }
    else if(jQuery('body').hasClass('home')){
        jQuery('.sticky-navbar').removeClass('uk-active-js');
        jQuery('.sticky-navbar').addClass('uk-inactive-js');
        jQuery('.uk-navbar-toggle').addClass('uk-contrast');
    } 
});

if(!jQuery('body').hasClass('home')) {
    jQuery('.sticky-navbar').addClass('uk-active-js');
    jQuery('.sticky-navbar').removeClass('uk-inactive-js');
    jQuery('.uk-navbar-toggle').removeClass('uk-contrast');
}