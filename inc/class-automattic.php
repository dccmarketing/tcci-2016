<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package  	DocBlock
 */
class Class_Names_Automattic {

	/**
	 * Constructor
	 */
	public function __construct() {} // __construct()

	/**
	 * Jetpack setup function.
	 *
	 * See: https://jetpack.com/support/infinite-scroll/
	 * See: https://jetpack.com/support/responsive-videos/
	 */
	function jetpack_setup() {

		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'render'    => '_s_infinite_scroll_render',
			'footer'    => 'page',
		) );

		add_theme_support( 'jetpack-responsive-videos' );

	} // jetpack_setup()

	/**
	 * Adds support for wp.com-specific theme functions.
	 *
	 * @global array $themecolors
	 */
	function wpcom_setup() {

		global $themecolors;

		if ( isset( $themecolors ) ) { return; }

		$themecolors = array(
			'bg'     => '',
			'border' => '',
			'text'   => '',
			'link'   => '',
			'url'    => '',
		);

	} // wpcom_setup()

} // class

/**
 * Custom render function for Infinite Scroll.
 */
function function_names_infinite_scroll_render() {

	while ( have_posts() ) {

		the_post();

		if ( is_search() ) {

			get_template_part( 'template-parts/content', 'search' );

		} else {

			get_template_part( 'template-parts/content', get_post_format() );

		}

	}

} // function_names_infinite_scroll_render()
