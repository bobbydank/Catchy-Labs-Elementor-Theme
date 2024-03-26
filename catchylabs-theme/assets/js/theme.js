(function ($) {
    
$(window).load(function () {
	
});
    
$(document).ready(function () {
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

	//https://dimsemenov.com/plugins/magnific-popup/documentation.html
	$('.popup-video').magnificPopup({
		type: 'iframe',
		fixedContentPos: false
	});
	$('.popup-gallery').each(function (i,e) {
		$(e).magnificPopup({
			delegate: 'a', // child items selector, by clicking on it popup will open
			type: 'image',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
			}
		});
	});
    
    //resizes the main nav on scroll
	main_nav_resizing();
});
    
function main_nav_resizing() {
	$('header.fixed').data('size','big');

	$(window).scroll(function () {
		if ($(window).width() > 1000) {
			if($(document).scrollTop() > 50){
				if($('header.fixed').data('size') == 'big'){
					$('header.fixed').data('size','small').addClass('scrolled');
				}
			} else {
				if($('header.fixed').data('size') == 'small'){
					$('header.fixed').data('size','big').removeClass('scrolled');
				}
			}
		}
	});
}
})(jQuery);