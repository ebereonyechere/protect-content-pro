<?php


namespace Mono_WP\Protect_Content_Pro\Providers;


abstract class Base_Service_Provider {
	/**
	 * Registers wordpress action hooks and filters.
	 *
	 * @return mixed
	 *
	 * @since 1.0.0
	 */
	abstract public function register();

	/**
	 * Callback function for wordpress action hooks and filters
	 *
	 * @return mixed
	 *
	 * @since 1.0.0
	 */
	abstract public function run();
}
