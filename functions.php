<?php
/**
 * TCCi 2016 functions and definitions
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package TCCi
 */

 /**
  * Set the constants used throughout.
  */
 define( 'PARENT_THEME_SLUG', 'tcci' );
 define( 'PARENT_THEME_VERSION', '1.0.2' );

/**
 * Custom template tags for this theme.
 */
require get_stylesheet_directory() . '/inc/template-tags.php';

/**
 * Load The image function library
 */
require get_stylesheet_directory() . '/inc/imagekit.php';

/**
 * Load Slushman Themekit
 */
require get_stylesheet_directory() . '/inc/themekit.php';

/**
 * Load Main Menu Walker
 */
require get_stylesheet_directory() . '/inc/main-menu-walker.php';

/**
 * Load Autoloader
 */
require get_stylesheet_directory() . '/inc/class-autoloader.php';

/**
 * Create an instance of each class and load the hooks function.
 */
$classes[] = 'Automattic';
$classes[] = 'Customizer';
$classes[] = 'Menukit';
$classes[] = 'Metabox_Post_Format';
$classes[] = 'Shortcode_Listmenu';
$classes[] = 'Shortcode_Search';
$classes[] = 'Now_Hiring';
$classes[] = 'Themehooks';
$classes[] = 'Utilities';
$classes[] = 'WooCommerce';

foreach ( $classes as $class ) {

	$class_name 	= 'TCCI_' . $class;
	$class_obj 		= new $class_name();

	add_action( 'after_setup_theme', array( $class_obj, 'hooks' ) );

}
