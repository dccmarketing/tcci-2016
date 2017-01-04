<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TCCi
 */

			/**
			 * The tcci_content_bottom action hook
			 */
			do_action( 'tcci_content_bottom' );

		?></div><!-- #content --><?php

		/**
		 * The tcci_content_after action hook
		 */
		do_action( 'tcci_content_after' );

		/**
		 * The tcci_footer_before action hook
		 */
		do_action( 'tcci_footer_before' );

		?><footer id="colophon" role="contentinfo"><?php

			/**
			 * The tcci_footer_top action hook
			 */
			do_action( 'tcci_footer_top' );

			/**
			 * The tcci_footer_content action hook
			 *
			 * @hooked 		footer_content
			 */
			do_action( 'tcci_footer_content' );

			/**
			 * The tcci_footer_bottom action hook
			 */
			do_action( 'tcci_footer_bottom' );

		?></footer><!-- #colophon --><?php

	/**
	 * The tcci_footer_after action hook
	 */
	do_action( 'tcci_footer_after' );

	wp_footer();

	/**
	 * The tcci_body_bottom action hook
	 */
	do_action( 'tcci_body_bottom' );

	?></body>
</html>
