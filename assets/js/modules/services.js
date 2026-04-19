/**
 * Services Module (Monday.com Replica)
 * Handles the interactive tags-and-assets style component
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        // Elements
        const $tagItems = $('.tag-component');
        const $bgLayers = $('.bg-img');
        const $serviceDescs = $('.service-desc');

        if ($tagItems.length === 0) return; // Exit if no interactive services block

        $tagItems.on('mouseenter', function() {
            const index = $(this).data('index');

            // Remove active class from all
            $tagItems.removeClass('active');
            $bgLayers.removeClass('active');
            $serviceDescs.removeClass('active');

            // Add active class to corresponding element
            $(this).addClass('active');

            // Find elements with matching index
            $(`.bg-img[data-index="${index}"]`).addClass('active');
            $(`.service-desc[data-index="${index}"]`).addClass('active');
        });
        
        // Optional: on click for mobile devices (fallback for touch where mouseenter might be an issue)
        $tagItems.on('click', function() {
             $(this).trigger('mouseenter');
        });
    });
})(jQuery);
