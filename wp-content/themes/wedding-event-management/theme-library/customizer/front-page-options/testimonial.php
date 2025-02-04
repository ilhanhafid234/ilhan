<?php

/**
 * Testimonial Section
 *
 * @package wedding_event_management
 */

$wp_customize->add_section(
	'wedding_event_management_testimonial_section',
	array(
		'panel'    => 'wedding_event_management_front_page_options',
		'title'    => esc_html__( 'Testimonial Section', 'wedding-event-management' ),
		'priority' => 10,
	)
);

// Testimonial Section - Enable Section.
$wp_customize->add_setting(
	'wedding_event_management_enable_testimonial_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'wedding_event_management_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Event_Management_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_event_management_enable_testimonial_section',
		array(
			'label'    => esc_html__( 'Enable Testimonial Section', 'wedding-event-management' ),
			'section'  => 'wedding_event_management_testimonial_section',
			'settings' => 'wedding_event_management_enable_testimonial_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'wedding_event_management_enable_testimonial_section',
		array(
			'selector' => '#wedding_event_management_service_section .section-link',
			'settings' => 'wedding_event_management_enable_testimonial_section',
		)
	);
}

// Testimonial Section - Button Label.
$wp_customize->add_setting(
	'wedding_event_management_testimonial_heading',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'wedding_event_management_testimonial_heading',
	array(
		'label'           => esc_html__( 'Heading', 'wedding-event-management' ),
		'section'         => 'wedding_event_management_testimonial_section',
		'settings'        => 'wedding_event_management_testimonial_heading',
		'type'            => 'text',
		'active_callback' => 'wedding_event_management_is_testimonial_section_enabled',
	)
);

// Testimonial Section - Button Label.
$wp_customize->add_setting(
	'wedding_event_management_testimonial_content',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'wedding_event_management_testimonial_content',
	array(
		'label'           => esc_html__( 'Content', 'wedding-event-management' ),
		'section'         => 'wedding_event_management_testimonial_section',
		'settings'        => 'wedding_event_management_testimonial_content',
		'type'            => 'text',
		'active_callback' => 'wedding_event_management_is_testimonial_section_enabled',
	)
);

// Testimonial Section - Content Type.
$wp_customize->add_setting(
	'wedding_event_management_testimonial_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'wedding_event_management_sanitize_select',
	)
);

$wp_customize->add_control(
	'wedding_event_management_testimonial_content_type',
	array(
		'label'           => esc_html__( 'Select Content Type', 'wedding-event-management' ),
		'section'         => 'wedding_event_management_testimonial_section',
		'settings'        => 'wedding_event_management_testimonial_content_type',
		'type'            => 'select',
		'active_callback' => 'wedding_event_management_is_testimonial_section_enabled',
		'choices'         => array(
			'page' => esc_html__( 'Page', 'wedding-event-management' ),
			'post' => esc_html__( 'Post', 'wedding-event-management' ),
		),
	)
);

// Services Category Setting.
$wp_customize->add_setting('wedding_event_management_services_category', array(
	'default'           => 'testimonial',
	'sanitize_callback' => 'sanitize_text_field',
));

// Add custom control for Services Category with conditional visibility.
$wp_customize->add_control(new Wedding_Event_Management_Customize_Category_Dropdown_Control($wp_customize, 'wedding_event_management_services_category', array(
	'label'    => __('Select Services Category', 'wedding-event-management'),
	'section'  => 'wedding_event_management_testimonial_section',
	'settings' => 'wedding_event_management_services_category',
	'active_callback' => function() use ($wp_customize) {
		return $wp_customize->get_setting('wedding_event_management_testimonial_content_type')->value() === 'post';
	},
)));

for ( $wedding_event_management_i = 1; $wedding_event_management_i <= 2; $wedding_event_management_i++ ) {

	// Testimonial Section - Select Post.
	$wp_customize->add_setting(
		'wedding_event_management_testimonial_content_post_' . $wedding_event_management_i,
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'wedding_event_management_testimonial_content_post_' . $wedding_event_management_i,
		array(
			'label'           => esc_html__( 'Select Post ', 'wedding-event-management' ) . $wedding_event_management_i,
			'description'     => sprintf( esc_html__( 'Kindly :- Select a Post based on the category selected in the upper settings', 'wedding-event-management' ), $wedding_event_management_i ),
			'section'         => 'wedding_event_management_testimonial_section',
			'settings'        => 'wedding_event_management_testimonial_content_post_' . $wedding_event_management_i,
			'active_callback' => 'wedding_event_management_is_service_section_and_content_type_post_enabled',
			'type'            => 'select',
			'choices'         => wedding_event_management_get_post_choices(),
		)
	);

	// Testimonial Section - Select Page.
	$wp_customize->add_setting(
		'wedding_event_management_testimonial_content_page_' . $wedding_event_management_i,
		array(
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'wedding_event_management_testimonial_content_page_' . $wedding_event_management_i,
		array(
			'label'           => esc_html__( 'Select Page ', 'wedding-event-management' ) . $wedding_event_management_i,
			'section'         => 'wedding_event_management_testimonial_section',
			'settings'        => 'wedding_event_management_testimonial_content_page_' . $wedding_event_management_i,
			'active_callback' => 'wedding_event_management_is_service_section_and_content_type_page_enabled',
			'type'            => 'select',
			'choices'         => wedding_event_management_get_page_choices(),
		)
	);

	$wp_customize->add_setting(
		'wedding_event_management_enable_social' . $wedding_event_management_i,
		array(
			'sanitize_callback' => 'wedding_event_management_sanitize_switch',
			'default'           => true,
		)
	);

	$wp_customize->add_control(
		new Wedding_Event_Management_Toggle_Switch_Custom_Control(
			$wp_customize,
			'wedding_event_management_enable_social' . $wedding_event_management_i,
			array(
				'label'   => esc_html__( 'Enable Social Icons', 'wedding-event-management' ),
				'description' => esc_html__( 'If you want to add a social icon you need to go to Dashboard = Appearance = Menus then create a new menu now add Custom Links then add proper links then choose Social then click Create Menu.', 'wedding-event-management' ),
				'section' => 'wedding_event_management_testimonial_section',
				// 'active_callback' => 'wedding_event_management_is_social_enabled',
			)
		)
	);
}