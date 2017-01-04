<?php

/**
 * A class of helpful menu-related functions
 *
 * @package TCCi
 * @author Slushman <chris@slushman.com>
 */
class TCCI_Menukit {

	/**
	 * Constructor
	 */
	public function __construct() {} // __construct()

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_filter( 'walker_nav_menu_start_el', array( $this, 'menu_show_hide' ), 10, 4 );
		add_filter( 'walker_nav_menu_start_el', array( $this, 'add_icons_to_menu' ), 10, 4 );
		add_filter( 'wp_nav_menu_items', 		array( $this, 'add_search_to_menu' ), 10, 2 );

	} // hooks()

	/**
	 * Add an icon the menu item
	 *
	 * @exits 		If $args is empty.
	 * @exits 		If 'slushicons' is not in the classes array.
	 * @hooked 		walker_nav_menu_start_el 		10
	 * @link 		http://www.billerickson.net/customizing-wordpress-menus/
	 * @param 		string 		$item_output		//
	 * @param 		object 		$item				//
	 * @param 		int 		$depth 				//
	 * @param 		array 		$args 				//
	 * @return 		string 							modified menu
	 */
	public function add_icons_to_menu( $item_output, $item, $depth, $args ) {

		if ( empty( $args ) ) { return $item_output; }
		if ( ! in_array( 'slushicons', $item->classes ) ) { return $item_output; }

		$atts 		= $this->get_attributes( $item );
		$icon 		= $this->get_icon_info( $item->classes );
		$textpos 	= $this->get_text_pos( $item->classes );

		if ( empty( $icon ) && empty( $textpos ) ) { return $item_output; }

		$output = '';
		$output .= '<a href="' . $item->url . '" class="icon-menu" ' . $atts . '>';

		if ( 'right' === $textpos ) {

			$output .= $this->get_icon( $icon );

		}

		if ( 'hide' === $textpos ) {

			$output .= '<span class="screen-reader-text">' . $item->title . '</span>';
			$output .= $this->get_icon( $icon );

		} else {

			$output .= '<span class="menu-label">' . $item->title . '</span>';

		}

		if ( 'left' === $textpos ) {

			$output .= $this->get_icon( $icon );

		}

		$output .= '</a>';

		return $output;

	} // add_icons_to_menu()

	/**
	 * Adds a search form to the menu.
	 *
	 * @exits 		If not on the correct menu.
	 * @hooked 		wp_nav_menu_items 			10
	 * @param 		array 		$items 			The current menu items.
	 * @param 		array 		$args 			The menu args.
	 * @return 		array 						The menu items plus a search form.
	 */
	public function add_search_to_menu( $items, $args ) {

		if ( 'social' !== $args->theme_location ) { return $items; }

		$search = '';
		$search .= '<li class="menu-item search">';
		$search .= '<span class="btn-search">';
		$search .= tcci_get_svg( 'search' );
		$search .= '</span>';
		$search .= get_search_form( false );
		$search .= '</li>';


		return $items . $search;

	} // add_search_to_menu()

	/**
	 * Returns a string of HTML attributes for the menu item
	 *
	 * @exits 		If $item is empty.
	 * @param 		object 		$item 			The menu item object
	 * @return 		string 						A string of attributes
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
	 * Returns the code for the icon.
	 *
	 * @exits 		If $icon is empty
	 * @exits 		if $icon is not an array.
	 * @param 		array 		$icon 			The icon info array.
	 * @return 		mixed 						The icon markup.
	 */
	private function get_icon( $icon ) {

		if ( empty( $icon ) || ! is_array( $icon ) ) { return; }

		$return = '';

		if ( 'dashicons' === $icon['type'] ) {

			$return = '<span class="dashicons dashicons-' . $icon['name'] . '"></span>';

		}

		if ( 'fontawesome' === $icon['type'] ) {

			$return = '<span class="fa fa-' . $icon['name'] . '"></span>';

		}

		if ( 'svg' === $icon['type'] ) {

			$check = tcci_get_svg( $icon['name'] );

			if ( ! is_null( $check ) ) {

				$return = $check;

			}

		}

		return $return;

	} // get_icon()

	/**
	 * Returns an array of info about the icon.
	 *
	 * @exits 		If $classes is empty.
	 * @param 		array 		$classes 			The menu item classes.
	 * @return 		array 							The type and name of the icon.
	 */
	private function get_icon_info( $classes ) {

		if ( empty( $classes ) ) { return; }

		$return = array();
		$checks = array( 'dic-', 'fas-', 'svg-' );

		foreach ( $classes as $class ) {

			if ( stripos( $class, $checks[0] ) !== FALSE ) {

				$return['type'] = 'dashicons';
				$return['name'] = str_replace( $checks[0], '', $class );
				break;

			}

			if ( stripos( $class, $checks[1] ) !== FALSE ) {

				$return['type'] = 'fontawesome';
				$return['name'] = str_replace( $checks[1], '', $class );
				break;

			}

			if ( stripos( $class, $checks[2] ) !== FALSE ) {

				$return['type'] = 'svg';
				$return['name'] = str_replace( $checks[2], '', $class );
				break;

			}

		} // foreach

		return $return;

	} // get_icon_info()

	/**
	 * Returns the text position from the menu item class.
	 *
	 * @exits 		If $classes is empty.
	 * @param 		array 		$classes 			The menu item classes.
	 * @return 		string 							The text position.
	 */
	private function get_text_pos( $classes ) {

		if ( empty( $classes ) ) { return; }

		if ( in_array( 'no-text', $classes ) ) { return 'hide'; }
		if ( in_array( 'text-left', $classes ) ) { return 'left'; }
		if ( in_array( 'text-right', $classes ) ) { return 'right'; }

		return;

	} // get_text_pos()

	/**
	 * Add Plus ("+") expander to menus with children
	 *
	 * @exits 		If $args is empty.
	 * @exits 		If $args is not an array.
	 * @exits 		If not on the correct menu.
	 * @exits 		If 'menu-item-has-children' is not in the $classes array.
	 * @hooked 		walker_nav_menu_start_el 		10
	 * @param 		string 		$item_output		//
	 * @param 		object 		$item				//
	 * @param 		int 		$depth 				//
	 * @param 		array 		$args 				//
	 * @return 		string 							modified menu
	 */
	public function menu_show_hide( $item_output, $item, $depth, $args ) {

		if ( empty( $args ) || is_array( $args ) ) { return $item_output; }
		if ( 'primary' !== $args->theme_location ) { return $item_output; }
		if ( ! in_array( 'menu-item-has-children', $item->classes ) ) { return $item_output; }

		$atts 	= $this->get_attributes( $item );
		$output = '';

		$output .= '<a href="' . $item->url . '">';
		$output .= $item->title;
		$output .= '<span class="children"></span>';
		$output .= '</a>';
		$output .= '<span class="show-hide flex-center"><span class="dashicons dashicons-arrow-down-alt"></span></span>';

		return $output;

	} // menu_show_hide()

} // class
