<?php
/**
 * Wedding Elegance Theme Options Panel
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'Wedding_Elegance_Theme_Options' ) ) {

	class Wedding_Elegance_Theme_Options {

		/**
		 * Returns single theme option
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_option( $id ) {

			if ( get_theme_mod($id) != '' ) {
				return get_theme_mod($id);
			}
			else {
				return null;
			}
		}

		/**
		 * Register Theme settings on Customizer
		 *
		 * @since 1.0.0
		 */
		public static function wetp_register( $wp_customize ) {

			$wp_customize->add_section( 'wedding_elegance_theme_options', 
				array(
					'title'       => __( 'Theme Options', 'wedding-elegance' ),
					'priority'    => 35,
					'capability'  => 'edit_theme_options',
					'description' => __('Footer Social Media Links and Copyright', 'wedding-elegance'),
				)
			);


			// Social Media links
			$wp_customize->add_setting( 'wedding_elegance_facebook_text_block', array(
				'sanitize_callback' => 'sanitize_text_field'
			) );

			$wp_customize->add_control( new WP_Customize_Control(
			    $wp_customize,
			    'wedding_elegance_facebook_text',
			        array(
			            'label'    => __( 'Facebook Link', 'wedding-elegance' ),
			            'section'  => 'wedding_elegance_theme_options',
			            'settings' => 'wedding_elegance_facebook_text_block',
			            'type'     => 'text'
			        )
			    )
			);

			$wp_customize->add_setting( 'wedding_elegance_instagram_text_block', array(
				'sanitize_callback' => 'sanitize_text_field'
			) );

			$wp_customize->add_control( new WP_Customize_Control(
			    $wp_customize,
			    'wedding_elegance_instagram_text',
			        array(
			            'label'    => __( 'Instagram Link', 'wedding-elegance' ),
			            'section'  => 'wedding_elegance_theme_options',
			            'settings' => 'wedding_elegance_instagram_text_block',
			            'type'     => 'text'
			        )
			    )
			);

			$wp_customize->add_setting( 'wedding_elegance_twitter_text_block', array(
				'sanitize_callback' => 'sanitize_text_field'
			) );

			$wp_customize->add_control( new WP_Customize_Control(
			    $wp_customize,
			    'wedding_elegance_twitter_text',
			        array(
			            'label'    => __( 'Twitter Link', 'wedding-elegance' ),
			            'section'  => 'wedding_elegance_theme_options',
			            'settings' => 'wedding_elegance_twitter_text_block',
			            'type'     => 'text'
			        )
			    )
			);

			$wp_customize->add_setting( 'wedding_elegance_copyright_text_block', array(
				'sanitize_callback' => 'sanitize_text_field'
			) );

			$wp_customize->add_control( new WP_Customize_Control(
			    $wp_customize,
			    'wedding_elegance_copyright_text',
			        array(
			            'label'    => __( 'Copyright', 'wedding-elegance' ),
			            'section'  => 'wedding_elegance_theme_options',
			            'settings' => 'wedding_elegance_copyright_text_block',
			            'type'     => 'textarea'
			        )
			    )
			);

		}
	}	
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'wedding_elegance_Theme_Options' , 'wetp_register' ) );


// Helper function to use in theme to return a theme option value
function wedding_elegance_get_theme_option( $id = '' , $is_link = false) {

	if($is_link) {
		$chars = array('-', ' ', '(', ')');
		return str_replace($chars, "", Wedding_Elegance_Theme_Options::get_theme_option( $id ));
	}
	else {
		return Wedding_Elegance_Theme_Options::get_theme_option( $id );
	}

	return false;
}

// Helper function to use in theme to check if any of the option has value
function wedding_elegance_check_options( $ids = array() ) {
	$has_value = 0;

	foreach($ids as $id) {

		if( Wedding_Elegance_Theme_Options::get_theme_option( $id ) ){
			$has_value++;
		}
	}

	if($has_value == 0) {
		return false;
	}
	else {
		return true;
	}
}