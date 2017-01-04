<?php
/**
 * Template part for displaying a text-only feature box.
 *
 * @package TCCi
 */

?><a class="track" href="<?php echo esc_url( $feature['url'] ); ?>" target="_blank">
	<img src="<?php echo esc_url( $feature['image'] ); ?>" />
	<p><?php echo esc_html( $feature['content'] ); ?></p>
</a>
