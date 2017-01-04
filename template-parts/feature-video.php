<?php
/**
 * Template part for displaying a text-only feature box.
 *
 * @package TCCi
 */

$thumb = tcci_get_video_thumb( $feature['video'] );

if ( ! empty( $feature['headline'] ) ) :

	?><h2><?php echo esc_html( $feature['headline'] ); ?></h2><?php

endif;

?><a class="track feat-video" href="<?php echo esc_url( $feature['video'] ); ?>" target="_blank">
	<span class="dashicons dashicons-video-alt3"></span>
	<img src="<?php echo esc_url( $thumb ); ?>" />
</a>
