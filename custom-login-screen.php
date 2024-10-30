<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Plugin Name: Custom Login Screen
 * Plugin URI:
 * Description: An unique and customizable WordPress login screen 
 * Version: 1.0.2
 * Author: Haris Ainur Rozak
 * Author URI: https://harisrozak.github.io
 */

define( "CLS", 'custom-login-screen' );
define( "CLS_DIR", plugin_dir_path( __FILE__ ) );
define( "CLS_URL", plugin_dir_url( __FILE__ ) );
define( "CLS_BASENAME", plugin_basename( __FILE__ ) );

require_once( CLS_DIR . 'includes/apply-settings.php' );

Class CLS {
	// lies required WP hooks
	public function __construct() {
		add_filter( 'plugin_action_links_' . CLS_BASENAME, array( $this, 'plugin_action_links' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 10, 1 );
		add_action( 'admin_action_custom-login-screen', array( $this, 'save_options' ) );
	}

	// add setting link to plugin list
	public function plugin_action_links( $links ) {
		$links[] = sprintf( "<a href='%s'>%s</a>", admin_url( 'themes.php?page=custom-login-screen' ), __( 'Settings', 'custom-logins-screen' ) );
		return $links;
	}

	// register admin page
	public function admin_menu() {
		add_submenu_page(
	        'themes.php',
	        __( 'Login Screen Option', 'custom-logins-screen' ),
	        __( 'Login Screen', 'custom-logins-screen' ),
	        'activate_plugins',
	        'custom-login-screen',
	        array( $this, 'settings_page' )
	    );
	}

	// load settings page
	public function settings_page() {
		// load form library
		require_once( CLS_DIR . 'includes/form-library.php' );
		$form_field = new HRS_FormLibrary();

		// load library uploader
		require_once( CLS_DIR . 'includes/file-uploader.php' );

		// load some required vars
		$options = $this->get_options();
		$login_styles = $this->login_styles;

		// load settings page
		require_once( CLS_DIR . 'includes/settings-page.php' );

		// load about us part
		require_once( CLS_DIR . 'about/about-html.php' );
	}

	// enqueue custom style on plugin settings page
	public function admin_enqueue_scripts( $hook ) {
		// show only on posts new form
    	if ( $hook != 'appearance_page_custom-login-screen' ) return;

    	// style admin
    	wp_enqueue_style( 'cls-admin', CLS_URL . "assets/style-admin.css" );    	

    	// load about us part
		require_once( CLS_DIR . 'about/admin-enqueue-script.php' );		
	}

	// get plugin settings
	public function get_options() {
		// set default options
		$default_options = array(
			'login_title' => "Your WordPress Title",
			'login_title_mobile' => "WordPress",
			'login_logo' => CLS_URL . "assets/logo.png",
			'login_logo_thumbnail' => CLS_URL . "assets/logo.png",
			'login_message' => "This text section should be a welcome message to site members. You can edit this text on admin plugin settings page",
			'style_preset' => "default",
		);

		// get options
		$options = get_option( 'custom-login-screen', $default_options );

		return $options;
	}

	// login styles selections
	public $login_styles = array(
		array( 'value' => 'default', 'label' => 'Default' ),
		array( 'value' => 'theme-blue-purple', 'label' => 'Blue Purple' ),
		array( 'value' => 'theme-clean-green', 'label' => 'Clean Green' ),
		array( 'value' => 'theme-coffee-brown', 'label' => 'Coffee Brown' ),
	);


	public function save_options() {
		// check nonce
		check_admin_referer( 'custom-login-screen' );

		// sanitize post data
		$post_data = $_POST[ 'cls' ];
		$sanitized_data = array(
			'login_title' => sanitize_text_field( $post_data[ 'login_title' ] ),
			'login_title_mobile' => sanitize_text_field( $post_data[ 'login_title_mobile' ] ),
			'login_logo' => sanitize_text_field( $post_data[ 'login_logo' ] ),
			'login_logo_thumbnail' => sanitize_text_field( $post_data[ 'login_logo_thumbnail' ] ),
			'login_message' => sanitize_textarea_field( $post_data[ 'login_message' ] ),
			'style_preset' => sanitize_text_field( $post_data[ 'style_preset' ] ),
		);

		// save the options
	    update_option( 'custom-login-screen', $sanitized_data );

	    // redirect
	    wp_redirect( add_query_arg( 'updated', '1', $_SERVER[ 'HTTP_REFERER' ] ) );
	    exit();
	}
}

$GLOBALS[ 'CLS' ] = new CLS();