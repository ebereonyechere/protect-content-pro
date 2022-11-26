<?php


namespace Mono_WP\Protect_Content_Pro\Controllers;

class Iframes_Controller extends Base_Controller {

	public function prevent_iframe_embed( $headers ) {
		$headers['Content-Security-Policy'] = "frame-ancestors 'none'";
		return $headers;
	}
	
}