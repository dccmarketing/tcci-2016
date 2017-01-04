/**
 * Shows/hides post format metaboxes based on the selected format.
 */
( function() {

	'use strict';

	var buttons, len, box, checked, valid;

	buttons = document.querySelectorAll( '.post-format' );
	if ( ! buttons ) { return; }

	len = buttons.length;
	if ( 0 >= len ) { return; }

	box = document.querySelector( '#post_format_data' );
	if ( ! box ) { return; }

	/**
	 * Hide the Post Format Metabox if the current
	 * post format is not selected.
	 */
	checked = document.querySelector( '.post-format[checked]' );
	valid = [ 'audio', 'image', 'link', 'video' ];

	if ( 0 > valid.indexOf( checked.value ) ) {

		box.classList.add( 'hide' );

	}

	/**
	 * Shows the correct post format metabox and hides the others.
	 */
	function showFormat() {

		var others = document.querySelectorAll( '.post-format-field:not( #post_format_' + this.value + ' )' );
		var field = document.querySelector( '#post_format_' + this.value );
		var otherslen = others.length;

		if ( 0 < otherslen ) {

			for ( var j = 0; j < otherslen; j++ ) {

				others[j].classList.add( 'hide' );

			}

		}

		if ( ! field ) {

			box.classList.add( 'hide' );
			return;

		}

		box.classList.remove( 'hide' );
		field.classList.remove( 'hide' );

	}

	for ( var i = 0; i < len; i++ ) {

		var button = buttons[i];
		var field = document.querySelector( '#post_format_' + button.value );

		button.addEventListener( 'click', showFormat );

	}

})();
