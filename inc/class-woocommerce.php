<?php
/**
 * WooCommerce Tweaks.
 *
 * @link 	https://docs.woothemes.com/document/third-party-custom-theme-compatibility/?utm_source=notice&utm_medium=product&utm_content=themecompatibility&utm_campaign=woocommerceplugin
 *
 * @package  	TCCi
 */
class TCCI_WooCommerce {

	/**
	 * Constructor
	 */
	public function __construct() {} // __construct()

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_action( 'woocommerce_before_main_content', 						array( $this, 'wrapper_begin' ) );
		add_action( 'woocommerce_after_main_content', 						array( $this, 'wrapper_end' ) );
		add_filter( 'get_the_archive_title', 								array( $this, 'remove_market_from_archive_title' ) );
		add_filter( 'single_product_archive_thumbnail_size', 				array( $this, 'change_shop_thumbnail_size' ) );
		add_filter( 'woocommerce_subcategory_count_html', 					array( $this, 'return_nothing' ) );
		add_filter( 'woocommerce_product_tabs', 							array( $this, 'rename_tabs' ), 98 );
		add_filter( 'woocommerce_product_tabs', 							array( $this, 'extra_product_tabs' ), 99 );
		add_action( 'woocommerce_after_single_product', 					array( $this, 'request_a_drawing_form' ), 30 );
		add_filter( 'woocommerce_product_additional_information_heading', 	array( $this, 'return_nothing' ) );
		add_filter( 'woocommerce_product_description_heading', 				array( $this, 'return_nothing' ) );
		add_action( 'save_post', 											array( $this, 'save_woocommerce_attr_to_meta' ), 10, 2 );
		remove_action( 'woocommerce_after_shop_loop_item', 					'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_single_product_summary', 				'woocommerce_template_single_title', 5 );
		remove_action( 'woocommerce_single_product_summary', 				'woocommerce_template_single_rating', 10 );
		remove_action( 'woocommerce_single_product_summary', 				'woocommerce_template_single_excerpt', 20 );
		remove_action( 'woocommerce_single_product_summary', 				'woocommerce_template_single_meta', 40 );
		remove_action( 'woocommerce_single_product_summary', 				'woocommerce_template_single_sharing', 50 );
		remove_action( 'woocommerce_after_single_product_summary', 			'woocommerce_output_product_data_tabs', 10 );
		remove_action( 'woocommerce_after_single_product_summary', 			'woocommerce_output_related_products', 20 );
		add_action( 'woocommerce_before_single_product', 					'woocommerce_template_single_title' );
		add_action( 'woocommerce_single_product_summary', 					'woocommerce_output_product_data_tabs', 4 );
		add_action( 'pre_get_posts', 										array( $this, 'show_all_market_products' ) );
		add_filter( 'wc_get_template', 										array( $this, 'remove_variation_cart_button' ), 10, 5 );

		/**
		 * Allows HTML in term (category, term) descriptions
		 */
		foreach ( array( 'pre_term_description' ) as $filter ) {
			remove_filter( $filter, 'wp_filter_kses' );
		}

