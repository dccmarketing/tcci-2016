<?php

/**
 * Class for creating a shortcode.
 */

class TCCI_Shortcode_Search {

	/**
	 * Constructor.
	 */
	public function __construct(){}

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_shortcode( 'search', array( $this, 'shortcode_search' ) );

	} // hoks()

	/**
	 * Returns a WordPress menu for a shortcode.
	 *
	 * @hooked 		add_shortcode
	 * @param 		array 		$atts 			Shortcode attributes
	 * @param 		mixed 		$content 		The page content
	 * @return 		mixed 						A WordPress menu
	 */
	public function shortcode_search( $atts, $content = null ) {

		$defaults['label'] 	= '';
		$defaults['tag'] 	= 'h2';
		$defaults['type'] 	= 'site'; // could also be product, if WooCommerce is active.
		$args				= shortcode_atts( $defaults, $atts, 'search' );

		ob_start();

		if ( ! empty( $args['label'] ) ) :

			echo '<' . $args['tag'] . '>' . esc_html( $args['label'] ) . '</' . $args['tag'] . '>';

		endif;

		if ( 'product' === $args['type'] ) {

			get_product_search_form();

		} else {

			get_search_form();

		}

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // shortcode_search()

} // class
