<?php
/**
	* Plugin Name: Arckytec Core
	* Description: A helper plugin.
	* Plugin URI:  htniloss://example.com/
	* Version:     1.0.1
	* Author:      Tashdid Diganta
	* Author URI:  htniloss://example.com/
	* Text Domain: arc-core
	* Elementor tested up to: 3.16.3
*/



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Controls_Manager;

/**
 * Define
*/
define('NILOS_ADDONS_URL', plugins_url('/', __FILE__));
define('NILOS_ADDONS_DIR', dirname(__FILE__));
define('NILOS_ADDONS_PATH', plugin_dir_path(__FILE__));
define('NILOS_ELEMENTS_PATH', NILOS_ADDONS_DIR . '/include/elementor');
define('NILOS_WIDGET_PATH', NILOS_ADDONS_DIR . '/include/widgets');
define('NILOS_INCLUDE_PATH', NILOS_ADDONS_DIR . '/include');

define( 'NILOS_ADDONS_FILE_', __FILE__ );
define( 'NILOS_ADDONS_VERSION_', '3.1.3');


/**
 * Include all files
*/
include_once(NILOS_ADDONS_DIR . '/include/custom-post-header.php');
include_once(NILOS_ADDONS_DIR . '/include/custom-post-footer.php');
include_once(NILOS_ADDONS_DIR . '/include/custom-post-project.php');
include_once(NILOS_ADDONS_DIR . '/include/custom-post-services.php');
include_once(NILOS_ADDONS_DIR . '/include/custom-post-team.php');
include_once(NILOS_ADDONS_DIR . '/include/custom-post-project.php');
include_once(NILOS_ADDONS_DIR . '/include/custom-metafields.php');
include_once(NILOS_ADDONS_DIR . '/include/common-functions.php');
include_once(NILOS_ADDONS_DIR . '/include/traits/elementor-widget-traits.php');
include_once(NILOS_ADDONS_DIR . '/include/allow-svg.php');
include_once(NILOS_ADDONS_DIR . '/include/class-ocdi-importer.php');

include_once(plugin_dir_path(__FILE__) . '/include/post-view.php');
// include_once(NILOS_ADDONS_DIR . '/include/menu/menu.php');

/**
 * NILOS Custom Widget
*/
include_once(NILOS_WIDGET_PATH . '/class-services-widget.php');
include_once(NILOS_WIDGET_PATH . '/class-newsletter-widget.php');
include_once(NILOS_WIDGET_PATH . '/class-socials-widget.php');
include_once(NILOS_WIDGET_PATH . '/class-search-widget.php');
include_once(NILOS_WIDGET_PATH . '/class-resent-post-widget.php');
include_once(NILOS_WIDGET_PATH . '/class-contact-widget.php');





/**
 * Main NILOS Core Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class NILOS_Core {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

	
		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'plugin.php' );
	}


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'arc-core' ),
			'<strong>' . esc_html__( 'Nilos Core', 'arc-core' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'arc-core' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'arc-core' ),
			'<strong>' . esc_html__( 'Nilos Core', 'arc-core' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'arc-core' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'arc-core' ),
			'<strong>' . esc_html__( 'Nilos Core', 'arc-core' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'arc-core' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

// Instantiate NILOS_Core.
new NILOS_Core();