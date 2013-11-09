<?php
/**
 * @package   vmp
 * @author    Varun Srinivas <varun@sudosaints.com>
 * @license   GPL-2.0+
 * @link      http://varun1505.com
 * @copyright 2013 Varun Srinivas
 */

/**
 * VMP Admin Class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 */
class Vmp_admin {

	/**
	 * Instance of this class.
	 * @since    1.0.0
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 * @since    1.0.0
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	
	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 * @since     1.0.0
	 */
	private function __construct() {
		/*
		 * Call $plugin_slug from public plugin class.
		 */
		$plugin = Vmp::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );
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
	 * Register and enqueue admin-specific style sheet.
	 * @since     1.0.0
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {
		
		wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), array(), Vmp::VERSION );
		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), array(), Plugin_Name::VERSION );
		}

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 * @since     1.0.0
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ), Plugin_Name::VERSION );
		}

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {
		add_menu_page('Messages', 'Messages', 'read', 'vmp-msgs',array($this,'display_plugin_admin_page'),plugins_url('assets/messages-16.png',__FILE__),20);
	}

	/**
	 * Render the settings page for this plugin.
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}
}
