<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TCCi
 */

/**
 * The tcci_html_before action hook
 */
do_action( 'tcci_html_before' );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head><?php

		/**
		 * The tcci_head_top action hook
		 */
		do_action( 'tcci_head_top' );

		?><meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"><?php

		wp_head();

		/**
		 * The tcci_head_bottom action hook
		 */
		do_action( 'tcci_head_bottom' );

	?></head>

	<body <?php body_class(); ?>><?php

		/**
		 * The tcci_body_top action hook
		 *
		 * @hooked 		analytics_code 			10
		 * @hooked 		add_hidden_search		15
		 * @hooked 		skip_link 				20
		 */
		do_action( 'tcci_body_top' );

		/**
		 * The tcci_header_before action hook
		 */
		do_action( 'tcci_header_before' );

		?><header role="banner"><?php

			/**
			 * The tcci_header_top action hook
			 *
			 * @hooked 		header_wrap_start 		10
			 * @hooked 		site_branding_start 	15
			 */
			do_action( 'tcci_header_top' );

			/**
			 * The header_content action hook
			 *
			 * @hooked 		site_title 			10
			 * @hooked 		site_description 	15
			 */
			do_action( 'tcci_header_content' );

			/**
			 * The tcci_header_bottom action hook
			 *
			 * @hooked 		tcci_header_bottom 	85
			 * @hooked 		header_wrap_end 	90
			 * @hooked 		primary_menu 		95
			 */
			do_action( 'tcci_header_bottom' );

		?></header><?php

		/**
		 * The tcci_header_after action hook
		 */
		do_action( 'tcci_header_after' );

		/**
		 * The tcci_content_before action hook
		 */
		do_action( 'tcci_content_before' );

		?><div id="content" class="site-content"><?php

			/**
			 * The tcci_content_top action hook
			 *
			 * @hooked 		breadcrumbs
			 */
			do_action( 'tcci_content_top' );
