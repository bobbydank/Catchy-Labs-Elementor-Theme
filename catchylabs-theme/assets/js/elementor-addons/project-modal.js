(function ($) {

    $(document).ready(function() {

        $('.cl-project-modal-container').each(function (index, element) {
            let $modal = $(element).find('.cl-project-modal');
            $modal.insertBefore('footer');
        });

        if (window.location.href.indexOf('#') > 0) {
            //$('body,html').css('overflow', 'hidden');
        }

        $('.cl-project-link').click(function () {
            //$('body,html').css('overflow', 'hidden');
        });

        $('.cl-project-modal a[href="#close"]').click(function () {
            $('body,html').removeAttr('style')
        });

    });

})(jQuery);