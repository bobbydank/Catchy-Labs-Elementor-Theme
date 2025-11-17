(function ($) {
    
$(window).on('load', function () {
	
});
    
$(document).ready(function () {
	
	if ($('.cl-simple-modal').length) {
		$(document).keyup(function(e) {
			if (e.key === "Escape") {     // escape key maps to keycode `27`
				var url = location.href;  //Save down the URL without hash.
    			location.href = "#close"; //Go to the target element.
    			history.replaceState(null,null,url);
			}
		});
	}

	//review slider
	if ($('.cl-review-slider2').length) {
		$('.cl-review-slider2').each(function (i, e) {
			var time = parseInt( $(e).attr('data-time') );
			$(e).find('.cl-review-container').slick({
				dots: false,
				infinite: true,
				speed: 300,
				slidesToShow: 1,
				autoplay: true,
				autoplaySpeed: time,
				adaptiveHeight: false,
				prevArrow: $(e).find('.fa-arrow-left'),
				nextArrow: $(e).find('.fa-arrow-right')
			});
		});
	}

	if ($('.b3-drop-list').length) {
		$('.b3-drop-list li .list-title').each(function () {
			$(this).click(function () {
				var $item = $(this).parent()
				var c = $item.attr('class')

				if (!$item.hasClass('active')) {
					$item.parent().find('li.active').removeClass('active')
					$item.find('.content').slideDown('fast', function () {
						$item.addClass('active')
					});
				}
			})
		})
	}

	if ($('.b3-circle-graphic').length) {
		$('.b3-circle-graphic .b3-cg-right a').each(function () {
			$(this).click(function (e) {
				e.preventDefault()

				var classes = $(this).attr('class')

				//position indicator
				if (!$('.b3-circle-graphic .b3-cg-right span').hasClass(classes)) {
					$('.b3-circle-graphic .b3-cg-right span').removeAttr('class').addClass(classes)
				}

				//content
				if (!$('.b3-circle-graphic .b3-cg-left div.active').hasClass(classes)) {
					$('.b3-circle-graphic .b3-cg-left div.active').slideUp('fast', function () {
						$(this).removeClass('active')
						$('.b3-circle-graphic .b3-cg-left .content').find('.'+classes).slideDown('fast', function () {
							$(this).addClass('active')
						})
					})

					if ($(window).width() < 951) {
						$('html, body').animate({
							scrollTop: $(".b3-circle-graphic .b3-cg-left").offset().top - 100
						}, 500);
					}
				}
			})
		})
	}

	if ($('.b3-sliders').length) {
        $('.b3-sliders').each(function (i,e) {
			var speed = parseInt( $(e).attr('data-time') );
			console.log(speed);

            $(e).find('.b3-slider-container').slick({
              dots: false,
              infinite: true,
              speed: 300,
			  autoplay: true,
  			  autoplaySpeed: speed,
              slidesToShow: 1,
              adaptiveHeight: false
            }); 
        });
    }

	if ($('cl-image-comparison').length) {
		$('.image-comparison-hover.before').click(function () {
			$(this).toggleClass('on');
			$(this).parent().addClass('hover-off');
			$(this).parent().find('.image-comparison-hover.after').removeClass('on');
		});
		  
		$('.image-comparison-hover.after').click(function () {
			$(this).toggleClass('on');
			$(this).parent().addClass('hover-off');
			$(this).parent().find('.image-comparison-hover.before').removeClass('on');
		});
	}	

	$('.cl-dropper-button').click(function () {
		const $this = $(this).find('a');
		const id = $this.attr('href');
		const $container = $('.cl-drop-down'+id);

		if ($container.hasClass('active')) {
			$container.slideUp('fast', function () {
				$container.removeClass('active');
			});
		} else {
			$container.slideDown('fast', function () {
				$container.addClass('active');
			});
		}
	});

	$('.cl-dropper-title').click(function () {
		const $this = $(this);
		const id = $this.attr('data-id');
		const $container = $('.cl-drop-down#'+id);
		
		$('.cl-dropper-title.on').removeClass('on');

		if ($container.hasClass('active')) {
			$('.cl-drop-down.active').slideDown().addClass('active');
			$container.slideUp('fast', function () {
				$container.removeClass('active');
			});
			$this.removeClass('on');
		} else {
			$('.cl-drop-down.active').slideUp().removeClass('active');
			$container.slideDown('fast', function () {
				$container.addClass('active');
			});
			$this.addClass('on');
		}
	});

	//search icons
    $('.cl-search-icon').click(function () {
		if (!$('#search-form-overlay').is(':visible')) {
		  $('#search-form-overlay').fadeIn();
		}
	});
	$('.icon-cancel').click(function () {
		if ($('#search-form-overlay').is(':visible')) {
		  $('#search-form-overlay').fadeOut();
		}
	});
});
    
})(jQuery);