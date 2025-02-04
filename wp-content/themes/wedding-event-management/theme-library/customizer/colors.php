<?php
/**
 * Color Option
 *
 * @package wedding_event_management
 */

// Primary Color.
$wp_customize->add_setting(
	'primary_color',
	array(
		'default'           => '#657150',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'primary_color',
		array(
			'label'    => __( 'Primary Color', 'wedding-event-management' ),
			'section'  => 'colors',
			'priority' => 5,
		)
	)
);