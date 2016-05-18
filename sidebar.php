<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TCCi
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) { return; }

/**
 * The tcci_sidebars_before action hook
 */
do_action( 'tcci_sidebars_before' );

?><aside id="secondary" class="widget-area" role="complementary"><?php

	/**
	 * The tcci_sidebar_top action hook
	 */
	do_action( 'tcci_sidebar_top' );

	dynamic_sidebar( 'sidebar-1' );

	/**
	 * The tcci_sidebar_bottom action hook
	 */
	do_action( 'tcci_sidebar_bottom' );

?></aside><!-- #secondary --><?php

/**
 * The tcci_sidebars_after action hook
 */
do_action( 'tcci_sidebars_after' );