<?php

/**
 * Class for creating a shortcode.
 */

class TCCI_Shortcode_Markets {

	/**
	 * Constructor.
	 */
	public function __construct(){}

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_shortcode( 'markets', array( $this, 'shortcode_markets' ) );

	} // hoks()

	/**
	 * Returns a WordPress menu for a shortcode.
	 *
	 * @hooked 		add_shortcode
	 * @param 		array 		$atts 			Shortcode attributes
	 * @param 		mixed 		$content 		The page content
	 * @return 		mixed 						A WordPress menu
	 */
	public function shortcode_markets( $atts, $content = null ) {

		$defaults 			= array();
		$args				= shortcode_atts( $defaults, $atts, 'markets' );

		ob_start();

		$markets = get_terms( 'product_market' );

		if ( empty( $markets ) ) { return; }

		?><ul class="wrap-market-apps"><?php

		foreach ( $markets as $market ) :

			$link 	= get_term_link( $market );

			if ( empty( $link ) ) { continue; }

			$meta 	= get_term_meta( $market->term_id );

			if ( empty( $meta ) ) { continue; }

			$imgsrc = wp_get_attachment_image_src( $meta['market-thumb'][0], 'medium' )[0];

			?><li class="market-app">
				<a href="<?php echo esc_url( $link ); ?>">
					<div class="market-img" style="background-image:url(<?php echo esc_url( $imgsrc );?>);"></div>
					<h3><?php echo esc_html( $market->name ); ?></h3>
				</a>
			</li><?php

		endforeach;

		?></ul><?php

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // shortcode_markets()

} // class
