<?php
/**
 * Front Page Options
 *
 * @package Wedding Event Management
 */

$wp_customize->add_panel(
	'wedding_event_management_front_page_options',
	array(
		'title'    => esc_html__( 'Front Page Options', 'wedding-event-management' ),
		'priority' => 20,
	)
);

// Banner Section.
require get_template_directory() . '/theme-library/customizer/front-page-options/banner.php';

// Tranding Product Section.
require get_template_directory() . '/theme-library/customizer/front-page-options/testimonial.php';