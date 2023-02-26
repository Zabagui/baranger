//SCROLL TO TOP
$(document).ready(function () {
  $('.scroll-to-top').hide();
  //Check to see if the window is top if not then display button
  $(window).scroll(function () {
  if ($(this).scrollTop() > 300) {
    $('.scroll-to-top').fadeIn();
  } else {
    $('.scroll-to-top').fadeOut();
  }
});
$('.scroll-to-top').click(function () {
  $('html, body').animate({ scrollTop: 0 }, 800);
  return false;
  });
});

//SLIDESHOW
$(window).on('load', function() {
  $('#slider').nivoSlider({
      effect:'boxRainGrow',
      slices: 25,
      boxCols: 15, // For box animations
      boxRows: 8, // For box animations
      animSpeed:2000,
      pauseTime:9000,
      directionNav:false,
      captionOpacity:0.80, //Universal caption opacity
      controlNav:false,
      keyboardNav:false,
      pauseOnHover:false
        });
});

//The effect parameter can be any of the following:
//
//    sliceDown
//    sliceDownLeft
//    sliceUp
//    sliceUpLeft
//    sliceUpDown
//    sliceUpDownLeft
//    fold
//    fade
//    random
//    slideInRight
//    slideInLeft
//    boxRandom
//    boxRain
//    boxRainReverse
//    boxRainGrow
//    boxRainGrowReverse

// TICKER www.alexefish.com
(function($) {
    $.fn.list_ticker = function(options) {
        var defaults = {
            speed: 8000,
            effect: 'slide'
        };
        var options = $.extend(defaults, options);
        return this.each(function() {
            var obj = $(this);
            var list = obj.children();
            list.not(':first').hide();
            setInterval(function() {
                list = obj.children();
                list.not(':first').hide();
                var first_li = list.eq(0)
                var second_li = list.eq(1)
                if (options.effect == 'slide') {
                    first_li.slideUp();
                    second_li.slideDown(function() {
                        first_li.remove().appendTo(obj);
                    });
                } else if (options.effect == 'fade') {
                    first_li.fadeOut(function() {
                        second_li.fadeIn();
                        first_li.remove().appendTo(obj);
                    });
                }
            }, options.speed)
        });
    };
})(jQuery);
$(function() {
    $('#ticker').list_ticker({
        speed: 8000,
        effect: 'fade'
    })
});

//Accordion Script
    $("#acc dd").hide();
    $("#acc dt").click(function () {
        $(this).next("#acc dd").slideToggle(300);
        $(this).toggleClass("expanded");
    });
    
