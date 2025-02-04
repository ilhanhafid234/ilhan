<?php
/**
 * Recommended plugins
 *
 * @package wedding-elegance
 */

if ( ! function_exists( 'wedding_elegance_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function wedding_elegance_recommended_plugins() {

        $plugins = array(  

            array(
                'name'     => esc_html__( 'Contact Form 7', 'wedding-elegance' ),
                'slug'     => 'contact-form-7',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Elementor Website Builder', 'wedding-elegance' ),
                'slug'     => 'elementor',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Recent Posts Widget with Thumbnails', 'wedding-elegance' ),
                'slug'     => 'recent-posts-widget-with-thumbnails',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'One Click Demo Import', 'wedding-elegance' ),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),
        );

        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'wedding_elegance_recommended_plugins' );