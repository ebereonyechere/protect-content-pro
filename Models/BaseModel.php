<?php


namespace Mono_WP\Protect_Content_Pro\Models;


use Mono_WP\Protect_Content_Pro\Exceptions\PostTypeMismatchException;
use Mono_WP\Protect_Content_Pro\Plugin;

class BaseModel {

	public $title;
	public $permalink;
	public $id;
	public $type;
	public $status;

	public function __construct( $id, $post_type ) {

		if ( get_post( $id )->post_type != $post_type ) {
			throw new PostTypeMismatchException();
		}

		$this->id        = $id;
		$this->type      = $post_type;
		$this->title     = get_post( $id )->post_title;
		$this->permalink = get_permalink( $id );
		$this->status    = get_post( $id )->post_status;
	}

	public function get( $key ) {
		return get_post_meta( $this->id, $key, true );
	}

	public function set( $key, $value ) {
		return update_post_meta( $this->id, $key, $value );
	}

}
