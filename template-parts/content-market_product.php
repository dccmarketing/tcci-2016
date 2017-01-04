<?php
/**
 * Template used for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TCCi
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class( 'market-product' ); ?>>
	<a class="market-product-link" href="<?php echo esc_url( the_permalink() ); ?>"><?php

	the_post_thumbnail( 'thumbnail', array( 'class' => 'market-thumb' ) );

	the_title( '<h2 class="title-market">', '</h2>' );

	?></a>
</article><!-- #post-## -->
