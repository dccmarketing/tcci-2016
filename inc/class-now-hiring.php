<?php
/**
 * Now Hiring Customizations.
 *
 * @package  	TCCi
 */
class TCCI_Now_Hiring {

	/**
	 * Constructor
	 */
	public function __construct() {} // __construct()

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_action( 'now-hiring-before-single', array( $this, 'single_begin' ) );
		add_action( 'now-hiring-after-single', 	array( $this, 'single_end' ) );

	} // hooks()

	public function single_begin( $meta ) {

		?><div id="primary" class="content-area full-width">
			<main id="main" role="main"><?php

	} // single_begin()

	public function single_end( $meta ) {

			?></div>
		</main><?php

	} // single_end()

} // class
