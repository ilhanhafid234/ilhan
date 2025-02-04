<?php
/**
 * Footer Options
 *
 * @package wedding_event_management
 */

$wp_customize->add_section(
	'wedding_event_management_footer_options',
	array(
		'panel' => 'wedding_event_management_theme_options',
		'title' => esc_html__( 'Footer Options', 'wedding-event-management' ),
	)
);
// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_event_management_footer_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Event_Management_Separator_Custom_Control( $wp_customize, 'wedding_event_management_footer_separators', array(
	'label' => __( 'Footer Settings', 'wedding-event-management' ),
	'section' => 'wedding_event_management_footer_options',
	'settings' => 'wedding_event_management_footer_separators',
)));

// column // 
$wp_customize->add_setting(
	'wedding_event_management_footer_widget_column',
	array(
        'default'			=> '4',
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'wedding_event_management_sanitize_select',
		
	)
);	

$wp_customize->add_control(
	'wedding_event_management_footer_widget_column',
	array(
	    'label'   		=> __('Select Widget Column','wedding-event-management'),
	    'section' 		=> 'wedding_event_management_footer_options',
		'type'			=> 'select',
		'choices'        => 
		array(
			'' => __( 'None', 'wedding-event-management' ),
			'1' => __( '1 Column', 'wedding-event-management' ),
			'2' => __( '2 Column', 'wedding-event-management' ),
			'3' => __( '3 Column', 'wedding-event-management' ),
			'4' => __( '4 Column', 'wedding-event-management' )
		) 
	) 
);

// Footer Background Color Setting
$wp_customize->add_setting('wedding_event_management_footer_background_color_setting', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wedding_event_management_footer_background_color_setting', array(
    'label' => __('Footer Background Color', 'wedding-event-management'),
    'section' => 'wedding_event_management_footer_options',
)));

// Footer Background Image Setting
$wp_customize->add_setting('wedding_event_management_footer_background_image_setting', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wedding_event_management_footer_background_image_setting', array(
    'label' => __('Footer Background Image', 'wedding-event-management'),
    'section' => 'wedding_event_management_footer_options',
)));
$wp_customize->add_setting('footer_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
));

// Add Footer Heading Text Transform Control
$wp_customize->add_control('footer_text_transform', array(
    'label' => __('Footer Heading Text Transform', 'wedding-event-management'),
    'section' => 'wedding_event_management_footer_options',
    'settings' => 'footer_text_transform',
    'type' => 'select',
    'choices' => array(
        'none' => __('None', 'wedding-event-management'),
        'capitalize' => __('Capitalize', 'wedding-event-management'),
        'uppercase' => __('Uppercase', 'wedding-event-management'),
        'lowercase' => __('Lowercase', 'wedding-event-management'),
    ),
));

$wp_customize->add_setting(
	'wedding_event_management_footer_copyright_text',
	array(
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => 'refresh',
	)
);

$wp_customize->add_control(
	'wedding_event_management_footer_copyright_text',
	array(
		'label'    => esc_html__( 'Copyright Text', 'wedding-event-management' ),
		'section'  => 'wedding_event_management_footer_options',
		'settings' => 'wedding_event_management_footer_copyright_text',
		'type'     => 'textarea',
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_event_management_scroll_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Event_Management_Separator_Custom_Control( $wp_customize, 'wedding_event_management_scroll_separators', array(
	'label' => __( 'Scroll Top Settings', 'wedding-event-management' ),
	'section' => 'wedding_event_management_footer_options',
	'settings' => 'wedding_event_management_scroll_separators',
)));



// Footer Options - Scroll Top.
$wp_customize->add_setting(
	'wedding_event_management_scroll_top',
	array(
		'sanitize_callback' => 'wedding_event_management_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Wedding_Event_Management_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_event_management_scroll_top',
		array(
			'label'   => esc_html__( 'Enable Scroll Top Button', 'wedding-event-management' ),
			'section' => 'wedding_event_management_footer_options',
		)
	)
);

$wp_customize->add_setting(
	'wedding_event_management_scroll_btn_icon',
	array(
        'default' => 'fas fa-chevron-up',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
		
	)
);	

$wp_customize->add_control(new Wedding_Event_Management_Change_Icon_Control($wp_customize, 
	'wedding_event_management_scroll_btn_icon',
	array(
	    'label'   		=> __('Scroll Top Icon','wedding-event-management'),
	    'section' 		=> 'wedding_event_management_footer_options',
		'iconset' => 'fa',
	))  
);

$wp_customize->add_setting( 'wedding_event_management_scroll_top_position', array(
    'default'           => 'bottom-right',
    'sanitize_callback' => 'wedding_event_management_sanitize_scroll_top_position',
) );

// Add control for Scroll Top Button Position
$wp_customize->add_control( 'wedding_event_management_scroll_top_position', array(
    'label'    => __( 'Scroll Top Position', 'wedding-event-management' ),
    'section'  => 'wedding_event_management_footer_options',
    'settings' => 'wedding_event_management_scroll_top_position',
    'type'     => 'select',
    'choices'  => array(
        'bottom-right' => __( 'Bottom Right', 'wedding-event-management' ),
        'bottom-left'  => __( 'Bottom Left', 'wedding-event-management' ),
        'bottom-center'=> __( 'Bottom Center', 'wedding-event-management' ),
    ),
) );

$wp_customize->add_setting( 'wedding_event_management_scroll_top_shape', array(
	'default'           => 'box',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'wedding_event_management_scroll_top_shape', array(
	'label'    => __( 'Scroll to Top Button Shape', 'wedding-event-management' ),
	'section'  => 'wedding_event_management_footer_options',
	'settings' => 'wedding_event_management_scroll_top_shape',
	'type'     => 'radio',
	'choices'  => array(
		'box'        => __( 'Box', 'wedding-event-management' ),
		'curved-box' => __( 'Curved Box', 'wedding-event-management' ),
		'circle'     => __( 'Circle', 'wedding-event-management' ),
	),
) );