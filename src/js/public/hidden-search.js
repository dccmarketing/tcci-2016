/**
 * hidden-search.js
 *
 * Handles toggling the appearnace of a hidden search field
 */
( function() {

	var search, button;

	search = document.querySelector( '.menu-item.search .search-form' );
	if ( ! search ) { return; }

	button = document.querySelector( '.menu-item.search .btn-search' );
	if ( ! button ) { return; }

	search.setAttribute( 'aria-hidden', 'true' );

	function toggleSearch( e ) {

		e.preventDefault();

		search.classList.toggle( 'open' );
		button.classList.toggle( 'open' );

		if ( search.classList.contains( 'open' ) ) {

			search.setAttribute( 'aria-hidden', 'false' );

		} else {

			search.setAttribute( 'aria-hidden', 'true' );

		}

	}

	button.addEventListener( 'click', toggleSearch );

} )();
