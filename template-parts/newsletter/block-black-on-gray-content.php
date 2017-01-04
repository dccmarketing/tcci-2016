<?php
/**
 * Black on Gray Content template for Newsletters
 */

?><div class="content <?php echo esc_attr( $block['chooser'] ); ?>"><?php

    echo apply_filters( 'the_content', $block['black_on_gray_content'] );

?></div>
