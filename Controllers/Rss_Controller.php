<?php


namespace Mono_WP\Protect_Content_Pro\Controllers;

class Rss_Controller extends Base_Controller {

	public function disable_feeds() {
		wp_die( __('No feeds available!') );
	}

}