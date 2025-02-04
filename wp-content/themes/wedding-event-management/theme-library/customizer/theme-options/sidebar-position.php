<?php

/**
 * Sidebar Position
 *
 * @package wedding_event_management
 */

$wp_customize->add_section(
	'wedding_event_management_sidebar_position',
	array(
		'title' => esc_html__( 'Sidebar Position', 'wedding-event-management' ),
		'panel' => 'wedding_event_management_theme_options',
	)
);


// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_event_management_global_sidebar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Event_Management_Separator_Custom_Control( $wp_customize, 'wedding_event_management_global_sidebar_separator', array(
	'label' => __( 'Global Sidebar Position', 'wedding-event-management' ),
	'section' => 'wedding_event_management_sidebar_position',
	'settings' => 'wedding_event_management_global_sidebar_separator',
)));

// Sidebar Position - Global Sidebar Position.
$wp_customize->add_setting(
	'wedding_event_management_sidebar_position',
	array(
		'sanitize_callback' => 'wedding_event_management_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'wedding_event_management_sidebar_position',
	array(
		'label'   => esc_html__( 'Select Sidebar Position', 'wedding-event-management' ),
		'section' => 'wedding_event_management_sidebar_position',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'wedding-event-management' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'wedding-event-management' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'wedding-event-management' ),
		),
	)
);


// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_event_management_post_sidebar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Event_Management_Separator_Custom_Control( $wp_customize, 'wedding_event_management_post_sidebar_separator', array(
	'label' => __( 'Post Sidebar Position', 'wedding-event-management' ),
	'section' => 'wedding_event_management_sidebar_position',
	'settings' => 'wedding_event_management_post_sidebar_separator',
)));

// Sidebar Position - Post Sidebar Position.
$wp_customize->add_setting(
	'wedding_event_management_post_sidebar_position',
	array(
		'sanitize_callback' => 'wedding_event_management_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'wedding_event_management_post_sidebar_position',
	array(
		'label'   => esc_html__( 'Select Sidebar Position', 'wedding-event-management' ),
		'section' => 'wedding_event_management_sidebar_position',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'wedding-event-management' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'wedding-event-management' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'wedding-event-management' ),
		),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_event_management_page_sidebar_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Event_Management_Separator_Custom_Control( $wp_customize, 'wedding_event_management_page_sidebar_separator', array(
	'label' => __( 'Page Sidebar Position', 'wedding-event-management' ),
	'section' => 'wedding_event_management_sidebar_position',
	'settings' => 'wedding_event_management_page_sidebar_separator',
)));

// Sidebar Position - Page Sidebar Position.
$wp_customize->add_setting(
	'wedding_event_management_page_sidebar_position',
	array(
		'sanitize_callback' => 'wedding_event_management_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'wedding_event_management_page_sidebar_position',
	array(
		'label'   => esc_html__( 'Select Sidebar Position', 'wedding-event-management' ),
		'section' => 'wedding_event_management_sidebar_position',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'wedding-event-management' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'wedding-event-management' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'wedding-event-management' ),
		),
	)
);


// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_event_management_sidebar_width_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Event_Management_Separator_Custom_Control( $wp_customize, 'wedding_event_management_sidebar_width_separator', array(
	'label' => __( 'Sidebar Width Setting', 'wedding-event-management' ),
	'section' => 'wedding_event_management_sidebar_position',
	'settings' => 'wedding_event_management_sidebar_width_separator',
)));


$wp_customize->add_setting( 'wedding_event_management_sidebar_width', array(
	'default'           => '30',
	'sanitize_callback' => 'wedding_event_management_sanitize_range_value',
) );

$wp_customize->add_control(new Wedding_Event_Management_Customize_Range_Control($wp_customize, 'wedding_event_management_sidebar_width', array(
	'section'     => 'wedding_event_management_sidebar_position',
	'label'       => __( 'Adjust Sidebar Width', 'wedding-event-management' ),
	'description' => __( 'Adjust the width of the sidebar.', 'wedding-event-management' ),
	'input_attrs' => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
)));

$wp_customize->add_setting( 'wedding_event_management_sidebar_widget_font_size', array(
    'default'           => 24,
    'sanitize_callback' => 'absint',
) );

// Add control for site title size
$wp_customize->add_control( 'wedding_event_management_sidebar_widget_font_size', array(
    'type'        => 'number',
    'section'     => 'wedding_event_management_sidebar_position',
    'label'       => __( 'Sidebar Widgets Heading Font Size ', 'wedding-event-management' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
));