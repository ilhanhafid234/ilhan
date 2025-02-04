<?php

/**
 * Render homepage sections.
 */
function wedding_event_management_homepage_sections() {
	$wedding_event_management_homepage_sections = array_keys( wedding_event_management_get_homepage_sections() );

	foreach ( $wedding_event_management_homepage_sections as $wedding_event_management_section ) {
		require get_template_directory() . '/sections/' . $wedding_event_management_section . '.php';
	}
}