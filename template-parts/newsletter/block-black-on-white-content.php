<?php
/**
 * Black on White Content template for Newsletters
 */

?><div class="content <?php echo esc_attr( $block['chooser'] ); ?>"><?php

    echo apply_filters( 'the_content', $block['black_on_white_content'] );

?></div>
