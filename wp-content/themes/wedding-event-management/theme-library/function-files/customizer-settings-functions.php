<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package wedding_event_management
 */


 function wedding_event_management_customize_css() {
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_html( get_theme_mod( 'primary_color', '#657150' ) ); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'wedding_event_management_customize_css' );

function wedding_event_management_enqueue_selected_fonts() {
    $wedding_event_management_fonts_url = wedding_event_management_get_fonts_url();
    if (!empty($wedding_event_management_fonts_url)) {
        wp_enqueue_style('wedding-event-management-google-fonts', $wedding_event_management_fonts_url, array(), null);
    }
}
add_action('wp_enqueue_scripts', 'wedding_event_management_enqueue_selected_fonts');

function wedding_event_management_layout_customizer_css() {
    $wedding_event_management_margin = get_theme_mod('wedding_event_management_layout_width_margin', 50);
    ?>
    <style type="text/css">
        body.site-boxed--layout #page  {
            margin: 0 <?php echo esc_attr($wedding_event_management_margin); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'wedding_event_management_layout_customizer_css');

function wedding_event_management_blog_layout_customizer_css() {
    // Retrieve the blog layout option
    $wedding_event_management_blog_layout_option = get_theme_mod('wedding_event_management_blog_layout_option_setting', 'Left');

    // Initialize custom CSS variable
    $wedding_event_management_custom_css = '';

    // Generate custom CSS based on the layout option
    if ($wedding_event_management_blog_layout_option === 'Default') {
        $wedding_event_management_custom_css .= '.mag-post-detail { text-align: center; }';
    } elseif ($wedding_event_management_blog_layout_option === 'Left') {
        $wedding_event_management_custom_css .= '.mag-post-detail { text-align: left; }';
    } elseif ($wedding_event_management_blog_layout_option === 'Right') {
        $wedding_event_management_custom_css .= '.mag-post-detail { text-align: right; }';
    }

    // Output the combined CSS
    ?>
    <style type="text/css">
        <?php echo wp_kses($wedding_event_management_custom_css, array( 'style' => array(), 'text-align' => array() )); ?>
    </style>
    <?php
}
add_action('wp_head', 'wedding_event_management_blog_layout_customizer_css');

function wedding_event_management_sidebar_width_customizer_css() {
    $wedding_event_management_sidebar_width = get_theme_mod('wedding_event_management_sidebar_width', '30');
    ?>
    <style type="text/css">
        .right-sidebar .asterthemes-wrapper .asterthemes-page {
            grid-template-columns: auto <?php echo esc_attr($wedding_event_management_sidebar_width); ?>%;
        }
        .left-sidebar .asterthemes-wrapper .asterthemes-page {
            grid-template-columns: <?php echo esc_attr($wedding_event_management_sidebar_width); ?>% auto;
        }
    </style>
    <?php
}
add_action('wp_head', 'wedding_event_management_sidebar_width_customizer_css');

if ( ! function_exists( 'wedding_event_management_get_page_title' ) ) {
    function wedding_event_management_get_page_title() {
        $wedding_event_management_title = '';

        if (is_404()) {
            $wedding_event_management_title = esc_html__('Page Not Found', 'wedding-event-management');
        } elseif (is_search()) {
            $wedding_event_management_title = esc_html__('Search Results for: ', 'wedding-event-management') . esc_html(get_search_query());
        } elseif (is_home() && !is_front_page()) {
            $wedding_event_management_title = esc_html__('Blogs', 'wedding-event-management');
        } elseif (function_exists('is_shop') && is_shop()) {
            $wedding_event_management_title = esc_html__('Shop', 'wedding-event-management');
        } elseif (is_page()) {
            $wedding_event_management_title = get_the_title();
        } elseif (is_single()) {
            $wedding_event_management_title = get_the_title();
        } elseif (is_archive()) {
            $wedding_event_management_title = get_the_archive_title();
        } else {
            $wedding_event_management_title = get_the_archive_title();
        }

        return apply_filters('wedding_event_management_page_title', $wedding_event_management_title);
    }
}

