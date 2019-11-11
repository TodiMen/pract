<?php
function businessup_header_setting( $wp_customize ) {
$wp_customize->remove_control('header_textcolor');

	/* Header Section */
	$wp_customize->add_panel( 'header_options', array(
		'priority' => 300,
		'capability' => 'edit_theme_options',
		'title' => __('Header Settings', 'businessup'),
	) );

	$wp_customize->add_section( 'header_contact' , array(
		'title' => __('Header Top Bar Setting', 'businessup'),
		'panel' => 'header_options',
   	) );
	
	$wp_customize->add_setting(
		'businessup_topbar_enable', array(
        'default'        => 'true',
        'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'businessup_topbar_enable', array(
        'label'   => __('Hide / Show Section', 'businessup'),
        'section' => 'header_contact',
        'type'    => 'radio',
        'choices'=>array('true'=>'On','false'=>'Off'),
    ) );

    $wp_customize->add_setting(
		'businessup_head_info_one', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'businessup_sanitize_textarea_content',
    ) );
    $wp_customize->add_control( 'businessup_head_info_one', array(
        'label' => __('Info one', 'businessup'),
        'section' => 'header_contact',
        'type' => 'textarea',
    ) );
	
	
	$wp_customize->add_setting(
		'businessup_head_info_two', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'businessup_sanitize_textarea_content',
    ) );
    $wp_customize->add_control( 'businessup_head_info_two', array(
        'label' => __('Info two', 'businessup'),
        'section' => 'header_contact',
        'type' => 'textarea',
    ) );
	
	$wp_customize->add_setting(
        'businessup_header_widget_four_label', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );  
    $wp_customize->add_control( 
        'businessup_header_widget_four_label', array(
        'label' => __('Button Text','businessup'),
        'section' => 'header_contact',
        'type' => 'text',
    ) );

    $wp_customize->add_setting(
        'businessup_header_widget_four_link', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );  
    $wp_customize->add_control( 
        'businessup_header_widget_four_link',array(
        'label'   => __('Button Link','businessup'),
        'section' => 'header_contact',
        'type' => 'text',
    ) );

    $wp_customize->add_setting(
        'businessup_header_widget_four_target', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'businessup_header_sanitize_checkbox',
    ) );  
    $wp_customize->add_control( 
        'businessup_header_widget_four_target', array(
        'label' => __('Open link in a new tab','businessup'),
        'section' => 'header_widget_four',
        'type' => 'checkbox',
    ) );

    $wp_customize->add_section( 'header_widget_one' , array(
		'title' => __('Header Widget One Setting', 'businessup'),
		'panel' => 'header_options',
		'priority'    => 600,
   	) );

   	$wp_customize->add_setting(
    	'businessup_header_widget_one_icon', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );  
    $wp_customize->add_control( 
        'businessup_header_widget_one_icon', array(
        'label' => __('Icon','businessup'),
        'section' => 'header_widget_one',
        'type' => 'text',
    ) );

    $wp_customize->add_setting(
        'businessup_header_widget_one_title', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );  
    $wp_customize->add_control( 
        'businessup_header_widget_one_title',array(
        'label'   => __('Title','businessup'),
        'section' => 'header_widget_one',
        'type' => 'text',
    ) );

    $wp_customize->add_setting(
        'businessup_header_widget_one_description', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'businessup_sanitize_textarea_content',
    ) );  
    $wp_customize->add_control( 
        'businessup_header_widget_one_description', array(
        'label' => __('Description','businessup'),
        'section' => 'header_widget_one',
        'type' => 'textarea',
    ) );

    // add Header widget Two Setting
    
    $wp_customize->add_section( 'header_widget_two' , array(
		'title' => __('Header Widget Two Setting', 'businessup'),
		'panel' => 'header_options',
		'priority'    => 620,
   	) );

   	$wp_customize->add_setting(
    	'businessup_header_widget_two_icon', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );  
    $wp_customize->add_control( 
        'businessup_header_widget_two_icon', array(
        'label' => __('Icon','businessup'),
        'section' => 'header_widget_two',
        'type' => 'text',
    ) );

    $wp_customize->add_setting(
        'businessup_header_widget_two_title', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );  
    $wp_customize->add_control( 
        'businessup_header_widget_two_title',array(
        'label'   => __('Title','businessup'),
        'section' => 'header_widget_two',
        'type' => 'text',
    ) );

    $wp_customize->add_setting(
        'businessup_header_widget_two_description', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'businessup_sanitize_textarea_content',
    ) );  
    $wp_customize->add_control( 
        'businessup_header_widget_two_description', array(
        'label' => __('Description','businessup'),
        'section' => 'header_widget_two',
        'type' => 'textarea',
    ) );

    // add Header widget Three Setting
    
    $wp_customize->add_section( 'header_widget_three' , array(
		'title' => __('Header Widget Three Setting', 'businessup'),
		'panel' => 'header_options',
		'priority'    => 620,
   	) );

   	$wp_customize->add_setting(
    	'businessup_header_widget_three_icon', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );  
    $wp_customize->add_control( 
        'businessup_header_widget_three_icon', array(
        'label' => __('Icon','businessup'),
        'section' => 'header_widget_three',
        'type' => 'text',
    ) );

    $wp_customize->add_setting(
        'businessup_header_widget_three_title', array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );  
    $wp_customize->add_control( 
        'businessup_header_widget_three_title',array(
        'label'   => __('Title','businessup'),
        'section' => 'header_widget_three',
        'type' => 'text',
    ) );

    $wp_customize->add_setting(
        'businessup_header_widget_three_description', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'businessup_sanitize_textarea_content',
    ) );  
    $wp_customize->add_control( 
        'businessup_header_widget_three_description', array(
        'label' => __('Description','businessup'),
        'section' => 'header_widget_three',
        'type' => 'textarea',
    ) );

	
	function businessup_header_info_sanitize_text( $input ) {

    return wp_kses_post( force_balance_tags( $input ) );

    }
	
	if ( ! function_exists( 'businessup_sanitize_textarea_content' ) ) :

	/**
	 * Sanitize textarea content.
	 *
	 * @since 1.0.0
	 *
	 * @param string               $input Content to be sanitized.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return string Sanitized content.
	 */
	function businessup_sanitize_textarea_content( $input, $setting ) {

		return ( stripslashes( wp_filter_post_kses( addslashes( $input ) ) ) );

	}
endif;
	
	function businessup_header_sanitize_checkbox( $input ) {
			// Boolean check 
	return ( ( isset( $input ) && true == $input ) ? true : false );
	
	}
	}
	add_action( 'customize_register', 'businessup_header_setting' );
	?>