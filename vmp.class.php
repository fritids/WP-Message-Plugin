<?php
/**
 * @package   vmp
 * @author    Varun Srinivas <varun@sudosaints.com>
 * @license   GPL-2.0+
 * @link      http://varun1505.com
 * @copyright 2013 Varun Srinivas
 */
class Vmp {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 * @since   1.0.0
	 * @var     string
	 */
	const VERSION = '1.0.0';

	/**
	 * Unique identifier for the plugin.
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 * @since    1.0.0s
	 * @var      string
	 */
	protected $plugin_slug = 'vmp';

	/**
	 * Instance of this class.
	 * @since    1.0.0
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		
		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		
	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 *@return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 * @since     1.0.0
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 * @since    1.0.0
	 */
	public static function activate() {
		//Create Database
		$table_name = "wp_vmp_messages";
		$sql = "
		  CREATE TABLE ".$table_name." (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			msg_from int(11) NOT NULL,
			msg_to VARCHAR(255) NOT NULL,
		  	subject VARCHAR(255) NOT NULL,
			message TEXT NOT NULL,
			sent_date TIMESTAMP,
			PRIMARY KEY  (id)
		  );";
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta($sql);
	}

	/**
	 * Fired when the plugin is deactivated.
	 * @since    1.0.0
	 */
	public static function deactivate( $network_wide ) {
		
	}
	
	/**
	 * Load the plugin text domain for translation.
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Register and enqueue public-facing style sheet.
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'css/public.css', __FILE__ ), array(), self::VERSION );
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'js/public.js', __FILE__ ), array( 'jquery' ), self::VERSION );
	}
}