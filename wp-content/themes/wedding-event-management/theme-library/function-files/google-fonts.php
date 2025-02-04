<?php
function wedding_event_management_get_all_google_fonts() {
    $wedding_event_management_webfonts_json = get_template_directory() . '/theme-library/google-webfonts.json';
    if ( ! file_exists( $wedding_event_management_webfonts_json ) ) {
        return array();
    }

    $wedding_event_management_fonts_json_data = file_get_contents( $wedding_event_management_webfonts_json );
    if ( false === $wedding_event_management_fonts_json_data ) {
        return array();
    }

    $wedding_event_management_all_fonts = json_decode( $wedding_event_management_fonts_json_data, true );
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        return array();
    }

    $wedding_event_management_google_fonts = array();
    foreach ( $wedding_event_management_all_fonts as $wedding_event_management_font ) {
        $wedding_event_management_google_fonts[ $wedding_event_management_font['family'] ] = array(
            'family'   => $wedding_event_management_font['family'],
            'variants' => $wedding_event_management_font['variants'],
        );
    }
    return $wedding_event_management_google_fonts;
}


function wedding_event_management_get_all_google_font_families() {
    $wedding_event_management_google_fonts  = wedding_event_management_get_all_google_fonts();
    $wedding_event_management_font_families = array();
    foreach ( $wedding_event_management_google_fonts as $wedding_event_management_font ) {
        $wedding_event_management_font_families[ $wedding_event_management_font['family'] ] = $wedding_event_management_font['family'];
    }
    return $wedding_event_management_font_families;
}

function wedding_event_management_get_fonts_url() {
    $wedding_event_management_fonts_url = '';
    $wedding_event_management_fonts     = array();

    $wedding_event_management_all_fonts = wedding_event_management_get_all_google_fonts();

    if ( ! empty( get_theme_mod( 'wedding_event_management_site_title_font', 'Raleway' ) ) ) {
        $wedding_event_management_fonts[] = get_theme_mod( 'wedding_event_management_site_title_font', 'Raleway' );
    }

    if ( ! empty( get_theme_mod( 'wedding_event_management_site_description_font', 'Raleway' ) ) ) {
        $wedding_event_management_fonts[] = get_theme_mod( 'wedding_event_management_site_description_font', 'Raleway' );
    }

    if ( ! empty( get_theme_mod( 'wedding_event_management_header_font', 'Sail' ) ) ) {
        $wedding_event_management_fonts[] = get_theme_mod( 'wedding_event_management_header_font', 'Sail' );
    }

    if ( ! empty( get_theme_mod( 'wedding_event_management_content_font', 'Arimo' ) ) ) {
        $wedding_event_management_fonts[] = get_theme_mod( 'wedding_event_management_content_font', 'Arimo' );
    }

    $wedding_event_management_fonts = array_unique( $wedding_event_management_fonts );

    foreach ( $wedding_event_management_fonts as $wedding_event_management_font ) {
        $wedding_event_management_variants      = $wedding_event_management_all_fonts[ $wedding_event_management_font ]['variants'];
        $wedding_event_management_font_family[] = $wedding_event_management_font . ':' . implode( ',', $wedding_event_management_variants );
    }

    $wedding_event_management_query_args = array(
        'family' => urlencode( implode( '|', $wedding_event_management_font_family ) ),
    );

    if ( ! empty( $wedding_event_management_font_family ) ) {
        $wedding_event_management_fonts_url = add_query_arg( $wedding_event_management_query_args, 'https://fonts.googleapis.com/css' );
    }

    return $wedding_event_management_fonts_url;
}

