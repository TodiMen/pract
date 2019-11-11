jQuery(document).ready(function ($) {

  $("#businessup-slider").owlCarousel({
	animateOut: 'slideOutDown',
        animateIn: 'flipInX',
        navigation: true, // Show next and prev buttons
        slideSpeed: 200,
        pagination: true,
        paginationSpeed: 400,
        singleItem: true,
        autoPlay: true,
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ]
  });
 });


/* =================================
===         SCROLL TOP       ====
=================================== */
(function($) {
  "use strict";
jQuery(".ta_upscr").hide(); 
function taupr() {
  jQuery(window).on('scroll', function() {
    if ($(this).scrollTop() > 500) {
        $('.ta_upscr').fadeIn();
    } else {
      $('.ta_upscr').fadeOut();
    }
  });   
  $('a.ta_upscr').on('click', function()  {
    $('body,html').animate({
      scrollTop: 0
    }, 800);
    return false;
  });
}    
taupr();
})(jQuery);

