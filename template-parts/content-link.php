<?php
/**
 * Template part for displaying posts of the Link post format.
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

	do_action( 'tcci_entry_bottom' );

?></article><!-- #post-## -->
