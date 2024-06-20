(function ($) {

$(window).resize(function () {
	//brand_resizer();

  /*if ($('.brand-statement').length) {
		$('.brand-statement').animate({left: 0}, 1000, function () {
			$('.brand-statement').delay(5000).animate({left: '-100%'}, 1000);
		});
	}*/
});

$(document).ready(function() {
  //brand_resizer();

  if ($('.brand-window').length) {
  	$('.brand-window.zooming-mark').each(function (i,e) {
  		$(e).removeClass('zooming-mark').addClass('zooming');
  	});

    var time = parseInt( $('.brand-window').attr('data-time') );

		if ($('.brand-window .container > div').length > 1) {
			window.timer = window.setInterval(function() {
				tha_brandRotatorLoop('+');
			}, time);

			/*$('.brand-controls li').click(function () {
				tha_brandRotatorLoop($(this).attr('data-count'));
			});

			$('.brand-image').click(function () {
				window.location.href = $(this).attr('data-url');
			});*/
		}
	}
});

//functions
function tha_brandRotatorLoop(direction) {
  	var count = $(".brand-window .container").children(".brand-image").length;
	var active = $('.brand-window .active').index();
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

	$(".brand-window .active").fadeOut(1000, function () {
		$(this).removeClass('active');
	});
    $(".brand-window").find(".brand-image").eq(next).fadeIn(1000, function () {
		$(this).addClass('active');
	});
	//$('#brand-controls li.active').removeClass('active');
	//$('#brand-controls li[data-count="'+next+'"]').addClass('active');
}

function brand_resizer() {
	if ($('.brand-window').length) {
		if ($(window).width() < 800) {
			$('.brand-window').removeAttr('style');
		} else {
			var h = $(window).height() - $('header').height();

			$('.brand-window').css({
				'height' : h,
			});
		}
	}
}

})(jQuery);
