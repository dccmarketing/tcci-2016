<?php
/**
 * The sidebar for the Sidebar Content page template
 *
 * @package TCCi
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) { return; }

/**
 * The tcci_sidebars_before action hook
 */
do_action( 'tcci_sidebars_before' );

?><aside id="secondary" class="widget-area sidebar-left" role="complementary"><?php

	/**
	 * The tcci_sidebar_top action hook
	 */
	do_action( 'tcci_sidebar_top' );

	dynamic_sidebar( 'sidebar-left' );

	/**
	 * The tcci_sidebar_bottom action hook
	 */
	do_action( 'tcci_sidebar_bottom' );

?></aside><!-- #secondary --><?php

/**
 * The tcci_sidebars_after action hook
 */
do_action( 'tcci_sidebars_after' );
