<?php

/**
 * A class of helpful menu-related functions
 *
 * @package TCCi
 * @author Slushman <chris@slushman.com>
 */
class TCCi_Menukit {

	/**
	 * Constructor
	 */
	public function __construct() {} // __construct()

	/**
	 * Adds an Dashicon icon before the menu item text
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function dashicon_before_menu_item( $item_output, $item, $depth, $args ) {

		if ( '' !== $args->theme_location ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$class 	= $item->classes[0];

		if ( empty( $class ) ) { return $item_output; }

		$output = '';

		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';
		$output .= '<span class="dashicons dashicons-' . $class . '"></span>';
		$output .= '<span class="menu-label">';
		$output .= $item->title;
		$output .= '</span>';
		$output .= '</a>';

		return $output;

	} // dashicon_before_menu_item()

	/**
	 * Adds a Dashicon after the menu item text
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function dashicon_after_menu_item( $item_output, $item, $depth, $args ) {

		if ( '' !== $args->theme_location || '' !== $args->theme_location ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$class 	= $item->classes[0];

		if ( empty( $class ) ) { return $item_output; }

		$output = '';

		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';
		$output .= '<span class="menu-label">';
		$output .= $item->title;
		$output .= '</span>';
		$output .= '<span class="dashicons dashicons-' . $class . '"></span>';
		$output .= '</a>';

		return $output;

	} // dashicon_after_menu_item()

	/**
	 * Replaces menu item text with an Dashicon
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function dashicon_only_menu_item( $item_output, $item, $depth, $args ) {

		if ( '' !== $args->theme_location ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$class 	= $item->classes[0];

		if ( empty( $class ) ) { return $item_output; }

		$output = '';

		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';
		$output .= '<span class="screen-reader-text">' . $item->title . '</span>';
		$output .= '<span class="dashicons dashicons-' . $class . '"></span>';
		$output .= '</a>';

		return $output;

	} // dashicon_only_menu_item()

	/**
	 * Adds an FontAwesome icon before the menu item text
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function fa_before_menu_item( $item_output, $item, $depth, $args ) {

		if ( '' !== $args->theme_location ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$class 	= $item->classes[0];

		if ( empty( $class ) ) { return $item_output; }

		$output = '';

		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';
		$output .= '<span class="fa fa-' . $class . '"></span>';
		$output .= '<span class="menu-label">';
		$output .= $item->title;
		$output .= '</span>';
		$output .= '</a>';

		return $output;

	} // fa_before_menu_item()

	/**
	 * Adds a FontAwesome icon after the menu item text
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function fa_after_menu_item( $item_output, $item, $depth, $args ) {

		if ( '' !== $args->theme_location || '' !== $args->theme_location ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$class 	= $item->classes[0];

		if ( empty( $class ) ) { return $item_output; }

		$output = '';

		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';
		$output .= '<span class="menu-label">';
		$output .= $item->title;
		$output .= '</span>';
		$output .= '<span class="fa fa-' . $class . '"></span>';
		$output .= '</a>';

		return $output;

	} // fa_after_menu_item()

	/**
	 * Replaces menu item text with a FontAwesome icon
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function fa_only_menu_item( $item_output, $item, $depth, $args ) {

		if ( '' !== $args->theme_location ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$class 	= $item->classes[0];

		if ( empty( $class ) ) { return $item_output; }

		$output = '';

		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';
		$output .= '<span class="screen-reader-text">' . $item->title . '</span>';
		$output .= '<span class="fa fa-' . $class . '"></span>';
		$output .= '</a>';

		return $output;

	} // fa_only_menu_item()

	/**
	 * Add Down Caret to Menus with Children
	 *
	 * @param 		string 		$item_output		//
	 * @param 		object 		$item				//
	 * @param 		int 		$depth 				//
	 * @param 		array 		$args 				//
	 *
	 * @return 		string 							modified menu
	 */
	public function menu_caret( $item_output, $item, $depth, $args ) {

		if ( ! in_array( 'menu-item-has-children', $item->classes ) ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$output = '';

		$output .= '<a href="' . $item->url . '">';
		$output .= $item->title;
		$output .= '<span class="children">' . tcci_get_svg( 'caret-down' ) . '</span>';
		$output .= '</a>';

		return $output;

	} // menu_caret()

	/**
	 * Add Plus ("+") expander to menus with children
	 *
	 * @param 		string 		$item_output		//
	 * @param 		object 		$item				//
	 * @param 		int 		$depth 				//
	 * @param 		array 		$args 				//
	 *
	 * @return 		string 							modified menu
	 */
	public function menu_show_hide( $item_output, $item, $depth, $args ) {

		showme( $args );

		if ( empty( $args ) || is_array( $args ) ) { return $item_output; }
		if ( 'primary' !== $args->theme_location ) { return $item_output; }
		if ( ! in_array( 'menu-item-has-children', $item->classes ) ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$output = '';

		$output .= '<a href="' . $item->url . '">';
		$output .= $item->title;
		$output .= '<span class="children"></span>';
		$output .= '</a>';
		$output .= '<span class="show-hide flex-center">+</span>';

		return $output;

	} // menu_show_hide()

	/**
	 * Adds an SVG icon before the menu item text
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function svg_before_menu_item( $item_output, $item, $depth, $args ) {

		if ( '' !== $args->theme_location ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$class 	= $this->get_svg_by_class( $item->classes );

		if ( empty( $class ) ) { return $item_output; }

		$output = '';

		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';
		$output .= $class;
		$output .= '<span class="menu-label">';
		$output .= $item->title;
		$output .= '</span>';
		$output .= '</a>';

		return $output;

	} // svg_before_menu_item()

	/**
	 * Adds an SVG icon after the menu item text
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function svg_after_menu_item( $item_output, $item, $depth, $args ) {

		if ( '' !== $args->theme_location ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$class 	= $this->get_svg_by_class( $item->classes );

		if ( empty( $class ) ) { return $item_output; }

		$output = '';

		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';
		$output .= '<span class="menu-label">';
		$output .= $item->title;
		$output .= '</span>';
		$output .= $class;
		$output .= '</a>';

		return $output;

	} // svg_after_menu_item()

	/**
	 * Replaces menu item text with an SVG icon
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function svg_only_menu_item( $item_output, $item, $depth, $args ) {

		if ( 'social' !== $args->theme_location ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$class 	= $this->get_svg_by_class( $item->classes );

		if ( empty( $class ) ) { return $item_output; }

		$output = '';

		$output .= '<a aria-label="' . $item->title . '" href="' . $item->url . '" class="icon-menu" ' . $atts . '>';
		$output .= '<span class="screen-reader-text">' . $item->title . '</span>';
		$output .= $class;
		$output .= '</a>';

		return $output;

	} // svg_only_menu_item()

	/**
	 * Returns a string of HTML attributes for the menu item
	 *
	 * @param 	object 		$item 			The menu item object
	 * @return 	string 						A string of attributes
	 */
	public function get_attributes( $item ) {

		if ( empty( $item ) ) { return; }

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$attributes = '';

		foreach ( $atts as $attr => $value ) {

			if ( ! empty( $value ) ) {

				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';

			}

		}

		return $attributes;

	} // get_attributes()

	/**
	 * Gets the appropriate SVG based on a menu item class
	 *
	 * @param 		array 		$classes 					Array of classes to check
	 * @param 		string 		$link 						Optional to add to the SVG
	 * @return 		mixed 									SVG icon
	 */
	public function get_svg_by_class( $classes ) {

		$output = '';

		foreach ( $classes as $class ) {

			$check = tcci_get_svg( $class );

			if ( ! is_null( $check ) ) { $output .= $check; break; }

		} // foreach

		return $output;

	} // get_svg_by_class()

	/**
	 * Replaces only the search menu item with an icon
	 *
	 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
	 *
	 * @param 	string 		$item_output		//
	 * @param 	object 		$item				//
	 * @param 	int 		$depth 				//
	 * @param 	array 		$args 				//
	 *
	 * @return 	string 							modified menu
	 */
	public function search_icon_only( $item_output, $item, $depth, $args ) {

		if ( '' !== $args->theme_location ) { return $item_output; }
		if ( 'Search' !== $item->post_title ) { return $item_output; }

		//showme( $item );

		$atts 	= $this->get_attributes( $item );
		$output = '';
		$output .= '<a class="btn-search dashicons dashicons-search" ' . $atts . '>';
		$output .= '<span class="screen-reader-text">' . $item->title . '</span>';
		$output .= '</a>';

		return $output;

	} // icons_only_menu_item()

} // class
