<?php

/**
 * WooCommerce Settings
 *
 * @package wedding_event_management
 */

$wp_customize->add_section(
	'wedding_event_management_woocommerce_settings',
	array(
		'panel' => 'wedding_event_management_theme_options',
		'title' => esc_html__( 'WooCommerce Settings', 'wedding-event-management' ),
	)
);

//WooCommerce - Products per page.
$wp_customize->add_setting( 'wedding_event_management_products_per_page', array(
    'default'           => 9,
    'sanitize_callback' => 'absint',
));

$wp_customize->add_control( 'wedding_event_management_products_per_page', array(
    'type'        => 'number',
    'section'     => 'wedding_event_management_woocommerce_settings',
    'label'       => __( 'Products Per Page', 'wedding-event-management' ),
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 50,
        'step' => 1,
    ),
));

//WooCommerce - Products per row.
$wp_customize->add_setting( 'wedding_event_management_products_per_row', array(
    'default'           => '3',
    'sanitize_callback' => 'wedding_event_management_sanitize_choices',
) );

$wp_customize->add_control( 'wedding_event_management_products_per_row', array(
    'label'    => __( 'Products Per Row', 'wedding-event-management' ),
    'section'  => 'wedding_event_management_woocommerce_settings',
    'settings' => 'wedding_event_management_products_per_row',
    'type'     => 'select',
    'choices'  => array(
        '2' => '2',
		'3' => '3',
		'4' => '4',
    ),
) );

//WooCommerce - Show / Hide Related Product.
$wp_customize->add_setting(
	'wedding_event_management_related_product_show_hide',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_event_management_sanitize_switch',
	)
);

$wp_customize->add_control(
	new wedding_event_management_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_event_management_related_product_show_hide',
		array(
			'label'   => esc_html__( 'Show / Hide Related product', 'wedding-event-management' ),
			'section' => 'wedding_event_management_woocommerce_settings',
		)
	)
);



