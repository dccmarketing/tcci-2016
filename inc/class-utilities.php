<?php

/**
 * A class of helpful theme functions
 *
 * @package TCCi
 * @author Slushman <chris@slushman.com>
 */
class TCCI_Utilities {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {} // __construct()

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_action( 'init', 							array( $this, 'setup' ) );
		add_action( 'init', 							array( $this, 'register_menus' ) );
		add_action( 'init', 							array( $this, 'content_width' ), 0 );
		add_action( 'wp_enqueue_scripts', 				array( $this, 'enqueue_public' ) );
		add_action( 'widgets_init', 					array( $this, 'widgets_init' ) );
		add_action( 'login_enqueue_scripts', 			array( $this, 'enqueue_login' ) );
		add_action( 'admin_enqueue_scripts', 			array( $this, 'enqueue_admin' ) );
		add_filter( 'style_loader_src', 				array( $this, 'remove_cssjs_ver' ), 10, 2 );
		add_filter( 'script_loader_src', 				array( $this, 'remove_cssjs_ver' ), 10, 2 );

		add_filter( 'body_class', 						array( $this, 'page_body_classes' ) );
		add_action( 'wp_head', 							array( $this, 'background_images' ) );
		add_filter( 'get_search_form', 					array( $this, 'make_search_button_a_button' ) );
		add_filter( 'embed_oembed_html', 				array( $this, 'youtube_add_id_attribute' ), 99, 4 );
		add_filter( 'embed_defaults', 					array( $this, 'set_embed_size' ) );
		add_action( 'init', 							array( $this, 'disable_emojis' ) );
		add_filter( 'excerpt_length', 					array( $this, 'excerpt_length' ) );
		add_filter( 'excerpt_more', 					array( $this, 'excerpt_read_more' ) );

