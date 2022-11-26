<?php


namespace Mono_WP\Protect_Content_Pro\Providers;


use Mono_WP\Protect_Content_Pro\Plugin;

class Assets_Service_Provider extends Base_Service_Provider {

	/**
	 * Registers wordpress action hooks and filters.
	 *
	 * @return mixed|void
	 *
	 * @since 1.0.0
	 */
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_footer', array( $this, 'add_footer_codes' ) );
	}

	public function run() {

	}

	/**
	 * Enqueues admin script and styles
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function enqueue_admin_scripts() {
		global $post_type;

		if ( is_admin() ) {

			wp_enqueue_script( 'media-upload' );
			wp_enqueue_script( 'thickbox' );
			wp_enqueue_media();

			wp_register_script( 'protect-content-pro-admin', Plugin::get_instance()->get_url() . 'Assets/js/protect-content-pro-admin.js', array(
				'jquery',
				'thickbox'
			), Plugin::get_instance()->version, false );

			wp_enqueue_script( 'protect-content-pro-admin' );

			wp_localize_script( 'protect-content-pro-admin', 'protect_content_pro', [
				'prefix' => Plugin::get_instance()->prefix,
			] );


			wp_register_style( 'protect-content-pro-admin', Plugin::get_instance()->get_url() . 'Assets/css/protect-content-pro-admin.css' );

			wp_enqueue_style( 'protect-content-pro-admin' );
		}



	}

	/**
	 * Enqueues frontend script and styles
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {

		if ( ! is_admin() ) {

			wp_register_script( 'protect-content-pro', Plugin::get_instance()->get_url() . 'Assets/js/protect-content-pro.js', array(
				'jquery',
				'protect-content-pro-devtools-detect'
			), Plugin::get_instance()->version, false );

			wp_register_script( 'protect-content-pro-devtools-detect', Plugin::get_instance()->get_url() . 'Assets/js/protect-content-pro-devtools-detect.js', null, Plugin::get_instance()->version, false);

			wp_enqueue_script( 'protect-content-pro-devtools-detect' );
			wp_enqueue_script( 'protect-content-pro' );

			wp_register_style( 'protect-content-pro', Plugin::get_instance()->get_url() . 'Assets/css/protect-content-pro.css' );
			wp_register_style( 'protect-content-pro-bootstrap', Plugin::get_instance()->get_url() . 'Assets/css/protect-content-pro.css' );

			wp_enqueue_style( 'protect-content-pro' );

			wp_localize_script( 'protect-content-pro', 'protect_content_pro', [
				'prefix' => Plugin::get_instance()->prefix,
                'displayed_notice' => get_option( Plugin::get_instance()->prefix . 'displayed_notice' ) ? get_option( Plugin::get_instance()->prefix . 'displayed_notice' ) : 'This action has been blocked.',
                'block_ctrl_shift_i' => get_option( Plugin::get_instance()->prefix . 'block_ctrl+shift+i' ),
                'block_ctrl_shift_c' => get_option( Plugin::get_instance()->prefix . 'block_ctrl+shift+c' ),
                'block_ctrl_shift_j' => get_option( Plugin::get_instance()->prefix . 'block_ctrl+shift+j' ),
                'block_ctrl_c' => get_option( Plugin::get_instance()->prefix . 'block_ctrl+c' ),
                'block_ctrl_u' => get_option( Plugin::get_instance()->prefix . 'block_ctrl+u' ),
                'block_ctrl_s' => get_option( Plugin::get_instance()->prefix . 'block_ctrl+s' ),
                'block_ctrl_p' => get_option( Plugin::get_instance()->prefix . 'block_ctrl+p' ),
                'block_devtools_opening' => get_option( Plugin::get_instance()->prefix . 'block_devtools_opening' ),
                'block_right_click' => get_option( Plugin::get_instance()->prefix . 'block_right_click' ),
			] );
		}
	}

	public function add_footer_codes() { ?>
		<div id="protect-content-pro-rclick-modal" class="protect-content-pro-rclick-modal-window">
			<div>
				<a href="javascript:;" title="Close" class="protect-content-pro-rclick-modal-close" id="protect-content-pro-rclick-modal-close-btn">Close</a>
<!--				<h1>Voilà!</h1>-->
				<div><?php echo esc_html( get_option( Plugin::get_instance()->prefix . 'displayed_notice' ) ) ? esc_html( get_option( Plugin::get_instance()->prefix . 'displayed_notice' ) ) : 'This action has been blocked.' ?></div>
				<br>
			</div>
		</div>
        <noscript>
            <style>
                body * {
                    display: none;
                }
                body::before {
                    content: 'JavaScript must be enabled in order for you to use this website. However, it seems JavaScript is either disabled or not supported by your browser. Enable JavaScript by changing your browser options, then try again. ';
                }
            </style>
        </noscript>
	<?php }
}
