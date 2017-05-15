<?php
/**
 * Newsletter template.
 */

$fields = get_fields( get_the_ID() );

get_header();

	?><div id="primary" class="content-area full-width newsletter">
		<main id="main" role="main"><?php

			/**
			 * The tcci_while_before action hook
			 *
			 * @hooked 		newsletter_header_image		10
			 */
			do_action( 'tcci_while_before' );

			while ( have_posts() ) : the_post();
			
				the_title( '<h1 class="entry-title">', '</h1>' );
				
				?><img class="header-image" src="https://tccimfg.com/wp-content/uploads/2014/04/ENG_H.jpeg"><?php

				/**
				 * The tcci_entry_before action hook
				 */
				do_action( 'tcci_entry_before' );

				if ( ! empty( $fields['posts'] ) ) :

					foreach ( $fields['posts'] as $block ) :
						
						?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
						
						set_query_var( 'story', $block['post'] );
						get_template_part( 'template-parts/newsletter/' . $block['design'] );
						
						?></article><!-- #post-## --><?php
						
					endforeach;

				endif;

				/**
				 * The tcci_entry_after action hook
				 *
				 * @hooked 		comments		10
				 */
				do_action( 'tcci_entry_after' );
				
				?><img class="footer-image" src="https://tccimfg.com/wp-content/uploads/2017/05/5-2016-nl-part9.jpg"><?php

			endwhile; // loop

			/**
			 * The tcci_while_after action hook
			 *
			 * @hooked 		newsletter_footer_image		10
			 */
			do_action( 'tcci_while_after' );
			
		?></main><!-- #main -->
	</div><!-- #primary --><?php

get_footer();
