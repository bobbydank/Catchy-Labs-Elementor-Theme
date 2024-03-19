(function ($) {

$(document).ready(function() {

	if ($('#b3-sliders').length) {
        
        $('#b3-sliders').each(function (i, e) {
            var time = parseInt( $(e).attr('data-time') );
            
            if ($(e).find('.b3-slider').length > 1) {
                window.timer = window.setInterval(function() {
                    var direction = '+';
                    
                    var count = $(e).children('.b3-slider').length;
                    var active = $(e).find('.active').index();
                    var next;
                    
                    if (direction == '+') {
                        if (active < count - 1) {
                            next = active + 1;
                        } else {
                            next = 0;
                        }
                    } else {
                        next = direction;
                    }
                    
                    $(e).find('.active').fadeOut(1000, function () {
                        $(this).removeClass('active');
                    });
                    $(e).find('.b3-slider').eq(next).fadeIn(1000, function () {
                        $(this).addClass('active');
                    });
                }, time);
            }
        });
	}

});

function tha_brandRotatorLoop(direction) {
  var count = $("#home-hero.rotator").children("article").length;
  var active = $('#home-hero.rotator .active').index();
  var next;

  if (direction == '+') {
    if (active < count - 1) {
    	next = active + 1;
    } else {
    	next = 0;
    }
  } else {
    next = direction;
  }

  $("#home-hero.rotator .active").fadeOut(1000, function () {
    $(this).removeClass('active');
  });
  $("#home-hero.rotator").find("article").eq(next).fadeIn(1000, function () {
    $(this).addClass('active');
  });
  //$('#brand-controls li.active').removeClass('active');
  //$('#brand-controls li[data-count="'+next+'"]').addClass('active');
}

})(jQuery);