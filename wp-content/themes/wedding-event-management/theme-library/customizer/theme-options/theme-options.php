<?php
/**
 * Header Options
 *
 * @package wedding_event_management
 */

// ---------------------------------------- GENERAL OPTIONBS ----------------------------------------------------


// ---------------------------------------- PRELOADER ----------------------------------------------------

$wp_customize->add_section(
	'wedding_event_management_general_options',
	array(
		'panel' => 'wedding_event_management_theme_options',
		'title' => esc_html__( 'General Options', 'wedding-event-management' ),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_event_management_preloader_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Event_Management_Separator_Custom_Control( $wp_customize, 'wedding_event_management_preloader_separator', array(
	'label' => __( 'Enable / Disable Site Preloader Section', 'wedding-event-management' ),
	'section' => 'wedding_event_management_general_options',
	'settings' => 'wedding_event_management_preloader_separator',
) ) );


// General Options - Enable Preloader.
$wp_customize->add_setting(
	'wedding_event_management_enable_preloader',
	array(
		'sanitize_callback' => 'wedding_event_management_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Wedding_Event_Management_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_event_management_enable_preloader',
		array(
			'label'   => esc_html__( 'Enable Preloader', 'wedding-event-management' ),
			'section' => 'wedding_event_management_general_options',
		)
	)
);

// Preloader Style Setting
$wp_customize->add_setting(
    'wedding_event_management_preloader_style',
    array(
        'default'           => 'style1',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'wedding_event_management_preloader_style',
    array(
        'type'     => 'select',
        'label'    => esc_html__('Select Preloader Styles', 'wedding-event-management'),
		'active_callback' => 'wedding_event_management_is_preloader_style',
        'section'  => 'wedding_event_management_general_options',
        'choices'  => array(
            'style1' => esc_html__('Style 1', 'wedding-event-management'),
            'style2' => esc_html__('Style 2', 'wedding-event-management'),
            'style3' => esc_html__('Style 3', 'wedding-event-management'),
        ),
    )
);


// ---------------------------------------- PAGINATION ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_event_management_pagination_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Event_Management_Separator_Custom_Control( $wp_customize, 'wedding_event_management_pagination_separator', array(
	'label' => __( 'Enable / Disable Pagination Section', 'wedding-event-management' ),
	'section' => 'wedding_event_management_general_options',
	'settings' => 'wedding_event_management_pagination_separator',
) ) );


// Pagination - Enable Pagination.
$wp_customize->add_setting(
	'wedding_event_management_enable_pagination',
	array(
		'default'           => true,
		'sanitize_callback' => 'wedding_event_management_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Event_Management_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_event_management_enable_pagination',
		array(
			'label'    => esc_html__( 'Enable Pagination', 'wedding-event-management' ),
			'section'  => 'wedding_event_management_general_options',
			'settings' => 'wedding_event_management_enable_pagination',
			'type'     => 'checkbox',
		)
	)
);

// Pagination - Pagination Type.
$wp_customize->add_setting(
	'wedding_event_management_pagination_type',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'wedding_event_management_sanitize_select',
	)
);

$wp_customize->add_control(
	'wedding_event_management_pagination_type',
	array(
		'label'           => esc_html__( 'Pagination Type', 'wedding-event-management' ),
		'section'         => 'wedding_event_management_general_options',
		'settings'        => 'wedding_event_management_pagination_type',
		'active_callback' => 'wedding_event_management_is_pagination_enabled',
		'type'            => 'select',
		'choices'         => array(
			'default' => __( 'Default (Older/Newer)', 'wedding-event-management' ),
			'numeric' => __( 'Numeric', 'wedding-event-management' ),
		),
	)
);



// ---------------------------------------- BREADCRUMB ----------------------------------------------------


// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_event_management_breadcrumb_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Event_Management_Separator_Custom_Control( $wp_customize, 'wedding_event_management_breadcrumb_separators', array(
	'label' => __( 'Enable / Disable Breadcrumb Section', 'wedding-event-management' ),
	'section' => 'wedding_event_management_general_options',
	'settings' => 'wedding_event_management_breadcrumb_separators',
)));


