<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TCCi
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php

	do_action( 'tcci_entry_top' );

	?><header class="entry-header content"><?php

		/**
		 * @hooked 		title_entry 		10
		 * @hooked 		posted_on 			20
		 */
		do_action( 'entry_header_content' );

	?></header><!-- .entry-header --><?php

	do_action( 'tcci_entry_content_before' );

	?><div class="entry-content"><?php

			/* translators: %s: Name of current post */
			the_content( sprintf(
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'tcci' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tcci' ),
				'after'  => '</div>',
			) );

	?></div><!-- .entry-content --><?php

	do_action( 'tcci_entry_content_after' );

	?><footer class="entry-footer"><?php

		tcci_entry_footer();

	?></footer><!-- .entry-footer --><?php

	do_action( 'tcci_entry_bottom' );

?></article><!-- #post-## -->