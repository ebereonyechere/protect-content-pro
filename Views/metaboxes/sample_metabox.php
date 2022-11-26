<?php

use Mono_WP\Protect_Content_Pro\Plugin;

?>
<div class="form-field form-required protect-content-pro-form-group">
    <input type="hidden" name="<?php echo esc_attr( 'save_' . Plugin::get_instance()->cpt . 'meta' ) ?>" value="1">
    <label for="<?php echo esc_attr( $prefix ) ?>link_url">Sample Field</label>
    <input name="<?php echo esc_attr( $prefix ) ?>link_url" id="<?php echo esc_attr( $prefix ) ?>link_url" type="url"
           value="<?php echo esc_attr( get_post_meta( $post->ID, 'link_url', true ) ) ?>" size="40" required>
    <p class="protect-content-pro-form-help-text">descrption.</p>
</div>

