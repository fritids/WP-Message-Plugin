<?php
/**
 * 
 * @package   vmp
 * @author    Varun Srinivas <varun@sudosaints.com>
 * @license   GPL-2.0+
 * @link      http://sudosaints.com
 *
 * @wordpress-plugin
 * Plugin Name:       Varun's Message Plugin
 * Plugin URI:        http://varun1505.com
 * Description:       A plugin that allows users to send messages to each other.
 * Version:           1.0.0
 * Author:            Varun Srinivas
 * Author URI:        http://varun1505.com
 * Text Domain:       vmp
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/varun1505/vmp
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( plugin_dir_path( __FILE__ ) . 'vmp.class.php' );
require_once( plugin_dir_path( __FILE__ ) . 'vmp-admin.class.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 */
register_activation_hook( __FILE__, array( 'vmp', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'vmp', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'vmp', 'get_instance' ) );
add_action( 'plugins_loaded', array( 'vmp_admin', 'get_instance' ) );