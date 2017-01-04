<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package TCCi
 */

if ( ! function_exists( 'tcci_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
	function tcci_posted_on() {

		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date( 'n/j' ) )
		);

		$posted_on = sprintf(
			esc_html_x( '%s', 'post date', 'tcci' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $time_string . '</span>'; // WPCS: XSS OK.

	} // tcci_posted_on()
endif;



if ( ! function_exists( 'tcci_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
	function tcci_entry_footer() {

		// Hide category and tag text for pages.
		if ( 'post' == get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'tcci' ) );
			if ( $categories_list && tcci_categorized_blog() ) {

				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'tcci' ) . '</span>', $categories_list );  // WPCS: XSS OK.

			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'tcci' ) );
			if ( $tags_list ) {

				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'tcci' ) . '</span>', $tags_list );  // WPCS: XSS OK.

			}

		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

			echo '<span class="comments-link">';
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', '_s' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) ); // translators: %s: post title
			echo '</span>';

		}

		edit_post_link( esc_html__( 'Edit', 'tcci' ), '<span class="edit-link">', '</span>' );

	} // tcci_entry_footer()
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function tcci_categorized_blog() {

	if ( false === ( $all_the_cool_cats = get_transient( 'tcci_categories' ) ) ) {

		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'tcci_categories', $all_the_cool_cats );

	}

	if ( $all_the_cool_cats > 1 ) {

		// This blog has more than 1 category so tcci_categorized_blog should return true.
		return true;

	} else {

		// This blog has only 1 category so tcci_categorized_blog should return false.
		return false;

	}

} // tcci_categorized_blog()

/**
 * Prints whatever in a nice, readable format
 */
function showme( $input ) {

	echo '<pre>'; print_r( $input ); echo '</pre>';

} // showme()
