<?php

namespace Mono_WP\Protect_Content_Pro\Providers;

use Mono_WP\Protect_Content_Pro\Controllers\Menus_Controller;
use Mono_WP\Protect_Content_Pro\Plugin;

/**
 * Undocumented class
 */
class Menus_Service_Provider extends Base_Service_Provider {

	/**
	 * Controller class responsible for display menus.
	 *
	 * @var Menu_Controller
	 */
	private $menus_controller;

	/**
	 * Construction function.
	 */
	public function __construct() {
		$this->menus_controller = new Menus_Controller();
	}

	/**
	 * Registers WordPress action hooks and filters.
	 *
	 * @return mixed|void
	 *
	 * @since 1.0.0
	 */
	public function register() {

		add_action( 'admin_menu', array( $this, 'run' ) );

	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function run() {

		add_menu_page( 'Protect Content PRO', 'Protect Content PRO', 'manage_options', 'protect-content-pro', array(
			$this->menus_controller,
			'show_settings_page'
		), 'dashicons-privacy' );


	}
}
