<?php
/**
 * White on Orange Content template for Newsletters
 */

?><div class="content <?php echo esc_attr( $block['chooser'] ); ?>"><?php

    echo apply_filters( 'the_content', $block['white_on_orange_content'] );

?></div>
