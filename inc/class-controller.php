<?php

/**
 * The file that defines the core actions and filters for the theme
 *
 * @since 		1.0.0
 *
 * @package 	DocBlock
 */
class Class_Names_Controller {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the theme.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Class_Names_Loader    $loader    Maintains and registers all hooks for the theme.
	 */
	protected $loader;

	/**
	 * The unique identifier of this theme.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $theme_name    The string used to uniquely identify this theme.
	 */
	protected $theme_name;

	/**
	 * The current version of the theme.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the theme.
	 */
	protected $version;

	/**
	 * Define the core functionality of the theme.
	 *
	 * Set the theme name and the theme version that can be used throughout the theme.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->theme_name 	= 'tcci';
		$this->version 		= '1.0.0';

		$this->load_dependencies();
		$this->define_utility_hooks();
		$this->define_menu_hooks();
		$this->define_theme_hooks();
		$this->define_metabox_hooks();
		$this->define_automattic_hooks();
		$this->define_customizer_hooks();

	} // __construct()

	/**
	 * Load the required dependencies for this theme.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core theme.
		 */
		require_once get_template_directory() . '/inc/class-loader.php';

		/**
		 * The class responsible for sanitizing user input
		 */
		require_once get_template_directory() . '/inc/class-sanitize.php';

		/**
		 * The class of opinionated, utility functions.
		 */
		require_once get_template_directory() . '/inc/class-utilities.php';

		/**
		 * The class of functions related to menus.
		 */
		require_once get_template_directory() . '/inc/class-menukit.php';

		/**
		 * The class of functions related to theme hooks.
		 */
		require_once get_template_directory() . '/inc/class-themehooks.php';

		/**
		 * The class responsible for defining all actions relating to metaboxes.
		 */
		require_once get_template_directory() . '/inc/class-metaboxes.php';

		/**
		 * The class responsible for defining all actions relating to metaboxes.
		 */
		require_once get_template_directory() . '/inc/class-automattic.php';

		/**
		 * The class responsible for defining all actions relating to metaboxes.
		 */
		require_once get_template_directory() . '/inc/class-customizer.php';

