<?php
/**
 * Replace with Theme Name Customizer
 *
 * Contains methods for customizing the theme customization screen.
 *
 * @link 		https://codex.wordpress.org/Theme_Customization_API
 * @since 		1.0.0
 * @package  	DocBlock
 */
class Class_Names_Customizer {

	/**
	 * Constructor
	 */
	public function __construct() {}

	/**
	 * Registers custom panels for the Customizer
	 *
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 *
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_panels( $wp_customize ) {

		// Theme Options Panel
		$wp_customize->add_panel( 'theme_options',
			array(
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( 'Options for Replace with Theme Name', 'tcci' ),
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Theme Options', 'tcci' ),
			)
		);

		/*
		// Theme Options Panel
		$wp_customize->add_panel( 'theme_options',
			array(
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( 'Options for Replace with Theme Name', 'tcci' ),
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Theme Options', 'tcci' ),
			)
		);
		*/

	} // register_panels()

	/**
	 * Registers custom sections for the Customizer
	 *
	 * Existing sections:
	 *
	 * Slug 				Priority 		Title
	 *
	 * title_tagline 		20 				Site Identity
	 * colors 				40				Colors
	 * header_image 		60				Header Image
	 * background_image 	80				Background Image
	 * nav 					100 			Navigation
	 * widgets 				110 			Widgets
	 * static_front_page 	120 			Static Front Page
	 * default 				160 			all others
	 *
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 *
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_sections( $wp_customize ) {

		/*
		// New Section
		$wp_customize->add_section( 'new_section',
			array(
				'capability' 	=> 'edit_theme_options',
				'description' 	=> esc_html__( 'New Customizer Section', 'tcci' ),
				'panel' 		=> 'theme_options',
				'priority' 		=> 10,
				'title' 		=> esc_html__( 'New Section', 'tcci' )
			)
		);
		*/

	} // register_sections()

	/**
	 * Registers controls/fields for the Customizer
	 *
	 * Note: To enable instant preview, we have to actually write a bit of custom
	 * javascript. See live_preview() for more.
	 *
	 * Note: To use active_callbacks, don't add these to the selecting control, it apepars these conflict:
	 * 		'transport' => 'postMessage'
	 * 		$wp_customize->get_setting( 'field_name' )->transport = 'postMessage';
	 *
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 *
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_fields( $wp_customize ) {

		// Enable live preview JS for default fields
		$wp_customize->get_setting( 'blogname' )->transport 		= 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport 	= 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



		// Site Identity Section Fields

		// Google Tag Manager Field
		$wp_customize->add_setting(
			'tag_manager',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'tag_manager',
			array(
				'description' 		=> esc_html__( 'Paste in the Google Tag Manager code here. Do not include the comment tags!', 'tcci' ),
				'label' 			=> esc_html__( 'Google Tag Manager', 'tcci' ),
				'priority' 			=> 90,
				'section' 			=> 'title_tagline',
				'settings' 			=> 'tag_manager',
				'type' 				=> 'textarea'
			)
		);
		$wp_customize->get_setting( 'tag_manager' )->transport = 'postMessage';




		/*
		// Fields & Controls

		// Text Field
		$wp_customize->add_setting(
			'text_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'text_field',
			array(
				'description' 		=> esc_html__( '', 'tcci' ),
				'label'  			=> esc_html__( 'Text Field', 'tcci' ),
				'priority' 			=> 10,
				'section'  			=> 'new_section',
				'settings' 			=> 'text_field',
				'type' 				=> 'text'
			)
		);
		$wp_customize->get_setting( 'text_field' )->transport = 'postMessage';



		// URL Field
		$wp_customize->add_setting(
			'url_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => 'esc_url_raw'
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'url_field',
			array(
				'description' 		=> esc_html__( '', 'tcci' ),
				'label' 			=> esc_html__( 'URL Field', 'tcci' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'url_field',
				'type' 				=> 'url'
			)
		);
		$wp_customize->get_setting( 'url_field' )->transport = 'postMessage';



		// Email Field
		$wp_customize->add_setting(
			'email_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_email',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'email_field',
			array(
				'description' 		=> esc_html__( '', 'tcci' ),
				'label' 			=> esc_html__( 'Email Field', 'tcci' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'email_field',
				'type' 				=> 'email'
			)
		);
		$wp_customize->get_setting( 'email_field' )->transport = 'postMessage';

		// Date Field
		$wp_customize->add_setting(
			'date_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'date_field',
			array(
				'description' 		=> esc_html__( '', 'tcci' ),
				'label' 			=> esc_html__( 'Date Field', 'tcci' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'date_field',
				'type' 				=> 'date'
			)
		);
		$wp_customize->get_setting( 'date_field' )->transport = 'postMessage';


		// Checkbox Field
		$wp_customize->add_setting(
			'checkbox_field',
			array(
				'default'  			=> 'true',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'checkbox_field',
			array(
				'description' 		=> esc_html__( '', 'tcci' ),
				'label' 			=> esc_html__( 'Checkbox Field', 'tcci' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'checkbox_field',
				'type' 				=> 'checkbox'
			)
		);
		$wp_customize->get_setting( 'checkbox_field' )->transport = 'postMessage';




		// Password Field
		$wp_customize->add_setting(
			'password_field',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'password_field',
			array(
				'description' 		=> esc_html__( '', 'tcci' ),
				'label' 			=> esc_html__( 'Password Field', 'tcci' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'password_field',
				'type' 				=> 'password'
			)
		);
		$wp_customize->get_setting( 'password_field' )->transport = 'postMessage';



		// Radio Field
		$wp_customize->add_setting(
			'radio_field',
			array(
				'default'  			=> 'choice1',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'radio_field',
			array(
				'choices' 			=> array(
					'choice1' 		=> esc_html__( 'Choice 1', 'tcci' ),
					'choice2' 		=> esc_html__( 'Choice 2', 'tcci' ),
					'choice3' 		=> esc_html__( 'Choice 3', 'tcci' )
				),
				'description' 		=> esc_html__( '', 'tcci' ),
				'label' 			=> esc_html__( 'Radio Field', 'tcci' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'radio_field',
				'type' 				=> 'radio'
			)
		);
		$wp_customize->get_setting( 'radio_field' )->transport = 'postMessage';



		// Select Field
		$wp_customize->add_setting(
			'select_field',
			array(
				'default'  			=> 'choice1',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'select_field',
			array(
				'choices' 			=> array(
					'choice1' 		=> esc_html__( 'Choice 1', 'tcci' ),
					'choice2' 		=> esc_html__( 'Choice 2', 'tcci' ),
					'choice3' 		=> esc_html__( 'Choice 3', 'tcci' )
				),
				'description' 		=> esc_html__( '', 'tcci' ),
				'label' 			=> esc_html__( 'Select Field', 'tcci' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'select_field',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'select_field' )->transport = 'postMessage';



		// Textarea Field
		$wp_customize->add_setting(
			'textarea_field',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'textarea_field',
			array(
				'description' 		=> esc_html__( '', 'tcci' ),
				'label' 			=> esc_html__( 'Textarea Field', 'tcci' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'textarea_field',
				'type'				=> 'textarea'
			)
		);
		$wp_customize->get_setting( 'textarea_field' )->transport = 'postMessage';



		// Range Field
		$wp_customize->add_setting(
			'range_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_hex_color'
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'range_field',
			array(
				'description' 		=> esc_html__( '', 'tcci' ),
				'input_attrs' 		=> array(
					'class' 		=> 'range-field',
					'max' 			=> 100,
					'min' 			=> 0,
					'step' 			=> 1,
					'style' 		=> 'color: #020202'
				),
				'label' 			=> esc_html__( 'Range Field', 'tcci' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'range_field',
				'type' 				=> 'range'
			)
		);
		$wp_customize->get_setting( 'range_field' )->transport = 'postMessage';



		// Page Select Field
		$wp_customize->add_setting(
			'select_page_field',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'select_page_field',
			array(
				'description' 		=> esc_html__( '', 'tcci' ),
				'label' 			=> esc_html__( 'Select Page', 'tcci' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'select_page_field',
				'type' 				=> 'dropdown-pages'
			)
		);
		$wp_customize->get_setting( 'dropdown-pages' )->transport = 'postMessage';



		// Color Chooser Field
		$wp_customize->add_setting(
			'color_field',
			array(
				'default'  			=> '#ffffff',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'color_field',
				array(
					'description' 	=> esc_html__( '', 'tcci' ),
					'label' 		=> esc_html__( 'Color Field', 'tcci' ),
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'color_field'
				),
			)
		);
		$wp_customize->get_setting( 'color_field' )->transport = 'postMessage';



		// File Upload Field
		$wp_customize->add_setting( 'file_upload' );
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'file_upload',
				array(
					'description' 	=> esc_html__( '', 'tcci' ),
					'label' 		=> esc_html__( 'File Upload', 'tcci' ),
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'file_upload'
				),
			)
		);



		// Image Upload Field
		$wp_customize->add_setting(
			'image_upload',
			array(
				'default' 			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'image_upload',
				array(
					'description' 	=> esc_html__( '', 'tcci' ),
					'label' 		=> esc_html__( 'Image Field', 'tcci' ),
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'image_upload'
				)
			)
		);
		$wp_customize->get_setting( 'image_upload' )->transport = 'postMessage';



		// Media Upload Field
		// Can be used for images
		// Returns the image ID, not a URL
		$wp_customize->add_setting(
			'media_upload',
			array(
				'default' 			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				'media_upload',
				array(
					'description' 	=> esc_html__( '', 'tcci' ),
					'label' 		=> esc_html__( 'Media Field', 'tcci' ),
					'mime_type' 	=> '',
					'priority' 		=> 10,
					'section'		=> 'new_section',
					'settings' 		=> 'media_upload'
				)
			)
		);
		$wp_customize->get_setting( 'media_upload' )->transport = 'postMessage';




		// Cropped Image Field
		$wp_customize->add_setting(
			'cropped_image',
			array(
				'default' 			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'cropped_image',
				array(
					'description' 	=> esc_html__( '', 'tcci' ),
					'flex_height' 	=> '',
					'flex_width' 	=> '',
					'height' 		=> '1080',
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'cropped_image',
					width' 			=> '1920'
				)
			)
		);
		$wp_customize->get_setting( 'cropped_image' )->transport = 'postMessage';


		// Country Select Field
		$wp_customize->add_setting(
			'country',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'country',
			array(
				'choices' 			=> tcb_landing_country_list(),
				'description' 		=> esc_html__( '', 'tcci' ),
				'label' 			=> esc_html__( 'Country', 'tcci' ),
				'priority' 			=> 250,
				'section' 			=> 'contact_info',
				'settings' 			=> 'country',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'country' )->transport = 'postMessage';


		// US States Select Field
		$wp_customize->add_setting(
			'us_state',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'us_state',
			array(
				'choices' => array(
					'AL' => esc_html__( 'Alabama', 'tcci' ),
					'AK' => esc_html__( 'Alaska', 'tcci' ),
					'AZ' => esc_html__( 'Arizona', 'tcci' ),
					'AR' => esc_html__( 'Arkansas', 'tcci' ),
					'CA' => esc_html__( 'California', 'tcci' ),
					'CO' => esc_html__( 'Colorado', 'tcci' ),
					'CT' => esc_html__( 'Connecticut', 'tcci' ),
					'DE' => esc_html__( 'Delaware', 'tcci' ),
					'DC' => esc_html__( 'District of Columbia', 'tcci' ),
					'FL' => esc_html__( 'Florida', 'tcci' ),
					'GA' => esc_html__( 'Georgia', 'tcci' ),
					'HI' => esc_html__( 'Hawaii', 'tcci' ),
					'ID' => esc_html__( 'Idaho', 'tcci' ),
					'IL' => esc_html__( 'Illinois', 'tcci' ),
					'IN' => esc_html__( 'Indiana', 'tcci' ),
					'IA' => esc_html__( 'Iowa', 'tcci' ),
					'KS' => esc_html__( 'Kansas', 'tcci' ),
					'KY' => esc_html__( 'Kentucky', 'tcci' ),
					'LA' => esc_html__( 'Louisiana', 'tcci' ),
					'ME' => esc_html__( 'Maine', 'tcci' ),
					'MD' => esc_html__( 'Maryland', 'tcci' ),
					'MA' => esc_html__( 'Massachusetts', 'tcci' ),
					'MI' => esc_html__( 'Michigan', 'tcci' ),
					'MN' => esc_html__( 'Minnesota', 'tcci' ),
					'MS' => esc_html__( 'Mississippi', 'tcci' ),
					'MO' => esc_html__( 'Missouri', 'tcci' ),
					'MT' => esc_html__( 'Montana', 'tcci' ),
					'NE' => esc_html__( 'Nebraska', 'tcci' ),
					'NV' => esc_html__( 'Nevada', 'tcci' ),
					'NH' => esc_html__( 'New Hampshire', 'tcci' ),
					'NJ' => esc_html__( 'New Jersey', 'tcci' ),
					'NM' => esc_html__( 'New Mexico', 'tcci' ),
					'NY' => esc_html__( 'New York', 'tcci' ),
					'NC' => esc_html__( 'North Carolina', 'tcci' ),
					'ND' => esc_html__( 'North Dakota', 'tcci' ),
					'OH' => esc_html__( 'Ohio', 'tcci' ),
					'OK' => esc_html__( 'Oklahoma', 'tcci' ),
					'OR' => esc_html__( 'Oregon', 'tcci' ),
					'PA' => esc_html__( 'Pennsylvania', 'tcci' ),
					'RI' => esc_html__( 'Rhode Island', 'tcci' ),
					'SC' => esc_html__( 'South Carolina', 'tcci' ),
					'SD' => esc_html__( 'South Dakota', 'tcci' ),
					'TN' => esc_html__( 'Tennessee', 'tcci' ),
					'TX' => esc_html__( 'Texas', 'tcci' ),
					'UT' => esc_html__( 'Utah', 'tcci' ),
					'VT' => esc_html__( 'Vermont', 'tcci' ),
					'VA' => esc_html__( 'Virginia', 'tcci' ),
					'WA' => esc_html__( 'Washington', 'tcci' ),
					'WV' => esc_html__( 'West Virginia', 'tcci' ),
					'WI' => esc_html__( 'Wisconsin', 'tcci' ),
					'WY' => esc_html__( 'Wyoming', 'tcci' ),
					'AS' => esc_html__( 'American Samoa', 'tcci' ),
					'AA' => esc_html__( 'Armed Forces America (except Canada)', 'tcci' ),
					'AE' => esc_html__( 'Armed Forces Africa/Canada/Europe/Middle East', 'tcci' ),
					'AP' => esc_html__( 'Armed Forces Pacific', 'tcci' ),
					'FM' => esc_html__( 'Federated States of Micronesia', 'tcci' ),
					'GU' => esc_html__( 'Guam', 'tcci' ),
					'MH' => esc_html__( 'Marshall Islands', 'tcci' ),
					'MP' => esc_html__( 'Northern Mariana Islands', 'tcci' ),
					'PR' => esc_html__( 'Puerto Rico', 'tcci' ),
					'PW' => esc_html__( 'Palau', 'tcci' ),
					'VI' => esc_html__( 'Virgin Islands', 'tcci' )
				),
				'description' 		=> esc_html__( '', 'tcci' ),
				'label' 			=> esc_html__( 'State', 'tcci' ),
				'priority' 			=> 230,
				'section' 			=> 'contact_info',
				'settings' 			=> 'us_state',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'us_state' )->transport = 'postMessage';


		// Canadian States Select Field
		$wp_customize->add_setting(
			'canada_state',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'canada_state',
			array(
				'choices' => array(
					'AB' => esc_html__( 'Alberta', 'tcci' ),
					'BC' => esc_html__( 'British Columbia', 'tcci' ),
					'MB' => esc_html__( 'Manitoba', 'tcci' ),
					'NB' => esc_html__( 'New Brunswick', 'tcci' ),
					'NL' => esc_html__( 'Newfoundland and Labrador', 'tcci' ),
					'NT' => esc_html__( 'Northwest Territories', 'tcci' ),
					'NS' => esc_html__( 'Nova Scotia', 'tcci' ),
					'NU' => esc_html__( 'Nunavut', 'tcci' ),
					'ON' => esc_html__( 'Ontario', 'tcci' ),
					'PE' => esc_html__( 'Prince Edward Island', 'tcci' ),
					'QC' => esc_html__( 'Quebec', 'tcci' ),
					'SK' => esc_html__( 'Saskatchewan', 'tcci' ),
					'YT' => esc_html__( 'Yukon', 'tcci' )
				),
				'description' 		=> esc_html__( '', 'tcci' ),
				'label' 			=> esc_html__( 'State', 'tcci' ),
				'priority' 			=> 230,
				'section' 			=> 'contact_info',
				'settings' 			=> 'canada_state',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'canada_state' )->transport = 'postMessage';


		// Australian States Select Field
		$wp_customize->add_setting(
			'australia_state',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'australia_state',
			array(
				'choices' => array(
					'ACT' 	=> esc_html__( 'Australian Capital Territory', 'tcci' ),
					'NSW' 	=> esc_html__( 'New South Wales', 'tcci' ),
					'NT' 	=> esc_html__( 'Northern Territory', 'tcci' ),
					'QLD' 	=> esc_html__( 'Queensland', 'tcci' ),
					'SA' 	=> esc_html__( 'South Australia', 'tcci' ),
					'TAS' 	=> esc_html__( 'Tasmania', 'tcci' ),
					'VIC' 	=> esc_html__( 'Victoria', 'tcci' ),
					'WA' 	=> esc_html__( 'Western Australia', 'tcci' )
				),
				'description' 		=> esc_html__( '', 'tcci' ),
				'label' 			=> esc_html__( 'State', 'tcci' ),
				'priority' 			=> 230,
				'section' 			=> 'contact_info',
				'settings' 			=> 'australia_state',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'australia_state' )->transport = 'postMessage';


		*/

	} // register_fields()

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @access 		public
	 * @since 		1.0.0
	 *
	 * @param 		string 		$selector 		CSS selector
	 * @param 		string 		$style 			The name of the CSS *property* to modify
	 * @param 		string 		$mod_name 		The name of the 'theme_mod' option to fetch
	 * @param 		string 		$prefix 		Optional. Anything that needs to be output before the CSS property
	 * @param 		string 		$postfix 		Optional. Anything that needs to be output after the CSS property
	 * @param 		bool 		$echo 			Optional. Whether to print directly to the page (default: true).
	 *
	 * @return 		string 						Returns a single line of CSS with selectors and a property.
	 */
	public function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {

		$return = '';
		$mod 	= get_theme_mod( $mod_name );

		if ( ! empty( $mod ) ) {

			$return = sprintf('%s { %s:%s; }',
				$selector,
				$style,
				$prefix . $mod . $postfix
			);

			if ( $echo ) {

				echo $return;

			}

		}

		return $return;

	} // generate_css()

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 *
	 * Used by hook: 'wp_head'
	 *
	 * @access 		public
	 * @see 		add_action( 'wp_head', $func )
	 * @since 		1.0.0
	 */
	public function header_output() {

		?><!-- Customizer CSS -->
		<style type="text/css"><?php

			// pattern:
			// tcb_landing_generate_css( 'selector', 'style', 'mod_name', 'prefix', 'postfix', true );
			//
			// background-image example:
			// tcb_landing_generate_css( '.class', 'background-image', 'background_image_example', 'url(', ')' );


		?></style><!-- Customizer CSS --><?php

		/**
		 * Hides all but the first Soliloquy slide while using Customizer previewer.
		 */
		if ( is_customize_preview() ) {

			?><style type="text/css">

				li.soliloquy-item:not(:first-child) {
					display: none !important;
				}

			</style><!-- Customizer CSS --><?php

		}

	} // header_output()

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * Used by hook: 'customize_preview_init'
	 *
	 * @access 		public
	 * @see 		add_action( 'customize_preview_init', $func )
	 * @since 		1.0.0
	 */
	public function live_preview() {

		wp_enqueue_script( 'tcci_customizer', get_template_directory_uri() . '/js/customizer.min.js', array( 'jquery', 'customize-preview' ), '', true );

	} // live_preview()

	/**
	 * Used by customizer controls, mostly for active callbacks.
	 *
	 * @hook		customize_controls_enqueue_scripts
	 *
	 * @access 		public
	 * @see 		add_action( 'customize_preview_init', $func )
	 * @since 		1.0.0
	 */
	public function control_scripts() {

		wp_enqueue_script( 'tcci_customizer_controls', get_template_directory_uri() . '/js/customizer-controls.min.js', array( 'jquery', 'customize-controls' ), false, true );

	} // control_scripts()

	/**
	 * Returns TRUE based on which link type is selected, otherwise FALSE
	 *
	 * @param 	object 		$control 			The control object
	 * @return 	bool 							TRUE if conditions are met, otherwise FALSE
	 */
	public function states_of_country_callback( $control ) {

		$country_setting = $control->manager->get_setting('country')->value();

		//wp_die( print_r( $radio_setting ) );
		//wp_die( print_r( $control->id ) );

		if ( 'us_state' === $control->id && 'US' === $country_setting ) { return true; }
		if ( 'canada_state' === $control->id && 'CA' === $country_setting ) { return true; }
		if ( 'australia_state' === $control->id && 'AU' === $country_setting ) { return true; }
		if ( 'default_state' === $control->id && ! tcb_landing_custom_countries( $country_setting ) ) { return true; }

		return false;

	} // states_of_country_callback()

	/**
	 * Returns true if a country has a custom select menu
	 *
	 * @param 		string 		$country 			The country code to check
	 *
	 * @return 		bool 							TRUE if the code is in the array, FALSE otherwise
	 */
	public function custom_countries( $country ) {

		$countries = array( 'US', 'CA', 'AU' );

		return in_array( $country, $countries );

	} // custom_countries()

	/**
	 * Returns an array of countries or a country name.
	 *
	 * @param 		string 		$country 		Country code to return (optional)
	 *
	 * @return 		array|string 				Array of countries or a single country name
	 */
	public function country_list( $country = '' ) {

		$countries = array();

		$countries['AF'] = esc_html__( 'Afghanistan (‫افغانستان‬‎)', 'tcci' );
		$countries['AX'] = esc_html__( 'Åland Islands (Åland)', 'tcci' );
		$countries['AL'] = esc_html__( 'Albania (Shqipëri)', 'tcci' );
		$countries['DZ'] = esc_html__( 'Algeria (‫الجزائر‬‎)', 'tcci' );
		$countries['AS'] = esc_html__( 'American Samoa', 'tcci' );
		$countries['AD'] = esc_html__( 'Andorra', 'tcci' );
		$countries['AO'] = esc_html__( 'Angola', 'tcci' );
		$countries['AI'] = esc_html__( 'Anguilla', 'tcci' );
		$countries['AQ'] = esc_html__( 'Antarctica', 'tcci' );
		$countries['AG'] = esc_html__( 'Antigua and Barbuda', 'tcci' );
		$countries['AR'] = esc_html__( 'Argentina', 'tcci' );
		$countries['AM'] = esc_html__( 'Armenia (Հայաստան)', 'tcci' );
		$countries['AW'] = esc_html__( 'Aruba', 'tcci' );
		$countries['AC'] = esc_html__( 'Ascension Island', 'tcci' );
		$countries['AU'] = esc_html__( 'Australia', 'tcci' );
		$countries['AT'] = esc_html__( 'Austria (Österreich)', 'tcci' );
		$countries['AZ'] = esc_html__( 'Azerbaijan (Azərbaycan)', 'tcci' );
		$countries['BS'] = esc_html__( 'Bahamas', 'tcci' );
		$countries['BH'] = esc_html__( 'Bahrain (‫البحرين‬‎)', 'tcci' );
		$countries['BD'] = esc_html__( 'Bangladesh (বাংলাদেশ)', 'tcci' );
		$countries['BB'] = esc_html__( 'Barbados', 'tcci' );
		$countries['BY'] = esc_html__( 'Belarus (Беларусь)', 'tcci' );
		$countries['BE'] = esc_html__( 'Belgium (België)', 'tcci' );
		$countries['BZ'] = esc_html__( 'Belize', 'tcci' );
		$countries['BJ'] = esc_html__( 'Benin (Bénin)', 'tcci' );
		$countries['BM'] = esc_html__( 'Bermuda', 'tcci' );
		$countries['BT'] = esc_html__( 'Bhutan (འབྲུག)', 'tcci' );
		$countries['BO'] = esc_html__( 'Bolivia', 'tcci' );
		$countries['BA'] = esc_html__( 'Bosnia and Herzegovina (Босна и Херцеговина)', 'tcci' );
		$countries['BW'] = esc_html__( 'Botswana', 'tcci' );
		$countries['BV'] = esc_html__( 'Bouvet Island', 'tcci' );
		$countries['BR'] = esc_html__( 'Brazil (Brasil)', 'tcci' );
		$countries['IO'] = esc_html__( 'British Indian Ocean Territory', 'tcci' );
		$countries['VG'] = esc_html__( 'British Virgin Islands', 'tcci' );
		$countries['BN'] = esc_html__( 'Brunei', 'tcci' );
		$countries['BG'] = esc_html__( 'Bulgaria (България)', 'tcci' );
		$countries['BF'] = esc_html__( 'Burkina Faso', 'tcci' );
		$countries['BI'] = esc_html__( 'Burundi (Uburundi)', 'tcci' );
		$countries['KH'] = esc_html__( 'Cambodia (កម្ពុជា)', 'tcci' );
		$countries['CM'] = esc_html__( 'Cameroon (Cameroun)', 'tcci' );
		$countries['CA'] = esc_html__( 'Canada', 'tcci' );
		$countries['IC'] = esc_html__( 'Canary Islands (islas Canarias)', 'tcci' );
		$countries['CV'] = esc_html__( 'Cape Verde (Kabu Verdi)', 'tcci' );
		$countries['BQ'] = esc_html__( 'Caribbean Netherlands', 'tcci' );
		$countries['KY'] = esc_html__( 'Cayman Islands', 'tcci' );
		$countries['CF'] = esc_html__( 'Central African Republic (République centrafricaine)', 'tcci' );
		$countries['EA'] = esc_html__( 'Ceuta and Melilla (Ceuta y Melilla)', 'tcci' );
		$countries['TD'] = esc_html__( 'Chad (Tchad)', 'tcci' );
		$countries['CL'] = esc_html__( 'Chile', 'tcci' );
		$countries['CN'] = esc_html__( 'China (中国)', 'tcci' );
		$countries['CX'] = esc_html__( 'Christmas Island', 'tcci' );
		$countries['CP'] = esc_html__( 'Clipperton Island', 'tcci' );
		$countries['CC'] = esc_html__( 'Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))', 'tcci' );
		$countries['CO'] = esc_html__( 'Colombia', 'tcci' );
		$countries['KM'] = esc_html__( 'Comoros (‫جزر القمر‬‎)', 'tcci' );
		$countries['CD'] = esc_html__( 'Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)', 'tcci' );
		$countries['CG'] = esc_html__( 'Congo (Republic) (Congo-Brazzaville)', 'tcci' );
		$countries['CK'] = esc_html__( 'Cook Islands', 'tcci' );
		$countries['CR'] = esc_html__( 'Costa Rica', 'tcci' );
		$countries['CI'] = esc_html__( 'Côte d’Ivoire', 'tcci' );
		$countries['HR'] = esc_html__( 'Croatia (Hrvatska)', 'tcci' );
		$countries['CU'] = esc_html__( 'Cuba', 'tcci' );
		$countries['CW'] = esc_html__( 'Curaçao', 'tcci' );
		$countries['CY'] = esc_html__( 'Cyprus (Κύπρος)', 'tcci' );
		$countries['CZ'] = esc_html__( 'Czech Republic (Česká republika)', 'tcci' );
		$countries['DK'] = esc_html__( 'Denmark (Danmark)', 'tcci' );
		$countries['DG'] = esc_html__( 'Diego Garcia', 'tcci' );
		$countries['DJ'] = esc_html__( 'Djibouti', 'tcci' );
		$countries['DM'] = esc_html__( 'Dominica', 'tcci' );
		$countries['DO'] = esc_html__( 'Dominican Republic (República Dominicana)', 'tcci' );
		$countries['EC'] = esc_html__( 'Ecuador', 'tcci' );
		$countries['EG'] = esc_html__( 'Egypt (‫مصر‬‎)', 'tcci' );
		$countries['SV'] = esc_html__( 'El Salvador', 'tcci' );
		$countries['GQ'] = esc_html__( 'Equatorial Guinea (Guinea Ecuatorial)', 'tcci' );
		$countries['ER'] = esc_html__( 'Eritrea', 'tcci' );
		$countries['EE'] = esc_html__( 'Estonia (Eesti)', 'tcci' );
		$countries['ET'] = esc_html__( 'Ethiopia', 'tcci' );
		$countries['FK'] = esc_html__( 'Falkland Islands (Islas Malvinas)', 'tcci' );
		$countries['FO'] = esc_html__( 'Faroe Islands (Føroyar)', 'tcci' );
		$countries['FJ'] = esc_html__( 'Fiji', 'tcci' );
		$countries['FI'] = esc_html__( 'Finland (Suomi)', 'tcci' );
		$countries['FR'] = esc_html__( 'France', 'tcci' );
		$countries['GF'] = esc_html__( 'French Guiana (Guyane française)', 'tcci' );
		$countries['PF'] = esc_html__( 'French Polynesia (Polynésie française)', 'tcci' );
		$countries['TF'] = esc_html__( 'French Southern Territories (Terres australes françaises)', 'tcci' );
		$countries['GA'] = esc_html__( 'Gabon', 'tcci' );
		$countries['GM'] = esc_html__( 'Gambia', 'tcci' );
		$countries['GE'] = esc_html__( 'Georgia (საქართველო)', 'tcci' );
		$countries['DE'] = esc_html__( 'Germany (Deutschland)', 'tcci' );
		$countries['GH'] = esc_html__( 'Ghana (Gaana)', 'tcci' );
		$countries['GI'] = esc_html__( 'Gibraltar', 'tcci' );
		$countries['GR'] = esc_html__( 'Greece (Ελλάδα)', 'tcci' );
		$countries['GL'] = esc_html__( 'Greenland (Kalaallit Nunaat)', 'tcci' );
		$countries['GD'] = esc_html__( 'Grenada', 'tcci' );
		$countries['GP'] = esc_html__( 'Guadeloupe', 'tcci' );
		$countries['GU'] = esc_html__( 'Guam', 'tcci' );
		$countries['GT'] = esc_html__( 'Guatemala', 'tcci' );
		$countries['GG'] = esc_html__( 'Guernsey', 'tcci' );
		$countries['GN'] = esc_html__( 'Guinea (Guinée)', 'tcci' );
		$countries['GW'] = esc_html__( 'Guinea-Bissau (Guiné Bissau)', 'tcci' );
		$countries['GY'] = esc_html__( 'Guyana', 'tcci' );
		$countries['HT'] = esc_html__( 'Haiti', 'tcci' );
		$countries['HM'] = esc_html__( 'Heard & McDonald Islands', 'tcci' );
		$countries['HN'] = esc_html__( 'Honduras', 'tcci' );
		$countries['HK'] = esc_html__( 'Hong Kong (香港)', 'tcci' );
		$countries['HU'] = esc_html__( 'Hungary (Magyarország)', 'tcci' );
		$countries['IS'] = esc_html__( 'Iceland (Ísland)', 'tcci' );
		$countries['IN'] = esc_html__( 'India (भारत)', 'tcci' );
		$countries['ID'] = esc_html__( 'Indonesia', 'tcci' );
		$countries['IR'] = esc_html__( 'Iran (‫ایران‬‎)', 'tcci' );
		$countries['IQ'] = esc_html__( 'Iraq (‫العراق‬‎)', 'tcci' );
		$countries['IE'] = esc_html__( 'Ireland', 'tcci' );
		$countries['IM'] = esc_html__( 'Isle of Man', 'tcci' );
		$countries['IL'] = esc_html__( 'Israel (‫ישראל‬‎)', 'tcci' );
		$countries['IT'] = esc_html__( 'Italy (Italia)', 'tcci' );
		$countries['JM'] = esc_html__( 'Jamaica', 'tcci' );
		$countries['JP'] = esc_html__( 'Japan (日本)', 'tcci' );
		$countries['JE'] = esc_html__( 'Jersey', 'tcci' );
		$countries['JO'] = esc_html__( 'Jordan (‫الأردن‬‎)', 'tcci' );
		$countries['KZ'] = esc_html__( 'Kazakhstan (Казахстан)', 'tcci' );
		$countries['KE'] = esc_html__( 'Kenya', 'tcci' );
		$countries['KI'] = esc_html__( 'Kiribati', 'tcci' );
		$countries['XK'] = esc_html__( 'Kosovo (Kosovë)', 'tcci' );
		$countries['KW'] = esc_html__( 'Kuwait (‫الكويت‬‎)', 'tcci' );
		$countries['KG'] = esc_html__( 'Kyrgyzstan (Кыргызстан)', 'tcci' );
		$countries['LA'] = esc_html__( 'Laos (ລາວ)', 'tcci' );
		$countries['LV'] = esc_html__( 'Latvia (Latvija)', 'tcci' );
		$countries['LB'] = esc_html__( 'Lebanon (‫لبنان‬‎)', 'tcci' );
		$countries['LS'] = esc_html__( 'Lesotho', 'tcci' );
		$countries['LR'] = esc_html__( 'Liberia', 'tcci' );
		$countries['LY'] = esc_html__( 'Libya (‫ليبيا‬‎)', 'tcci' );
		$countries['LI'] = esc_html__( 'Liechtenstein', 'tcci' );
		$countries['LT'] = esc_html__( 'Lithuania (Lietuva)', 'tcci' );
		$countries['LU'] = esc_html__( 'Luxembourg', 'tcci' );
		$countries['MO'] = esc_html__( 'Macau (澳門)', 'tcci' );
		$countries['MK'] = esc_html__( 'Macedonia (FYROM) (Македонија)', 'tcci' );
		$countries['MG'] = esc_html__( 'Madagascar (Madagasikara)', 'tcci' );
		$countries['MW'] = esc_html__( 'Malawi', 'tcci' );
		$countries['MY'] = esc_html__( 'Malaysia', 'tcci' );
		$countries['MV'] = esc_html__( 'Maldives', 'tcci' );
		$countries['ML'] = esc_html__( 'Mali', 'tcci' );
		$countries['MT'] = esc_html__( 'Malta', 'tcci' );
		$countries['MH'] = esc_html__( 'Marshall Islands', 'tcci' );
		$countries['MQ'] = esc_html__( 'Martinique', 'tcci' );
		$countries['MR'] = esc_html__( 'Mauritania (‫موريتانيا‬‎)', 'tcci' );
		$countries['MU'] = esc_html__( 'Mauritius (Moris)', 'tcci' );
		$countries['YT'] = esc_html__( 'Mayotte', 'tcci' );
		$countries['MX'] = esc_html__( 'Mexico (México)', 'tcci' );
		$countries['FM'] = esc_html__( 'Micronesia', 'tcci' );
		$countries['MD'] = esc_html__( 'Moldova (Republica Moldova)', 'tcci' );
		$countries['MC'] = esc_html__( 'Monaco', 'tcci' );
		$countries['MN'] = esc_html__( 'Mongolia (Монгол)', 'tcci' );
		$countries['ME'] = esc_html__( 'Montenegro (Crna Gora)', 'tcci' );
		$countries['MS'] = esc_html__( 'Montserrat', 'tcci' );
		$countries['MA'] = esc_html__( 'Morocco (‫المغرب‬‎)', 'tcci' );
		$countries['MZ'] = esc_html__( 'Mozambique (Moçambique)', 'tcci' );
		$countries['MM'] = esc_html__( 'Myanmar (Burma) (မြန်မာ)', 'tcci' );
		$countries['NA'] = esc_html__( 'Namibia (Namibië)', 'tcci' );
		$countries['NR'] = esc_html__( 'Nauru', 'tcci' );
		$countries['NP'] = esc_html__( 'Nepal (नेपाल)', 'tcci' );
		$countries['NL'] = esc_html__( 'Netherlands (Nederland)', 'tcci' );
		$countries['NC'] = esc_html__( 'New Caledonia (Nouvelle-Calédonie)', 'tcci' );
		$countries['NZ'] = esc_html__( 'New Zealand', 'tcci' );
		$countries['NI'] = esc_html__( 'Nicaragua', 'tcci' );
		$countries['NE'] = esc_html__( 'Niger (Nijar)', 'tcci' );
		$countries['NG'] = esc_html__( 'Nigeria', 'tcci' );
		$countries['NU'] = esc_html__( 'Niue', 'tcci' );
		$countries['NF'] = esc_html__( 'Norfolk Island', 'tcci' );
		$countries['MP'] = esc_html__( 'Northern Mariana Islands', 'tcci' );
		$countries['KP'] = esc_html__( 'North Korea (조선 민주주의 인민 공화국)', 'tcci' );
		$countries['NO'] = esc_html__( 'Norway (Norge)', 'tcci' );
		$countries['OM'] = esc_html__( 'Oman (‫عُمان‬‎)', 'tcci' );
		$countries['PK'] = esc_html__( 'Pakistan (‫پاکستان‬‎)', 'tcci' );
		$countries['PW'] = esc_html__( 'Palau', 'tcci' );
		$countries['PS'] = esc_html__( 'Palestine (‫فلسطين‬‎)', 'tcci' );
		$countries['PA'] = esc_html__( 'Panama (Panamá)', 'tcci' );
		$countries['PG'] = esc_html__( 'Papua New Guinea', 'tcci' );
		$countries['PY'] = esc_html__( 'Paraguay', 'tcci' );
		$countries['PE'] = esc_html__( 'Peru (Perú)', 'tcci' );
		$countries['PH'] = esc_html__( 'Philippines', 'tcci' );
		$countries['PN'] = esc_html__( 'Pitcairn Islands', 'tcci' );
		$countries['PL'] = esc_html__( 'Poland (Polska)', 'tcci' );
		$countries['PT'] = esc_html__( 'Portugal', 'tcci' );
		$countries['PR'] = esc_html__( 'Puerto Rico', 'tcci' );
		$countries['QA'] = esc_html__( 'Qatar (‫قطر‬‎)', 'tcci' );
		$countries['RE'] = esc_html__( 'Réunion (La Réunion)', 'tcci' );
		$countries['RO'] = esc_html__( 'Romania (România)', 'tcci' );
		$countries['RU'] = esc_html__( 'Russia (Россия)', 'tcci' );
		$countries['RW'] = esc_html__( 'Rwanda', 'tcci' );
		$countries['BL'] = esc_html__( 'Saint Barthélemy (Saint-Barthélemy)', 'tcci' );
		$countries['SH'] = esc_html__( 'Saint Helena', 'tcci' );
		$countries['KN'] = esc_html__( 'Saint Kitts and Nevis', 'tcci' );
		$countries['LC'] = esc_html__( 'Saint Lucia', 'tcci' );
		$countries['MF'] = esc_html__( 'Saint Martin (Saint-Martin (partie française))', 'tcci' );
		$countries['PM'] = esc_html__( 'Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)', 'tcci' );
		$countries['WS'] = esc_html__( 'Samoa', 'tcci' );
		$countries['SM'] = esc_html__( 'San Marino', 'tcci' );
		$countries['ST'] = esc_html__( 'São Tomé and Príncipe (São Tomé e Príncipe)', 'tcci' );
		$countries['SA'] = esc_html__( 'Saudi Arabia (‫المملكة العربية السعودية‬‎)', 'tcci' );
		$countries['SN'] = esc_html__( 'Senegal (Sénégal)', 'tcci' );
		$countries['RS'] = esc_html__( 'Serbia (Србија)', 'tcci' );
		$countries['SC'] = esc_html__( 'Seychelles', 'tcci' );
		$countries['SL'] = esc_html__( 'Sierra Leone', 'tcci' );
		$countries['SG'] = esc_html__( 'Singapore', 'tcci' );
		$countries['SX'] = esc_html__( 'Sint Maarten', 'tcci' );
		$countries['SK'] = esc_html__( 'Slovakia (Slovensko)', 'tcci' );
		$countries['SI'] = esc_html__( 'Slovenia (Slovenija)', 'tcci' );
		$countries['SB'] = esc_html__( 'Solomon Islands', 'tcci' );
		$countries['SO'] = esc_html__( 'Somalia (Soomaaliya)', 'tcci' );
		$countries['ZA'] = esc_html__( 'South Africa', 'tcci' );
		$countries['GS'] = esc_html__( 'South Georgia & South Sandwich Islands', 'tcci' );
		$countries['KR'] = esc_html__( 'South Korea (대한민국)', 'tcci' );
		$countries['SS'] = esc_html__( 'South Sudan (‫جنوب السودان‬‎)', 'tcci' );
		$countries['ES'] = esc_html__( 'Spain (España)', 'tcci' );
		$countries['LK'] = esc_html__( 'Sri Lanka (ශ්‍රී ලංකාව)', 'tcci' );
		$countries['VC'] = esc_html__( 'St. Vincent & Grenadines', 'tcci' );
		$countries['SD'] = esc_html__( 'Sudan (‫السودان‬‎)', 'tcci' );
		$countries['SR'] = esc_html__( 'Suriname', 'tcci' );
		$countries['SJ'] = esc_html__( 'Svalbard and Jan Mayen (Svalbard og Jan Mayen)', 'tcci' );
		$countries['SZ'] = esc_html__( 'Swaziland', 'tcci' );
		$countries['SE'] = esc_html__( 'Sweden (Sverige)', 'tcci' );
		$countries['CH'] = esc_html__( 'Switzerland (Schweiz)', 'tcci' );
		$countries['SY'] = esc_html__( 'Syria (‫سوريا‬‎)', 'tcci' );
		$countries['TW'] = esc_html__( 'Taiwan (台灣)', 'tcci' );
		$countries['TJ'] = esc_html__( 'Tajikistan', 'tcci' );
		$countries['TZ'] = esc_html__( 'Tanzania', 'tcci' );
		$countries['TH'] = esc_html__( 'Thailand (ไทย)', 'tcci' );
		$countries['TL'] = esc_html__( 'Timor-Leste', 'tcci' );
		$countries['TG'] = esc_html__( 'Togo', 'tcci' );
		$countries['TK'] = esc_html__( 'Tokelau', 'tcci' );
		$countries['TO'] = esc_html__( 'Tonga', 'tcci' );
		$countries['TT'] = esc_html__( 'Trinidad and Tobago', 'tcci' );
		$countries['TA'] = esc_html__( 'Tristan da Cunha', 'tcci' );
		$countries['TN'] = esc_html__( 'Tunisia (‫تونس‬‎)', 'tcci' );
		$countries['TR'] = esc_html__( 'Turkey (Türkiye)', 'tcci' );
		$countries['TM'] = esc_html__( 'Turkmenistan', 'tcci' );
		$countries['TC'] = esc_html__( 'Turks and Caicos Islands', 'tcci' );
		$countries['TV'] = esc_html__( 'Tuvalu', 'tcci' );
		$countries['UM'] = esc_html__( 'U.S. Outlying Islands', 'tcci' );
		$countries['VI'] = esc_html__( 'U.S. Virgin Islands', 'tcci' );
		$countries['UG'] = esc_html__( 'Uganda', 'tcci' );
		$countries['UA'] = esc_html__( 'Ukraine (Україна)', 'tcci' );
		$countries['AE'] = esc_html__( 'United Arab Emirates (‫الإمارات العربية المتحدة‬‎)', 'tcci' );
		$countries['GB'] = esc_html__( 'United Kingdom', 'tcci' );
		$countries['US'] = esc_html__( 'United States', 'tcci' );
		$countries['UY'] = esc_html__( 'Uruguay', 'tcci' );
		$countries['UZ'] = esc_html__( 'Uzbekistan (Oʻzbekiston)', 'tcci' );
		$countries['VU'] = esc_html__( 'Vanuatu', 'tcci' );
		$countries['VA'] = esc_html__( 'Vatican City (Città del Vaticano)', 'tcci' );
		$countries['VE'] = esc_html__( 'Venezuela', 'tcci' );
		$countries['VN'] = esc_html__( 'Vietnam (Việt Nam)', 'tcci' );
		$countries['WF'] = esc_html__( 'Wallis and Futuna', 'tcci' );
		$countries['EH'] = esc_html__( 'Western Sahara (‫الصحراء الغربية‬‎)', 'tcci' );
		$countries['YE'] = esc_html__( 'Yemen (‫اليمن‬‎)', 'tcci' );
		$countries['ZM'] = esc_html__( 'Zambia', 'tcci' );
		$countries['ZW'] = esc_html__( 'Zimbabwe', 'tcci' );

		if ( ! empty( $country ) ) {

			return $countries[$country];

		}

		return $countries;

	} // country_list()

} // class
