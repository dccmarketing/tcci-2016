<?php
/**
 * Template part for displaying the new term meta fields.
 *
 * @package TCCi
 */

wp_nonce_field( basename( __FILE__ ), 'nonce_type_description' );

?><tr class="form-field term-comp-type-wrap">
	<th scope="row"><label for="comp-type-desc"><?php

		esc_html_e( 'Compressor Type Description', 'tcci' );

	?></label></th>
	<td><?php

	$atts['id'] 						= 'comp-type-desc';
	$atts['settings']['textarea_name'] 	= 'comp-type-desc';

	$meta = $this->get_term_meta_value( $term->term_id, $atts['id'], 'editor' );

	if ( ! empty( $meta ) ) {

		$atts['value'] = $meta;

	}

	$atts = apply_filters( 'tcci-2016-field-' . $atts['id'], $atts );

	include( get_stylesheet_directory() . '/template-parts/fields/editor.php' );
	unset( $atts );

	?></td>
</tr>