// Breadcrumb - Enable Breadcrumb.
$wp_customize->add_setting(
	'wedding_event_management_enable_breadcrumb',
	array(
		'sanitize_callback' => 'wedding_event_management_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Wedding_Event_Management_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_event_management_enable_breadcrumb',
		array(
			'label'   => esc_html__( 'Enable Breadcrumb', 'wedding-event-management' ),
			'section' => 'wedding_event_management_general_options',
		)
	)
);

// Breadcrumb - Separator.
$wp_customize->add_setting(
	'wedding_event_management_breadcrumb_separator',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '/',
	)
);

$wp_customize->add_control(
	'wedding_event_management_breadcrumb_separator',
	array(
		'label'           => esc_html__( 'Separator', 'wedding-event-management' ),
		'active_callback' => 'wedding_event_management_is_breadcrumb_enabled',
		'section'         => 'wedding_event_management_general_options',
	)
);



// ---------------------------------------- Website layout ----------------------------------------------------


// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_event_management_layuout_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Event_Management_Separator_Custom_Control( $wp_customize, 'wedding_event_management_layuout_separator', array(
	'label' => __( 'Website Layout Setting', 'wedding-event-management' ),
	'section' => 'wedding_event_management_general_options',
	'settings' => 'wedding_event_management_layuout_separator',
)));


$wp_customize->add_setting(
	'wedding_event_management_website_layout',
	array(
		'sanitize_callback' => 'wedding_event_management_sanitize_switch',
		'default'           => false,
	)
);

$wp_customize->add_control(
	new Wedding_Event_Management_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_event_management_website_layout',
		array(
			'label'   => esc_html__('Boxed Layout', 'wedding-event-management'),
			'section' => 'wedding_event_management_general_options',
		)
	)
);


$wp_customize->add_setting('wedding_event_management_layout_width_margin', array(
	'default'           => 50,
	'sanitize_callback' => 'wedding_event_management_sanitize_range_value',
));

$wp_customize->add_control(new Wedding_Event_Management_Customize_Range_Control($wp_customize, 'wedding_event_management_layout_width_margin', array(
		'label'       => __('Set Width', 'wedding-event-management'),
		'description' => __('Adjust the width around the website layout by moving the slider. Use this setting to customize the appearance of your site to fit your design preferences.', 'wedding-event-management'),
		'section'     => 'wedding_event_management_general_options',
		'settings'    => 'wedding_event_management_layout_width_margin',
		'active_callback' => 'wedding_event_management_is_layout_enabled',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 130,
			'step' => 1,
		),
)));




// ---------------------------------------- HEADER OPTIONS ----------------------------------------------------	


$wp_customize->add_section(
	'wedding_event_management_header_options',
	array(
		'panel' => 'wedding_event_management_theme_options',
		'title' => esc_html__( 'Header Options', 'wedding-event-management' ),
	)
);


// Add setting for sticky header
$wp_customize->add_setting(
	'wedding_event_management_enable_sticky_header',
	array(
		'sanitize_callback' => 'wedding_event_management_sanitize_switch',
		'default'           => false,
	)
);

// Add control for sticky header setting
$wp_customize->add_control(
	new Wedding_Event_Management_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_event_management_enable_sticky_header',
		array(
			'label'   => esc_html__( 'Enable Sticky Header', 'wedding-event-management' ),
			'section' => 'wedding_event_management_header_options',
		)
	)
);

// Header Options - Enable Search Icon.
$wp_customize->add_setting(
	'wedding_event_management_enable_search_icon',
	array(
		'sanitize_callback' => 'wedding_event_management_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Wedding_Event_Management_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_event_management_enable_search_icon',
		array(
			'label'   => esc_html__( 'Enable Search Icon', 'wedding-event-management' ),
			'section' => 'wedding_event_management_header_options',
		)
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'wedding_event_management_menu_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Wedding_Event_Management_Separator_Custom_Control( $wp_customize, 'wedding_event_management_menu_separator', array(
	'label' => __( 'Menu Settings', 'wedding-event-management' ),
	'section' => 'wedding_event_management_header_options',
	'settings' => 'wedding_event_management_menu_separator',
)));

$wp_customize->add_setting( 'wedding_event_management_menu_font_size', array(
    'default'           => 16,
    'sanitize_callback' => 'absint',
) );

