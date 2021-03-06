<?php
/**
 * Template Name: Full-width, no sidebar
 *
 * Description: A full-width template with no sidebar
 *
 * @package TCCi
 */

get_header();

	?><div id="primary" class="content-area full-width">
		<main id="main" role="main"><?php

			/**
			 * The tcci_while_before action hook
			 */
			do_action( 'tcci_while_before' );

			while ( have_posts() ) : the_post();

				/**
				 * The tcci_entry_before action hook
				 */
				do_action( 'tcci_entry_before' );

				get_template_part( 'template-parts/content', 'page' );

				/**
				 * The tcci_entry_after action hook
				 *
				 * @hooked 		comments 		10
				 */
				do_action( 'tcci_entry_after' );

			endwhile; // loop

			/**
			 * The tcci_while_after action hook
			 */
			do_action( 'tcci_while_after' );

		?></main><!-- #main -->
	</div><!-- #primary --><?php

get_footer();