		$this->loader 		= new Class_Names_Loader();
		$this->sanitizer 	= new Class_Names_Sanitize();

	} // load_dependencies()

	/**
	 * Register all of the hooks related to metaboxes
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_automattic_hooks() {

		$theme_automattic = new Class_Names_Automattic( $this->get_theme_name(), $this->get_version() );

		$this->loader->action( 'after_setup_theme', $theme_automattic, 'jetpack_setup' );
		$this->loader->action( 'after_setup_theme', $theme_automattic, 'wpcom_setup' );

	} // define_automattic_hooks()

	/**
	 * Register all of the hooks related to metaboxes
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_customizer_hooks() {

		$theme_customizer = new Class_Names_Customizer( $this->get_theme_name(), $this->get_version() );

		$this->loader->action( 'customize_register', 					$theme_customizer, 'register_panels' );
		$this->loader->action( 'customize_register', 					$theme_customizer, 'register_sections' );
		$this->loader->action( 'customize_register', 					$theme_customizer, 'register_fields' );
		$this->loader->action( 'wp_head', 								$theme_customizer, 'header_output' );
		$this->loader->action( 'customize_preview_init', 				$theme_customizer, 'live_preview' );
		$this->loader->action( 'customize_controls_enqueue_scripts', 	$theme_customizer, 'control_scripts' );

	} // define_customizer_hooks()

	/**
	 * Register all of the hooks related to customizing the appearance of the menus.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_menu_hooks() {

		$theme_menu = new Class_Names_Menukit( $this->get_theme_name(), $this->get_version() );

		//$this->loader->filter( 'walker_nav_menu_start_el', 		$theme_menu, 'dashicon_before_menu_item', 10, 4 );
		//$this->loader->filter( 'walker_nav_menu_start_el', 		$theme_menu, 'dashicon_after_menu_item', 10, 4 );
		//$this->loader->filter( 'walker_nav_menu_start_el', 		$theme_menu, 'dashicon_only_menu_item', 10, 4 );
		//$this->loader->filter( 'walker_nav_menu_start_el', 		$theme_menu, 'menu_caret', 10, 4 );
		//$this->loader->filter( 'walker_nav_menu_start_el', 		$theme_menu, 'svg_before_menu_item', 10, 4 );
		//$this->loader->filter( 'walker_nav_menu_start_el', 		$theme_menu, 'svg_after_menu_item', 10, 4 );
		//$this->loader->filter( 'walker_nav_menu_start_el', 		$theme_menu, 'svg_only_menu_item', 10, 4 );
		//$this->loader->filter( 'walker_nav_menu_start_el', 		$theme_menu, 'search_icon_only', 10, 4 );
		//$this->loader->filter( 'walker_nav_menu_start_el', 			$theme_menu, 'menu_show_hide', 10, 4 );

	} // define_menu_hooks()

	/**
	 * Register all of the hooks related to metaboxes
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_metabox_hooks() {

		$theme_metaboxes = new Class_Names_Metaboxes( $this->get_theme_name(), $this->get_version() );

		$this->loader->action( 'add_meta_boxes', 				$theme_metaboxes, 'add_metaboxes' );
		$this->loader->action( 'save_post', 					$theme_metaboxes, 'validate_meta', 10, 2 );
		//$this->loader->action( 'edit_form_after_title', 		$theme_metaboxes, 'metabox_subtitle', 10, 2 );
		$this->loader->action( 'add_meta_boxes', 				$theme_metaboxes, 'set_meta' );
		//$this->loader->filter( 'post_type_labels', 				$theme_metaboxes, 'change_featured_image_labels', 10, 1 );


	} // define_metabox_hooks()

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the theme.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_theme_hooks() {

		$theme_hooks = new Class_Names_Themehooks( $this->get_theme_name(), $this->get_version() );

		$this->loader->action( 'function_names_header_top', 			$theme_hooks, 'header_wrap_start', 10 );
		$this->loader->action( 'function_names_header_top', 			$theme_hooks, 'site_branding_start', 15 );
		$this->loader->action( 'function_names_header_content', 		$theme_hooks, 'title_site', 10 );
		$this->loader->action( 'function_names_header_content', 		$theme_hooks, 'site_description', 15 );
		$this->loader->action( 'function_names_header_bottom', 			$theme_hooks, 'site_branding_end', 85 );
		$this->loader->action( 'function_names_header_bottom', 			$theme_hooks, 'header_wrap_end', 90 );
		$this->loader->action( 'function_names_header_bottom', 			$theme_hooks, 'menu_primary', 95 );
		$this->loader->action( 'function_names_body_top', 				$theme_hooks, 'analytics_code', 10 );
		$this->loader->action( 'function_names_body_top', 				$theme_hooks, 'add_hidden_search', 15 );
		$this->loader->action( 'function_names_body_top', 				$theme_hooks, 'skip_link', 20 );
		$this->loader->action( 'function_names_while_before', 			$theme_hooks, 'title_archive' );
		$this->loader->action( 'function_names_while_before', 			$theme_hooks, 'title_single_post' );
		$this->loader->action( 'function_names_while_after', 			$theme_hooks, 'posts_nav' );
		$this->loader->action( 'function_names_footer_content', 		$theme_hooks, 'footer_content' );
		$this->loader->action( 'function_names_content_top', 			$theme_hooks, 'breadcrumbs' );
		$this->loader->action( 'function_names_entry_after', 			$theme_hooks, 'comments', 10 );
		$this->loader->action( 'function_names_404_before', 			$theme_hooks, 'title_404', 10 );
		$this->loader->action( 'function_names_404_content', 			$theme_hooks, 'add_search', 10 );
		$this->loader->action( 'function_names_404_content', 			$theme_hooks, 'four_04_posts_widget', 15 );
		$this->loader->action( 'function_names_404_content', 			$theme_hooks, 'four_04_categories', 20 );
		$this->loader->action( 'function_names_404_content', 			$theme_hooks, 'four_04_archives', 25 );
		$this->loader->action( 'function_names_404_content', 			$theme_hooks, 'four_04_tag_cloud', 30 );
		$this->loader->action( 'entry_header_content', 					$theme_hooks, 'title_entry', 10 );
		$this->loader->action( 'entry_header_content', 					$theme_hooks, 'title_page', 10 );
		$this->loader->action( 'entry_header_content', 					$theme_hooks, 'title_none', 10 );
		$this->loader->action( 'entry_header_content', 					$theme_hooks, 'title_search', 10 );
		$this->loader->action( 'entry_header_content', 					$theme_hooks, 'posted_on', 20 );
		$this->loader->action( 'function_names_footer_top', 			$theme_hooks, 'footer_wrap_begin' );
		$this->loader->action( 'function_names_footer_content', 		$theme_hooks, 'footer_locations', 10 );
		$this->loader->action( 'function_names_footer_content', 		$theme_hooks, 'footer_content', 20 );
		$this->loader->action( 'function_names_footer_bottom', 			$theme_hooks, 'footer_wrap_end' );

	} // define_theme_hooks()

	/**
	 * Register all of the hooks related to the utility functions.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_utility_hooks() {

		$theme_utils = new Class_Names_Utilities( $this->get_theme_name(), $this->get_version() );

		$this->loader->action( 'after_setup_theme', 				$theme_utils, 'setup' );
		$this->loader->action( 'after_setup_theme', 				$theme_utils, 'content_width', 0 );
		$this->loader->action( 'wp_enqueue_scripts', 				$theme_utils, 'public_scripts_and_styles' );
		$this->loader->action( 'widgets_init', 						$theme_utils, 'widgets_init' );
		$this->loader->action( 'login_enqueue_scripts', 			$theme_utils, 'login_scripts' );
		$this->loader->action( 'admin_enqueue_scripts', 			$theme_utils, 'admin_scripts_and_styles' );
		$this->loader->filter( 'style_loader_src', 					$theme_utils, 'remove_cssjs_ver', 10, 2 );
		$this->loader->filter( 'script_loader_src', 				$theme_utils, 'remove_cssjs_ver', 10, 2 );

		$this->loader->filter( 'body_class', 						$theme_utils, 'page_body_classes' );
		$this->loader->action( 'wp_head', 							$theme_utils, 'background_images' );
		$this->loader->filter( 'get_search_form', 					$theme_utils, 'make_search_button_a_button' );
		$this->loader->filter( 'embed_oembed_html', 				$theme_utils, 'youtube_add_id_attribute', 99, 4 );
		$this->loader->action( 'init', 								$theme_utils, 'disable_emojis' );
		$this->loader->filter( 'excerpt_length', 					$theme_utils, 'excerpt_length' );
		$this->loader->filter( 'excerpt_more', 						$theme_utils, 'excerpt_read_more' );

		$this->loader->filter( 'post_mime_types', 					$theme_utils, 'add_mime_types' );
		$this->loader->filter( 'upload_mimes', 						$theme_utils, 'custom_upload_mimes' );
		$this->loader->filter( 'mce_buttons_2', 					$theme_utils, 'add_editor_buttons' );
		$this->loader->filter( 'manage_page_posts_columns', 		$theme_utils, 'page_template_column_head', 10 );
		$this->loader->action( 'manage_page_posts_custom_column', 	$theme_utils, 'page_template_column_content', 10, 2 );
		$this->loader->action( 'edit_category', 					$theme_utils, 'category_transient_flusher' );
		$this->loader->action( 'save_post', 						$theme_utils, 'category_transient_flusher' );
		//$this->loader->filter( 'wp_setup_nav_menu_item', 			$theme_utils, 'add_menu_title_as_class', 10, 1 );
		//$this->loader->filter( 'wp_nav_menu_container_allowedtags', $theme_utils, 'allow_section_tags_as_containers', 10, 1 );

		$this->loader->shortcode( 'listmenu', 						$theme_utils, 'list_menu' );

	} // define_utility_hooks()

	/**
	 * The name of the theme used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 *
	 * @return    string    The name of the theme.
	 */
	public function get_theme_name() {

		return $this->theme_name;

	} // get_theme_name()

	/**
	 * The reference to the class that orchestrates the hooks with the theme.
	 *
	 * @since     1.0.0
	 *
	 * @return    Class_Names_Loader    Orchestrates the hooks of the theme.
	 */
	public function get_loader() {

		return $this->loader;

	} // get_loader()

	/**
	 * Retrieve the version number of the theme.
	 *
	 * @since     1.0.0
	 *
	 * @return    string    The version number of the theme.
	 */
	public function get_version() {

		return $this->version;

	} // get_version()



	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$this->loader->run();

	} // run()

} // class
