<?php


namespace Mono_WP\Protect_Content_Pro\Controllers;


use Mono_WP\Protect_Content_Pro\Plugin;

class Watermark_Controller extends Base_Controller {


	public function generate_watermark( $resource ) {
		$type = explode( '/', $resource['type'] );

		if ( $type[0] === 'image' ) {
			if ( $type[1] === 'png' ) {
				$image = imagecreatefrompng( $resource['url'] );
			} else {
				$image = imagecreatefromjpeg( $resource['url'] );
			}

			$watermark = get_option( Plugin::get_instance()->prefix . 'watermark_image' );

			$opacity = 0.5;
			imagealphablending($watermark, false); // imagesavealpha can only be used by doing this for some reason
			imagesavealpha($watermark, true); // this one helps you keep the alpha.
			$transparency = 1 - $opacity;
			imagefilter($watermark, IMG_FILTER_COLORIZE, 0,0,0,127*$transparency); // the fourth parameter is alpha
//			imagepng($watermark);

			$stamp = imagecreatefrompng( $watermark );

			$marge_right = 10;
			$marge_bottom = 10;
			$sx = imagesx($stamp);
			$sy = imagesy($stamp);

			imagecopy($image, $stamp, imagesx($image) - $sx - $marge_right, imagesy($image) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

			ob_start();

			if( $type[1] === 'png' ) {
				base64_encode( imagepng( $image ) );
				$image_data = ob_get_contents();
				$file_name = bin2hex(random_bytes(8)) . '.png';
				file_put_contents( wp_upload_dir()['path'] . '/' . $file_name, $image_data );
			} else {
				base64_encode( imagejpeg( $image ) );
				$image_data = ob_get_contents();
				$file_name = bin2hex(random_bytes(8)) . '.jpeg';
				file_put_contents( wp_upload_dir()['path'] . '/' . $file_name, $image_data );
			}
			ob_end_clean();

			$resource['file'] = wp_upload_dir()['subdir'] . '/' . $file_name;

			return $resource;

		}
	}
}