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

$(window).on('load', function() {
  $('#slider').nivoSlider({
      effect:'fade',
      animSpeed:2000,
      pauseTime:7000,
      directionNav:false,
      captionOpacity:0.80, //Universal caption opacity
      controlNav:false,
      keyboardNav:false,
      pauseOnHover:false
        });
});
