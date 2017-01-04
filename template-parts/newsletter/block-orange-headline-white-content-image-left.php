<?php
/**
 * Orange Content, White Content, Image Right template for Newsletters
 */

?><div class="content headline-content <?php echo esc_attr( $block['chooser'] ); ?>"><?php

    foreach ( $block['orange_headline_white_content_image_left'] as $item ) :

        ?><h3 class="orange-on-white-headline"><?php echo esc_html( $item['headline'] ); ?></h3>
        <img class="content-image" src="<?php echo esc_url( $item['image'] ); ?>"><?php

        echo apply_filters( 'the_content', $item['content'] );

    endforeach;

?></div>
