<?php
/**
 * The Home Footer sidebar template
 *
 * @package TCCi
 */

if ( ! is_active_sidebar( 'home_footer' ) ) { return; }

/**
 * The tcci_sidebars_before action hook
 */
do_action( 'tcci_sidebars_before' );

?><aside class="sidebar-homefooter" role="complementary">
	<div class="wrap"><?php

		/**
		 * The tcci_sidebar_top action hook
		 */
		do_action( 'tcci_sidebar_top' );

		dynamic_sidebar( 'home_footer' );

		/**
		 * The tcci_sidebar_bottom action hook
		 */
		do_action( 'tcci_sidebar_bottom' );

	?></div>
</aside><!-- #secondary --><?php

/**
 * The tcci_sidebars_after action hook
 */
do_action( 'tcci_sidebars_after' );
