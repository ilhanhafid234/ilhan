<?php
/**
 * Active Callbacks
 *
 * @package wedding_event_management
 */

// Theme Options.
function wedding_event_management_is_pagination_enabled( $wedding_event_management_control ) {
	return ( $wedding_event_management_control->manager->get_setting( 'wedding_event_management_enable_pagination' )->value() );
}
function wedding_event_management_is_breadcrumb_enabled( $wedding_event_management_control ) {
	return ( $wedding_event_management_control->manager->get_setting( 'wedding_event_management_enable_breadcrumb' )->value() );
}
function wedding_event_management_is_layout_enabled( $wedding_event_management_control ) {
	return ( $wedding_event_management_control->manager->get_setting( 'wedding_event_management_website_layout' )->value() );
}
function wedding_event_management_is_pagetitle_bcakground_image_enabled( $wedding_event_management_control ) {
	return ( $wedding_event_management_control->manager->get_setting( 'wedding_event_management_page_header_style' )->value() );
}
function wedding_event_management_is_preloader_style( $wedding_event_management_control ) {
	return ( $wedding_event_management_control->manager->get_setting( 'wedding_event_management_enable_preloader' )->value() );
}

// Banner Slider Section.
function wedding_event_management_is_banner_slider_section_enabled( $wedding_event_management_control ) {
	return ( $wedding_event_management_control->manager->get_setting( 'wedding_event_management_enable_banner_section' )->value() );
}
function wedding_event_management_is_banner_slider_section_and_content_type_post_enabled( $wedding_event_management_control ) {
	$wedding_event_management_content_type = $wedding_event_management_control->manager->get_setting( 'wedding_event_management_banner_slider_content_type' )->value();
	return ( wedding_event_management_is_banner_slider_section_enabled( $wedding_event_management_control ) && ( 'post' === $wedding_event_management_content_type ) );
}
function wedding_event_management_is_banner_slider_section_and_content_type_page_enabled( $wedding_event_management_control ) {
	$wedding_event_management_content_type = $wedding_event_management_control->manager->get_setting( 'wedding_event_management_banner_slider_content_type' )->value();
	return ( wedding_event_management_is_banner_slider_section_enabled( $wedding_event_management_control ) && ( 'page' === $wedding_event_management_content_type ) );
}

//Testimonial Section.
function wedding_event_management_is_testimonial_section_enabled( $wedding_event_management_control ) {
	return ( $wedding_event_management_control->manager->get_setting( 'wedding_event_management_enable_testimonial_section' )->value() );
}
function wedding_event_management_is_service_section_and_content_type_post_enabled( $wedding_event_management_control ) {
	$wedding_event_management_content_type = $wedding_event_management_control->manager->get_setting( 'wedding_event_management_testimonial_content_type' )->value();
	return ( wedding_event_management_is_testimonial_section_enabled( $wedding_event_management_control ) && ( 'post' === $wedding_event_management_content_type ) );
}
function wedding_event_management_is_service_section_and_content_type_page_enabled( $wedding_event_management_control ) {
	$wedding_event_management_content_type = $wedding_event_management_control->manager->get_setting( 'wedding_event_management_testimonial_content_type' )->value();
	return ( wedding_event_management_is_testimonial_section_enabled( $wedding_event_management_control ) && ( 'page' === $wedding_event_management_content_type ) );
}