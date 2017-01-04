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
			 */
			do_action( 'tcci_while_before' );

			while ( have_posts() ) : the_post();

				/**
				 * The tcci_entry_before action hook
				 */
				do_action( 'tcci_entry_before' );

				if ( ! empty( $fields['header_image'] ) ) {

					?><img class="header-image" src="<?php echo esc_url( $fields['header_image'] ); ?>"><?php

				}

				if ( ! empty( $fields['content_block'] ) ) {

					foreach ( $fields['content_block'] as $block ) {

						set_query_var( 'block', $block );
						get_template_part( 'template-parts/newsletter/block', $block['chooser'] );

					}

				}

				if ( ! empty( $fields['footer_image'] ) ) {

					?><img class="footer-image" src="<?php echo esc_url( $fields['footer_image'] ); ?>"><?php

				}

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
