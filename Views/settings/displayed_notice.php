<?php if ( protect_content_pro_freemius()->is__premium_only() ) : ?>
	<?php if ( $has_valid_licence ) : ?>
        <textarea class="regular-text"
                  name="<?php echo esc_attr( $setting ) ?>"
                  id="<?php echo esc_attr( $setting ) ?>"
                  rows="5"
        ><?php echo $value ?>
</textarea>
	<?php endif; ?>
<?php endif; ?>

<?php if ( $is_not_paying ) : ?>
    <strong><a href="<?php echo esc_attr( $upgrade_link ) ?>">This feature is only availbale in the Pro version of
            Protect Content PRO. Click to upgrade and access all pro feaures.</a></strong>
<?php endif; ?>

<p class="protect-content-pro-form-notification"><i><span class="dashicons dashicons-info-outline"></span> This
        is the notice displayed to users who try to use a blocked function</i></p>