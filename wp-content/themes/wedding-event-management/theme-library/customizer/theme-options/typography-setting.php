<?php

/**
 * Typography Settings
 *
 * @package wedding_event_management
 */

// Typography Settings
$wp_customize->add_section(
    'wedding_event_management_typography_setting',
    array(
        'panel' => 'wedding_event_management_theme_options',
        'title' => esc_html__( 'Typography Settings', 'wedding-event-management' ),
    )
);

$wp_customize->add_setting(
    'wedding_event_management_site_title_font',
    array(
        'default'           => 'Raleway',
        'sanitize_callback' => 'wedding_event_management_sanitize_google_fonts',
    )
);

$wp_customize->add_control(
    'wedding_event_management_site_title_font',
    array(
        'label'    => esc_html__( 'Site Title Font Family', 'wedding-event-management' ),
        'section'  => 'wedding_event_management_typography_setting',
        'settings' => 'wedding_event_management_site_title_font',
        'type'     => 'select',
        'choices'  => wedding_event_management_get_all_google_font_families(),
    )
);

// Typography - Site Description Font.
$wp_customize->add_setting(
	'wedding_event_management_site_description_font',
	array(
		'default'           => 'Raleway',
		'sanitize_callback' => 'wedding_event_management_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'wedding_event_management_site_description_font',
	array(
		'label'    => esc_html__( 'Site Description Font Family', 'wedding-event-management' ),
		'section'  => 'wedding_event_management_typography_setting',
		'settings' => 'wedding_event_management_site_description_font',
		'type'     => 'select',
		'choices'  => wedding_event_management_get_all_google_font_families(),
	)
);

// Typography - Header Font.
$wp_customize->add_setting(
	'wedding_event_management_header_font',
	array(
		'default'           => 'Sail',
		'sanitize_callback' => 'wedding_event_management_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'wedding_event_management_header_font',
	array(
		'label'    => esc_html__( 'Heading Font Family', 'wedding-event-management' ),
		'section'  => 'wedding_event_management_typography_setting',
		'settings' => 'wedding_event_management_header_font',
		'type'     => 'select',
		'choices'  => wedding_event_management_get_all_google_font_families(),
	)
);

// Typography - Body Font.
$wp_customize->add_setting(
	'wedding_event_management_content_font',
	array(
		'default'           => 'Arimo',
		'sanitize_callback' => 'wedding_event_management_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'wedding_event_management_content_font',
	array(
		'label'    => esc_html__( 'Content Font Family', 'wedding-event-management' ),
		'section'  => 'wedding_event_management_typography_setting',
		'settings' => 'wedding_event_management_content_font',
		'type'     => 'select',
		'choices'  => wedding_event_management_get_all_google_font_families(),
	)
);