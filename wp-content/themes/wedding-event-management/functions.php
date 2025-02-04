<?php
/**
 * Wedding Event Management functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wedding_event_management
 */

$wedding_event_management_theme_data = wp_get_theme();
if( ! defined( 'WEDDING_EVENT_MANAGEMENT_THEME_VERSION' ) ) define ( 'WEDDING_EVENT_MANAGEMENT_THEME_VERSION', $wedding_event_management_theme_data->get( 'Version' ) );
if( ! defined( 'WEDDING_EVENT_MANAGEMENT_THEME_NAME' ) ) define( 'WEDDING_EVENT_MANAGEMENT_THEME_NAME', $wedding_event_management_theme_data->get( 'Name' ) );
if( ! defined( 'WEDDING_EVENT_MANAGEMENT_THEME_TEXTDOMAIN' ) ) define( 'WEDDING_EVENT_MANAGEMENT_THEME_TEXTDOMAIN', $wedding_event_management_theme_data->get( 'TextDomain' ) );

if ( ! defined( 'WEDDING_EVENT_MANAGEMENT_VERSION' ) ) {
	define( 'WEDDING_EVENT_MANAGEMENT_VERSION', '1.0.0' );
}

if ( ! function_exists( 'wedding_event_management_setup' ) ) :
	
	function wedding_event_management_setup() {
		
		load_theme_textdomain( 'wedding-event-management', get_template_directory() . '/languages' );

		add_theme_support( 'woocommerce' );

		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'wedding-event-management' ),
				'testimonial-1'  => esc_html__( 'Testimonial 1', 'wedding-event-management' ),
				'testimonial-2'  => esc_html__( 'Testimonial 2', 'wedding-event-management' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'woocommerce',
			)
		);

		add_theme_support(
			'custom-background',
			apply_filters(
				'wedding_event_management_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support( 'align-wide' );

		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'wedding_event_management_setup' );

function wedding_event_management_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wedding_event_management_content_width', 640 );
}
add_action( 'after_setup_theme', 'wedding_event_management_content_width', 0 );

function wedding_event_management_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wedding-event-management' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wedding-event-management' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	$wedding_event_management_footer_widget_column = get_theme_mod('wedding_event_management_footer_widget_column','4');
	for ($i=1; $i<=$wedding_event_management_footer_widget_column; $i++) {
		register_sidebar( array(
			'name' => __( 'Footer  ', 'wedding-event-management' )  . $i,
			'id' => 'wedding-event-management-footer-widget-' . $i,
			'description' => __( 'The Footer Widget Area', 'wedding-event-management' )  . $i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h4 class="widget-title">',
			'after_title' => '</h4></div>',
		) );
	}
}
add_action( 'widgets_init', 'wedding_event_management_widgets_init' );

//Change number of products per page 
add_filter( 'loop_shop_per_page', 'wedding_event_management_products_per_page' );
function wedding_event_management_products_per_page( $cols ) {
  	return  get_theme_mod( 'wedding_event_management_products_per_page',9);
}

// Change number or products per row 
add_filter('loop_shop_columns', 'wedding_event_management_loop_columns');
	if (!function_exists('wedding_event_management_loop_columns')) {
	function wedding_event_management_loop_columns() {
		return get_theme_mod( 'wedding_event_management_products_per_row', 3 );
	}
}

/**
 * Enqueue scripts and styles.
 */
function wedding_event_management_scripts() {
	// Append .min if SCRIPT_DEBUG is false.
	$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Slick style.
	wp_enqueue_style( 'wedding-event-management-slick-style', get_template_directory_uri() . '/resource/css/slick' . $min . '.css', array(), '1.8.1' );

	// Fontawesome style.
	wp_enqueue_style( 'wedding-event-management-fontawesome-style', get_template_directory_uri() . '/resource/css/fontawesome' . $min . '.css', array(), '5.15.4' );

	// Main style.
	wp_enqueue_style( 'wedding-event-management-style', get_template_directory_uri() . '/style.css', array(), WEDDING_EVENT_MANAGEMENT_VERSION );

	// RTL style.
	wp_style_add_data('wedding-event-management-style', 'rtl', 'replace');

	// Navigation script.
	wp_enqueue_script( 'wedding-event-management-navigation-script', get_template_directory_uri() . '/resource/js/navigation' . $min . '.js', array(), WEDDING_EVENT_MANAGEMENT_VERSION, true );

	// Slick script.
	wp_enqueue_script( 'wedding-event-management-slick-script', get_template_directory_uri() . '/resource/js/slick' . $min . '.js', array( 'jquery' ), '1.8.1', true );

	// Custom script.
	wp_enqueue_script( 'wedding-event-management-custom-script', get_template_directory_uri() . '/resource/js/custom.js', array( 'jquery' ), WEDDING_EVENT_MANAGEMENT_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Include the file.
	require_once get_theme_file_path( 'theme-library/function-files/wptt-webfont-loader.php' );

	// Load the webfont.
	wp_enqueue_style(
		'sail',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Sail&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style(
		'arimo',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&family=Sail&display=swap' ),
		array(),
		'1.0'
	);

}
add_action( 'wp_enqueue_scripts', 'wedding_event_management_scripts' );

/**
 * Include wptt webfont loader.
 */
require_once get_theme_file_path( 'theme-library/function-files/wptt-webfont-loader.php' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/theme-library/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/theme-library/function-files/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/theme-library/function-files/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/theme-library/customizer.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/theme-library/function-files/google-fonts.php';

/**
 * Dynamic CSS
 */
require get_template_directory() . '/theme-library/dynamic-css.php';

/**
 * Breadcrumb
 */
require get_template_directory() . '/theme-library/function-files/class-breadcrumb-trail.php';

/**
 * Getting Started
*/
require get_template_directory() . '/theme-library/getting-started/getting-started.php';

/**
 * Demo Import
*/
require get_parent_theme_file_path( '/theme-wizard/config.php' );

// Enqueue Customizer live preview script
function wedding_event_management_customizer_live_preview() {
    wp_enqueue_script(
        'wedding-event-management-customizer',
        get_template_directory_uri() . '/js/customizer.js',
        array('jquery', 'customize-preview'),
        '',
        true
    );
}
add_action('customize_preview_init', 'wedding_event_management_customizer_live_preview');

/**
 * Customizer Settings Functions
*/
require get_template_directory() . '/theme-library/function-files/customizer-settings-functions.php';