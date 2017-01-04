<?php
/**
 * Template used for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TCCi
 */

?><li id="post-<?php the_ID(); ?>" <?php post_class( 'market-product' ); ?>>
	<a class="market-product-link" href="<?php echo esc_url( get_permalink( $product->ID ) ); ?>"><?php

		echo get_the_post_thumbnail( $product, 'product_thumb', array( 'class' => 'market-thumb' ) );

		?><h3 class="title-product"><?php

			echo esc_html( $product->post_title );

			if ( ! empty( $ccs ) ) {

				?><div class="comps-ccs">(<?php echo esc_html( $ccs[0]->name ); ?>cc)</div><?php

			}
		?></h3>
	</a>
</li><!-- #post-## -->
