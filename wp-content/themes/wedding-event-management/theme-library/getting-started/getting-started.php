<?php
/**
 * Getting Started Page.
 *
 * @package wedding_event_management
 */


if( ! function_exists( 'wedding_event_management_getting_started_menu' ) ) :
/**
 * Adding Getting Started Page in admin menu
 */
function wedding_event_management_getting_started_menu(){	
	add_theme_page(
		__( 'Getting Started', 'wedding-event-management' ),
		__( 'Getting Started', 'wedding-event-management' ),
		'manage_options',
		'wedding-event-management-getting-started',
		'wedding_event_management_getting_started_page'
	);
}
endif;
add_action( 'admin_menu', 'wedding_event_management_getting_started_menu' );

if( ! function_exists( 'wedding_event_management_getting_started_admin_scripts' ) ) :
/**
 * Load Getting Started styles in the admin
 */
function wedding_event_management_getting_started_admin_scripts( $hook ){
	// Load styles only on our page
	if( 'appearance_page_wedding-event-management-getting-started' != $hook ) return;

    wp_enqueue_style( 'wedding-event-management-getting-started', get_template_directory_uri() . '/resource/css/getting-started.css', false, WEDDING_EVENT_MANAGEMENT_THEME_VERSION );

    wp_enqueue_script( 'wedding-event-management-getting-started', get_template_directory_uri() . '/resource/js/getting-started.js', array( 'jquery' ), WEDDING_EVENT_MANAGEMENT_THEME_VERSION, true );
}
endif;
add_action( 'admin_enqueue_scripts', 'wedding_event_management_getting_started_admin_scripts' );

if( ! function_exists( 'wedding_event_management_getting_started_page' ) ) :
/**
 * Callback function for admin page.
*/
function wedding_event_management_getting_started_page(){ 
	$wedding_event_management_theme = wp_get_theme();?>
	<div class="wrap getting-started">
		<div class="intro-wrap">
			<div class="intro cointaner">
				<div class="intro-content">
					<h3><?php echo esc_html( 'Welcome to', 'wedding-event-management' );?> <span class="theme-name"><?php echo esc_html( WEDDING_EVENT_MANAGEMENT_THEME_NAME ); ?></span></h3>
					<p class="about-text">
						<?php
						// Remove last sentence of description.
						$wedding_event_management_description = explode( '. ', $wedding_event_management_theme->get( 'Description' ) );

						$wedding_event_management_description = implode( '. ', $wedding_event_management_description );

						echo esc_html( $wedding_event_management_description . '' );
					?></p>
					<div class="btns-getstart">
						<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"target="_blank" class="button button-primary"><?php esc_html_e( 'Customize', 'wedding-event-management' ); ?></a>
						<a class="button button-primary" href="<?php echo esc_url( 'https://wordpress.org/support/theme/wedding-event-management/reviews/#new-post' ); ?>" title="<?php esc_attr_e( 'Visit the Review', 'wedding-event-management' ); ?>" target="_blank">
							<?php esc_html_e( 'Review', 'wedding-event-management' ); ?>
						</a>
						<a class="button button-primary" href="<?php echo esc_url( 'https://wordpress.org/support/theme/wedding-event-management' ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'wedding-event-management' ); ?>" target="_blank">
							<?php esc_html_e( 'Contact Support', 'wedding-event-management' ); ?>
						</a>
					</div>
					<div class="btns-wizard">
						<a class="wizard" href="<?php echo esc_url( admin_url( 'themes.php?page=weddingeventmanagement-wizard' ) ); ?>"target="_blank" class="button button-primary"><?php esc_html_e( 'One Click Demo Setup', 'wedding-event-management' ); ?></a>
					</div>
				</div>
				<div class="intro-img">
					<img src="<?php echo esc_url(get_template_directory_uri()) .'/screenshot.png'; ?>" />
				</div>				
			</div>
		</div>

		<div class="cointaner panels">
			<ul class="inline-list">
				<li class="current">
                    <a id="help" href="javascript:void(0);">
                        <?php esc_html_e( 'Getting Started', 'wedding-event-management' ); ?>
                    </a>
                </li>
				<li>
                    <a id="free-pro-panel" href="javascript:void(0);">
                        <?php esc_html_e( 'Free Vs Pro', 'wedding-event-management' ); ?>
                    </a>
                </li>
			</ul>
			<div id="panel" class="panel">
				<?php require get_template_directory() . '/theme-library/getting-started/tabs/help-panel.php'; ?>
				<?php require get_template_directory() . '/theme-library/getting-started/tabs/free-vs-pro-panel.php'; ?>
				<?php require get_template_directory() . '/theme-library/getting-started/tabs/link-panel.php'; ?>
			</div>
		</div>
	</div>
	<?php
}
endif;