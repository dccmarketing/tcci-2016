<?php
/**
 * Template Name: Markets
 *
 * Description: Page template with sidebar on the left-side
 *
 * @package TCCi
 */

get_header();

	?><div class="wrap-market"><?php

		get_sidebar( 'market' );

		?><div id="primary" class="content-area sidebar-content">
			<main id="main" role="main"><?php

				/**
				 * The tcci_while_before action hook
				 */
				do_action( 'tcci_while_before' );

				?><div class="market-products"><?php

				while ( have_posts() ) : the_post();

					/**
					 * The tcci_entry_before action hook
					 */
					do_action( 'tcci_entry_before' );

					get_template_part( 'template-parts/content', 'market_product' );

					/**
					 * The tcci_entry_after action hook
					 *
					 * @hooked 		comments 		10
					 */
					do_action( 'tcci_entry_after' );

				endwhile; // loop

				?></div><?php

				/**
				 * The tcci_while_after action hook
				 */
				do_action( 'tcci_while_after' );

			?></main><!-- #main -->
		</div><!-- #primary -->
	</div><?php

get_footer();
