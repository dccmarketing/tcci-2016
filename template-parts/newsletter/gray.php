<?php
/**
 * White on Gray Headline with content for Newsletters
 */

?><header class="entry-header content">
	<h2 class="headline white-on-gray-headline"><?php

		echo esc_html( $story->post_title );

	?></h2>
</header>
<div class="entry-content"><?php

		echo apply_filters( 'the_content', $story->post_content );

?></div><!-- .entry-content -->