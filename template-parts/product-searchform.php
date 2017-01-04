<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 *
 *	This template overrides the default WooCommerce template using the
 *	get_product_search_form() function ion the inc/class-woocommerce.php file.
 *
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?><form role="search" method="get" class="search-form woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<label class="screen-reader-text" for="woocommerce-product-search-field"><?php _e( 'Search for:', 'woocommerce' ); ?></label>
	<input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
	<button type="submit" class="search-submit">
		<span class="screen-reader-text"><?php echo esc_attr_e( 'Search', 'tcci' ); ?></span>
		<span class="dashicons dashicons-search"></span>
	</button>
	<input type="hidden" name="post_type" value="product" />
	<input type="hidden" name="product_cat" value="air-brake-compressors" />
</form>
