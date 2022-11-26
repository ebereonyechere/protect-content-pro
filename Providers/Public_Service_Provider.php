<?php


namespace Mono_WP\Protect_Content_Pro\Providers;

use Mono_WP\Protect_Content_Pro\Controllers\Rest_Api_Controller;
use Mono_WP\Protect_Content_Pro\Plugin;

class Public_Service_Provider extends Base_Service_Provider {

	private $rest_api_controller, $iframes_controller, $rss_controller;

	public function __construct() {
		if ( protect_content_pro_freemius()->is__premium_only() ) {
			$this->rest_api_controller = new Rest_Api_Controller();
		}
	}

	public function register() {
		if ( protect_content_pro_freemius()->is__premium_only() ) {
			if ( Plugin::get_instance()->has_valid_licence() ) {

				if ( get_option( Plugin::get_instance()->prefix . 'prevent_iframe_embed' ) ) {
					add_action( 'wp_headers', array( $this->iframes_controller, 'prevent_iframe_embed' ) );
				}

				if ( get_option( Plugin::get_instance()->prefix . 'disable_non_auth_rest_api' ) ) {
					add_action( 'rest_authentication_errors', array( $this->rest_api_controller, 'block_for_non_auth' ) );
				}

				if ( get_option( Plugin::get_instance()->prefix . 'disable_rss_feeds' ) ) {
					add_action( 'do_feed', array( $this->rss_controller, 'disable_feeds' ), 1 );
					add_action( 'do_feed_rdf', array( $this->rss_controller, 'disable_feeds' ), 1 );
					add_action( 'do_feed_rss', array( $this->rss_controller, 'disable_feeds' ), 1 );
					add_action( 'do_feed_rss2', array( $this->rss_controller, 'disable_feeds' ), 1 );
					add_action( 'do_feed_atom', array( $this->rss_controller, 'disable_feeds' ), 1 );
					add_action( 'do_feed_rss2_comments', array( $this->rss_controller, 'disable_feeds' ), 1 );
					add_action( 'do_feed_atom_comments', array( $this->rss_controller, 'disable_feeds' ), 1 );
				}

			}
		}
	}

	public function run() {
		// TODO: Implement run() method.
	}
}