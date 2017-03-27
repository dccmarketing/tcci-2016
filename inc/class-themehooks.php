<?php

/**
 * A class of methods using hooks in the theme.
 *
 * @package TCCi
 * @author Slushman <chris@slushman.com>
 */
class TCCI_Themehooks {

	/**
	 * Constructor
	 */
	public function __construct() {}

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_action( 'tcci_header_top', 			array( $this, 'header_wrap_begin' ), 10 );
		add_action( 'tcci_header_top', 			array( $this, 'site_branding_start' ), 15 );

		add_action( 'tcci_header_content', 		array( $this, 'title_site' ), 10 );
		add_action( 'tcci_header_content', 		array( $this, 'site_branding_end' ), 15 );
		//add_action( 'tcci_header_content', 		array( $this, 'header_nav_wrap_begin' ), 19 );
		add_action( 'tcci_header_content', 		array( $this, 'lang_switcher' ), 20 );
		add_action( 'tcci_header_content', 		array( $this, 'menu_topheader' ), 25 );
		add_action( 'tcci_header_content', 		array( $this, 'menu_social' ), 30 );
		add_action( 'tcci_header_content', 		array( $this, 'menu_primary' ), 85 );

	//	add_action( 'tcci_header_bottom', 		array( $this, 'header_nav_wrap_end' ), 85 );
		add_action( 'tcci_header_bottom',		array( $this, 'header_wrap_end' ), 90 );

		add_action( 'tcci_body_top', 			array( $this, 'analytics_code' ), 10 );
		add_action( 'tcci_body_top', 			array( $this, 'add_hidden_search' ), 15 );
		add_action( 'tcci_body_top', 			array( $this, 'skip_link' ), 20 );

		add_action( 'tcci_while_before', 		array( $this, 'title_archive' ) );
		add_action( 'tcci_while_before', 		array( $this, 'title_single_post' ) );
		add_action( 'tcci_while_before', 		array( $this, 'title_search' ) );

		add_action( 'tcci_while_after', 		array( $this, 'posts_nav' ) );
		add_action( 'tcci_while_after', 		array( $this, 'products_featured' ), 10 );
		add_action( 'tcci_while_after', 		array( $this, 'products_wrap_begin' ), 15 );
		add_action( 'tcci_while_after', 		array( $this, 'products_wobble' ), 20 );
		add_action( 'tcci_while_after', 		array( $this, 'products_swash' ), 30 );
		add_action( 'tcci_while_after', 		array( $this, 'products_reciprocating' ), 40 );
		add_action( 'tcci_while_after', 		array( $this, 'products_wrap_end' ), 95 );

		add_action( 'tcci_content_after', 		array( $this, 'market_images' ) );
		add_action( 'tcci_content_after', 		array( $this, 'sidebar_home_footer' ) );

		add_action( 'tcci_entry_content_after', array( $this, 'equal_features' ), 10 );
		add_action( 'tcci_entry_content_after', array( $this, 'four_features' ), 20 );

		add_action( 'tcci_entry_after', 		array( $this, 'comments' ), 10 );

		add_action( 'tcci_404_before', 			array( $this, 'title_404' ), 10 );

		add_action( 'tcci_404_content', 		array( $this, 'add_search' ), 10 );
		add_action( 'tcci_404_content', 		array( $this, 'four_04_posts_widget' ), 15 );
		add_action( 'tcci_404_content', 		array( $this, 'four_04_categories' ), 20 );
		add_action( 'tcci_404_content', 		array( $this, 'four_04_archives' ), 25 );
		add_action( 'tcci_404_content', 		array( $this, 'four_04_tag_cloud' ), 30 );

		add_action( 'entry_header_content', 	array( $this, 'posted_on' ), 10 );
		add_action( 'entry_header_content', 	array( $this, 'title_entry' ), 20 );
		add_action( 'entry_header_content', 	array( $this, 'title_page' ), 10 );
		add_action( 'entry_header_content', 	array( $this, 'title_link_post' ), 10 );

		add_action( 'tcci_footer_top', 			array( $this, 'footer_wrap_begin' ) );

		add_action( 'tcci_footer_content', 		array( $this, 'site_description' ), 10 );
		add_action( 'tcci_footer_content', 		array( $this, 'menu_social' ), 15 );
		add_action( 'tcci_footer_content', 		array( $this, 'footer_content' ), 20 );

