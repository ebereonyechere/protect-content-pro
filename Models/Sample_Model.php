<?php


namespace Mono_WP\Protect_Content_Pro\Models;


use Mono_WP\Protect_Content_Pro\Exceptions\PostTypeMismatchException;
use Mono_WP\Protect_Content_Pro\Plugin;

class Sample_Model extends BaseModel {

	public $clicks;

	public function __construct( $id ) {
		try {
			parent::__construct( $id, Plugin::get_instance()->cpt );
		} catch ( PostTypeMismatchException $e ) {
			wp_die( 'An error has occurred! Post type mismatch' );
		}

	}

	public static function in_random_order() {
		$links = self::all();

		$links_count = count( $links );

		$random_links = [];

		while ( count( $random_links ) != $links_count ) {
			$index = rand( 0, count( $links ) );
			if ( ! $links[ $index ] ) {
				continue;
			}
			array_push( $random_links, $links[ $index ] );
			unset( $links[ $index ] );
		}

		return $random_links;
	}

	public static function all() {
		return get_posts( [
			'numberposts' => '-1',
			'post_type'   => Plugin::get_instance()->cpt
		] );
	}

	public static function find( $ids ) {
		if ( ! is_array( $ids ) ) {
			if ( get_post( $ids )->post_type != Plugin::get_instance()->cpt ) {
				return;
			}

			return get_post( $ids );
		}

		$links = [];

		foreach ( $ids as $id ) {
			if ( get_post( $id )->post_type != Plugin::get_instance()->cpt ) {
				continue;
			}
			array_push( $links, get_post( $id ) );
		}

		return $links;
	}

}
