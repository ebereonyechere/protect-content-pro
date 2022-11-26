<?php


namespace Mono_WP\Protect_Content_Pro\Controllers;

class Rest_Api_Controller extends Base_Controller {

	public function block_for_non_auth( $result ) {
		if ( true === $result || is_wp_error( $result ) ) {
			return $result;
		}

		if ( ! is_user_logged_in() ) {
			return new WP_Error(
				'rest_api_disable',
				__( 'The rest api has been disabled' ),
				array( 'status' => 401 )
			);
		}

		return $result;

	}

}