(function(api) {

    api.sectionConstructor['wedding-event-management-upsell'] = api.Section.extend({

        // Remove events for this section.
        attachEvents: function() {},

        // Ensure this section is active. Normally, sections without contents aren't visible.
        isContextuallyActive: function() {
            return true;
        }
    });

    const wedding_event_management_section_lists = ['banner', 'service'];
    wedding_event_management_section_lists.forEach(wedding_event_management_homepage_scroll);

    function wedding_event_management_homepage_scroll(item, index) {
        // Detect when the front page sections section is expanded (or closed) so we can adjust the preview accordingly.
        item = item.replace(/-/g, '_');
        wp.customize.section('wedding_event_management_' + item + '_section', function(section) {
            section.expanded.bind(function(isExpanding) {
                // Value of isExpanding will = true if you're entering the section, false if you're leaving it.
                wp.customize.previewer.send(item, { expanded: isExpanding });
            });
        });
    }
})(wp.customize);

// Example JavaScript/jQuery for tab interaction
jQuery(document).ready(function($) {
    $('.customize-control-radio input[type="radio"]').change(function() {
        // Remove active class from all labels
        $('.customize-control-radio label').removeClass('active');
        
        // Add active class to the selected label
        $(this).next('label').addClass('active');
    });
});

jQuery(document).ready(function($) {
    $('#wedding-event-management-custom-container img').on('click', function() {
        $('#wedding-event-management-custom-container img').removeClass('wedding-event-management-selected-img');
        $(this).addClass('wedding-event-management-selected-img');
        $(this).prev('input[type="radio"]').prop('checked', true).trigger('change');
    });
});