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
	protected $plugin_screen_hook_suffix = 'vmp-msgs';

	
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
		add_action('admin_init',array($this,'register_settings'));
	}
	
	/**
	 * Register the settings for Messages
	 */
	function register_settings(){
		register_setting( 'vmp_messages', 'vmp_user_roles');
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
		$screen = get_current_screen();
		if(strpos($screen->id,'vmp')) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), array(), Vmp::VERSION );
			wp_enqueue_style( $this->plugin_slug .'-jquery-ui', plugins_url( 'css/jquery-ui.css', __FILE__ ), array(), Vmp::VERSION );
			wp_enqueue_style( $this->plugin_slug .'-select2-styles', plugins_url( 'css/select2.css', __FILE__ ), array(), Vmp::VERSION );
		}
	}

	/**
	 * Register and enqueue admin-specific JavaScript only for plugin pages
	 * @since     1.0.0
	 * @return    null
	 */
	public function enqueue_admin_scripts() {
		$screen = get_current_screen();
		if(strpos($screen->id,'vmp')) {
			wp_enqueue_script( $this->plugin_slug . '-select2-script', plugins_url( 'js/select2.min.js', __FILE__ ), array( 'jquery' ), Vmp::VERSION );
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' , 'jquery-ui-tabs' , $this->plugin_slug . '-select2-script' ), Vmp::VERSION );			
		}
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {
		add_menu_page('Messages', 'Messages', 'read', 'vmp-msgs',array($this,'display_plugin_admin_page'),plugins_url('assets/messages-16.png',__FILE__),20);
		if(is_admin()){ 
			add_submenu_page('vmp-msgs', 'Message Settings', 'Settings', 'activate_plugins', 'vmp-settings',array($this,'settings'));
		}
	}

	public function settings(){
		
		if(isset($_POST['submit'])){
			unset($_POST['submit']);
			update_option('vmp_user_roles', serialize($_POST));
		}
		include_once('views/admin/settings.php');
	}
	
	/**
	 * Render the Messages Page
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		$view = isset($_GET['view'])?$_GET['view']:"home";
		
		$msgs = new MessageService();
		$user = wp_get_current_user();
		$inboxes = $msgs->getUserMessages($user->ID);
		
		switch ($view){
			case 'home':include_once( 'views/admin/message.php' );
						break;
			case 'single':
						$signle = $msgs->getMessage($_GET['id']);
						include_once( 'views/admin/single.php' );
						break;
			case 'send-msg': $this->sendMessage();
						break;
			default: include_once( 'views/admin/message.php' );
		}
	}
	
	public function sendMessage(){
		if(isset($_POST['send-msg'])) {
			
			$to = $_POST['msgTo'];
			$msg = new Message();
			$msg->setTo($to);
			$currentUser = wp_get_current_user();
			$msg->setFrom($currentUser->ID);
			$msg->setSubject($_POST['subject']);
			$msg->setMessage($_POST['message']);			
			$msg->send();
			$this->redirect(admin_url('admin.php?page=vmp-msgs'));
		} 
	}
	
	function redirect($url){
		echo '<script>window.location.assign("'.$url.'");</script>';
	}
}
