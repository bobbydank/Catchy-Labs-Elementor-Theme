(function ($) {

$(document).ready(function() {
  	//cl_shadowboxHandling();

	cl_create_fullsubmenus();
	$('.navbar-toggle').click(function () {
		if ($('#full-menu').hasClass('open')) {
			$(this).find('#cl-hamburger').removeClass('open');
			$('#full-menu').removeClass('open');
		} else {
			$(this).find('#cl-hamburger').addClass('open');
			$('#full-menu').addClass('open');
		}
	});
	$('#full-menu .close').click(function () {
		$('#cl-hamburger').removeClass('open');
		$('#full-menu').removeClass('open');
	});
	$('#full-menu .plus').click(function () {
		var $submenu = $(this).parent().find('> ul');

		if ($(this).hasClass('open')) {
			$submenu.slideUp();
			$(this).removeClass('open');
		} else {
			$submenu.slideDown();
			$(this).addClass('open');
		}
	});

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

});

//functions
function cl_create_fullsubmenus() {
	$('#full-menu ul.menu > li').each(function(index, element) {
		if ($(element).find('ul.sub-menu').length) {
			$(element).append('<div class="plus"><span></span><span></span></div>');
		}
    });
}

function cl_shadowboxHandling() {
	Shadowbox.init({
		overlayColor	: '#000',
		overlayOpacity	: 0.8,
		onClose			: SBClose,
		onOpen			: SBOpen,
		//skipSetup: true,
	});

	//console.log('here');

	function SBOpen() {
		$('body').css({
			'height' : '100%',
			'overflow' : 'hidden'
		});

		if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {

			$('#sb-body-inner').css({
				'overflow': 'scroll',
				'-webkit-overflow-scrolling': 'touch'
			});

		}
	}

	function SBClose() {
		$('body').removeAttr('style');
	}
}

})(jQuery);
