<?php


namespace Mono_WP\Protect_Content_Pro\Providers;

use Mono_WP\Protect_Content_Pro\Controllers\Watermark_Controller;
use Mono_WP\Protect_Content_Pro\Plugin;

class Admin_Service_Provider extends Base_Service_Provider {

	private $watermark_controller;

	public function __construct() {
		if ( protect_content_pro_freemius()->is__premium_only() ) {
			$this->watermark_controller = new Watermark_Controller();
		}
	}

	public function register() {
		if ( protect_content_pro_freemius()->is__premium_only() ) {
			if ( Plugin::get_instance()->has_valid_licence() ) {
				if ( get_option( Plugin::get_instance()->prefix . 'enable_image_watermarking' ) ) {
					add_action( 'wp_handle_upload', array( $this->watermark_controller, 'generate_watermark' ) );
				}
			}
		}

	}

	public function run() {
		// TODO: Implement run() method.
	}
}