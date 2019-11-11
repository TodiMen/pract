<?php
function businessup_homepage_setting( $wp_customize ) {


			$wp_customize->add_panel( 'homepage_setting', array(
                'priority' => 400,
                'capability' => 'edit_theme_options',
                'title' => __('Frontpage Settings', 'businessup'),
            ) );

            
            /* --------------------------------------
            =========================================
            Slider Section
            =========================================
            -----------------------------------------*/ 
            $wp_customize->add_section(
                'businessup_slider_section_settings', array(
                'title' => __('Slider Settings','businessup'),
                'panel'  => 'homepage_setting',
            ) );
			
			//Slider Enable/Disable setting
            $wp_customize->add_setting(
                'businessup_slider_enable', array(
                'default' => 'true',
                'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('businessup_slider_enable', array(
                'label'   => __('Hide / Show Section', 'businessup'),
                'section' => 'businessup_slider_section_settings',
                'type'    => 'radio',
                 'choices'=>array('true'=>'On','false'=>'Off'),
            ));
			
			//Slider Overlay Color
			$wp_customize->add_setting(
				'businessup_slider_overlay_color', array( 'sanitize_callback' => 'businessup_sanitize_colors',
			) );
			
			$wp_customize->add_control(new businessup_Customize_Alpha_Color_Control( $wp_customize,
                'businessup_slider_overlay_color', array(
				'label'      => __('Overlay Color', 'businessup' ),
				'palette' => true,
				'section' => 'businessup_slider_section_settings')
			) );
			
			
		    /* --------------------------------------
		    =========================================
		    Service Section
		    =========================================
		    -----------------------------------------*/  
		    // add section to manage Services
		    $wp_customize->add_section(
		        'businessup_service_section_settings', array(
		        'title' => __('Service Settings','businessup'),
		        'description' => '',
		        'panel'  => 'homepage_setting',
		    ) );

			//Service Enable / Disable setting
            $wp_customize->add_setting(
            	'businessup_service_enable', array(
                'default'        => 'true',
                'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control(
            	'businessup_service_enable', array(
                'label'   => __('Hide / Show Section', 'businessup'),
                'section' => 'businessup_service_section_settings',
                'type'    => 'radio',
                'choices'=>array('true'=>'On','false'=>'Off'),
            ) );
			
			//Service Overlay 
           $wp_customize->add_setting(
                'businessup_service_overlay_color', array( 'sanitize_callback' => 'businessup_sanitize_colors',
                
            ) );
            
            $wp_customize->add_control(new businessup_Customize_Alpha_Color_Control( $wp_customize,'businessup_service_overlay_color', array(
               'label'      => __('Overlay Color', 'businessup' ),
                'palette' => true,
                'section' => 'businessup_service_section_settings')
            ) );

            //Service text color setting
            $wp_customize->add_setting(
                'businessup_service_text_color', array( 'sanitize_callback' => 'sanitize_hex_color',
                
            ) );
            
            $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize,'businessup_service_text_color', array(
               'label'      => __('Text Color', 'businessup' ),
                'palette' => true,
                'section' => 'businessup_service_section_settings')
            ) );
			

             
            //Service Title setting
		   	$wp_customize->add_setting(
                'businessup_service_title', array(
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ) );	
            $wp_customize->add_control( 
            	'businessup_service_title',array(
                'label'   => __('Title','businessup'),
                'section' => 'businessup_service_section_settings',
                'type' => 'text',
            ) );

            //Service SubTitle setting
            $wp_customize->add_setting(
                'businessup_service_subtitle', array(
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'businessup_homepage_sanitize_textarea_content',
            ) );  
            $wp_customize->add_control( 'businessup_service_subtitle', array(
                'label'   => __('Description','businessup'),
                'section' => 'businessup_service_section_settings',
                'type' => 'textarea',
            ) );

            
			/* --------------------------------------
		    =========================================
		    Callout Section
		    =========================================
		    -----------------------------------------*/
		    // add section to manage Callout
		    $wp_customize->add_section(
		    	'businessup_callout_section_settings', array(
		        'title' => __('Callout Settings','businessup'),
		        'panel'  => 'homepage_setting',
		    ) );
			
			//Callout Enable / Disable setting
			$wp_customize->add_setting(
				'businessup_callout_enable', array(
				'default' => 'true',
				'capability' => 'edit_theme_options',
				 'sanitize_callback' => 'sanitize_text_field',
			) );
			$wp_customize->add_control(
				'businessup_callout_enable', array(
				'label' => __('Hide / Show Section', 'businessup'),
				'section' => 'businessup_callout_section_settings',
				'type'    => 'radio',
				'choices' => array('true'=>'On','false'=>'Off'),
			) );

		    //Callout Background image
		    $wp_customize->add_setting( 
		    	'businessup_callout_background', array(
		    	'sanitize_callback' => 'esc_url_raw',
		    ) );

		    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 
		    	'businessup_callout_background', array(
		    	'label'    => __( 'Background Image', 'businessup' ),
		    	'section'  => 'businessup_callout_section_settings',
		    	'settings' => 'businessup_callout_background',) 
		    ) );
			
			//Callout Overlay Color
			$wp_customize->add_setting(
				'businessup_callout_overlay_color', array( 'sanitize_callback' => 'businessup_sanitize_colors',
			) );

			$wp_customize->add_control(new businessup_Customize_Alpha_Color_Control( $wp_customize,'businessup_callout_overlay_color', array(
				'label' => 'Overlay Color',
				'palette' => true,
				'section' => 'businessup_callout_section_settings')
			) );

            //Callout Text Color setting
            $wp_customize->add_setting(
                'businessup_callout_text_color', array( 'sanitize_callback' => 'sanitize_hex_color',
            ) );
            
            $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize,'businessup_callout_text_color', array(
               'label'      => __('Text Color', 'businessup' ),
                'palette' => true,
                'section' => 'businessup_callout_section_settings')
            ) );

		    
			

          // Callout Title Setting
		    $wp_customize->add_setting(
		    	'businessup_callout_title', array(
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'businessup_template_sanitize_text',
		    ) );	
		    $wp_customize->add_control( 
		    	'businessup_callout_title', array(
		    	'label'   => __('Title','businessup'),
		    	'section' => 'businessup_callout_section_settings',
		    	'type' => 'text',
		    ) );	

			// Callout Description Setting	    
		    $wp_customize->add_setting(
		    	'businessup_callout_description', array(
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'businessup_homepage_sanitize_textarea_content',
		    ) );	
		    $wp_customize->add_control( 
		    	'businessup_callout_description', array(
		    	'label'   => __('Description','businessup'),
		    	'section' => 'businessup_callout_section_settings',
		    	'type' => 'textarea',
		    ) );	

		    // Callout Button One Label Setting	 
		    $wp_customize->add_setting(
		    	'businessup_callout_button_one_label', array(
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
		    ) );	
		    $wp_customize->add_control( 
		    	'businessup_callout_button_one_label', array(
		    	'label' => __('Button Text','businessup'),
		    	'section' => 'businessup_callout_section_settings',
		    	'type' => 'text',
		    ) );	

		    //Callout Button One Link Setting	
		    $wp_customize->add_setting(
		    	'businessup_callout_button_one_link', array(
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );	
		    $wp_customize->add_control( 
		    	'businessup_callout_button_one_link',array(
		    	'label' => __('Button Link','businessup'),
		    	'section' => 'businessup_callout_section_settings',
		    	'type' => 'text',
		    ) );	

		    //Callout Button One Target Setting	
		    $wp_customize->add_setting(
		    	'businessup_callout_button_one_target', array(
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'businessup_homepage_sanitize_checkbox',
		    ) );	
		    $wp_customize->add_control( 
		    	'businessup_callout_button_one_target',array(
		    	'label' => __('Open link in a new tab','businessup'),
		    	'section' => 'businessup_callout_section_settings',
		    	'type' => 'checkbox',
		    ) );

		    //Callout Button Two Label Setting	
		    $wp_customize->add_setting(
		    	'businessup_callout_button_two_label', array(
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
		    ) );	
		    $wp_customize->add_control( 
		    	'businessup_callout_button_two_label', array(
		    	'label' => __('Button Text','businessup'),
		    	'section' => 'businessup_callout_section_settings',
		    	'type' => 'text',
		    ) );	

		    //Callout Button Two Link Setting
		    $wp_customize->add_setting(
		    	'businessup_callout_button_two_link', array(
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );	
		    $wp_customize->add_control( 
		    	'businessup_callout_button_two_link', array(
		    	'label' => __('Button Link','businessup'),
		    	'type' => 'text',
		    	'section' => 'businessup_callout_section_settings',
		    ) );	

		    //Callout Button Two Target Setting
		    $wp_customize->add_setting(
		    	'businessup_callout_button_two_target', array(
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'businessup_homepage_sanitize_checkbox',
		    ) );	
		    $wp_customize->add_control( 
		    	'businessup_callout_button_two_target', array(
		    	'label' => __('Open link in a new tab','businessup'),
		    	'section' => 'businessup_callout_section_settings',
		    	'type' => 'checkbox',
		    ) );

            /* --------------------------------------
            =========================================
            Latest News Section
            =========================================
            -----------------------------------------*/
            // add section to manage Latest News
            $wp_customize->add_section(
                'businessup_news_section_settings', array(
                'title' => __('Latest News settings','businessup'),
                'description' => '',
                'panel'  => 'homepage_setting',
            ) );
            
            //Latest News Enable / Disable setting

            $wp_customize->add_setting(
                'businessup_news_enable', array(
                'default' => 'true',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
                
            ));
            $wp_customize->add_control('businessup_news_enable', array(
                'label' => __('Hide / Show Section', 'businessup'),
                'section' => 'businessup_news_section_settings',
                'type' => 'radio',
                'choices'=>array('true'=>'On','false'=>'Off'),
            ));

            //Latest News Background Image
            $wp_customize->add_setting( 
                'businessup_news_background', array(
                'sanitize_callback' => 'esc_url_raw',
            ) );
            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 
                'businessup_news_background', array(
                'label'    => __( 'Background Image', 'businessup' ),
                'section'  => 'businessup_news_section_settings',
                'settings' => 'businessup_news_background', ) 
            ) );
			
			//Latest News Overlay color
            $wp_customize->add_setting(
                'businessup_news_overlay_color', array( 'sanitize_callback' => 'businessup_sanitize_colors',
            ) );
            
            $wp_customize->add_control(new businessup_Customize_Alpha_Color_Control( $wp_customize,'businessup_news_overlay_color', array(
                'label' => __('Overlay Color', 'businessup' ),
                'palette' => true,
                'section' => 'businessup_news_section_settings')
            ) );

            //Latest News text color
            $wp_customize->add_setting(
                'businessup_news_text_color', array( 'sanitize_callback' => 'sanitize_hex_color',
            ) );
            
            $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize,'businessup_news_text_color', array(
                'label' => __('Text Color', 'businessup' ),
                'palette' => true,
                'section' => 'businessup_news_section_settings')
            ) );
			
            
			// hide meta content
            $wp_customize->add_setting(
                'disable_news_meta', array(
                'default' => 'false',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'businessup_homepage_sanitize_checkbox',
            ) );
            $wp_customize->add_control(
                'disable_news_meta', array(
                'label' => __('Hide post meta from blog pages, archive pages, categories, authors, etc.','businessup'),
                'section' => 'businessup_news_section_settings',
                'type' => 'checkbox',
            ) );

            // Latest News Title Setting
            $wp_customize->add_setting(
                'businessup_news_title', array(
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ) );    
            $wp_customize->add_control( 
                'businessup_news_title',array(
                'label'   => __('Title','businessup'),
                'section' => 'businessup_news_section_settings',
                'type' => 'text',
            ) );

            // Latest News Subtitle Setting
            $wp_customize->add_setting(
                'businessup_news_subtitle', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'businessup_homepage_sanitize_textarea_content',
            ) );  
            $wp_customize->add_control( 
                'businessup_news_subtitle',array(
                'label'   => __('Description','businessup'),
                'section' => 'businessup_news_section_settings',
                'type' => 'textarea',
            ) );    

            function businessup_template_sanitize_text( $input ) {

			return wp_kses_post( force_balance_tags( $input ) );

			}
			
			function businessup_homepage_sanitize_checkbox( $input ) {
			// Boolean check 
			return ( ( isset( $input ) && true == $input ) ? true : false );
			}
	
			function businessup_template_sanitize_html( $input ) {

			return force_balance_tags( $input );
			}
			
			
			function businessup_sanitize_colors( $input ) {
			// Is this an rgba color or a hex?
			$mode = ( false === strpos( $input, 'rgba' ) ) ? 'hex' : 'rgba';

			if ( 'rgba' === $mode ) {
				return businessup_sanitize_rgba( $input );
			} else {
				return businessup_sanitize_colors( $input );
			}
			}
		
					/**
			 * Sanitize rgba color.
			 *
			 * @param string $value Color in rgba format.
			 *
			 * @return string
			 */
			function businessup_sanitize_rgba( $value ) {
				$red   = 'rgba(0,0,0,0)';
				$green = 'rgba(0,0,0,0)';
				$blue  = 'rgba(0,0,0,0)';
				$alpha = 'rgba(0,0,0,0)';   // If empty or an array return transparent
				if ( empty( $value ) || is_array( $value ) ) {
					return '';
				}

				// By now we know the string is formatted as an rgba color so we need to further sanitize it.
				$value = str_replace( ' ', '', $value );
				sscanf( $value, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
				return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
			}
			
			if ( ! function_exists( 'businessup_homepage_sanitize_textarea_content' ) ) :

			/**
			 * Sanitize textarea content.
			 *
			 * @since 1.0.0
			 *
			 * @param string               $input Content to be sanitized.
			 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
			 * @return string Sanitized content.
			 */
			function businessup_homepage_sanitize_textarea_content( $input, $setting ) {

				return ( stripslashes( wp_filter_post_kses( addslashes( $input ) ) ) );

			}
		endif;
		
		
		if ( ! function_exists( 'businessup_sanitize_image' ) ) :

	/**
	 * Sanitize image.
	 *
	 * @since 1.0.0
	 *
	 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
	 *
	 * @param string               $image Image filename.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return string The image filename if the extension is allowed; otherwise, the setting default.
	 */
	function businessup_sanitize_image( $image, $setting ) {

		/**
		 * Array of valid image file types.
		 *
		 * The array includes image mime types that are included in wp_get_mime_types().
		*/
		$mimes = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'gif'          => 'image/gif',
		'png'          => 'image/png',
		'bmp'          => 'image/bmp',
		'tif|tiff'     => 'image/tiff',
		'ico'          => 'image/x-icon',
		);

		// Return an array with file extension and mime_type.
		$file = wp_check_filetype( $image, $mimes );

		// If $image has a valid mime_type, return it; otherwise, return the default.
		return ( $file['ext'] ? $image : $setting->default );

	}

endif;
			
			
}

add_action( 'customize_register', 'businessup_homepage_setting' );
?>