		add_action( 'tcci_footer_bottom', 		array( $this, 'footer_wrap_end' ) );

	} // hooks()

	/**
	 * Adds a hidden search field
	 *
	 * @hooked 		tcci_body_top 		15
	 * @return 		mixed 				The HTML markup for a search field
	 */
	public function add_hidden_search() {

		?><div aria-hidden="true" class="hidden-search-top" id="hidden-search-top">
			<div class="wrap"><?php

				get_search_form();

			?></div>
		</div><?php

	} // add_hidden_search()

	/**
	 * Adds a search form
	 *
	 * @hooked 		tcci_404_content 		15
	 * @return 		mixed 		Search form markup
	 */
	public function add_search() {

		get_search_form();

	} // add_search()

	/**
	 * Inserts Google Tag manager code after body tag
	 *
	 * @hooked 		tcci_body_top 		10
	 * @return 		mixed 				The inserted Google Tag Manager code
	 */
	public function analytics_code() {

		$tag = get_theme_mod( 'tag_manager' );

		if ( ! empty( $tag ) ) {

			echo '<!-- Google Tag Manager -->';
			echo $tag;
			echo '<!-- Google Tag Manager -->';

		}

	} // analytics_code()

	/**
	 * Returns the appropriate breadcrumbs.
	 *
	 * @exits 		If on the front page.
	 * @hooked		tcci_wrap_content
	 * @return 		mixed 				WooCommerce breadcrumbs, then Yoast breadcrumbs
	 */
	public function breadcrumbs() {

		if ( is_front_page() ) { return; }

		?><div class="breadcrumbs">
			<div class="wrap-crumbs"><?php

				if ( function_exists( 'woocommerce_breadcrumb' ) ) {

					$args['after'] 			= '</span>';
					$args['before'] 		= '<span rel="v:child" typeof="v:Breadcrumb">';
					$args['delimiter'] 		= '&nbsp;>&nbsp;';
					$args['home'] 			= esc_html_x( 'Home', 'breadcrumb', 'tcci' );
					$args['wrap_after'] 	= '</span></span></nav>';
					$args['wrap_before'] 	= '<nav class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '><span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb">';

					woocommerce_breadcrumb( $args );

				} elseif ( function_exists( 'yoast_breadcrumb' ) ) {

					yoast_breadcrumb();

				}

			?></div><!-- .wrap-crumbs -->
		</div><!-- .breadcrumbs --><?php

	} // breadcrumbs()

	/**
	 * The comments markup
	 *
	 * If comments are open or we have at least one comment, load up the comment template.
	 *
	 * @exits 		If comments are closed
	 * @exits 		If there are no comments.
	 * @hooked 		tcci_entry_after 		10
	 * @return 		mixed 					The comments markup
	 */
	public function comments() {

		if ( ! comments_open() || get_comments_number() <= 0 ) { return; }

		comments_template();

	} // comments()

	/**
	 * Displays four feature boxes.
	 *
	 * @exits 		If this isn't the page_landing1.php page template.
	 * @exits 		If $fields['features'] is empty.
	 * @hooked 		tcci_entry_content_after
	 */
	public function equal_features() {

		$template = basename( get_page_template() );

		if ( 'page_landing.php' !== $template ) { return; }

		$fields = get_fields( get_the_ID() );

		if ( empty( $fields['equal-features'] ) ) { return; }

		?><ul class="features equal-features"><?php

		foreach ( $fields['equal-features'] as $feature ) :

			?><li><?php

			set_query_var( 'feature', $feature );
			get_template_part( 'template-parts/feature', 'equal' );

			?></li><?php

		endforeach;

		?></ul><?php

	} // equal_features()

	/**
	 * Adds the copyright and credits to the footer content.
	 *
	 * @hooked 		tcci_footer_content
	 * @return 		mixed 									The footer markup
	 */
	public function footer_content() {

		?><div class="site-info">
			<ul>
				<li class="copyright">
					&copy <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( get_admin_url(), 'tcci' ); ?>"><?php echo get_bloginfo( 'name' ); ?></a>
				</li>
				<li>
					<a href="tel:12174220055">+1 217.422.0055 tel</a>
				</li>
				<li>+1 217.422.4323 fax</li>
				<li class="credits"><?php

					printf( esc_html__( 'Site created by %1$s', 'tcci' ), '<a href="https://dccmarketing.com/" rel="nofollow" target="_blank">DCC</a>' );

				?></li>
			</ul>
		</div><!-- .site-info --><?php

	} // footer_content()

	/**
	 * Adds the opening wrapper tag.
	 *
	 * @hooked 		tcci_footer_top
	 * @return 		mixed 		The opening wrapper tag
	 */
	public function footer_wrap_begin() {

		?><div class="wrap wrap-footer"><?php

	} // footer_wrap_begin()

	/**
	 * Adds the closing wrapper tag.
	 *
	 * @hooked 		tcci_footer_bottom
	 * @return 		mixed 		The closing wrapper tag
	 */
	public function footer_wrap_end() {

		?></div><!-- wrap-footer --><?php

	} // footer_wrap_end()

	/**
	 * Adds the  to the 404 page content.
	 *
	 * @exits 		If not on the 404 page.
	 * @hooked 		tcci_404_content		25
	 * @return 		mixed 							Markup for the archives
	 */
	public function four_04_archives() {

		if ( ! is_404() ) { return; }

		/* translators: %1$s: smiley */
		$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'tcci' ), convert_smilies( ':)' ) ) . '</p>';

		the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

	} // four_04_archives()

	/**
	 * Adds the  to the 404 page content.
	 *
	 * @exits 		If not on the 404 page.
	 * @exits 		If this isn't a categorized blog.
	 * @hooked 		tcci_404_content		20
	 * @return 		mixed 							The categories widget
	 */
	public function four_04_categories() {

		if ( ! is_404() ) { return; }
		if ( ! tcci_categorized_blog() ) { return; }

		?><div class="widget widget_categories">
			<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'tcci' ); ?></h2>
			<ul><?php

				wp_list_categories( array(
					'orderby'    => 'count',
					'order'      => 'DESC',
					'show_count' => 1,
					'title_li'   => '',
					'number'     => 10,
				) );

			?></ul>
		</div><!-- .widget --><?php

	} // four_04_categories()

	/**
	 * Adds the Recent Posts widget to the 404 page.
	 *
	 * @exits 		If not on the 404 page.
	 * @hooked 		tcci_404_content 		15
	 * @return 		mixed 							The Recent Posts widget
	 */
	public function four_04_posts_widget() {

		if ( ! is_404() ) { return; }

		the_widget( 'WP_Widget_Recent_Posts' );

	} // four_04_posts_widget()

	/**
	 * Adds the  to the 404 page content.
	 *
	 * @exits 		If not on the 404 page.
	 * @hooked 		tcci_404_content		30
	 * @return 		mixed 							The tag cloud widget
	 */
	public function four_04_tag_cloud() {

		if ( ! is_404() ) { return; }

		the_widget( 'WP_Widget_Tag_Cloud' );

	} // four_04_tag_cloud()

	/**
	 * Displays four feature boxes.
	 *
	 * @exits 		If this isn't the page_landing1.php page template.
	 * @exits 		If $fields['features'] is empty.
	 * @hooked 		tcci_entry_content_after
	 */
	public function four_features() {

		$template = basename( get_page_template() );

		if ( 'page_landing.php' !== $template ) { return; }

		$fields = get_fields( get_the_ID() );

		if ( empty( $fields['features'] ) ) { return; }

		?><ul class="features four-features"><?php

		foreach ( $fields['features'] as $feature ) :

			?><li><?php

			set_query_var( 'feature', $feature );
			get_template_part( 'template-parts/feature', $feature['type'] );

			?></li><?php

		endforeach;

		?></ul><?php

	} // four_features()

	/**
	 * The header wrap markup
	 *
	 * @hooked 		tcci_header_content 		19
	 * @return 		mixed 				The header wrap markup
	 */
	public function header_nav_wrap_begin() {

		?><div class="wrap-navs"><?php

	} // header_nav_wrap_begin()

	/**
	 * The header wrap markup
	 *
	 * @hooked  	tcci_header_bottom 		85
	 * @return 		mixed 					The header wrap markup
	 */
	public function header_nav_wrap_end() {

		?></div><!-- .wrap-navs --><?php

	} // header_nav_wrap_end()

	/**
	 * The header wrap markup
	 *
	 * @hooked 		tcci_header_top 		10
	 * @return 		mixed 				The header wrap markup
	 */
	public function header_wrap_begin() {

		?><div class="wrap wrap-header"><?php

	} // header_wrap_begin()

	/**
	 * The header wrap markup
	 *
	 * @hooked  	tcci_header_bottom 		90
	 * @return 		mixed 					The header wrap markup
	 */
	public function header_wrap_end() {

		?></div><!-- .wrap-header --><?php

	} // header_wrap_end()

	/**
	 * Displays the market image markup.
	 *
	 * @exits 		If not on the product_market taxonomy.
	 * @hooked 		tcci_content_after
	 */
	public function market_images() {

		if ( ! is_tax( 'product_market' ) ) { return; }

		?><div class="market-img"></div><?php

	} // market_images()

	/**
	 * Adds the WPML language switcher.
	 *
	 * @hooked 		tcci_header_content 		20
	 */
	public function lang_switcher() {

		if ( ! function_exists( 'wpml_add_language_selector' ) ) { return; }

		echo '<div class="langs">';

		do_action( 'wpml_add_language_selector' );

		echo '</div>';

	} // lang_switcher()

	/**
	 * Adds the primary menu
	 *
	 * @hooked 		tcci_header_bottom 		95
	 * @return 		mixed 					The menu markup
	 */
	public function menu_primary() {

		?><nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="btn-text"><?php esc_html_e( 'Menu', 'tcci' ); ?></span>
			</button><?php

				$menu_args['menu_id'] 			= 'primary-menu';
				$menu_args['theme_location'] 	= 'primary';
				$menu_args['walker']  			= new TCCI_Walker();

				wp_nav_menu( $menu_args );

		?></nav><!-- #site-navigation --><?php

	} // menu_primary()

	/**
	 * Adds the social menu
	 *
	 * @exits 		If the social menu is not active.
	 * @hooked 		tcci_header_bottom 		65
	 * @return 		mixed 					The menu markup
	 */
	public function menu_social() {

		if ( ! has_nav_menu( 'social' ) ) { return; }

		$menu_args['theme_location']	= 'social';
		$menu_args['container'] 		= 'div';
		$menu_args['container_id']    	= 'menu-social-media';
		$menu_args['container_class'] 	= 'menu nav-social';
		$menu_args['menu_id']         	= 'menu-social-media-items';
		$menu_args['menu_class']      	= 'menu-items';
		$menu_args['depth']           	= 1;
		$menu_args['fallback_cb']     	= '';

		wp_nav_menu( $menu_args );

	} // menu_social()

	/**
	 * Adds the top header menu
	 *
	 * @exits 		If the top-header menu is not active.
	 * @hooked 		tcci_header_bottom 		65
	 * @return 		mixed 					The menu markup
	 */
	public function menu_topheader() {

		if ( ! has_nav_menu( 'top-header' ) ) { return; }

		$menu_args['theme_location']	= 'top-header';
		$menu_args['container'] 		= 'div';
		$menu_args['container_id']    	= 'menu-topheader';
		$menu_args['container_class'] 	= 'menu nav-topheader';
		$menu_args['menu_id']         	= 'menu-topheader-items';
		$menu_args['menu_class']      	= 'menu-items';
		$menu_args['depth']           	= 1;
		$menu_args['fallback_cb']     	= '';

		wp_nav_menu( $menu_args );

	} // menu_topheader()

	/**
	 * Adds the posted_on post meta.
	 *
	 * @exits 		If not the 'post' post type.
	 * @exits 		If this is a single post.
	 * @exits 		If post has a format.
	 * @hooked 		entry_header_content
	 * @return 		mixed 			The posted_on post meta.
	 */
	public function posted_on() {

		if ( 'post' != get_post_type() ) { return; }
		if ( is_single() ) { return; }
		if ( has_post_format() ) { return; }

		?><div class="entry-meta"><?php

			tcci_posted_on();

		?></div><!-- .entry-meta --><?php

	} // posted_on()

	/**
	 * Adds the post navigation to the archive pages
	 *
	 * @exits 		If not on the home (blog) page.
	 * @eixts 		If not an archive page.
	 * @hooked 		tcci_while_after
	 * @return 		mixed 							The posts navigation
	 */
	public function posts_nav() {

		if ( ! is_home() && ! is_archive() ) { return; }

		$args = array();

		if ( is_category( 'press' ) ) {

			$args['prev_text'] = __( 'Older Press', 'tcci' );
			$args['next_text'] = __( 'More Recent Press', 'tcci' );

		}

		if ( is_category( 'news' ) ) {

			$args['prev_text'] = __( 'Older News', 'tcci' );
			$args['next_text'] = __( 'More Recent News', 'tcci' );

		}

		the_posts_navigation( $args );

	} // posts_nav()

	/**
	 * Displays a list of products in the "featured" category.
	 *
	 * @exits 		If not the compressors page.
	 * @exits 		If there are no products.
	 * @hooked 		tcci_while_after 		10
	 */
	public function products_featured() {

		if ( ! is_page( 'compressors' ) ) { return FALSE; }

		$feat_args['ignore_sticky_posts'] 		= 1;
		$feat_args['meta_query']    			= WC()->query->get_meta_query();
		$feat_args['order'] 					= 'ASC';
		$feat_args['orderby'] 					= 'title';
		$feat_args['posts_per_page'] 			= '1';
		$feat_args['tax_query'][0]['taxonomy'] 	= 'product_cat';
		$feat_args['tax_query'][0]['terms'] 	= 'featured';
		$feat_args['tax_query'][0]['field'] 	= 'slug';
		$feat_args['tax_query'][0]['operator'] 	= 'IN';

		$products = tcci_get_posts( 'product', $feat_args, 'compressors-featured' );

		if ( empty( $products->posts ) ) { return; }

		$product 	= $products->posts[0];
		$thumb 		= get_the_post_thumbnail( $product->ID, 'thumbnail', array( 'class' => 'market-thumb' ) );

		?><section class="products-featured">
			<a href="<?php echo esc_url( get_permalink( $product->ID ) ); ?>">
				<h2 class="featured-product-title"><?php esc_html_e( 'Featured Product', 'tcci' ); ?></h2>
				<div class="featured-product market-product"><?php

					if ( $thumb ) {

						?><div class="feat-product-img"><?php

							echo $thumb;

						?></div><?php

					}

					?><div class="feat-product-desc">
						<h3><?php echo esc_html( $product->post_title ); ?></h3><?php
						echo wp_filter_kses( $product->post_content );
					?></div>
				</div>
			</a>
		</section><?php

	} // products_featured()

	/**
	 * Displays a list of products with the "reciprocating"
	 * compressor_type attribute.
	 *
	 * Cannot order by cubic centimeters since some products
	 * don't have that data entered.
	 *
	 * @exits 		If not the compressors page.
	 * @hooked 		tcci_while_after 		40
	 * @link 		http://new.galalaly.me/2013/05/woocommerce-sort-by-custom-attributes/
	 */
	public function products_reciprocating() {

		if ( ! is_page( 'compressors' ) ) { return FALSE; }

		$feat_args['ignore_sticky_posts'] 			= 1;
		//$feat_args['meta_key'] 						= 'pa_cubic-centimeters';
		$feat_args['meta_query']    				= WC()->query->get_meta_query();
		$feat_args['order'] 						= 'ASC';
		$feat_args['orderby'] 						= 'title';
		//$feat_args['orderby'] 						= 'meta_value_num';
		$feat_args['tax_query'][0]['taxonomy'] 		= 'pa_compressor-type';
		$feat_args['tax_query'][0]['terms'] 		= 'reciprocating';
		$feat_args['tax_query'][0]['field'] 		= 'slug';
		$feat_args['tax_query'][0]['operator'] 		= 'IN';

		$products = tcci_get_posts( 'product', $feat_args, 'compressors-reciprocating' );

		?><section class="product-group products-reciprocating">
			<h2 class="product-group-title"><?php esc_html_e( 'Reciprocating', 'tcci' ); ?></h2>
			<div class="group-desc"><?php

				$term = get_term_by( 'slug', 'reciprocating', 'pa_compressor-type'  );
				$desc = TCCi_Termmeta_Attributes::get_term_meta_value( $term->term_id, 'comp-type-desc', 'editor' );

				echo wp_kses_post( $desc );

			?></div>
		</section>
		<div class="product-group-products products-reciprocating"><?php

		if ( ! empty( $products->post ) ) :

			?><ul class="product-group-list"><?php

			foreach ( $products->posts as $product ) :

				$ccs = get_the_terms( $product->ID, 'pa_cubic-centimeters' );

				set_query_var( 'ccs', $ccs );
				set_query_var( 'product', $product );
				get_template_part( 'template-parts/content', 'comps_product' );

			endforeach;

			?></ul><?php

		endif;

		?></div><?php

	} // products_reciprocating()

	/**
	 * Displays a list of products with the "swash"
	 * compressor_type attribute.
	 *
	 * @exits 		If not the compressors page.
	 * @hooked 		tcci_while_after 		30
	 * @link 		http://new.galalaly.me/2013/05/woocommerce-sort-by-custom-attributes/
	 */
	public function products_swash() {

		if ( ! is_page( 'compressors' ) ) { return FALSE; }

		$feat_args['ignore_sticky_posts'] 		= 1;
		$feat_args['meta_key'] 					= 'pa_cubic-centimeters';
		$feat_args['meta_query']    			= WC()->query->get_meta_query();
		$feat_args['order'] 					= 'ASC';
		$feat_args['orderby'] 					= 'meta_value_num';
		$feat_args['tax_query'][0]['taxonomy'] 	= 'pa_compressor-type';
		$feat_args['tax_query'][0]['terms'] 	= 'swash';
		$feat_args['tax_query'][0]['field'] 	= 'slug';
		$feat_args['tax_query'][0]['operator'] 	= 'IN';
		$feat_args['update_post_meta_cache'] 	= true;
		$feat_args['update_post_term_cache'] 	= true;

		$products = tcci_get_posts( 'product', $feat_args, 'compressors-swash' );

		?><section class="product-group products-swash">
			<h2 class="product-group-title"><?php esc_html_e( 'Swash', 'tcci' ); ?></h2>
			<div class="group-desc"><?php

				$term = get_term_by( 'slug', 'swash', 'pa_compressor-type'  );
				$desc = TCCi_Termmeta_Attributes::get_term_meta_value( $term->term_id, 'comp-type-desc', 'editor' );

				echo wp_kses_post( $desc );

			?></div>
		</section>
		<div class="product-group-products products-swash"><?php

		if ( ! empty( $products->post ) ) :

			?><ul class="product-group-list"><?php

			foreach ( $products->posts as $product ) :

				$ccs = get_the_terms( $product->ID, 'pa_cubic-centimeters' );

				set_query_var( 'ccs', $ccs );
				set_query_var( 'product', $product );
				get_template_part( 'template-parts/content', 'comps_product' );

			endforeach;

			?></ul><?php

		endif;

		?></div><?php

	} // products_swash()

	/**
	 * Displays a list of products with the "wobble"
	 * compressor_type attribute.
	 *
	 * @exits 		If not the compressors page.
	 * @hooked 		tcci_while_after 		20
	 * @link 		http://new.galalaly.me/2013/05/woocommerce-sort-by-custom-attributes/
	 */
	public function products_wobble() {

		if ( ! is_page( 'compressors' ) ) { return FALSE; }

		$feat_args['ignore_sticky_posts'] 		= 1;
		$feat_args['meta_key'] 					= 'pa_cubic-centimeters';
		$feat_args['meta_query']    			= WC()->query->get_meta_query();
		$feat_args['order'] 					= 'ASC';
		$feat_args['orderby'] 					= 'meta_value_num';
		$feat_args['tax_query'][0]['taxonomy'] 	= 'pa_compressor-type';
		$feat_args['tax_query'][0]['terms'] 	= 'wobble';
		$feat_args['tax_query'][0]['field'] 	= 'slug';
		$feat_args['tax_query'][0]['operator'] 	= 'IN';

		$products = tcci_get_posts( 'product', $feat_args, 'compressors-wobble' );

		?><section class="product-group products-wobble">
			<h2 class="product-group-title"><?php esc_html_e( 'Wobble', 'tcci' ); ?></h2>
			<div class="group-desc"><?php

				$term = get_term_by( 'slug', 'wobble', 'pa_compressor-type' );
				$desc = TCCi_Termmeta_Attributes::get_term_meta_value( $term->term_id, 'comp-type-desc', 'editor' );

				echo wp_kses_post( $desc );

			?></div>
		</section>
		<div class="product-group-products products-wobble"><?php

		if ( ! empty( $products->post ) ) :

			?><ul class="product-group-list"><?php

			foreach ( $products->posts as $product ) :

				$ccs = get_the_terms( $product->ID, 'pa_cubic-centimeters' );

				set_query_var( 'ccs', $ccs );
				set_query_var( 'product', $product );
				get_template_part( 'template-parts/content', 'comps_product' );

			endforeach;

			?></ul><?php

		endif;

		?></div><?php

	} // products_wobble()

	/**
	 * Adds the opening wrapper tag.
	 *
	 * @exits 		If not the compressors page.
	 * @hooked 		tcci_while_after 		15
	 * @return 		mixed 		The opening wrapper tag
	 */
	public function products_wrap_begin() {

		if ( ! is_page( 'compressors' ) ) { return; }

		?><div class="wrap-products"><?php

	} // products_wrap_begin()

	/**
	 * Adds the closing wrapper tag.
	 *
	 * @exits 		If not the compressors page.
	 * @hooked 		tcci_while_after 		90
	 * @return 		mixed 		The closing wrapper tag
	 */
	public function products_wrap_end() {

		if ( ! is_page( 'compressors' ) ) { return; }

		?></div><!-- wrap-footer --><?php

	} // products_wrap_end()

	public function sae_ad() {

		$template = basename( get_page_template() );

		if ( 'page_sae-landing.php' !== $template ) { return; }

		$fields = get_fields( get_the_ID() );

		if ( empty( $fields['wind_image'] ) && empty( $fields['cnc_image'] ) ) { return; }

		?><div class="sae-ad-imgs">
			<a class="track" href="<?php echo esc_url( $fields['wind_page'] ); ?>">
				<img src="<?php echo esc_url( $fields['wind_image'] ); ?>" />
				<p><?php echo esc_html( $fields['wind_text'] ); ?></p>
			</a>
			<a class="track" href="<?php echo esc_url( $fields['cnc_page'] ); ?>">
				<img src="<?php echo esc_url( $fields['cnc_image'] ); ?>" />
				<p><?php echo esc_html( $fields['cnc_text'] ); ?></p>
			</a>
		</div><?php

	} // sae_ad()

	/**
	 * Adds the home footer sidebar via hook.
	 *
	 * @exits 		If not the front page.
	 * @hooked 		tcci_content_after
	 */
	public function sidebar_home_footer() {

		if ( ! is_front_page() ) { return; }

		return get_sidebar( 'home-footer' );

	} // sidebar_home_footer()

	/**
	 * Adds the starting site branding markup
	 *
	 * @hooked 		tcci_header_bottom			85
	 * @return 		mixed 						HTML markup
	 */
	public function site_branding_end() {

		?></div><!-- .site-branding --><?php

	} // site_branding_end()

	/**
	 * Adds the starting site branding markup
	 *
	 * @hooked 		tcci_header_top				15
	 * @return 		mixed 						HTML markup
	 */
	public function site_branding_start() {

		?><div class="site-branding"><?php

	} // site_branding_start()

	/**
	 * Adds the site description markup
	 *
	 * @hooked 		tcci_header_content 		15
	 * @return 		mixed 								The site description markup
	 */
	public function site_description() {

		$description = get_bloginfo( 'description', 'display' );

		if ( $description || is_customize_preview() ) {

			?><p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p><?php

		}

	} // site_description()

	/**
	 * Adds the a11y skip link markup
	 *
	 * @hooked 		tcci_body_top 		20
	 * @return 		mixed 				Skip link markup
	 */
	public function skip_link() {

		?><a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'tcci' ); ?></a><?php

	} // skip_link()

	/**
	 * The 404 page title markup
	 *
	 * @exits 		If not the 404 page.
	 * @hooked 		tcci_404_content 		10
	 * @return 		mixed 							The 440 page title
	 */
	public function title_404() {

		if ( ! is_404() ) { return; }

		?><header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'tcci' ); ?></h1>
		</header><!-- .page-header -->
		<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'tcci' ); ?></p><?php

	} // title_404()

	/**
	 * Adds the page title to an archive page
	 *
	 * @exits 		If not an archive page.
	 * @hooked 		tcci_while_before
	 * @return 		mixed 							The archive page title
	 */
	public function title_archive() {

		if ( ! is_archive() ) { return; }

		?><header class="page-header"><?php

			the_archive_title( '<h1 class="page-title title-archive">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );

		?></header><!-- .page-header --><?php

	} // title_archive()

	/**
	 * Returns the entry title
	 *
	 * @exits 		If on the front page.
	 * @exits 		If this is a page.
	 * @exits 		If has the link post format.
	 * @hooked 		entry_header_content 			10
	 * @return 		mixed 							The entry title
	 */
	public function title_entry() {

		if ( is_front_page() ) { return; }
		if ( is_page() ) { return; }
		if ( has_post_format( 'link' ) ) { return; }

		if ( is_single() ) {

			the_title( '<h1 class="entry-title">', '</h1>' );

		} else {

			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

		}

	} // title_entry()

	/**
	 * Displays the post title for the link post format.
	 *
	 * @exits 		If on the front page.
	 * @exits 		If not on an archive page.
	 * @exits 		If not the link post format.
	 * @exits 		If the link is empty.
	 * @hooked 		entry_header_content
	 * @return 		mixed 							The entry title
	 */
	public function title_link_post() {

		if ( is_front_page() ) { return; }
		if ( ! is_archive() ) { return; }
		if ( ! has_post_format( 'link' ) ) { return; }

		$meta = get_post_custom( get_the_ID() );
		$link = $meta['post-link'][0];

		if ( empty( $link ) ) { return; }

		?><div class="dashwrap">
			<span class="dashicons dashicons-admin-links"></span>
		</div>
		<h2 class="entry-title link-post">
			<a href="<?php echo esc_url( $link ); ?>" target="_blank"><?php the_title(); ?></a>
		</h2><?php

	} // title_link_post()

	/**
	 * Returns the page title
	 *
	 * @exits 		If on the front page.
	 * @exits 		If on the blog page;
	 * @exits 		If this is not a page.
	 * @hooked 		tcci_while_before 		10
	 * @return 		mixed 							The entry title
	 */
	public function title_page() {

		if ( is_front_page() || is_home() ) { return; }
		if ( ! is_page() ) { return; }

		the_title( '<h1 class="page-title">', '</h1>' );

	} // title_page()

	/**
	 * The search title markup
	 *
	 * @exits 		If this is not a search.
	 * @hooked 		tcci_while_before
	 * @return 		mixed 							Search title markup
	 */
	public function title_search() {

		if ( ! is_search() ) { return; }

		?><header class="page-header">
			<h1 class="page-title"><?php

				printf( esc_html__( 'Search Results for: %s', 'tcci' ), '<span>' . get_search_query() . '</span>' );

			?></h1>
		</header><!-- .page-header --><?php

	} // title_search()

	/**
	 * Adds the single post title to the index
	 *
	 * @exits 		If this is no the home page.
	 * @exits 		If this is the front page.
	 * @hooked 		tcci_while_before
	 * @return 		mixed 							The single post title
	 */
	public function title_single_post() {

		if ( ! is_home() || is_front_page() ) { return; }

		?><header class="page-header">
			<h1 class="page-title"><?php single_post_title(); ?></h1>
		</header><?php

	} // title_single_post()

	/**
	 * Adds the site title markup
	 *
	 * @exits 		If get_custom_logo() does not exist.
	 * @exits 		If the custom logo is empty.
	 * @hooked 		tcci_header_content 		10
	 * @return 		mixed 								The site title markup
	 */
	public function title_site() {

		if ( ! function_exists( 'get_custom_logo' ) ) { return; }

		$logo = get_custom_logo();

		if ( empty( $logo ) ) { return; }

		if ( is_front_page() && is_home() ) {

			?><h1 class="site-title"><?php echo $logo; ?></h1><?php

		} else {

			?><p class="site-title"><?php echo $logo; ?></p><?php

		}

	} // title_site()

} // class
