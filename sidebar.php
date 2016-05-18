<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DocBlock
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) { return; }

/**
 * The function_names_sidebars_before action hook
 */
do_action( 'function_names_sidebars_before' );

?><aside id="secondary" class="widget-area" role="complementary"><?php

	/**
	 * The function_names_sidebar_top action hook
	 */
	do_action( 'function_names_sidebar_top' );

	dynamic_sidebar( 'sidebar-1' );

	/**
	 * The function_names_sidebar_bottom action hook
	 */
	do_action( 'function_names_sidebar_bottom' );

?></aside><!-- #secondary --><?php

/**
 * The function_names_sidebars_after action hook
 */
do_action( 'function_names_sidebars_after' );