// Add control for site title size
$wp_customize->add_control( 'wedding_event_management_menu_font_size', array(
    'type'        => 'number',
    'section'     => 'wedding_event_management_header_options',
    'label'       => __( 'Menu Font Size ', 'wedding-event-management' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
));

$wp_customize->add_setting( 'wedding_event_management_menu_text_transform', array(
    'default'           => 'none', // Default value for text transform
    'sanitize_callback' => 'sanitize_text_field',
) );

// Add control for menu text transform
$wp_customize->add_control( 'wedding_event_management_menu_text_transform', array(
    'type'     => 'select',
    'section'  => 'wedding_event_management_header_options', // Adjust the section as needed
    'label'    => __( 'Menu Text Transform', 'wedding-event-management' ),
    'choices'  => array(
        'none'       => __( 'None', 'wedding-event-management' ),
        'capitalize' => __( 'Capitalize', 'wedding-event-management' ),
        'uppercase'  => __( 'Uppercase', 'wedding-event-management' ),
        'lowercase'  => __( 'Lowercase', 'wedding-event-management' ),
    ),
) );



// ----------------------------------------SITE IDENTITY----------------------------------------------------

// Site Logo - Enable Setting.
$wp_customize->add_setting(
	'wedding_event_management_enable_site_logo',
	array(
		'default'           => true, // Default is to display the logo.
		'sanitize_callback' => 'wedding_event_management_sanitize_switch', // Sanitize using a custom switch function.
	)
);

$wp_customize->add_control(
	new Wedding_Event_Management_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_event_management_enable_site_logo',
		array(
			'label'    => esc_html__( 'Enable Site Logo', 'wedding-event-management' ),
			'section'  => 'title_tagline', // Section to add this control.
			'settings' => 'wedding_event_management_enable_site_logo',
		)
	)
);

// Site Title - Enable Setting.
$wp_customize->add_setting(
	'wedding_event_management_enable_site_title_setting',
	array(
		'default'           => false,
		'sanitize_callback' => 'wedding_event_management_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Event_Management_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_event_management_enable_site_title_setting',
		array(
			'label'    => esc_html__( 'Enable Site Title', 'wedding-event-management' ),
			'section'  => 'title_tagline',
			'settings' => 'wedding_event_management_enable_site_title_setting',
		)
	)
);

// Tagline - Enable Setting.
$wp_customize->add_setting(
	'wedding_event_management_enable_tagline_setting',
	array(
		'default'           => false,
		'sanitize_callback' => 'wedding_event_management_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Wedding_Event_Management_Toggle_Switch_Custom_Control(
		$wp_customize,
		'wedding_event_management_enable_tagline_setting',
		array(
			'label'    => esc_html__( 'Enable Tagline', 'wedding-event-management' ),
			'section'  => 'title_tagline',
			'settings' => 'wedding_event_management_enable_tagline_setting',
		)
	)
);
$wp_customize->add_setting( 'wedding_event_management_site_title_size', array(
    'default'           => 30, // Default font size in pixels
    'sanitize_callback' => 'absint', // Sanitize the input as a positive integer
) );

// Add control for site title size
$wp_customize->add_control( 'wedding_event_management_site_title_size', array(
    'type'        => 'number',
    'section'     => 'title_tagline', // You can change this section to your preferred section
    'label'       => __( 'Site Title Font Size ', 'wedding-event-management' ),
    'input_attrs' => array(
        'min'  => 10,
        'max'  => 100,
        'step' => 1,
    ),
) );

$wp_customize->add_setting('wedding_event_management_site_logo_width', array(
    'default'           => 200,
    'sanitize_callback' => 'wedding_event_management_sanitize_range_value',
));

$wp_customize->add_control(new Wedding_Event_Management_Customize_Range_Control($wp_customize, 'wedding_event_management_site_logo_width', array(
    'label'       => __('Adjust Site Logo Width', 'wedding-event-management'),
    'description' => __('This setting controls the Width of Site Logo', 'wedding-event-management'),
    'section'     => 'title_tagline',
    'settings'    => 'wedding_event_management_site_logo_width',
    'input_attrs' => array(
        'min'  => 0,
        'max'  => 400,
        'step' => 5,
    ),
)));