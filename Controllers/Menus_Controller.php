<?php


namespace Mono_WP\Protect_Content_Pro\Controllers;


use Mono_WP\Protect_Content_Pro\Helpers\View;
use Mono_WP\Protect_Content_Pro\Models\SampleModel;

class Menus_Controller extends Base_Controller {

	public function show_settings_page() {
		$tab = sanitize_text_field( $_GET['tab'] ) ?? 'settings';

		View::render( 'pages.settings', compact( 'tab' ) );
	}

	public function show_upgrade_page() {
		View::render( 'pages.upgrade' );
	}

	public function show_accounts_page() {

	}
}
