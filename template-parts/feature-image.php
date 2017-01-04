<?php
/**
 * Template part for displaying a text-only feature box.
 *
 * @package TCCi
 */

if ( 'internal' === $feature['link_type'] ) {

	$url = $feature['page'];

} else {

	$url = $feature['url'];

}

$image = $feature['image'];

if ( ! empty( $feature['headline'] ) ) :

	?><h2><?php echo esc_html( $feature['headline'] ); ?></h2><?php

endif;

?><a class="track" href="<?php echo esc_url( $url ); ?>"<?php if ( 'external' === $feature['link_type'] ) { echo ' target="_blank"'; } ?>>
    <img src="<?php echo esc_url( $image['url'] ); ?>" />
</a>
