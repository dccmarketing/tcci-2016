<?php
/**
 * TCCi 2016 Term Meta for Attributes terms.
 *
 * @since 		1.0.0
 * @package  	TCCi
 */
class TCCI_Termmeta_Attributes {

	/**
	 * The ID of this theme.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$theme_name 		The ID of this theme.
	 */
	private $theme_name;

	/**
	 * The version of this theme.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$version 			The current version of this theme.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string 			$plugin_name 		The name of this theme.
	 * @param 		string 			$version 			The version of this theme.
	 */
	public function __construct( $theme_name, $version ) {

		PARENT_THEME_SLUG 	= $theme_name;
		PARENT_THEME_VERSION 		= $version;

	} // __construct()

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		register_meta( 'term', 'type-description', 'wp_kses_post' );
		add_action( 'pa_compressor-type_edit_form_fields', 	array( $this, 'add_termmeta_fields_to_edit_screen' ), 99, 2 );
		add_action( 'pa_compressor-type_add_form_fields', 	array( $this, 'add_termmeta_fields_to_new_screen' ), 99 );
		add_action( 'edit_pa_compressor-type', 				array( $this, 'validate_meta' ) );
		add_action( 'create_pa_compressor-type', 			array( $this, 'validate_meta' ) );

	} // hoks()

	/**
	 * Includes the view for the term meta edit fields.
	 *
	 * @exits 		If not in the admin.
	 * @exits 		If not on the pa_compress-type taxonomy.
	 * @param 		object 		$term 			The term object
	 * @param 		string 		$taxonomy 		The taxonomy slug
	 */
	public function add_termmeta_fields_to_edit_screen( $term, $taxonomy ) {

		if ( ! is_admin() ) { return; }
		if ( 'pa_compressor-type' !== $taxonomy ) { return; }

		include( get_stylesheet_directory() . '/template-parts/metaboxes/compressor-type-desc-edit.php' );

	} // add_termmeta_fields_to_edit_screen()

	/**
	 * Includes the view for the new term meta fields.
	 */
	public function add_termmeta_fields_to_new_screen() {

		if ( ! is_admin() ) { return; }

		include( get_stylesheet_directory() . '/template-parts/metaboxes/compressor-type-desc-new.php' );

	} // add_termmeta_fields_to_new_screen()

	/**
	 * Check each nonce. If any don't verify, $nonce_check is increased.
	 * If all nonces verify, returns 0.
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		int 		The value of $nonce_check
	 */
	private function check_nonces( $posted ) {

		$nonces 		= array();
		$nonce_check 	= 0;

		$nonces[] 		= 'nonce_type_description';

		foreach ( $nonces as $nonce ) {

			if ( ! isset( $posted[$nonce] ) ) { $nonce_check++; }
			if ( isset( $posted[$nonce] ) && ! wp_verify_nonce( $posted[$nonce], PARENT_THEME_SLUG ) ) { $nonce_check++; }

		}

		return $nonce_check;

	} // check_nonces()

	/**
	 * Returns an array of the all the metabox fields and their respective types
	 *
	 * $fields[] 	= array( 'field-name', 'field-type', 'Field Label' );
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		array 		Metabox fields and types
	 */
	private function get_term_fields() {

		$fields 	= array();
		$fields[] 	= array( 'comp-type-desc', 'editor', '' );

		return $fields;

	} // get_term_fields()

	/**
	 * Returns the requested term meta.
	 *
	 * @exits 		If $term_id, $key, or $type are empty.
	 * @param 		int 		$term_id 		The term ID.
	 * @param  		string 		$key 			The meta key.
	 * @param  		string 		$type    		The data type.
	 * @return 		string 						The sanitized meta data.
	 */
	public static function get_term_meta_value( $term_id, $key, $type ) {

		if ( empty( $term_id ) || empty( $key ) || empty( $type ) ) { return; }

		$value 		= get_term_meta( $term_id, $key, true );
		$sanitizer 	= new TCCI_Sanitize();

		return $sanitizer->clean( $value, $type );

	} // get_term_meta_value()

	/**
	 * Sanitizes the description term meta.
	 *
	 * @param 		mixed 		$value 			The current description.
	 * @return 		mixed 						The sanitized description.
	 */
	public function sanitize_description( $value ) {

		$sanitizer 	= new TCCI_Sanitize();
		$new_value 	= $sanitizer->clean( $value, 'editor' );

		return $new_value;

	} // sanitize_description()

	/**
	 * Saves term meta data
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @param 		int 		$term_id 		The term ID
	 * @return 		array 		$ids 			An array of the meta IDs.
	 */
	public function validate_meta( $term_id ) {

		if ( ! current_user_can( 'edit_posts' ) ) { return $term_id; }

		$nonce_check = $this->check_nonces( $_POST );

		if ( 0 >= $nonce_check ) { return $term_id; }

		$metas = $this->get_term_fields();
		$ids = array();

		foreach ( $metas as $meta ) {

			$value 		= ( empty( $this->meta[$meta[0]][0] ) ? '' : $this->meta[$meta[0]][0] );
			$sanitizer 	= new TCCI_Sanitize();
			$new_value 	= $sanitizer->clean( $_POST[$meta[0]], $meta[1] );
			$ids 		= update_term_meta( $term_id, $meta[0], $new_value );

			unset( $value );
			unset( $sanitizer );
			unset( $new_value );

		} // foreach

		return $ids;

	} // validate_meta()

} // class
