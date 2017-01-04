<?php
/**
 * Template part for displaying a content feature box.
 *
 * @package TCCi
 */

if ( ! empty( $feature['headline'] ) ) :

	?><h2><?php echo esc_html( $feature['headline'] ); ?></h2><?php

endif;

?><div><?php echo apply_filters( 'the_content', $feature['content'] ); ?></div>
