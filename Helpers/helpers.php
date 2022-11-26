<?php

if ( ! function_exists('monowp_dd') ) {
	function monowp_dd( $var ) {
		echo '<pre>';
		var_dump( $var );
		echo '<pre>';
		die;
	}
}

if ( ! function_exists( 'monowp_rand_string' ) ) {
	function monowp_rand_string($length = 5) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}