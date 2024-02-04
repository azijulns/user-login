<?php

/**
 * Plugin Name:  user login
 * Description:
 * Version:     1.0.1
 * Author:      Azijul
 * Author URI:  https://azijul.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: text-domain
 *
 */

defined('ABSPATH') || die();

define('USER_PLUGIN_VERSION', '1.0.1');
define('USER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('USER_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
define('USER_PLUGIN_ASSETS', trailingslashit(USER_PLUGIN_DIR_URL . 'assets'));

if (!class_exists('USER_PLUGIN_PLUGIN')) :

	final class USER_MAIN {
		private static $instance;

		private function __construct() {
			add_action('plugins_loaded', [$this, 'init_plugin']);
		}

		public function init_plugin() {
			new user_login\AssetsManager();
			new user_login\Functions();
		}

		public static function instance() {
			if (!isset(self::$instance) && !(self::$instance instanceof USER_MAIN)) {
				self::$instance = new USER_MAIN();
				self::$instance->includes();
			}

			return self::$instance;
		}

		private function includes() {
			require_once USER_PLUGIN_DIR . 'includes/assets-manager.php';
			require_once USER_PLUGIN_DIR . 'includes/functions.php';
		}
	}

endif;

function user_init_plugin() {
	return USER_MAIN::instance();
}

user_init_plugin();