		foreach ( array( 'term_description' ) as $filter ) {
			remove_filter( $filter, 'wp_kses_data' );
		}

	} // hooks()

	/**
	 * Changes the thumbnail size for the shop page.
	 * @param 		string 		$size 		The current thumbnail size.
	 * @return 		string 					The modified thumbnail size.
	 */
	public function change_shop_thumbnail_size( $size ) {

		$size = 'thumbnail';

		return $size;

	} // change_shop_thumbnail_size()

	public function enable_oembeds( $content, $raw_content ) {

		//

	} // enable_oembeds()

	/**
	 * Adds extra tabs to the product pages
	 *
	 * @param 	array 		$tabs 		The current tabs array
	 * @return 	array 					The modified tabs array
	 */
	function extra_product_tabs( $tabs ) {

		$resources = get_field( 'downloads_files' );
		$title = get_field( 'downloads_title' );

		if ( empty( $resources ) ) { return $tabs; }

		if ( empty( $title ) ) {

			$title = get_theme_mod( 'resources_tab_name' );

		}

		$tabs['resources_tab'] = array(
			'title'    => $title,
			'priority' => 15,
			'callback' => 'tcci_resources_tab_content'
		);

		return $tabs;

	} // extra_product_tabs()

	/**
	 * Adds the page title to an archive page
	 *
	 * @hooked 		get_the_archive_title
	 *
	 * @return 		mixed 							The archive page title
	 */
	public function remove_market_from_archive_title( $title ) {

		if ( ! is_archive() && ! is_tax( 'product_market' ) ) { return $title; }

		$title = single_cat_title( '', false );

		return $title;

	} // title_market()
	
	public function remove_variation_cart_button( $located, $template_name, $args, $template_path, $default_path ) {
		
		if ( 'single-product/add-to-cart/variation-add-to-cart-button.php' !== $template_name ) { return $located; }
		
		return '';
		
	} // remove_variation_cart_button()

	/**
	 * Rename the default tabs.
	 *
	 * @exits 		If $tabs is empty.
	 * @exits 		If the tab to rename is empty.
	 * @hooked
	 * @param 		array 		$tabs 		The current array of tabs.
	 * @return 		array 		$tabs 		The modified array of tabs.
	 */
	public function rename_tabs( $tabs ) {

		if ( empty( $tabs ) ) { return $tabs; }
		if ( empty( $tabs['additional_information'] ) ) { return $tabs; }

		$tabs['additional_information']['title'] = __( 'Specifications', 'tcci' );

		return $tabs;

	} // rename_tabs()

	/**
	 * Displays the Request a Drawing form.
	 */
	public function request_a_drawing_form() {

		if ( function_exists( 'FrmFormsController::show_form' ) ) { return; }

		$form_id = get_theme_mod( 'formidable_form_select' );

		?><div class="product-drawing-form"><?php

		echo FrmFormsController::show_form( $form_id, '', true );

		?></div><?php

	} // request_a_drawing_form()

	/**
	 * Generic function for returning nothing instead of default value for the filter.
	 *
	 * @param 		mixed 		$default 		The default value.
	 *
	 * @return 		void
	 */
	public function return_nothing( $default ) {

		return '';

	} // return_nothing()

	/**
	 * Saves the attribute data for each post as post meta.
	 * Allows for orderby attributes values using WP_Query.
	 *
	 * @exits 		If not the product post type.
	 * @param 		int 		$post_id 		The post ID.
	 * @param 		obj 		$post_obj 		The post object.
	 */
	public function save_woocommerce_attr_to_meta( $post_id, $post_obj ) {

		if ( 'auto-draft' === $post_obj->post_status ) { return; }
		if ( 'product' != $post_obj->post_type ) { return; }

		foreach( $_REQUEST['attribute_names'] as $index => $value ) {

			update_post_meta( $post_id, $value, $_REQUEST['attribute_values'][$index] );

		}

	} // save_woocommerce_attr_to_meta()

	/**
	 * Changes the query to show all products on the product_market
	 * taxonomy pages.
	 *
	 * @param 		obj 		$query 		The query object.
	 * @return 		obj 					The modified query object.
	 */
	public function show_all_market_products( $query ) {

		if ( ! $query->is_tax( 'product_market' ) ) { return $query; }

		$query->set( 'posts_per_page', -1 );

	} // show_all_market_products()

	/**
	 * Beginning wrapper tags for theme compatibility
	 *
	 * @return 		mixed 		Beginning theme tags
	 */
	public function wrapper_begin() {

	  echo '<div id="primary" class="content-area full-width"><main id="main" role="main">';

	} // wrapper_begin()

	/**
	 * Ending wrapper tags for theme compatibility
	 *
	 * @return 		mixed 		Ending theme tags
	 */
	public function wrapper_end() {

	  echo '</main><!-- #main --></div><!-- #primary -->';

	} // wrapper_end()

} // class

/**
 * Displays the resources tab content.
 */
function tcci_resources_tab_content() {

	$resources = get_field( 'downloads_files' );

	if ( empty( $resources ) ) { return; }

	$description = get_theme_mod( 'resources_description' );

	if ( ! empty( $description ) ) {

		?><p><?php echo esc_html( $description ); ?></p><?php

	}

	?><ul class="list-applications"><?php

	foreach ( $resources as $resource ) :

		?><li><?php

		if ( empty( $resource['file'] ) ) {

			echo esc_html( $resource['name'] );

		} else {

			?><a href="<?php echo esc_url( $resource['file'] ); ?>"><?php

				echo esc_html( $resource['name'] );

			?></a><?php

		}

		?></li><?php

	endforeach;

	?></ul><?php

} // tcci_resources_tab_content()


/**
 * Display product search form.
 *
 * Will first attempt to locate the product-searchform.php file in either the child or.
 * the parent, then load it. If it doesn't exist, then the default search form.
 * will be displayed.
 *
 * OVERRIDES THE DEFAULT WOOCOMMERCE FUNCTION.
 *
 * @subpackage  Forms
 * @param bool $echo (default: true)
 * @return string
 */
function get_product_search_form( $echo = true  ) {

	ob_start();

	do_action( 'pre_get_product_search_form'  );

	get_template_part( 'template-parts/product', 'searchform' );

	$form = apply_filters( 'get_product_search_form', ob_get_clean() );

	if ( $echo ) {

		echo $form;

	} else {

		return $form;

	}

} // get_product_search_form()
