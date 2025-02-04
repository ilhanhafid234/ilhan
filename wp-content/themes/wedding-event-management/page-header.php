<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! wedding_event_management_has_page_header() ) {
    return;
}

$wedding_event_management_classes = array( 'page-header' );
$wedding_event_management_style = wedding_event_management_page_header_style();

if ( $wedding_event_management_style ) {
    $wedding_event_management_classes[] = $wedding_event_management_style . '-page-header';
}

$wedding_event_management_visibility = get_theme_mod( 'wedding_event_management_page_header_visibility', 'all-devices' );

if ( 'hide-all-devices' === $wedding_event_management_visibility ) {
    // Don't show the header at all
    return;
}

if ( 'hide-tablet' === $wedding_event_management_visibility ) {
    $wedding_event_management_classes[] = 'hide-on-tablet';
} elseif ( 'hide-mobile' === $wedding_event_management_visibility ) {
    $wedding_event_management_classes[] = 'hide-on-mobile';
} elseif ( 'hide-tablet-mobile' === $wedding_event_management_visibility ) {
    $wedding_event_management_classes[] = 'hide-on-tablet-mobile';
}

$wedding_event_management_PAGE_TITLE_background_color = get_theme_mod('wedding_event_management_page_title_background_color_setting', '');

// Get the toggle switch value
$wedding_event_management_background_image_enabled = get_theme_mod('wedding_event_management_page_header_style', true);

// Add background image to the header if enabled
$wedding_event_management_background_image = get_theme_mod( 'wedding_event_management_page_header_background_image', '' );
$wedding_event_management_background_height = get_theme_mod( 'wedding_event_management_page_header_image_height', '200' );
$wedding_event_management_inline_style = '';

if ( $wedding_event_management_background_image_enabled && ! empty( $wedding_event_management_background_image ) ) {
    $wedding_event_management_inline_style .= 'background-image: url(' . esc_url( $wedding_event_management_background_image ) . '); ';
    $wedding_event_management_inline_style .= 'height: ' . esc_attr( $wedding_event_management_background_height ) . 'px; ';
    $wedding_event_management_inline_style .= 'background-size: cover; ';
    $wedding_event_management_inline_style .= 'background-position: center center; ';

    // Add the unique class if the background image is set
    $wedding_event_management_classes[] = 'has-background-image';
}

$wedding_event_management_classes = implode( ' ', $wedding_event_management_classes );
$wedding_event_management_heading = get_theme_mod( 'wedding_event_management_page_header_heading_tag', 'h1' );
$wedding_event_management_heading = apply_filters( 'wedding_event_management_page_header_heading', $wedding_event_management_heading );

?>

<?php do_action( 'wedding_event_management_before_page_header' ); ?>

<header class="<?php echo esc_attr( $wedding_event_management_classes ); ?>" style="<?php echo esc_attr( $wedding_event_management_inline_style ); ?> background-color: <?php echo esc_attr($wedding_event_management_PAGE_TITLE_background_color); ?>;">

    <?php do_action( 'wedding_event_management_before_page_header_inner' ); ?>

    <div class="asterthemes-wrapper page-header-inner">

        <?php if ( wedding_event_management_has_page_header() ) : ?>

            <<?php echo esc_attr( $wedding_event_management_heading ); ?> class="page-header-title">
                <?php echo wp_kses_post( wedding_event_management_get_page_title() ); ?>
            </<?php echo esc_attr( $wedding_event_management_heading ); ?>>

        <?php endif; ?>

        <?php if ( function_exists( 'wedding_event_management_breadcrumb' ) ) : ?>
            <?php wedding_event_management_breadcrumb(); ?>
        <?php endif; ?>

    </div><!-- .page-header-inner -->

    <?php do_action( 'wedding_event_management_after_page_header_inner' ); ?>

</header><!-- .page-header -->

<?php do_action( 'wedding_event_management_after_page_header' ); ?>