<?php if ( protect_content_pro_freemius()->is__premium_only() ) : ?>
	<?php if ( $has_valid_licence ) : ?>
        <input type="hidden" name="<?php echo esc_attr( $setting ) ?>" value="<?php echo esc_attr( $value ) ?>"
               id="<?php echo esc_attr( $setting ) ?>">

        <button type="button" class="button button-primary" id="protect-content-pro-watermark-upload-btn">Upload New
            Image
        </button>
	<?php endif; ?>
<?php endif; ?>

<?php if ( $is_not_paying ) : ?>
    <strong><a href="<?php echo esc_attr( $upgrade_link ) ?>">This feature is only availbale in the Pro version of
            Protect Content PRO. Click to upgrade and access all pro feaures.</a></strong>
<?php endif; ?>

<p class="protect-content-pro-form-notification"><i><span class="dashicons dashicons-info-outline"></span> The image to
        use for the watermark</i></p>

<?php if ( protect_content_pro_freemius()->is__premium_only() ) : ?>
	<?php if ( $has_valid_licence ) : ?>
        <br>

        <img src="<?php echo $value ?>" alt="" id="<?php echo esc_attr( $prefix ) ?>watermark_image_preview"
             style="margin-top: 10px; <?php echo $setting ? '' : 'display: none;' ?>" width="100">
	<?php endif; ?>
<?php endif; ?>
