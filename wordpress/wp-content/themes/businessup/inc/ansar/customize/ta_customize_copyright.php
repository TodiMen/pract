<?php
// Footer copyright section 
function businessup_footer_copyright( $wp_customize ) {
	$wp_customize->add_panel('businessup_copyright', array(
		'priority' => 700,
		'capability' => 'edit_theme_options',
		'title' => __('Footer Settings', 'businessup'),
	) );

    $wp_customize->add_section('footer_widget_back', array(
        'title' => __('Background Setting','businessup'),
        'priority' => 30,
        'panel' => 'businessup_copyright',
    ) );
    
	
	//Footer Widget Background image
    $wp_customize->add_setting( 
        'businessup_footer_widget_background', array(
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'businessup_footer_widget_background', array(
        'label'    => __( 'Background Image', 'businessup' ),
        'section'  => 'footer_widget_back',
        'settings' => 'businessup_footer_widget_background',
    ) ) );
    
	//Footer Widget Overlay Color
	$wp_customize->add_setting(
				'businessup_overlay_footer_widget_control', array( 'sanitize_callback' => 'businessup_sanitize_colors',
			) );

			$wp_customize->add_control(new businessup_Customize_Alpha_Color_Control( $wp_customize,'businessup_overlay_footer_widget_control', array(
				'label' => __('Overlay Color', 'businessup' ),
				'palette' => true,
				'section' => 'footer_widget_back')
	) );
	
	
    

   $wp_customize->add_section('footer_widget_column', array(
        'title' => __('Widget Column Layout','businessup'),
        'priority' => 30,
		'panel' => 'businessup_copyright',
    ) );
	
	
	
	 $wp_customize->add_setting(
                'businessup_footer_column_layout', array(
                'default' => 3,
                'sanitize_callback' => 'businessup_sanitize_select',
            ) );

            $wp_customize->add_control(
                'businessup_footer_column_layout', array(
                'type' => 'select',
                'label' => __('Select Column Layout','businessup'),
                'section' => 'footer_widget_column',
                'choices' => array(1=>1, 2=>2,3=>3,4=>4),
            ) );
			
	if ( ! function_exists( 'businessup_sanitize_select' ) ) :

	/**
	 * Sanitize select.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed                $input The value to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return mixed Sanitized value.
	 */
	function businessup_sanitize_select( $input, $setting ) {

		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

endif;		
}
add_action( 'customize_register', 'businessup_footer_copyright' );
?>