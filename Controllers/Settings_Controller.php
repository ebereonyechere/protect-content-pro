<?php


namespace Mono_WP\Protect_Content_Pro\Controllers;


use Mono_WP\Protect_Content_Pro\Helpers\View;
use Mono_WP\Protect_Content_Pro\Plugin;

class Settings_Controller extends Base_Controller {

	public function display_settings() {
		_e( 'Use these settings to control and configure how Protect Content Pro works to protect your site.', 'protect-content-pro' );
	}


	public function display_setting_field( $args ) {
		$view    = 'settings.' . $args['field'];
		$prefix  = Plugin::get_instance()->prefix;
		$setting = $prefix . $args[ 'field' ];
		$value = get_option( $prefix. $args[ 'field' ] );
		$has_valid_licence = Plugin::get_instance()->has_valid_licence();
		$upgrade_link = Plugin::get_instance()->upgrade_link();
		$is_not_paying = Plugin::get_instance()->is_not_paying();

		View::render( $view, compact( 'prefix', 'setting', 'value', 'has_valid_licence', 'upgrade_link', 'is_not_paying' ) );
	}

}
