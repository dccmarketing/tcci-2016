<?php

/**
 * Provides the markup for any checkbox field
 *
 * @package    TCCi
 */
$defaults['class'] 			= 'widefat';
$defaults['description'] 	= __( '', 'tcci' );
$defaults['id'] 			= '';
$defaults['name'] 			= '';
$defaults['value'] 			= '';
$atts 						= wp_parse_args( $atts, $defaults );

?><label for="<?php echo esc_attr( $atts['id'] ); ?>">
	<input aria-role="checkbox"
		<?php checked( 1, $atts['value'], true ); ?>
		class="<?php echo esc_attr( $atts['class'] ); ?>"
		id="<?php echo esc_attr( $atts['id'] ); ?>"
		name="<?php echo esc_attr( $atts['name'] ); ?>"
		type="checkbox"
		value="1" />
	<span class="description"><?php echo wp_kses( $atts['description'], array( 'code' => array() ) ); ?></span>
</label>
