<?php
/**
 * Custom page walker for this theme.
 *
 * @package WordPress
 * @subpackage Wedding_Elegance
 * @since Wedding Elegance 1.0
 */

if ( ! class_exists( 'Wedding_Elegance_Walker_Page' ) ) {
	/**
	 * CUSTOM PAGE WALKER
	 * A custom walker for pages.
	 */
	class Wedding_Elegance_Walker_Page extends Walker_Nav_Menu {

		function start_el(&$output, $item, $depth=0, $args=[], $id=0) {
				$output .= "<li class='" .  implode(" ", $item->classes) . "'>";

				if ($item->url) {
					$output .= '<a href="' . $item->url . '">';
				} else {
					$output .= '<span>';
				}
		 
				$output .= $item->title;
		 
				if ($item->url) {
					$output .= '</a>';
				} else {
					$output .= '</span>';
				}
		 
				if ($args->walker->has_children) {
					$output .= '<button type="button" class="sub-menu-toggle fill-children-current-color"><span class="screen-reader-text">' . __( 'Show sub menu', 'wedding-elegance' ) . '</span>' . '<i class="fa fa-chevron-down"></i>' . '</button>';;
				}
		}
	}
}
