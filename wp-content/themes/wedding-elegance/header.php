<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section, opens the <body> tag and adds the site's header.
 *
 * @package Wedding Elegance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main_content">
<?php _e( 'Skip to content', 'wedding-elegance' ); ?></a>
<?php
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}
	$site_name = get_bloginfo( 'name' );
	$tagline   = get_bloginfo( 'description', 'display' );
	$header_nav_menu = wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'fallback_cb' => false,
			'echo' => false,
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'container'      => false,
			'menu_class'     => 'main-navigation',
			'walker'   => new Wedding_Elegance_Walker_Page(),
		)
	);

	?>
	<header id="site-header" class="site-header dynamic-header menu-dropdown-tablet" role="banner">
		<div class="container header-inner">
			<div class="site-branding">
				<div class="site-branding-col">
					<?php
					if ( has_custom_logo() ) {
						the_custom_logo();
					} elseif ( $site_name ) {
						?>
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Home', 'wedding-elegance' ); ?>" rel="home">
								<?php echo esc_html( $site_name ); ?>
							</a>
						</h1>
						<p class="site-description">
							<?php
							if ( $tagline ) {
								echo esc_html( $tagline );
							}
							?>
						</p>
					<?php } ?>
				</div>
			<div class="site-branding-col">
				<div id="menu-header">
					<div class="header-inner-menu">
						<div class="main-navigation-wrapper">
							<?php if ( $header_nav_menu ) : ?>
								<button class="site-navigation-toggle-holder">
									<div class="site-navigation-toggle">
										<i class="eicon-menu-bar"></i>
										<span class="elementor-screen-only"><?php echo __( 'Menu', 'wedding-elegance' ); ?></span>
									</div>
								</button>
								<nav class="site-navigation" role="navigation" aria-label="<?php _e( 'Main Menu', 'wedding-elegance' ); ?>">
									<div class="menu-primary-navigation-container">
										<?php echo $header_nav_menu; ?>
									</div>
								</nav>
							<?php else: ?>
								<button class="site-navigation-toggle-holder">
									<div class="site-navigation-toggle">
										<i class="eicon-menu-bar"></i>
										<span class="elementor-screen-only"><?php echo __( 'Menu', 'wedding-elegance' ); ?></span>
									</div>
								</button>
								<nav class="site-navigation" role="navigation" aria-label="<?php _e( 'Main Menu', 'wedding-elegance' ); ?>">
									<div class="menu-primary-navigation-container">
										<ul id="menu-primary-navigation" class="main-navigation">
											<?php 
												wp_list_pages( array(
												    'title_li' => '',
												) );
											?>
										</ul>
									</div>
								</nav>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div class="mobile-menu-modal" id="mobile_modal">

		<div class="modal-inner">
			<div class="align-right">
				<button class="site-navigation-toggle-holder mobile-close">
					<div class="site-navigation-toggle">
						<span><?php echo __( 'Close Menu', 'wedding-elegance' ); ?></span>
						<i class="eicon-close"></i>
					</div>
				</button>
			</div>
			
			<nav class="site-navigation-mobile" aria-label="Mobile">
				<?php
					if ( $header_nav_menu ){
						echo $header_nav_menu;
					}
					else {
				?>
					<ul id="menu-primary-navigation" class="main-navigation">
						<?php 
							wp_list_pages( array(
							    'title_li' => '',
							) );
						?>
					</ul>
				<?php
					} 
				?>
			</nav>
		</div>
	</div>