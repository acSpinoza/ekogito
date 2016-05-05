/**
 * File custom.js.
 *
 * JS Customization
 */
 
 
( function($) {
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

(function($) {
  "use strict";
  UIkit.on('domready.uk.dom', function() {
    //Change slideshow on focuschange of slider
    var slideshow = UIkit.slideshow('#slideshow');
    $('#slider').on('focusitem.uk.slider', function(event, index, item, slider) {
      slideshow.show($(item).data('ukSlideshowItem'));
    });
  });
}(jQuery));
//other way to reach component on init
UIkit.on('init.uk.component', function(e, name, component) {
  if (name === 'slideshow') {
    UIkit.$('#autoplay').on('change.uk.button', function(e, active) {
      component[(active ? 'start' : 'stop')]();
    });
  }
});


/*(function($) {
 $('.uk-slideshow li').hover(function(){
   console.log(this);
   $(this).find('figcaption').fadeOut();
  
 });
  $('.uk-slideshow li').mouseout(function(){
   console.log(this);
   $(this).find('figcaption').fadeIn();
  
 })
}(jQuery));*/