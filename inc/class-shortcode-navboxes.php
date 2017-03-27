<?php

/**
 * Class for creating a shortcode.
 */

class TCCI_Shortcode_Navboxes {

	/**
	 * Constructor.
	 */
	public function __construct(){}

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_shortcode( 'navboxes', array( $this, 'shortcode_navboxes' ) );

	} // hooks()
	
	/**
	 * Returns a WordPress menu for a shortcode.
	 *
	 * @hooked 		add_shortcode
	 * @param 		array 		$atts 			Shortcode attributes
	 * @param 		mixed 		$content 		The page content
	 * @return 		mixed 						A WordPress menu
	 */
	public function shortcode_navboxes( $atts, $content = null ) {

		$defaults['type'] 		= 'pages'; // Could be: pages, cats, tax
		$defaults['include']	= array();
		$defaults['terms'] 		= '';
		$args					= shortcode_atts( $defaults, $atts, 'navboxes' );
		
		if ( empty( $args ) ) { return; }
		
		ob_start();
	
		if ( 'pages' === $args['type'] ) {
			
			$items = get_pages( $args );
			
		} elseif ( 'cats' === $args['type'] ) {
			
			$items = get_categories( $args );
			
		} elseif ( 'tax' === $args['type'] ) {
			
			$items = get_terms( $args['terms'] );
			
		}
		
		?><ul class="wrap-navboxes"><?php

		foreach ( $items as $item ) :
			
			if ( 'pages' === $args['type'] ) {
				
				$link = get_page_link( $item->ID );
				
				if ( empty( $link ) ) { continue; }
				
				$images = tcci_get_featured_images( $item->ID );

				if ( empty( $images ) ) { continue; }
				
				$imgsrc = $images['sizes']['full']['url'];
				$title = $item->post_title;
				
			} elseif ( 'cats' === $args['type'] ) {
				
				$link = get_category_link( $item->term_id );
				
				if ( empty( $link ) ) { continue; }
				
				$images = get_field( 'category_image', $item );
				$imgsrc = $images['url'];
				$title = $item->name;
				
			} elseif ( 'tax' === $args['type'] ) {
				
				$link = get_term_link( $item->term_id );
				
				//if ( empty( $link ) ) { continue; }
				
				$meta 	= get_term_meta( $item->term_id );

				//if ( empty( $meta ) ) { continue; }

				$imgsrc = wp_get_attachment_image_src( $meta['market-thumb'][0], 'medium' )[0];
				$title = $item->name;
				
			}

			?><li class="navbox">
				<a href="<?php echo esc_url( $link ); ?>"><?php
				
					if ( ! empty( $imgsrc ) ) :
						
						?><div class="navbox-img" style="background-image:url(<?php echo esc_url( $imgsrc );?>);"></div><?php
						
					endif;
					
					?><h3><?php echo esc_html( $title ); ?></h3>
				</a>
			</li><?php

		endforeach;

		?></ul><?php
		
		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // shortcode_navboxes()

} // class
