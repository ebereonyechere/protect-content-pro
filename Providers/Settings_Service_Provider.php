<?php


namespace Mono_WP\Protect_Content_Pro\Providers;


use Mono_WP\Protect_Content_Pro\Controllers\Settings_Controller;
use Mono_WP\Protect_Content_Pro\Plugin;

class Settings_Service_Provider extends Base_Service_Provider {

	private $settings_controller, $settings;

	public function __construct() {
		$this->settings_controller = new Settings_Controller();

		$this->settings            = array(
			array(
				'key'   => 'block_right_click',
				'title' => 'Block right click?'
			),
			array(
				'key'   => 'block_ctrl+shift+i',
				'title' => 'Block Ctrl + Shift + I shortcut?'
			),
			array(
				'key'   => 'block_ctrl+shift+c',
				'title' => 'Block Ctrl + Shift + C shortcut?'
			),
			array(
				'key'   => 'block_ctrl+shift+j',
				'title' => 'Block Ctrl + Shift + J shortcut?'
			),
			array(
				'key'   => 'block_ctrl+c',
				'title' => 'Block Ctrl + C shortcut?'
			),
			array(
				'key'   => 'block_ctrl+u',
				'title' => 'Block Ctrl + U shortcut?'
			),
			array(
				'key'   => 'block_ctrl+s',
				'title' => 'Block Ctrl + S shortcut?'
			),
			array(
				'key'   => 'block_ctrl+p',
				'title' => 'Block Ctrl + P shortcut?'
			),
			array(
				'key'   => 'disable_non_auth_rest_api',
				'title' => 'Block rest api for non-logged in users?'
			),
			array(
				'key'   => 'disable_rss_feeds',
				'title' => 'Block RSS feeds?'
			),
			array(
				'key'   => 'prevent_iframe_embed',
				'title' => 'Prevent third-party iframe embed?'
			),
			array(
				'key'   => 'block_devtools_opening',
				'title' => 'Block devtools opening?'
			),
			array(
				'key'   => 'enable_image_watermarking',
				'title' => 'Enable Image Watermarking?'
			),
			array(
				'key'   => 'watermark_image',
				'title' => 'Image to use as watermark'
			),
			array(
				'key'   => 'displayed_notice',
				'title' => 'Notice displayed in popup'
			)

		);
	}

	/**
	 * Registers wordpress action hooks and filters.
	 *
	 * @return mixed|void
	 *
	 * @since 1.0.0
	 */
	public function register() {
		add_action( 'admin_init', array( $this, 'run' ) );
	}

	public function run() {

		foreach ( $this->settings as $setting ) {

			Plugin::get_instance()->add_setting( $setting );

			register_setting( Plugin::get_instance()->prefix . 'settings', Plugin::get_instance()->prefix . $setting[ 'key' ] );

			add_settings_field( Plugin::get_instance()->prefix . $setting[ 'key' ], $setting[ 'title' ], [
				$this->settings_controller,
				'display_setting_field'
			], Plugin::get_instance()->prefix . 'settings', Plugin::get_instance()->prefix . 'settings', [ 'field' => $setting[ 'key' ] ] );

		}

		add_settings_section( Plugin::get_instance()->prefix . 'settings', 'Proetct Content PRO Settings', [
			$this->settings_controller,
			'display_settings'
		], Plugin::get_instance()->prefix . 'settings' );



	}
}
