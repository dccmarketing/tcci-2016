<?php
/**
 * Template part for displaying the new term meta fields.
 *
 * @package TCCi
 */

wp_nonce_field( basename( __FILE__ ), 'nonce_type_description' );

?><div class="form-field term-market-image-wrap">
	<label for="comp-type-desc"><?php esc_html_e( 'Compressor Type Description', 'tcci' ); ?></label><?php

	$atts['id'] 						= 'comp-type-desc';
	$atts['settings']['textarea_name'] 	= 'comp-type-desc';

	$atts = apply_filters( 'tcci-2016-field-' . $atts['id'], $atts );

	include( get_stylesheet_directory() . '/template-parts/fields/editor.php' );
	unset( $atts );

?></div>
