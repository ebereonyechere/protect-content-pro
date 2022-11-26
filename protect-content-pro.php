<?php

/**
 * Plugin Name: Protect Content Pro
 * Plugin URI: http://monowp.com/protect-content-pro
 * Description: Protect Content Pro helps us protect your site's content from content theives.
 * Version: 1.0.0
 * Author: Mono WP
 * Author URI: https://monowp.com/
 * Requires at least: 4.5
 * Tested up to: 6.0
 * Requires PHP: 7.4
 *
 * Text Domain: protect-content-pro
 * Domain Path: /Languages/
 *
 * @fs_premium_only /Controllers/Iframes_Controller.php, /Controllers/Rest_Api_Controller.php, /Controllers/Rss_Controller.php, /Controllers/Watermark_Controller.php
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'What are you doing here?' );
}

use  Mono_WP\Protect_Content_Pro\Plugin;

require_once dirname( __FILE__ ) . '/Helpers/helpers.php';

if ( function_exists( 'protect_content_pro_freemius' ) ) {
	protect_content_pro_freemius()->set_basename( true, __FILE__ );
} else {
	// DO NOT REMOVE THIS IF, IT IS ESSENTIAL FOR THE `function_exists` CALL ABOVE TO PROPERLY WORK.

	if ( ! function_exists( 'protect_content_pro_freemius' ) ) {
		// Create a helper function for easy SDK access.
		function protect_content_pro_freemius() {
			global $protect_content_pro_freemius;

			if ( ! isset( $protect_content_pro_freemius ) ) {
				// Activate multisite network integration.
				if ( ! defined( 'WP_FS__PRODUCT_11082_MULTISITE' ) ) {
					define( 'WP_FS__PRODUCT_11082_MULTISITE', true );
				}
				// Include Freemius SDK.
				require_once dirname( __FILE__ ) . '/includes/freemius/start.php';
				$protect_content_pro_freemius = fs_dynamic_init( array(
					'id'             => '11082',
					'slug'           => 'protect-content-pro',
					'type'           => 'plugin',
					'public_key'     => 'pk_26914202278c009bcf7c7a125d523',
					'is_premium'     => true,
					'has_addons'     => false,
					'has_paid_plans' => true,
					'trial'          => array(
						'days'               => 7,
						'is_require_payment' => false,
					),
					'menu'           => array(
						'slug' => 'protect-content-pro',
//                    'first-path' => 'edit.php?post_type=affiliate_link&page=settings&tab=guide',
					),
					'secret_key'     => 'sk_vVtHp=IXe]=$8uD$R(6p0:P.;4(~w',
				) );
			}

			return $protect_content_pro_freemius;
		}

		// Init Freemius.
		protect_content_pro_freemius();
		// Signal that SDK was initiated.
		do_action( 'protect_content_pro_freemius_loaded' );
	}

	require_once plugin_dir_path( __FILE__ ) . '/vendor/autoload.php';
	register_activation_hook( __FILE__, 'activate_protect_content_pro' );
	register_deactivation_hook( __FILE__, 'deactivate_protect_content_pro' );
	register_uninstall_hook( __FILE__, 'uninstall_protect_content_pro' );
	//monowp_protect_content_pro_freemuis()->add_action('after_uninstall', 'monowp_protect_content_pro_freemuis_uninstall_cleanup');
	$super_affiliate_links = Plugin::get_instance();
	$super_affiliate_links->init();

	function activate_protect_content_pro() {
		Plugin::get_instance()->activate();
	}

	function deactivate_protect_content_pro() {
		Plugin::get_instance()->deactivate();
	}

	function uninstall_protect_content_pro() {
		Plugin::get_instance()->uninstall();

	}

}