if ( ! function_exists( 'wedding_event_management_has_page_header' ) ) {
    function wedding_event_management_has_page_header() {
        // Default to true (display header)
        $wedding_event_management_return = true;

        // Custom conditions for disabling the header
        if ('hide-all-devices' === get_theme_mod('wedding_event_management_page_header_visibility', 'all-devices')) {
            $wedding_event_management_return = false;
        }

        // Apply filters and return
        return apply_filters('wedding_event_management_display_page_header', $wedding_event_management_return);
    }
}

if ( ! function_exists( 'wedding_event_management_page_header_style' ) ) {
    function wedding_event_management_page_header_style() {
        $wedding_event_management_style = get_theme_mod('wedding_event_management_page_header_style', 'default');
        return apply_filters('wedding_event_management_page_header_style', $wedding_event_management_style);
    }
}

function wedding_event_management_page_title_customizer_css() {
    $wedding_event_management_layout_option = get_theme_mod('wedding_event_management_page_header_layout', 'left');
    ?>
    <style type="text/css">
        .asterthemes-wrapper.page-header-inner {
            <?php if ($wedding_event_management_layout_option === 'flex') : ?>
                display: flex;
                justify-content: space-between;
                align-items: center;
            <?php else : ?>
                text-align: <?php echo esc_attr($wedding_event_management_layout_option); ?>;
            <?php endif; ?>
        }
    </style>
    <?php
}
add_action('wp_head', 'wedding_event_management_page_title_customizer_css');

function wedding_event_management_pagetitle_height_css() {
    $wedding_event_management_height = get_theme_mod('wedding_event_management_pagetitle_height', 50);
    ?>
    <style type="text/css">
        header.page-header {
            padding: <?php echo esc_attr($wedding_event_management_height); ?>px 0;
        }
    </style>
    <?php
}
add_action('wp_head', 'wedding_event_management_pagetitle_height_css');

function wedding_event_management_site_logo_width() {
    $wedding_event_management_site_logo_width = get_theme_mod('wedding_event_management_site_logo_width', 200);
    ?>
    <style type="text/css">
        .site-logo img {
            max-width: <?php echo esc_attr($wedding_event_management_site_logo_width); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'wedding_event_management_site_logo_width');

function wedding_event_management_menu_font_size_css() {
    $wedding_event_management_menu_font_size = get_theme_mod('wedding_event_management_menu_font_size', 16);
    ?>
    <style type="text/css">
        .main-navigation a {
            font-size: <?php echo esc_attr($wedding_event_management_menu_font_size); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'wedding_event_management_menu_font_size_css');

function wedding_event_management_sidebar_widget_font_size_css() {
    $wedding_event_management_sidebar_widget_font_size = get_theme_mod('wedding_event_management_sidebar_widget_font_size', 24);
    ?>
    <style type="text/css">
        h2.wp-block-heading,aside#secondary .widgettitle,aside#secondary .widget-title {
            font-size: <?php echo esc_attr($wedding_event_management_sidebar_widget_font_size); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'wedding_event_management_sidebar_widget_font_size_css');

// Retrieve the slider visibility setting
$wedding_event_management_slider = get_theme_mod('wedding_event_management_enable_banner_section', false);

// Function to output custom CSS directly in the head section
function wedding_event_management_custom_css() {
    global $wedding_event_management_slider;
    if ($wedding_event_management_slider == false) {
        echo '<style type="text/css">
            .home header.site-header .header-main-wrapper .bottom-header-outer-wrapper .bottom-header-part {
                background: #363636 !important;
                position: relative !important;
            }
        </style>';
    }
}

// Hook the function into the wp_head action
add_action('wp_head', 'wedding_event_management_custom_css');

// Woocommerce Related Products Settings
function wedding_event_management_related_product_css() {
    $wedding_event_management_related_product_show_hide = get_theme_mod('wedding_event_management_related_product_show_hide', true);

    if ( $wedding_event_management_related_product_show_hide != true) {
        ?>
        <style type="text/css">
            .related.products {
                display: none;
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'wedding_event_management_related_product_css');