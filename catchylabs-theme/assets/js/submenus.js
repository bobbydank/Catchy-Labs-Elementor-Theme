// JavaScript Document
(function ($) {

$(document).ready(function() {

	sgo_create_submenus();
	//sgo_full_submenus();

	/*
	if ($(window).width() > 1000) {
		if ($('.the-submenu.keep-alive, #president-button').length) {
			$('body').data('size','big');

			$(window).scroll(function(){
				if($(document).scrollTop() > 0){
					//if ($('body').data('size') == 'big') {
						$('body').data('size','small');

						$('.the-submenu.keep-alive').slideUp('fast', function () {
							$('#submenu .keep-alive').removeClass('over').css('display','none');
						});

						if ($('#president-button').length) {
							$('#president-button').slideUp();
						}
					//}
				} else {
					//if($('body').data('size') == 'small'){
						$('body').data('size','big');

						$('.the-submenu.keep-alive').slideDown('fast', function () {
							$('#submenu .keep-alive').addClass('over').removeAttr('style');
						});

						if ($('#president-button').length) {
							$('#president-button').slideDown();
						}
					//}
				}
			});
		}
	}*/

	//nav menu drop downs
	function addMenu() {
		if ($(window).width() > 950) {
			if ($('.search').is(':visible')) {
				$('.search').slideUp();
			}

			if ($('#president-button').is(':visible')) {
				$('#president-button').slideUp();
			}

			var $this = $(this);

			if ($this.hasClass('menu-item-has-children') && !$(this).hasClass('over') ) {
				var rel = parseInt($this.attr('rel'));

				if ($('.main-nav-search .search').is(':visible')) {
					$('.main-nav-search .search').slideUp();
				}

				if (!$('.submenu-'+rel).hasClass('over')) {
					if ($('#submenu').is(':visible')) {
						//console.log('here');
						$('#submenu').slideUp('fast', function () {
							$('.submenu.over').removeClass('over').css('display','none');
							$('.submenu-'+rel).addClass('over').css('display','block');
							$('#submenu').slideDown();
						});
					} else {
						$('.submenu-'+rel).addClass('over').css('display','block');
						$('#submenu').slideDown();

					}

					/*console.log($('.submenu-'+rel).height());
					if ($('.submenu-'+rel).height() < 40) {
						$('.submenu-'+rel).addClass('no-border');
					}*/
				}

			}
		}

		$(this).removeClass('close').addClass('over');
    }
    function removeMenu() {
		$(this).removeClass('over').addClass('close');
	}

	//assign hovers
	$("#masthead .nav-menu .menu > li").hoverIntent(addMenu, removeMenu);

	//additional hovers
	$("#submenu").on('mouseleave',function () {
		cmw_stuff();
	});

	/*$('#header-top').on('mouseenter',function () {
		cmw_stuff();
	});*/

	calculateLIsInRow();
	$(window).resize(calculateLIsInRow);

});

function cmw_stuff() {
	if ($(window).width() > 950) {
		//$('.submenu.no-border').removeClass('no-border');

		if ($('#submenu .keep-alive').length) {
			if (!$('#submenu .keep-alive').hasClass('over')) {
				$('#submenu').slideUp('fast', function () {
					$('.submenu.over').removeClass('over').removeAttr('style');
					$('#submenu .keep-alive').addClass('over').removeAttr('style');
					$('#submenu').slideDown('fast');
				});
			}
		} else {
			$('#submenu').slideUp('fast', function () {
				if ($('#president-button').length) {
					$('#president-button').slideDown();
				}
			});
			$('.submenu.over').removeClass('over').removeAttr('style');
		}
		//console.log('mouseout');
	}
}

function sgo_create_submenus() {
	var count = 0;
    var pad = $('.page-current-title').innerWidth() + 50; 
    //console.log(pad);
    
	$('#masthead .nav-menu .menu li.menu-item-has-children').each(function(index, element) {
        //console.log(element);
		$(element).attr('rel',count);

		//create div area
		if ($(element).hasClass('current_page_item') || $(element).hasClass('current-page-ancestor')) {
			$('#submenu').addClass('keep-alive');
			$('#submenu .inner').append('<div class="submenu section over keep-alive submenu-'+count+'"></div>');
		} else {
			$('#submenu .inner').append('<div class="submenu section submenu-'+count+'"></div>');
		}

		//copy ul.children to submenu area
		$(element).find('ul.sub-menu').css('padding-right', pad).clone().appendTo('.submenu-'+count);

		count++;
    });
}

function calculateLIsInRow() {
    var lisInRow = 0;
    $('.the-submenu li').each(function(index, element) {
        var $this = $(element);
        
        $this.removeClass("end-of-row").attr('data-top', $this.position().top);
        //console.log($this.offset());
        
        if($this.prev().length > 0) {
            if($this.position().top != $this.prev().position().top) {
               $this.prev().addClass("end-of-row");
               // return false;
            }
            lisInRow++;
        } else {
            lisInRow++;
        }
        if($this.next().length > 0) {
        
        } else {
            $this.addClass("end-of-row");
        }
    });
}

})(jQuery);// JavaScript Document
