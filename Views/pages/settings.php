<?php use Mono_WP\Protect_Content_Pro\Plugin;

settings_errors(); ?>

<div class="wrap">

    <nav class="nav-tab-wrapper">
        <a href="<?php echo esc_attr( admin_url( 'admin.php?page=protect-content-pro' ) ) ?>"
           class="nav-tab <?php if ( $tab == 'settings' ) : ?>nav-tab-active<?php endif; ?>">Settings</a>
        <a href="<?php echo esc_attr( admin_url( 'admin.php?page=protect-content-pro&tab=guide' ) ) ?>"
           class="nav-tab <?php if ( $tab == 'guide' ): ?>nav-tab-active<?php endif; ?>">User Guide</a>
    </nav>

    <div class="tab-content">
		<?php switch ( $tab ) :
			case 'settings': ?>
                <form action="options.php" method="post">
					<?php

					settings_fields( Plugin::get_instance()->prefix . 'settings' );
					do_settings_sections( Plugin::get_instance()->prefix . 'settings' );
					submit_button( 'Save Settings' );
					?>
                </form>
				<?php break;
			case 'guide':
				\Mono_WP\Protect_Content_Pro\Helpers\View::render( 'pages.guide' );
				break;
		endswitch; ?>
    </div>


</div>
