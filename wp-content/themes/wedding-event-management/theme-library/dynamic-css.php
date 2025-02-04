<?php

/**
 * Dynamic CSS
 */
function wedding_event_management_dynamic_css() {
	$wedding_event_management_primary_color = get_theme_mod( 'primary_color', '#657150' );

	$wedding_event_management_site_title_font       = get_theme_mod( 'wedding_event_management_site_title_font', 'Raleway' );
	$wedding_event_management_site_description_font = get_theme_mod( 'wedding_event_management_site_description_font', 'Raleway' );
	$wedding_event_management_header_font           = get_theme_mod( 'wedding_event_management_header_font', 'Sail' );
	$wedding_event_management_content_font             = get_theme_mod( 'wedding_event_management_content_font', 'Arimo' );

	// Enqueue Google Fonts
	$fonts_url = wedding_event_management_get_fonts_url();
	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'wedding-event-management-google-fonts', esc_url( $fonts_url ), array(), null );
	}

	$wedding_event_management_custom_css  = '';
	$wedding_event_management_custom_css .= '
    /* Color */
    :root {
        --primary-color: ' . esc_attr( $wedding_event_management_primary_color ) . ';
        --header-text-color: ' . esc_attr( '#' . get_header_textcolor() ) . ';
    }
    ';

	$wedding_event_management_custom_css .= '
    /* Typography */
    :root {
        --font-heading: "' . esc_attr( $wedding_event_management_header_font ) . '", serif;
        --font-main: -apple-system, BlinkMacSystemFont, "' . esc_attr( $wedding_event_management_content_font ) . '", "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
    }

    body,
	button, input, select, optgroup, textarea, p {
        font-family: "' . esc_attr( $wedding_event_management_content_font ) . '", serif;
	}

	.site-identity p.site-title, h1.site-title a, h1.site-title, p.site-title a, .site-branding h1.site-title a {
        font-family: "' . esc_attr( $wedding_event_management_site_title_font ) . '", serif;
	}
    
	p.site-description {
        font-family: "' . esc_attr( $wedding_event_management_site_description_font ) . '", serif !important;
	}
    ';

	wp_add_inline_style( 'wedding-event-management-style', $wedding_event_management_custom_css );
}
add_action( 'wp_enqueue_scripts', 'wedding_event_management_dynamic_css', 99 );