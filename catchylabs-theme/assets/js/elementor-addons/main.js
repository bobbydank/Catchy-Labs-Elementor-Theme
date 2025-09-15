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

	// Post Feed Filters - Custom Dropdown
	if ($('.post-feed-filters').length) {
		// Handle dropdown toggle
		$('.dropdown-toggle').on('click', function(e) {
			e.preventDefault();
			e.stopPropagation();
			
			const $dropdown = $(this).closest('.custom-dropdown');
			const $menu = $dropdown.find('.dropdown-menu');
			const $toggle = $(this);
			
			// Close other dropdowns
			$('.custom-dropdown').not($dropdown).find('.dropdown-menu').removeClass('show');
			$('.dropdown-toggle').not($toggle).removeClass('active');
			
			// Toggle current dropdown
			$menu.toggleClass('show');
			$toggle.toggleClass('active');
		});

		// Close dropdown when clicking outside
		$(document).on('click', function(e) {
			if (!$(e.target).closest('.custom-dropdown').length) {
				$('.dropdown-menu').removeClass('show');
				$('.dropdown-toggle').removeClass('active');
			}
		});

		// Handle checkbox changes
		$('.checkbox-option input[type="checkbox"]').on('change', function() {
			const $dropdown = $(this).closest('.custom-dropdown');
			const taxonomy = $dropdown.data('taxonomy');
			updateDropdownText($dropdown);
		});

		// Select All functionality
		$('.select-all-btn').on('click', function(e) {
			e.preventDefault();
			const $dropdown = $(this).closest('.custom-dropdown');
			$dropdown.find('.checkbox-option input[type="checkbox"]').prop('checked', true);
			updateDropdownText($dropdown);
		});

		// Clear All functionality
		$('.clear-all-btn').on('click', function(e) {
			e.preventDefault();
			const $dropdown = $(this).closest('.custom-dropdown');
			$dropdown.find('.checkbox-option input[type="checkbox"]').prop('checked', false);
			updateDropdownText($dropdown);
		});

		// Function to update dropdown text
		function updateDropdownText($dropdown) {
			const $text = $dropdown.find('.dropdown-text');
			const $checkboxes = $dropdown.find('.checkbox-option input[type="checkbox"]:checked');
			const taxonomy = $dropdown.data('taxonomy');
			const taxonomyLabel = $dropdown.closest('.filter-group').find('> label').text().replace(':', '');
			
			if ($checkboxes.length === 0) {
				$text.text('All ' + taxonomyLabel);
			} else if ($checkboxes.length === 1) {
				// Get the term name from the data attribute
				const $option = $checkboxes.first().closest('.checkbox-option');
				const termName = $option.data('term-name');
				$text.text(termName);
			} else {
				$text.text($checkboxes.length + ' selected');
			}
		}

		// Initialize dropdown text on page load
		$('.custom-dropdown').each(function() {
			updateDropdownText($(this));
		});

		// Add loading state to apply button
		$('.apply-filters-btn').on('click', function(e) {
			const $btn = $(this);
			const $form = $btn.closest('form');
			const originalText = $btn.text();
			
			// Check if any checkboxes are checked
			const checkedBoxes = $form.find('input[type="checkbox"]:checked');
			console.log('Checked boxes:', checkedBoxes.length);
			
			// Don't prevent default - let the form submit naturally
			$btn.prop('disabled', true).text('Applying...');
			
			// Submit the form
			$form.submit();
		});

		// Also handle form submission directly
		$('.filter-form').on('submit', function(e) {
			console.log('Form submitting...');
			const checkedBoxes = $(this).find('input[type="checkbox"]:checked');
			console.log('Checked boxes on submit:', checkedBoxes.length);
			
			// If no checkboxes are checked, we still want to submit to clear filters
			return true;
		});

		// Keyboard support
		$('.dropdown-toggle').on('keydown', function(e) {
			if (e.key === 'Enter' || e.key === ' ') {
				e.preventDefault();
				$(this).click();
			}
		});

		// Prevent dropdown from closing when clicking inside
		$('.dropdown-menu').on('click', function(e) {
			e.stopPropagation();
		});
	}
});
    
})(jQuery);
