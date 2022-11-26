<?php if ( protect_content_pro_freemius()->is__premium_only() ) : ?>
	<?php if ( $has_valid_licence ) : ?>
        <input name="<?php echo esc_attr( $setting ) ?>" type="checkbox"
               id="<?php echo esc_attr( $setting ) ?>" value="1" <?php echo $value == 1 ? 'checked' : '' ?>>
	<?php endif; ?>
<?php endif; ?>

<?php if ( $is_not_paying ) : ?>
    <strong><a href="<?php echo esc_attr( $upgrade_link ) ?>">This feature is only availbale in the Pro version of
            Protect Content PRO. Click to upgrade and access all pro feaures.</a></strong>
<?php endif; ?>

<p class="protect-content-pro-form-notification"><i><span class="dashicons dashicons-info-outline"></span> This
        blocks the inspect element mode of the developer tools</i></p>