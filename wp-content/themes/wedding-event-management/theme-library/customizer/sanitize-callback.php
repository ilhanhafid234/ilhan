<?php

function wedding_event_management_sanitize_select( $wedding_event_management_input, $wedding_event_management_setting ) {
	$wedding_event_management_input = sanitize_key( $wedding_event_management_input );
	$choices = $wedding_event_management_setting->manager->get_control( $wedding_event_management_setting->id )->choices;
	return ( array_key_exists( $wedding_event_management_input, $choices ) ? $wedding_event_management_input : $wedding_event_management_setting->default );
}

function wedding_event_management_sanitize_switch( $wedding_event_management_input ) {
	if ( true === $wedding_event_management_input ) {
		return true;
	} else {
		return false;
	}
}

function wedding_event_management_sanitize_google_fonts( $wedding_event_management_input, $wedding_event_management_setting ) {
	$choices = $wedding_event_management_setting->manager->get_control( $wedding_event_management_setting->id )->choices;
	return ( array_key_exists( $wedding_event_management_input, $choices ) ? $wedding_event_management_input : $wedding_event_management_setting->default );
}

/**
 * Sanitize HTML input.
 *
 * @param string $wedding_event_management_input HTML input to sanitize.
 * @return string Sanitized HTML.
 */
function wedding_event_management_sanitize_html( $wedding_event_management_input ) {
    return wp_kses_post( $wedding_event_management_input );
}

// Sanitize Scroll Top Position
function wedding_event_management_sanitize_scroll_top_position( $wedding_event_management_input ) {
    $wedding_event_management_valid_positions = array( 'bottom-right', 'bottom-left', 'bottom-center' );
    if ( in_array( $wedding_event_management_input, $wedding_event_management_valid_positions ) ) {
        return $wedding_event_management_input;
    } else {
        return 'bottom-right'; // Default to bottom-right if invalid value
    }
}

function wedding_event_management_sanitize_choices( $wedding_event_management_input, $wedding_event_management_setting ) {
    global $wp_customize; 
    $wedding_event_management_control = $wp_customize->get_control( $wedding_event_management_setting->id ); 
    if ( array_key_exists( $wedding_event_management_input, $wedding_event_management_control->choices ) ) {
        return $wedding_event_management_input;
    } else {
        return $wedding_event_management_setting->default;
    }
}

function wedding_event_management_sanitize_range_value( $wedding_event_management_number, $wedding_event_management_setting ) {

	// Ensure input is an absolute integer.
	$wedding_event_management_number = absint( $wedding_event_management_number );

	// Get the input attributes associated with the setting.
	$wedding_event_management_atts = $wedding_event_management_setting->manager->get_control( $wedding_event_management_setting->id )->input_attrs;

	// Get minimum number in the range.
	$wedding_event_management_min = ( isset( $wedding_event_management_atts['min'] ) ? $wedding_event_management_atts['min'] : $wedding_event_management_number );

	// Get maximum number in the range.
	$wedding_event_management_max = ( isset( $wedding_event_management_atts['max'] ) ? $wedding_event_management_atts['max'] : $wedding_event_management_number );

	// Get step.
	$wedding_event_management_step = ( isset( $wedding_event_management_atts['step'] ) ? $wedding_event_management_atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default.
	return ( $wedding_event_management_min <= $wedding_event_management_number && $wedding_event_management_number <= $wedding_event_management_max && is_int( $wedding_event_management_number / $wedding_event_management_step ) ? $wedding_event_management_number : $wedding_event_management_setting->default );
}