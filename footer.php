<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DocBlock
 */

			/**
			 * The function_names_content_bottom action hook
			 */
			do_action( 'function_names_content_bottom' );

		?></div><!-- #content --><?php

		/**
		 * The function_names_content_after action hook
		 */
		do_action( 'function_names_content_after' );

		/**
		 * The function_names_footer_before action hook
		 */
		do_action( 'function_names_footer_before' );

		?><footer id="colophon" role="contentinfo"><?php

			/**
			 * The function_names_footer_top action hook
			 */
			do_action( 'function_names_footer_top' );

			/**
			 * The function_names_footer_content action hook
			 *
			 * @hooked 		footer_content
			 */
			do_action( 'function_names_footer_content' );

			/**
			 * The function_names_footer_bottom action hook
			 */
			do_action( 'function_names_footer_bottom' );\

		?></footer><!-- #colophon --><?php

	/**
	 * The function_names_footer_after action hook
	 */
	do_action( 'function_names_footer_after' );

	wp_footer();

	/**
	 * The function_names_body_bottom action hook
	 */
	do_action( 'function_names_body_bottom' );

	?></body>
</html>