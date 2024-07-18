(function ($) {
    
$(window).on('load', function () {
	
});
    
$(document).ready(function () {
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
	$('.cl-video-popup a').magnificPopup({
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
			}
		});
	});
    
    //resizes the main nav on scroll
	if ($('header.fixed').length) {
		main_nav_resizing();
	}

	//modal opener
	$('.cl-elementor-modal-opener a').on('click', function(event) {
        event.preventDefault(); // Prevent the default action
		
        var hash = this.hash; // Get the hash from the clicked link
        var currentUrl = window.location.href.split('#')[0]; // Get the current URL without any hash
        window.location.href = currentUrl + hash; // Append the hash to the current URL and navigate
    });
});
    
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

})(jQuery);