<?php
/**
 * Template part for displaying a text-only feature box.
 *
 * @package TCCi
 */

$linktype = get_sub_field( 'link_type' );

if ( 'internal' === $linktype ) {

	$url = get_sub_field( 'page' );

} else {

	$url = get_sub_field( 'url' );

}

$image = get_sub_field( 'image' );

if ( ! empty( get_sub_field( 'headline' ) ) ) :

	?><h2><?php the_sub_field( 'headline' ); ?></h2><?php

endif;

?><a class="track" href="<?php echo esc_url( $url ); ?>"<?php if ( 'external' === $linktype ) { echo ' target="_blank"'; } ?>>
    <img src="<?php echo esc_url( $image['url'] ); ?>" />
    <p><?php echo esc_html( get_sub_field( 'text' ) ); ?></p>
</a>
