<?php
/**
 * Full-Width Image template for Newsletters
 */

?><div class="image-gallery <?php echo esc_attr( $block['chooser'] ); ?>">
    <ul><?php

    foreach ( $block['image_gallery'] as $image ) :

        ?><li>
            <a href="<?php echo esc_url( $image['url'] ); ?>">
                 <img src="<?php echo esc_url( $image['sizes']['medium'] ); ?>" alt="<?php echo $image['alt']; ?>" />
            </a><?php

            if ( ! empty( $image['caption'] ) ) :

                ?><p class="caption"><?php echo esc_html( $image['caption'] ); ?></p><?php

            endif;

        ?></li><?php

    endforeach;

    ?></ul>
</div>
