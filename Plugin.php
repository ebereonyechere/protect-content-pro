<?php

namespace Mono_WP\Protect_Content_Pro;

use Freemius;

/**
 * Main plugin class, responsible for managing all service providers and freemius integration
 *
 * Class Plugin
 *
 * @since 1.0.0
 */
class Plugin {
	private static $instance = null;

	/**
	 * Plugin version
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public $version = '1.0.0';

	/**
	 * Plugin unique prefix
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public $prefix = 'protect_content_pro_';

	/**
	 * Plugin CPT name
	 * @var string
	 *
	 * @since 1.0.0
	 */
	public $cpt = null;

	/**
	 * Plugin Service providers that hook plugin into wordpress via action hooks and filters
	 * @var array
	 *
	 * @since 1.0.0
	 */
	protected $providers = [
		Providers\Assets_Service_Provider::class,
		Providers\Menus_Service_Provider::class,
		Providers\Settings_Service_Provider::class,
		Providers\Admin_Service_Provider::class,
		Providers\Public_Service_Provider::class,
	];

	private $bootstrapper;

	public $settings = [];

	/**
	 * Plugin constructor.
	 *
	 * @access private
	 * @since 1.0.0
	 */
	private function __construct() {

		if ( $this->has_valid_licence() ) {
			$providers       = [
			];
			$this->providers = array_merge( $this->providers, $providers );
		}

		$this->bootstrapper = new Bootstrapper( $this->providers );
	}

	/**
	 * Init plugin and instantiate all service providers
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function init() {
		$this->bootstrapper->run();
	}

	/**
	 * Get the plugin's absolute path
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function get_path() {
		return plugin_dir_path( __FILE__ );
	}

	/**
	 * Get the plugin's absolute url
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	public function get_url() {
		return plugin_dir_url( __FILE__ );
	}

	/**
	 * Checks if the user has a valid pro licence
	 *
	 * @return bool
	 *
	 * @since 1.0.0
	 */
	public function has_valid_licence() {
		return $this->freemius()->can_use_premium_code();
	}

	/**
	 * Get the freemius instance
	 *
	 * @return Freemius
	 *
	 * @access private
	 * @since 1.0.0
	 */
	public function freemius() {
		return protect_content_pro_freemius();
	}

	/**
	 * Checks if the user is not paying
	 *
	 * @return bool
	 *
	 * @since 1.0.0
	 */
	public function is_not_paying() {
		return $this->freemius()->is_not_paying();
	}

	public function upgrade_link() {
		return $this->freemius()->get_upgrade_url();
	}


	/**
	 * Checks if the user is on trial
	 *
	 * @return bool
	 *
	 * @since 1.0.0
	 */
	public function is_trial() {
		return $this->freemius()->is_trial();
	}


	public function add_setting( $setting ) {
		$this->settings[] = $setting;
	}

	public function activate() {
		$prefix = self::get_instance()->prefix;

		update_option( $prefix . 'block_right_click', '1', true );
		update_option( $prefix . 'block_ctrl+c', '1', true );
		update_option( $prefix . 'block_ctrl+u', '1', true );
		update_option( $prefix . 'block_ctrl+s', '1', true );
		update_option( $prefix . 'block_ctrl+p', '1', true );


		flush_rewrite_rules();
	}

	/**
	 * Get current instance of plugin
	 *
	 * @return Plugin|null
	 *
	 * @since 1.0.0
	 */
	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function deactivate() {
		flush_rewrite_rules();
	}

	public function uninstall() {
		foreach ( $this->get_instance()->settings as $setting ) {
			delete_option( $this->get_instance()->prefix . $setting[ 'key' ] );
		}
	}

}
