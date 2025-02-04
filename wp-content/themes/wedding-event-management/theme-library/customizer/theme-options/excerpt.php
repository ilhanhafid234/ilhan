<?php

/**
 * Excerpt
 *
 * @package wedding_event_management
 */

$wp_customize->add_section(
	'wedding_event_management_excerpt_options',
	array(
		'panel' => 'wedding_event_management_theme_options',
		'title' => esc_html__( 'Excerpt', 'wedding-event-management' ),
	)
);

// Excerpt - Excerpt Length.
$wp_customize->add_setting(
	'wedding_event_management_excerpt_length',
	array(
		'default'           => 20,
		'sanitize_callback' => 'absint',
		'transport'         => 'refresh',
	)
);

$wp_customize->add_control(
	'wedding_event_management_excerpt_length',
	array(
		'label'       => esc_html__( 'Excerpt Length (no. of words)', 'wedding-event-management' ),
		'section'     => 'wedding_event_management_excerpt_options',
		'settings'    => 'wedding_event_management_excerpt_length',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 10,
			'max'  => 200,
			'step' => 1,
		),
	)
);