		add_filter( 'post_mime_types', 					array( $this, 'add_mime_types' ) );
		add_filter( 'single_template', 					array( $this, 'template_newsletters' ) );
		add_filter( 'upload_mimes', 					array( $this, 'custom_upload_mimes' ) );
		add_filter( 'mce_buttons_2', 					array( $this, 'add_editor_buttons' ) );
		add_filter( 'manage_page_posts_columns', 		array( $this, 'page_template_column_head' ), 10 );
		add_action( 'manage_page_posts_custom_column', 	array( $this, 'page_template_column_content' ), 10, 2 );
		add_action( 'edit_category', 					array( $this, 'category_transient_flusher' ) );
		add_action( 'save_post', 						array( $this, 'category_transient_flusher' ) );
		//add_filter( 'wp_setup_nav_menu_item', 			array( $this, 'add_menu_title_as_class' ), 10, 1 );
		//add_filter( 'wp_nav_menu_container_allowedtags', array( $this, 'allow_section_tags_as_containers' ), 10, 1 );
		
	} // hooks()

	public function setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /assets/languages/ directory.
		 */
		load_theme_textdomain( 'tcci', get_stylesheet_directory() . '/assets/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'link',
		) );

		/**
		 * Set up the WordPress core custom logo feature.
		 *
		 * Add an array to the decalaration below to add these features.
		 *
		 * @param  	int 	height 			Defined height
		 * @param 	int 	width 			Defined width
		 * @param  	bool 	flex-height 	True if the theme has additional space for the logo vertically.
		 * @param 	bool 	flex-width 		True if the theme has additional space for the logo horizontally.
		 */
		add_theme_support( 'custom-logo' );

		/**
		 * Enable Yoast Breadcrumb support
		 */
		add_theme_support( 'yoast-seo-breadcrumbs' );

		/**
		 * Enable WooCommerce support
		 */
		add_theme_support( 'woocommerce' );

		/**
		 * Create custom image sizes.
		 */
		add_image_size( 'product_thumb', 80, 80 );

	} // setup()

	/**
	 * Add core editor buttons that are disabled by default
	 *
	 * @param 	array 		$buttons 		The current buttons
	 *
	 * @return 	array 						The modified buttons
	 */
	public function add_editor_buttons( $buttons ) {

		$buttons[] = 'superscript';
		$buttons[] = 'subscript';

		return $buttons;

	} // add_editor_buttons()

	/**
	 * Adds the Menu Item Title as a class on the menu item
	 *
	 * @param 	object 		$menu_item 			A menu item object
	 */
	public function add_menu_title_as_class( $menu_item ) {

		$title = sanitize_title( $menu_item->title );

		if ( empty( $menu_item->classes ) || ! is_array( $menu_item->classes ) ) {

			$menu_item->classes[0] = $title;

		} elseif ( ! in_array( $title, $menu_item->classes ) ) {
			
			$menu_item->classes[] = $title;
			
		}

		return $menu_item;

	} // add_menu_title_as_class()

	/**
	 * Adds PDF as a filter for the Media Library
	 *
	 * @param 	array 		$post_mime_types 		The current MIME types
	 *
	 * @return 	array 								The modified MIME types
	 */
	public function add_mime_types( $post_mime_types ) {

		$post_mime_types['application/pdf'] = array( esc_html__( 'PDFs', 'tcci' ), esc_html__( 'Manage PDFs', 'tcci' ), _n_noop( 'PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>' ) );
		$post_mime_types['text/x-vcard'] 	= array( esc_html__( 'vCards', 'tcci' ), esc_html__( 'Manage vCards', 'tcci' ), _n_noop( 'vCard <span class="count">(%s)</span>', 'vCards <span class="count">(%s)</span>' ) );

		return $post_mime_types;

	} // add_mime_types()

	/**
	 * Adds more allowed tags for WP menu containers.
	 *
	 * @param 		array 			$tags 			The current allowed tags
	 *
	 * @return 		array 							The modified allowed tags
	 */
	public function allow_section_tags_as_containers( $tags ) {

		$tags[] = 'section';

		return $tags;

	} // allow_section_tags_as_containers()

	/**
	 * Creates a style tag in the header with the background image
	 *
	 * @exits 		If not on the product_market taxonomy.
	 * @exits 		If the term meta is empty.
	 * @exits 		If the image is empty.
	 * @return 		mixed 			Style tag
	 */
	public function background_images() {

		if ( ! is_tax( 'product_market' ) ) { return FALSE; }

		global $wp_query;

		$meta 	= get_term_meta( $wp_query->queried_object->term_id );

		if ( empty( $meta ) ) { return; }

		$image 	= wp_get_attachment_image_src( $meta['market-image'][0], 'full' )[0];

		if ( empty( $image ) ) { return; }

		?><style>
			.market-img {background-image:url(<?php echo esc_url( $image ); ?>);}

			@media only screen and (max-width: 767px){
				.market-img {background-image:url() !important;}
			}

		</style><!-- Background Images --><?php

	} // background_images()

	/**
	 * Flush out the transients used in tcci_categorized_blog.
	 */
	public function category_transient_flusher() {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

		// Like, beat it. Dig?
		delete_transient( 'tcci_categories' );

	} // category_transient_flusher()

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global 		int 		$content_width
	 */
	public function content_width() {

		$GLOBALS['content_width'] = apply_filters( 'tcci_content_width', 640 );

	} // content_width()

	/**
	 * Adds support for additional MIME types to WordPress
	 *
	 * @param 		array 		$existing_mimes 			The existing MIME types
	 *
	 * @return 		array 									The modified MIME types
	 */
	public function custom_upload_mimes( $existing_mimes = array() ) {

		// add your extension to the array
		$existing_mimes['vcf'] = 'text/x-vcard';

		return $existing_mimes;

	} // custom_upload_mimes()

	/**
	 * Removes WordPress emoji support everywhere
	 */
	public function disable_emojis() {

		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	} // disable_emojis()

	/**
	 * Enqueues scripts and styles for the admin
	 */
	public function enqueue_admin( $hook ) {

		wp_enqueue_media();

		wp_enqueue_style( PARENT_THEME_SLUG . '-admin', get_stylesheet_directory_uri() . '/admin.css' );

		wp_enqueue_script( PARENT_THEME_SLUG . '-admin', get_stylesheet_directory_uri() . '/assets/js/admin.min.js', array( 'jquery' ), PARENT_THEME_VERSION, true );

		//wp_enqueue_script( PARENT_THEME_SLUG . '-file-uploader', get_stylesheet_directory_uri() . '/js/file-uploader.js', array( 'jquery' ), PARENT_THEME_VERSION, true );

		// if ( 'nav-menus.php' != $hook ) { return; } // Page-specific scripts & styles after this

	} // enqueue_admin()

	/**
	 * Enqueues scripts and styles for the login page
	 */
	public function enqueue_login() {

		wp_enqueue_style( 'tcci-login', get_stylesheet_directory_uri() . '/login.css', 10, 2 );

		//wp_enqueue_script( 'tcci-login', get_stylesheet_directory_uri() . '/js/login.min.js', array(), '20160518', true );

	} // enqueue_login()

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue_public() {

		wp_enqueue_style( 'tcci-style', get_stylesheet_uri() );

		wp_enqueue_script( 'tcci-public', get_stylesheet_directory_uri() . '/assets/js/public.min.js', array( 'jquery', 'enquire' ), '20160518', true );

		wp_enqueue_style( 'dashicons' );

		wp_enqueue_script( 'enquire', '//cdnjs.cloudflare.com/ajax/libs/enquire.js/2.1.2/enquire.min.js', array(), '20150804', true );

		wp_enqueue_style( 'tcci-fonts', $this->fonts_url(), array(), null );

	} // enqueue_public()

	/**
	 * Limits excerpt length.
	 *
	 * @param 	int 		$length 			The current word length of the excerpt
	 *
	 * @return 	int 							The word length of the excerpt
	 */
	public function excerpt_length( $length ) {

		if ( is_home() || is_front_page() ) {

			return 30;

		}

		return $length;

	} // excerpt_length()

	/**
	 * Customizes the "Read More" text for excerpts
	 *
	 * @global   			$post 		The post object
	 *
	 * @param 	mixed 		$more 		The current "read more"
	 *
	 * @return 	mixed 					The modifed "read more"
	 */
	public function excerpt_read_more( $more ) {

		global $post;

		$return = sprintf( '... <a class="moretag read-more" href="%s">', esc_url( get_permalink( $post->ID ) ) );
		$return .= esc_html__( 'Read more', 'tcci' );
		$return .= '<span class="screen-reader-text">';
		$return .= sprintf( esc_html__( ' about %s', 'tcci' ), $post->post_title );
		$return .= '</span></a>';

		return $return;

	} // excerpt_read_more()

	/**
	 * Properly encode a font URLs to enqueue a Google font
	 *
	 * @return 	mixed 		A properly formatted, translated URL for a Google font
	 */
	public static function fonts_url() {

		$return 	= '';
		$families 	= '';
		$fonts[] 	= array( 'font' => 'Titillium Web', 'weights' => '400,300,600,700', 'translate' => esc_html_x( 'on', 'Titillium Web font: on or off', 'tcci' ) );

		foreach ( $fonts as $font ) {

			if ( 'off' == $font['translate'] ) { continue; }

			$families[] = $font['font'] . ':' . $font['weights'];

		}

		if ( ! empty( $families ) ) {

			$query_args['family'] 	= urlencode( implode( '|', $families ) );
			$query_args['subset'] 	= urlencode( 'latin' );
			$return 				= add_query_arg( $query_args, '//fonts.googleapis.com/css' );

		}

		return $return;

	} // fonts_url()
	
	/**
	 * Converts the search input button to an HTML5 button element
	 *
	 * @hook 		get_search_form
	 *
	 * @param 		mixed  		$form 			The current form HTML
	 *
	 * @return 		mixed 						The modified form HTML
	 */
	public function make_search_button_a_button( $form ) {

		$form = '<form action="' . esc_url( home_url( '/' ) ) . '" class="search-form" method="get" role="search" >
				<label class="screen-reader-text" for="site-search">' . _x( 'Search for:', 'label' ) . '</label>
				<input class="search-field" id="site-search" name="s" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" title="' . esc_attr_x( 'Search for:', 'label' ) . '" type="search" value="' . get_search_query() . '"  />
				<button type="submit" class="search-submit">
					<span class="screen-reader-text">'. esc_attr_x( 'Search', 'submit button' ) .'</span>
					<span class="dashicons dashicons-search"></span>
				</button>
			</form>';

		return $form;

	} // make_search_button_a_button()

	/**
	 * Adds classes to the body tag.
	 *
	 * @global 	$post						The $post object
	 *
	 * @param 	array 		$classes 		Classes for the body element.
	 *
	 * @return 	array 						The modified body class array
	 */
	public function page_body_classes( $classes ) {

		global $post;

		if ( empty( $post->post_content ) ) {

			$classes[] = 'content-none';

		} else {

			$classes[] = $post->post_name;

		}

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {

			$classes[] = 'group-blog';

		}

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {

			$classes[] = 'hfeed';

		}

		return $classes;

	} // page_body_classes()

	/**
	 * The content for each column cell
	 *
	 * @param 		string 		$column_name 		The name of the column
	 * @param 		int 		$post_ID 			The post ID
	 *
	 * @return 		mixed 							The cell content
	 */
	public function page_template_column_content( $column_name, $post_ID ) {

		if ( 'page_template' !== $column_name ) { return; }

		$slug 		= get_page_template_slug( $post_ID );
		$templates 	= get_page_templates();
		$name 		= array_search( $slug, $templates );

		if ( ! empty( $name ) ) {

			echo '<span class="name-template">' . $name . '</span>';

		} else {

			echo '<span class="name-template">' . esc_html( 'Default', 'tcci' ) . '</span>';

		}

	} // page_template_column_content()

	/**
	 * Adds the page template column to the columns on the page listings
	 *
	 * @param 	array 		$defaults 			The current column names
	 *
	 * @return 	array           				The modified column names
	 */
	public function page_template_column_head( $defaults ) {

		$defaults['page_template'] = esc_html( 'Page Template', 'tcci' );

		return $defaults;

	} // page_template_column_head()

	/**
	 * Registers Menus
	 *
	 * @hooked 		after_setup_theme
	 */
	public function register_menus() {

		register_nav_menus( array(
			'primary' 		=> esc_html__( 'Primary', 'tcci' ),
			'social' 		=> esc_html__( 'Social', 'tcci' ),
			'top-header' 	=> esc_html__( 'Top Header', 'tcci' ),
			'footer' 		=> esc_html__( 'Footer', 'tcci' )
		) );

	} // register_menus()

	/**
	 * Removes query strings from static resources
	 * to increase Pingdom and GTMatrix scores.
	 *
	 * Does not remove query strings from Google Font calls.
	 *
	 * @param 	string 		$src 			The resource URL
	 *
	 * @return 	string 						The modifed resource URL
	 */
	public function remove_cssjs_ver( $src ) {

		if ( empty( $src ) ) { return; }
		if ( strpos( $src, 'https://fonts.googleapis.com' ) ) { return; }

		if ( strpos( $src, '?ver=' ) ) {

			$src = remove_query_arg( 'ver', $src );

		}

		return $src;

	} // remove_cssjs_ver()

	/**
	 * Removes the "Private" text from the private pages in the breadcrumbs
	 *
	 * @param 	string 		$text 			The breadcrumb text
	 *
	 * @return 	string 						The modified breadcrumb text
	 */
	public function remove_private( $text ) {

		$check = stripos( $text, 'Private: ' );

		if ( is_int( $check ) ) {

			$text = str_replace( 'Private: ', '', $text );

		}

		return $text;

	} // remove_private()

	/**
	 * Sets the default size of embeds.
	 */
	public function set_embed_size() {

		return array( 'width' => 500, 'height' => 281 );

	} // set_embed_size()

	/**
	 * Adds a single post template for the newsletters category.
	 *
	 * @param 		string 		$template 		The current single post template.
	 * @return 		string 						The single post template.
	 */
	public function template_newsletters( $template ) {

		if( ! is_single() ) { return $template; }

		global $post;

		$fields = get_fields( $post->ID );

		if( empty( $fields ) ) { return $template; }

		$new_template = '';

		if( has_term( 'newsletters', 'category', $post ) ) {

			$new_template = locate_template( array( 'single-newsletters.php' ) );

		}

		if ( empty( $new_template ) ) { return $template; }

		return $new_template;

	} // template_newsletters()

	/**
	 * Unlinks breadcrumbs that are private pages
	 *
	 * @param 	mixed 		$output 		The HTML output for the breadcrumb
	 * @param 	array 		$link 			Array of link info
	 *
	 * @return 	mixed 						The modified link output
	 */
	public function unlink_private_pages( $output, $link ) {

		if ( ! isset( $link['url'] ) || empty( $link['url'] ) ) { return $output; }

		$id 		= url_to_postid( $link['url'] );
		$options 	= WPSEO_Options::get_all();

		if ( $options['breadcrumbs-home'] !== $link['text'] && 0 === $id ) {

			$output = '<span rel="v:child" typeof="v:Breadcrumb">' . $link['text'] . '</span>';

		}

		return $output;

	} // unlink_private_pages()

	/**
	 * Register widget areas.
	 *
	 * @hooked 		widgets_init
	 * @link 		https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	public function widgets_init() {

		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'tcci' ),
			'id'            => 'sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'tcci' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Markets', 'tcci' ),
			'id'            => 'markets',
			'description'   => esc_html__( 'Add widgets here.', 'tcci' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Home Footer', 'tcci' ),
			'id'            => 'home_footer',
			'description'   => esc_html__( 'Add widgets here.', 'tcci' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

	} // widgets_init()

	/**
	 * Adds the video ID as the ID attribute on the iframe
	 *
	 * @param 		string 		$html 			The current oembed HTML
	 * @param 		string 		$url 			The oembed URL
	 * @param 		array 		$attr 			The oembed attributes
	 * @param 		int 		$post_id 		The post ID
	 *
	 * @return 		string 						The modified oembed HTML
	 */
	public function youtube_add_id_attribute( $html, $url, $attr, $post_id ) {

		$check = strpos( $url, 'youtu' );

		if ( ! $check ) { return $html; }

		if ( strpos( $url, 'watch?v=' ) > 0 ) {

			$id = explode( 'watch?v=', $url );

		} else {

			$id = explode( '.be/', $url );

		}

		$html = str_replace( 'allowfullscreen>', 'allowfullscreen id="video-' . $id[1] . '">', $html );

		return $html;

	} // youtube_add_id_attribute

} // class
