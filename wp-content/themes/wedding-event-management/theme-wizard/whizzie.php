<?php
/**
 * Wizard
 *
 * @package Whizzie
 * @author Aster Themes
 * @since 1.0.0
 */

class Whizzie {

	protected $version = '1.1.0';
	protected $theme_name = '';
	protected $theme_title = '';
	protected $page_slug = '';
	protected $page_title = '';
	protected $config_steps = array();
	public $plugin_path;
	public $parent_slug;
	
	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $plugin_url = '';

	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $tgmpa_instance;

	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $tgmpa_menu_slug = 'tgmpa-install-plugins';

	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';

	/*** Constructor ***
	* @param $config	Our config parameters
	*/
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();
	}

	/**
	* Set some settings
	* @since 1.0.0
	* @param $config	Our config parameters
	*/

	public function set_vars( $config ) {
		// require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/class-tgm-plugin-activation.php';
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/tgm.php';

		if( isset( $config['page_slug'] ) ) {
			$this->page_slug = esc_attr( $config['page_slug'] );
		}
		if( isset( $config['page_title'] ) ) {
			$this->page_title = esc_attr( $config['page_title'] );
		}
		if( isset( $config['steps'] ) ) {
			$this->config_steps = $config['steps'];
		}

		$this->plugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->plugin_path );
		$this->plugin_url = trailingslashit( get_template_directory_uri() . $relative_url );
		$current_theme = wp_get_theme();
		$this->theme_title = $current_theme->get( 'Name' );
		$this->theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $current_theme->get( 'Name' ) ) );
		$this->page_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_page_slug', $this->theme_name . '-wizard' );
		$this->parent_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_parent_slug', '' );
	}

	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */
	public function init() {
		if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_setup_plugins', array( $this, 'setup_plugins' ) );
		add_action( 'wp_ajax_setup_widgets', array( $this, 'setup_widgets' ) );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'theme-wizard-style', get_template_directory_uri() . '/theme-wizard/assets/css/theme-wizard-style.css');
		wp_register_script( 'theme-wizard-script', get_template_directory_uri() . '/theme-wizard/assets/js/theme-wizard-script.js', array( 'jquery' ), );

		wp_localize_script(
			'theme-wizard-script',
			'wedding_event_management_whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'verify_text'	=> esc_html( 'verifying', 'wedding-event-management' )
			)
		);
		wp_enqueue_script( 'theme-wizard-script' );
	}

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}

	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2*/
	public function get_tgmpa_instance() {
		$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}

	/**
	 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tgmpa_url() {
		$this->tgmpa_menu_slug = ( property_exists( $this->tgmpa_instance, 'menu' ) ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
		$this->tgmpa_menu_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->tgmpa_instance, 'parent_slug' ) && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->tgmpa_url = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug );
	}

	/***        Make a modal screen for the wizard        ***/
	
	public function menu_page() {
		add_theme_page( esc_html( $this->page_title ), esc_html( $this->page_title ), 'manage_options', $this->page_slug, array( $this, 'wedding_event_management_setup_wizard' ) );
	}

	/***        Make an interface for the wizard        ***/

	public function wizard_page() {
		tgmpa_load_bulk_installer();
		// install plugins with TGM.
		if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
			die( 'Failed to find TGM' );
		}
		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );

		// copied from TGM
		$method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
		$fields = array_keys( $_POST ); // Extra fields to pass to WP_Filesystem.
		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true; // Stop the normal page form from displaying, credential request form will be shown.
		}
		// Now we have some credentials, setup WP_Filesystem.
		if ( ! WP_Filesystem( $creds ) ) {
			// Our credentials were no good, ask the user for them again.
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}
		/* If we arrive here, we have the filesystem */ ?>
		<div class="main-wrap">
			<?php
			echo '<div class="card whizzie-wrap">';
				// The wizard is a list with only one item visible at a time
				$steps = $this->get_steps();
				echo '<ul class="whizzie-menu">';
				foreach( $steps as $step ) {
					$class = 'step step-' . esc_attr( $step['id'] );
					echo '<li data-step="' . esc_attr( $step['id'] ) . '" class="' . esc_attr( $class ) . '">';
						printf( '<h2>%s</h2>', esc_html( $step['title'] ) );
						// $content is split into summary and detail
						$content = call_user_func( array( $this, $step['view'] ) );
						if( isset( $content['summary'] ) ) {
							printf(
								'<div class="summary">%s</div>',
								wp_kses_post( $content['summary'] )
							);
						}
						if( isset( $content['detail'] ) ) {
							// Add a link to see more detail
							printf( '<p><a href="#" class="more-info">%s</a></p>', __( 'More Info', 'wedding-event-management' ) );
							printf(
								'<div class="detail">%s</div>',
								$content['detail'] // Need to escape this
							);
						}
						// The next button
						if( isset( $step['button_text'] ) && $step['button_text'] ) {
							printf(
								'<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
								esc_attr( $step['callback'] ),
								esc_attr( $step['id'] ),
								esc_html( $step['button_text'] )
							);
						}
					echo '</li>';
				}
				echo '</ul>';
				?>
				<div class="step-loading"><span class="spinner"></span></div>
			</div><!-- .whizzie-wrap -->

		</div><!-- .wrap -->
	<?php }



	public function activation_page() {
		?>
		<div class="main-wrap">
			<h3><?php esc_html_e('Theme Setup Wizard','wedding-event-management'); ?></h3>
		</div>
		<?php
	}

	public function wedding_event_management_setup_wizard(){

			$display_string = '';

			$body = [
				'site_url'					 => site_url(),
				'theme_text_domain'	 => wp_get_theme()->get( 'TextDomain' )
			];

			$body = wp_json_encode( $body );
			$options = [
				'body'        => $body,
				'sslverify' 	=> false,
				'headers'     => [
					'Content-Type' => 'application/json',
				]
			];

			//custom function about theme customizer
			$return = add_query_arg( array()) ;
			$theme = wp_get_theme( 'wedding-event-management' );

			?>
				<div class="wrapper-info get-stared-page-wrap">
					<div class="tab-sec theme-option-tab">
						<div id="demo_offer" class="tabcontent">
							<?php $this->wizard_page(); ?>
						</div>
					</div>
				</div>
			<?php
	}
	

	/**
	* Set options for the steps
	* Incorporate any options set by the theme dev
	* Return the array for the steps
	* @return Array
	*/
	public function get_steps() {
		$dev_steps = $this->config_steps;
		$steps = array(
			'intro' => array(
				'id'			=> 'intro',
				'title'			=> __( 'Welcome to ', 'wedding-event-management' ) . $this->theme_title,
				'icon'			=> 'dashboard',
				'view'			=> 'get_step_intro', // Callback for content
				'callback'		=> 'do_next_step', // Callback for JS
				'button_text'	=> __( 'Start Now', 'wedding-event-management' ),
				'can_skip'		=> false // Show a skip button?
			),
			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Plugins', 'wedding-event-management' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'Install Plugins', 'wedding-event-management' ),
				'can_skip'		=> true
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Demo Importer', 'wedding-event-management' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'install_widgets',
				'button_text'	=> __( 'Import Demo', 'wedding-event-management' ),
				'can_skip'		=> true
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'All Done', 'wedding-event-management' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> ''
			)
		);

		// Iterate through each step and replace with dev config values
		if( $dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from config.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $dev_steps as $dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $dev_step['id'] ) ) {
					$id = $dev_step['id'];
					if( isset( $steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $dev_step[$element] ) ) {
								$steps[$id][$element] = $dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $steps;
	}

	/*** Display the content for the intro step ***/
	public function get_step_intro() { ?>
		<div class="summary">
			<p style="text-align: center;"><?php esc_html_e( 'Thank you for choosing our theme! We are excited to help you get started with your new website.', 'wedding-event-management' ); ?></p>
			<p style="text-align: center;"><?php esc_html_e( 'To ensure you make the most of our theme, we recommend following the setup steps outlined here. This process will help you configure the theme to best suit your needs and preferences. Click on the "Start Now" button to begin the setup.', 'wedding-event-management' ); ?></p>
		</div>
	<?php }
	
	

	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	public function get_step_plugins() {
		$plugins = $this->get_plugins();
		$content = array(); ?>
			<div class="summary">
				<p>
					<?php esc_html_e('Additional plugins always make your website exceptional. Install these plugins by clicking the install button. You may also deactivate them from the dashboard.','wedding-event-management') ?>
				</p>
			</div>
		<?php // The detail element is initially hidden from the user
		$content['detail'] = '<ul class="whizzie-do-plugins">';
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug=>$plugin ) {
			$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $plugin['name'] ) . '<span>';
			$keys = array();
			if ( isset( $plugins['install'][ $slug ] ) ) {
			    $keys[] = 'Installation';
			}
			if ( isset( $plugins['update'][ $slug ] ) ) {
			    $keys[] = 'Update';
			}
			if ( isset( $plugins['activate'][ $slug ] ) ) {
			    $keys[] = 'Activation';
			}
			$content['detail'] .= implode( ' and ', $keys ) . ' required';
			$content['detail'] .= '</span></li>';
		}
		$content['detail'] .= '</ul>';

		return $content;
	}

	/*** Display the content for the widgets step ***/
	public function get_step_widgets() { ?>
		<div class="summary">
			<p><?php esc_html_e('To get started, use the button below to import demo content and add widgets to your site. After installation, you can manage settings and customize your site using the Customizer. Enjoy your new theme!', 'wedding-event-management'); ?></p>
		</div>
	<?php }

	/***        Print the content for the final step        ***/

	public function get_step_done() { ?>
		<div id="aster-demo-setup-guid">
			<div class="aster-setup-menu">
				<h3><?php esc_html_e('Setup Navigation Menu','wedding-event-management'); ?></h3>
				<p><?php esc_html_e('Follow the following Steps to Setup Menu','wedding-event-management'); ?></p>
				<h4><?php esc_html_e('A) Create Pages','wedding-event-management'); ?></h4>
				<ol>
					<li><?php esc_html_e('Go to Dashboard >> Pages >> Add New','wedding-event-management'); ?></li>
					<li><?php esc_html_e('Enter Page Details And Save Changes','wedding-event-management'); ?></li>
				</ol>
				<h4><?php esc_html_e('B) Add Pages To Menu','wedding-event-management'); ?></h4>
				<ol>
					<li><?php esc_html_e('Go to Dashboard >> Appearance >> Menu','wedding-event-management'); ?></li>
					<li><?php esc_html_e('Click On The Create Menu Option','wedding-event-management'); ?></li>
					<li><?php esc_html_e('Select The Pages And Click On The Add to Menu Button','wedding-event-management'); ?></li>
					<li><?php esc_html_e('Select Primary Menu From The Menu Setting','wedding-event-management'); ?></li>
					<li><?php esc_html_e('Click On The Save Menu Button','wedding-event-management'); ?></li>
				</ol>
			</div>
			<div class="aster-setup-widget">
				<h3><?php esc_html_e('Setup Footer Widgets','wedding-event-management'); ?></h3>
				<p><?php esc_html_e('Follow the following Steps to Setup Footer Widgets','wedding-event-management'); ?></p>
				<ol>
					<li><?php esc_html_e('Go to Dashboard >> Appearance >> Widgets','wedding-event-management'); ?></li>
					<li><?php esc_html_e('Drag And Add The Widgets In The Footer Columns','wedding-event-management'); ?></li>
				</ol>
			</div>
			<div style="display:flex; justify-content: center; margin-top: 20px; gap:20px">
				<div class="aster-setup-finish">
					<a target="_blank" href="<?php echo esc_url(home_url()); ?>" class="button button-primary">Visit Site</a>
				</div>
				<div class="aster-setup-finish">
					<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>" class="button button-primary">Customize Your Demo</a>
				</div>
				<div class="aster-setup-finish">
					<a target="_blank" href="<?php echo esc_url( admin_url('themes.php?page=wedding-event-management-getting-started') ); ?>" class="button button-primary">Getting Started</a>
				</div>
			</div>
		</div>
	<?php }

	/***       Get the plugins registered with TGMPA       ***/
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug=>$plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}


	public function setup_plugins() {
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();

		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','wedding-event-management' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','wedding-event-management' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','wedding-event-management' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','wedding-event-management' ) ) );
		}
		exit;
	}

	/***------------------------------------------------- Imports the Demo Content* @since 1.1.0 ----------------------------------------------****/


	//                      ------------- MENUS -----------------                    //

	public function wedding_event_management_customizer_primary_menu(){
		// ------- Create Primary Menu --------
		$wedding_event_management_themename = 'Wedding Event Management'; // Ensure the theme name is set
		$wedding_event_management_menuname = $wedding_event_management_themename . ' Primary Menu';
		$wedding_event_management_bpmenulocation = 'primary';
		$wedding_event_management_menu_exists = wp_get_nav_menu_object($wedding_event_management_menuname);
	
		if( !$wedding_event_management_menu_exists ) {
			$wedding_event_management_menu_id = wp_create_nav_menu($wedding_event_management_menuname);
			
			// Home
			wp_update_nav_menu_item($wedding_event_management_menu_id, 0, array(
				'menu-item-title' => __('Home', 'wedding-event-management'),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url('/'),
				'menu-item-status' => 'publish'
			));

			// Portfolio
			$page_portfolio = get_page_by_path('portfolio');
			if($page_portfolio){
				wp_update_nav_menu_item($wedding_event_management_menu_id, 0, array(
					'menu-item-title' => __('Portfolio', 'wedding-event-management'),
					'menu-item-classes' => 'portfolio',
					'menu-item-url' => get_permalink($page_portfolio),
					'menu-item-status' => 'publish'
				));
			}

			// Services
			$page_services = get_page_by_path('services'); // Preferred over get_page_by_title()
			if($page_services){
				wp_update_nav_menu_item($wedding_event_management_menu_id, 0, array(
					'menu-item-title' => __('Services', 'wedding-event-management'),
					'menu-item-classes' => 'services',
					'menu-item-url' => get_permalink($page_services),
					'menu-item-status' => 'publish'
				));
			}
	
			// Blogs
			$page_blog = get_page_by_path('blog');
			if($page_blog){
				wp_update_nav_menu_item($wedding_event_management_menu_id, 0, array(
					'menu-item-title' => __('Blogs', 'wedding-event-management'),
					'menu-item-classes' => 'blog',
					'menu-item-url' => get_permalink($page_blog),
					'menu-item-status' => 'publish'
				));
			}

			// Contact
			$page_contact = get_page_by_path('contact');
			if($page_contact){
				wp_update_nav_menu_item($wedding_event_management_menu_id, 0, array(
					'menu-item-title' => __('Contact', 'wedding-event-management'),
					'menu-item-classes' => 'contact',
					'menu-item-url' => get_permalink($page_contact),
					'menu-item-status' => 'publish'
				));
			}
	
			// Assign menu to location if not set
			if( !has_nav_menu($wedding_event_management_bpmenulocation) ){
				$locations = get_theme_mod('nav_menu_locations');
				$locations[$wedding_event_management_bpmenulocation] = $wedding_event_management_menu_id;
				set_theme_mod('nav_menu_locations', $locations);
			}
		}
	}

	public function wedding_event_management_customizer_social_nav_menu() {

		// Loop through and create individual social menus for testimonials
		for ($i = 1; $i <= 2; $i++) {
			$wedding_event_management_menuname = 'Testimonial Social Menu ' . $i;
			$wedding_event_management_bpmenulocation = 'testimonial-' . $i;
			$wedding_event_management_menu_exists = wp_get_nav_menu_object($wedding_event_management_menuname);
	
			if (!$wedding_event_management_menu_exists) {
				$wedding_event_management_menu_id = wp_create_nav_menu($wedding_event_management_menuname);
	
				wp_update_nav_menu_item($wedding_event_management_menu_id, 0, array(
					'menu-item-title'  => __('Facebook', 'wedding-event-management'),
					'menu-item-url'    => 'https://www.facebook.com',
					'menu-item-status' => 'publish',
				));
	
				wp_update_nav_menu_item($wedding_event_management_menu_id, 0, array(
					'menu-item-title'  => __('Twitter', 'wedding-event-management'),
					'menu-item-url'    => 'https://www.twitter.com',
					'menu-item-status' => 'publish',
				));
	
				wp_update_nav_menu_item($wedding_event_management_menu_id, 0, array(
					'menu-item-title'  => __('Instagram', 'wedding-event-management'),
					'menu-item-url'    => 'https://www.instagram.com',
					'menu-item-status' => 'publish',
				));
	
				// Assign the created menu to the corresponding location
				if (!has_nav_menu($wedding_event_management_bpmenulocation)) {
					$locations = get_theme_mod('nav_menu_locations');
					$locations[$wedding_event_management_bpmenulocation] = $wedding_event_management_menu_id;
					set_theme_mod('nav_menu_locations', $locations);
				}
			}
		}
	}

	//                      ------------- /*** Imports demo content ***/ -----------------                    //

	public function setup_widgets() {

		// Create a front page and assign the template
		$wedding_event_management_home_title = 'Home';
		$wedding_event_management_home_check = get_page_by_path('home');
		if (!$wedding_event_management_home_check) {
			$wedding_event_management_home = array(
				'post_type'    => 'page',
				'post_title'   => $wedding_event_management_home_title,
				'post_status'  => 'publish',
				'post_author'  => 1,
				'post_name'    => 'home' // Unique slug for the home page
			);
			$wedding_event_management_home_id = wp_insert_post($wedding_event_management_home);

			// Set the static front page
			if (!is_wp_error($wedding_event_management_home_id)) {
				update_option('page_on_front', $wedding_event_management_home_id);
				update_option('show_on_front', 'page');
			}
		}

		// Create a posts page and assign the template
		$wedding_event_management_blog_title = 'Blogs';
		$wedding_event_management_blog_check = get_page_by_path('blog');
		if (!$wedding_event_management_blog_check) {
			$wedding_event_management_blog = array(
				'post_type'    => 'page',
				'post_title'   => $wedding_event_management_blog_title,
				'post_status'  => 'publish',
				'post_author'  => 1,
				'post_name'    => 'blog' // Unique slug for the blog page
			);
			$wedding_event_management_blog_id = wp_insert_post($wedding_event_management_blog);

			// Set the posts page
			if (!is_wp_error($wedding_event_management_blog_id)) {
				update_option('page_for_posts', $wedding_event_management_blog_id);
			}
		}

		// Create a Services page and assign the template
		$wedding_event_management_services_title = 'Services';
		$wedding_event_management_services_check = get_page_by_path('services');
		if (!$wedding_event_management_services_check) {
			$wedding_event_management_services = array(
				'post_type'    => 'page',
				'post_title'   => $wedding_event_management_services_title,
				'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
				'post_status'  => 'publish',
				'post_author'  => 1,
				'post_name'    => 'services' // Unique slug for the Services page
			);
			wp_insert_post($wedding_event_management_services);
		}

		// Create a Portfolio page and assign the template
		$wedding_event_management_portfolio_title = 'Portfolio';
		$wedding_event_management_portfolio_check = get_page_by_path('portfolio');
		if (!$wedding_event_management_portfolio_check) {
			$wedding_event_management_portfolio = array(
				'post_type'    => 'page',
				'post_title'   => $wedding_event_management_portfolio_title,
				'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
				'post_status'  => 'publish',
				'post_author'  => 1,
				'post_name'    => 'portfolio' // Unique slug for the Portfolio page
			);
			wp_insert_post($wedding_event_management_portfolio);
		}

		// Create a Contact page and assign the template
		$wedding_event_management_contact_title = 'Contact';
		$wedding_event_management_contact_check = get_page_by_path('contact');
		if (!$wedding_event_management_contact_check) {
			$wedding_event_management_contact = array(
				'post_type'    => 'page',
				'post_title'   => $wedding_event_management_contact_title,
				'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
				'post_status'  => 'publish',
				'post_author'  => 1,
				'post_name'    => 'contact' // Unique slug for the Contact page
			);
			wp_insert_post($wedding_event_management_contact);
		}

		/*----------------------------------------- Header Button --------------------------------------------------*/	


		// ------------------------------------------ Blogs for Sections --------------------------------------

			// Create categories if not already created
			$wedding_event_management_category_slider = wp_create_category('Slider');
			$wedding_event_management_category_testimonial = wp_create_category('Testimonial');

			// Array of categories to assign to each set of posts
			$wedding_event_management_categories = array($wedding_event_management_category_slider, $wedding_event_management_category_testimonial);
			
			// Array of image URLs for the "Services" category
			$services_images = array(
				get_template_directory_uri() . '/resource/img/testimonial1.png',
				get_template_directory_uri() . '/resource/img/testimonial2.png',
			);

			// Loop to create posts
			for ($i = 1; $i <= 5; $i++) {
				$title = array(
					'From The Smallest Event To Grandest Event',
					'From Simple Gatherings To Grand Celebrations',
					'From Intimate Moments To Spectacular Events',
					'Alia Carry',
					'Larry Brook',
				);

				$content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.';

				// Determine category and post index to use for title
				$category_index = ($i <= 3) ? 0 : 1; // First 3 for Slider, next 3 for Blog
				$post_title = $title[$i - 1]; // Adjust for zero-based index in title array

				// Create post object
				$my_post = array(
					'post_title'    => wp_strip_all_tags($post_title),
					'post_content'  => $content,
					'post_status'   => 'publish',
					'post_type'     => 'post',
					'post_category' => array($wedding_event_management_categories[$category_index]), // Assign Slider to first 3, Blog to next 3
				);

				// Insert the post into the database
				$post_id = wp_insert_post($my_post);

				// Determine the category and set image URLs based on category
				if ($category_index === 0) { // Slider category
					$wedding_event_management_image_url = get_template_directory_uri() . '/resource/img/slider.png';
					$wedding_event_management_image_name = 'slider.png';
				} else { // Services category
					// Use different images for each post in Services category
					$service_image_index = $i - 4; // Get the correct index for the Services images array (4, 5, 6, 7 corresponds to 0, 1, 2, 3)
					$wedding_event_management_image_url = $services_images[$service_image_index];
					$wedding_event_management_image_name = basename($wedding_event_management_image_url);
				}

				$wedding_event_management_upload_dir = wp_upload_dir();
				$wedding_event_management_image_data = file_get_contents($wedding_event_management_image_url);
				$wedding_event_management_unique_file_name = wp_unique_filename($wedding_event_management_upload_dir['path'], $wedding_event_management_image_name);
				$filename = basename($wedding_event_management_unique_file_name);

				if (wp_mkdir_p($wedding_event_management_upload_dir['path'])) {
					$file = $wedding_event_management_upload_dir['path'] . '/' . $filename;
				} else {
					$file = $wedding_event_management_upload_dir['basedir'] . '/' . $filename;
				}

				if ( ! function_exists( 'WP_Filesystem' ) ) {
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
				}
				
				WP_Filesystem();
				global $wp_filesystem;
				
				if ( ! $wp_filesystem->put_contents( $file, $wedding_event_management_image_data, FS_CHMOD_FILE ) ) {
					wp_die( 'Error saving file!' );
				}

				$wp_filetype = wp_check_filetype($filename, null);
				$attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title'     => sanitize_file_name($filename),
					'post_content'   => '',
					'post_status'    => 'inherit'
				);

				$wedding_event_management_attach_id = wp_insert_attachment($attachment, $file, $post_id);

				require_once(ABSPATH . 'wp-admin/includes/image.php');

				$wedding_event_management_attach_data = wp_generate_attachment_metadata($wedding_event_management_attach_id, $file);
				wp_update_attachment_metadata($wedding_event_management_attach_id, $wedding_event_management_attach_data);
				set_post_thumbnail($post_id, $wedding_event_management_attach_id);
			}

		
		// ---------------------------------------- Slider --------------------------------------------------- //

			for($i=1; $i<=3; $i++) {
				set_theme_mod('wedding_event_management_banner_button_label_'.$i,'View More');
				set_theme_mod('wedding_event_management_banner_button_link_'.$i,'');
			}


		// ---------------------------------------- Services --------------------------------------------------- //

			set_theme_mod('wedding_event_management_testimonial_heading','Testimonial');
			set_theme_mod('wedding_event_management_testimonial_content','They Said We Are Best');
			set_theme_mod('wedding_event_management_enable_testimonial_section',true);
			

		// ---------------------------------------- Footer section --------------------------------------------------- //	
		
			set_theme_mod('wedding_event_management_footer_background_color_setting','#000000');
			
		// ---------------------------------------- Related post_tag --------------------------------------------------- //	
		
			set_theme_mod('wedding_event_management_post_related_post_label','Related Posts');
			set_theme_mod('wedding_event_management_related_posts_count','3');
			set_theme_mod('wedding_event_management_enable_banner_section',true);
			

		$this->wedding_event_management_customizer_primary_menu();
		$this->wedding_event_management_customizer_social_nav_menu();
	}
}