<?php
/**
 * Theme functions and definitions
 *
 * @package Wedding Elegance
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define( 'WEDDING_ELEGANCE_VERSION', '1.0' );
define( 'WEDDING_ELEGANCE_THEME_NAME', 'Wedding Elegance' );
define( 'WEDDING_ELEGANCE_THEME_SLUG', 'wedding-elegance' );

if ( ! function_exists( 'wedding_elegance_setup' ) ) {

    function wedding_elegance_setup() {
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'wedding-elegance' ),
            'footer' => __( 'Footer Menu', 'wedding-elegance' )
        ));

        register_sidebar( array(
            'name' => __( 'Footer Widget 1', 'wedding-elegance' ),
            'id' => 'footer-sidebar-1',
            'description' => 'Appears in the footer area',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));

        register_sidebar( array(
            'name' => __( 'Social Media Footer ', 'wedding-elegance' ),
            'id' => 'footer-social-links',
            'description' => 'Appears in the footer area',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));

        add_editor_style('/assets/css/editor-style');

        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]
        );

        add_theme_support( 'custom-background', apply_filters( 'wedding_elegance_custom_background_args', array(
            'default-color' => 'fff',
            'default-image' => '',
        ) ) );

        add_theme_support(
            'custom-logo',
            [
                'height'      => 100,
                'width'       => 350,
                'flex-height' => true,
                'flex-width'  => true,
            ]
        );

        add_theme_support( "responsive-embeds" );
        add_theme_support( 'align-wide' );
        add_theme_support( 'wp-block-styles' );
    }

    add_filter('excerpt_more','__return_false');
}
add_action( 'after_setup_theme', 'wedding_elegance_setup' );

remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

if ( ! function_exists( 'wedding_elegance_widgets_init' ) ) {
    
    function wedding_elegance_widgets_init() {
        register_sidebar( array (
            'name' => __( 'Main Sidebar', 'wedding-elegance' ),
            'id' => 'sidebar-1',
            'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'wedding-elegance' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
}
add_action( 'widgets_init', 'wedding_elegance_widgets_init' );

if ( ! function_exists( 'wedding_elegance_scripts_styles' ) ) {

    function wedding_elegance_scripts_styles() {

        wp_enqueue_style(
            'wedding-elegance',
            get_template_directory_uri() . '/style.css',
            [],
            WEDDING_ELEGANCE_VERSION
        );

        wp_enqueue_style(
            'wedding-elegance-style',
            get_template_directory_uri() . '/theme.min.css',
            [],
            WEDDING_ELEGANCE_VERSION
        );

        wp_enqueue_style(
            'wedding-elegance-font-awesome',
            get_template_directory_uri() . '/assets/css/font-awesome.css',
            [],
            WEDDING_ELEGANCE_VERSION
        );

        wp_enqueue_script( 
            'wedding-elegance-custom_script', 
            get_stylesheet_directory_uri() . '/assets/js/wedding_elegance_script.js', 
            array( 'jquery' ), 
            WEDDING_ELEGANCE_VERSION
        );

    }
}
add_action( 'wp_enqueue_scripts', 'wedding_elegance_scripts_styles' );

/*Plugin Recommendation*/
require get_template_directory() . '/includes/tgm/class-tgm-plugin-activation.php';
require get_template_directory() . '/includes/tgm/hook-tgm.php';  

/*Theme Options*/
require get_template_directory() . '/includes/wedding-elegance-theme-options.php';
require get_template_directory() . '/includes/class-wedding-elegance-walker-page.php';
