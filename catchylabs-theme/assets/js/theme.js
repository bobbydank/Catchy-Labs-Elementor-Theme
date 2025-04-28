(function ($) {
    
$(window).on('load', function () {
	
});
	
$(document).ready(function () {
	cl_resizing_function();
	$(window).resize(cl_resizing_function);
	
	if ($('.cl-dual-hover-container #normal .open').length) {
		$('.cl-dual-hover-container #normal .open a').click(function (e) {
			$('.cl-dual-hover-container #hover').removeAttr('style');
			
			e.preventDefault();
			$(this).closest('.cl-dual-hover-container').find('#hover').addClass('active');
		});
	}
	if ($('.cl-dual-hover-container #hover .close').length) {
		$('.cl-dual-hover-container #hover .close').click(function (e) {
			e.preventDefault();
			$('.cl-dual-hover-container #hover').fadeOut('fast').removeClass('active');
		});
	}

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
	$('#full-menu ul.menu > li.menu-item-has-children > a[href="#"]').click(function (e) {
		e.preventDefault();
		var $submenu = $(this).parent().find('> ul');
		var $plus = $(this).parent().find('.plus');

		if ($plus.hasClass('open')) {
			$submenu.slideUp();
			$plus.removeClass('open');
		} else {
			$submenu.slideDown();
			$plus.addClass('open');
		}
	});

	//https://dimsemenov.com/plugins/magnific-popup/documentation.html
	$('.cl-youtube-popup a').magnificPopup({
		type: 'iframe',
		fixedContentPos: false,
		iframe: {
			markup: '<div class="mfp-iframe-scaler">' +
					'<div class="mfp-close"></div>' +
					'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
					'</div>',
			patterns: {
				youtube: {
					index: 'youtube.com/',
					id: function(url) {
						// Match either embed or watch URL and extract the video ID
						var matchEmbed = url.match(/(?:youtube\.com\/embed\/)([^?&#]+)/);
						var matchWatch = url.match(/(?:youtube\.com\/watch\?v=)([^&#]+)/);
						if (matchEmbed) {
							return matchEmbed[1]; // Video ID from embed URL
						} else if (matchWatch) {
							return matchWatch[1]; // Video ID from watch URL
						}
						return null; // Fallback if no match
					},
					src: 'https://www.youtube.com/embed/%id%?autoplay=1'
				}
			}
		}
	});
	$('.cl-video-popup.iframe a').magnificPopup({
		type: 'iframe',
		fixedContentPos: false
	});
	$('.cl-popup-gallery').each(function (i,e) {
		$(e).magnificPopup({
			delegate: 'a', // child items selector, by clicking on it popup will open
			type: 'image',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				tPrev: 'Previous (Left arrow key)', // title for left button
					tNext: 'Next (Right arrow key)', // title for right button
			}
		});
	});
	
	//resizes the main nav on scroll
	if ($('header.fixed').length) {
		main_nav_resizing();
	}

	//modal opener
	$('a').on('click', function(event) {
		var href = $(this).attr('href');
		var hash = this.hash; // Get the hash from the clicked link

		if ($(this).hasClass('cl-modal-closer') || hash == '#modal-close') {
			if (isMobileScreen()) {
				event.preventDefault();

				$('.cl-modal-container').removeClass('mobile-active');
				$('#modal-container').slideUp('fast');
			}
		} else if (href && href.indexOf('#') !== -1) {
			if ($('#modal-container').find(hash).length) {
				event.preventDefault();
				
				if (isMobileScreen()) {
					$('#modal-container').find(hash).addClass('mobile-active');
					$('#modal-container').slideDown('fast');
				} else {
					var currentUrl = window.location.href.split('#')[0]; // Get the current URL without any hash
					window.location.href = currentUrl + hash; // Append the hash to the current URL and navigate
				}
			}
		}
	});
	var modals = $('.cl-elementor-modal');
	if (modals.length > 0) {
		// Create a new div with the ID 'modal-container' and append it to the body
		var $modalContainer = $('<div id="modal-container"></div>');
		
		// Find the div.page-content and get its classes
		var pageContentClasses = $('.page-content').find('> div').attr('class');

		// Add these classes to the modal-container
		if (pageContentClasses) {
			$modalContainer.addClass(pageContentClasses);
		}
		
		// Append the modal-container to the body
		$modalContainer.insertAfter('main');

		// Move each cl-elementor-modal into the new container
		modals.each(function() {
			$(this).append('<a href="#modal-close" class="cl-modal-closer"></a>');
			$(this).appendTo($modalContainer);
		});
	}

	//standing gallery
	// Loop through each standing gallery instance
	$('.cl-standing-gallery').each(function(index, element) {
		var $gallery = $(element); // Current gallery instance

		// Initialize variables for slick arrows
		var $prevArrow = $gallery.find('.nav-arrows .left-icon');
		console.log($prevArrow);
		var $nextArrow = $gallery.find('.nav-arrows .right-icon');

		// Get the autoplay speed from the data attribute of the current gallery
		var autoplaySpeed = $gallery.data('speed') * 1000; // Convert to milliseconds

		// Get the number of images in the navigation
		var navImageCount = $gallery.find('.nav-image .nav-item').length;

		// Initialize the main image slider for the current gallery
		$gallery.find('.main-image').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,  // Disable arrows on the main slider
			fade: true,     // Enable fade effect
			asNavFor: $gallery.find('.nav-image'),  // Sync with the nav slider
		});

		// Initialize the navigation (thumbnails) slider for the current gallery
		if (navImageCount >= 4) {
			// If there are 4 or more images, initialize the nav slider with slick
			$gallery.find('.nav-image').slick({
				slidesToShow: 4,    // Show 4 images in the navigation
				slidesToScroll: 1,
				asNavFor: $gallery.find('.main-image'),  // Sync with the main slider
				dots: false,        // Disable dots
				centerMode: true,   // Optional, can be removed if not needed
				focusOnSelect: true, // Allow clicking on nav to change main image
				prevArrow:"<button type='button' class='slick-prev pull-left'><img src='/wp-content/themes/catchylabs-theme/assets/images/blk-left-arrow.svg' class='arrow' alt='Previous arrow' /></button>",
        		nextArrow:"<button type='button' class='slick-next pull-right'><img src='/wp-content/themes/catchylabs-theme/assets/images/blk-right-arrow.svg' class='arrow' alt='Next arrow' /></button>",
				autoplay: true,
  				autoplaySpeed: autoplaySpeed,
				  responsive: [
					{
						breakpoint: 1300,
						settings: {
							centerMode : true,
							slidesToShow: 3
						}
					},
					{
						breakpoint: 1024,
						settings: {
							centerMode : false,
							slidesToShow: 2
						}
					},
					{
						breakpoint: 768,
						settings: {
							centerMode : false,
							slidesToShow: 1
						}
					}
				]
			});
		} else {
			// If there are less than 4 images, don't initialize slick (static layout)
			$gallery.find('.nav-image').addClass('static-nav');
		}
	});
	
});

function cl_resizing_function() {
	$('body:not(.elementor-editor-active) .cl-dual-hover-container').each(function() {
		var parentHeight = $(this).outerHeight();
		$(this).find('#hover').css('height', parentHeight);
	});
}
	
function main_nav_resizing() {
	$('header.fixed').data('size','big');

	$(window).scroll(function () {
		if($(document).scrollTop() > 50){
			if($('header.fixed').data('size') == 'big'){
				$('header.fixed').data('size','small').addClass('scrolled');
			}
		} else {
			if($('header.fixed').data('size') == 'small'){
				$('header.fixed').data('size','big').removeClass('scrolled');
			}
		}
	});

	//
}

//functions
function cl_create_fullsubmenus() {
	$('#full-menu ul.menu li.menu-item-has-children').each(function(index, element) {
		//if ($(element).find('ul.sub-menu').length) {
			$(element).append('<div class="plus"><span></span><span></span></div>');
		//}
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

function isMobileScreen() {
	var screenWidth = $(window).width();
	var screenHeight = $(window).height();

	// Check if width is less than 900px or height is less than 700px
	if (screenWidth < 900 || screenHeight < 900) {
		return true;  // Mobile device detected based on screen size
	}
	return false;  // Not a mobile device
}
	
})(jQuery);