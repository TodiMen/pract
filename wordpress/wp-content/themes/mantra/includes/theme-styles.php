<?php
/*
 * Styles and scripts registration and enqueuing
 *
 * @package mantra
 * @subpackage Functions
 */

// Adding the viewport meta if the mobile view has been enabled
function mantra_mobile_meta() {
    global $mantra_options;
	if ($mantra_options['mantra_zoom'] == 1) {
    	echo '<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0">' . PHP_EOL;
	} else {
		echo '<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">' . PHP_EOL;
	}
}
if ($mantra_options['mantra_mobile']) add_action( 'cryout_seo_hook', 'mantra_mobile_meta' );


function mantra_enqueue_styles() {
	global $mantra_options;

	// Main theme style
	wp_enqueue_style( 'mantra-style', get_stylesheet_uri(), NULL, _CRYOUT_THEME_VERSION  );

	// Google Fonts
	if (!empty($mantra_options['mantra_googlefont']))
		wp_enqueue_style( 'mantra-googlefont', "//fonts.googleapis.com/css?family=" . preg_replace( '/\s+/', '+', esc_attr($mantra_options['mantra_googlefont']) ) );
	if (!empty($mantra_options['mantra_googlefonttitle']))
		wp_enqueue_style( 'mantra-googlefont-title', "//fonts.googleapis.com/css?family=" . preg_replace( '/\s+/', '+', esc_attr($mantra_options['mantra_googlefonttitle']) ) );
	if (!empty($mantra_options['mantra_googlefontside']))
		wp_enqueue_style( 'mantra-googlefont-side', "//fonts.googleapis.com/css?family=" . preg_replace( '/\s+/', '+', esc_attr($mantra_options['mantra_googlefontside']) ) );
	if (!empty($mantra_options['mantra_googlefontsubheader']))
		wp_enqueue_style( 'mantra-googlefont-headings', "//fonts.googleapis.com/css?family=" . preg_replace( '/\s+/', '+', esc_attr($mantra_options['mantra_googlefontsubheader']) ) );

	// Options-based generated styling
	wp_add_inline_style( 'mantra-style', preg_replace( "/[\n\r\t\s]+/", " ", mantra_custom_styles() ) ); // includes/custom-styles.php

	// Presentation Page options-based styling (only used when needed)
	if ( ($mantra_options['mantra_frontpage']=="Enable") && is_front_page() ) {
		wp_add_inline_style( 'mantra-style', preg_replace( "/[\n\r\t\s]+/", " ", mantra_frontpage_css() ) ); // also in includes/custom-styles.php
	}

	// RTL support
	if ( is_rtl() ) wp_enqueue_style( 'mantra-rtl', get_template_directory_uri() . '/resources/css/rtl.css', NULL, _CRYOUT_THEME_VERSION );

	// User supplied custom styling
	wp_add_inline_style( 'mantra-style', preg_replace( "/[\n\r\t\s]+/", " ", mantra_customcss() ) ); // also in includes/custom-styles.php

	/// Responsive styling (loaded last)
	if ( $mantra_options['mantra_mobile']=="Enable" ) {
		wp_enqueue_style( 'mantra-mobile', get_template_directory_uri() . '/resources/css/style-mobile.css', NULL, _CRYOUT_THEME_VERSION  );
	}

}
add_action('wp_enqueue_scripts', 'mantra_enqueue_styles' );


// JS loading and hook into wp_enque_scripts
add_action('wp_head', 'mantra_customjs' );

// Scripts loading and hook into wp_enque_scripts
function mantra_scripts_method() {
    global $mantra_options;

    // If frontend - load the js for the menu and the social icons animations
	if ( !is_admin() ) {
		wp_enqueue_script( 'mantra-frontend', get_template_directory_uri() . '/resources/js/frontend.js', array('jquery'), _CRYOUT_THEME_VERSION );

		$js_options = array(
			'responsive' => 0,
			'image_class' => '',
			'equalize_sidebars' => 0,
		);
		$js_options['image_class'] = 'image' . $mantra_options['mantra_image'];
		if ( $mantra_options['mantra_mobile'] == "Enable" ) { $js_options['responsive'] = 1; }
		if ( !empty($mantra_options['mantra_s1bg']) || !empty($mantra_options['mantra_s2bg']) ) { $js_options['equalize_sidebars'] = 1; }

		wp_localize_script( 'mantra-frontend', 'mantra_options',  $js_options );

  		// If mantra presentation page is enabled and the current page is home page - load the nivo slider js
		if ( $mantra_options['mantra_frontpage'] == "Enable" && is_front_page() ) {
			wp_enqueue_script( 'mantra-nivoslider', get_template_directory_uri() . '/resources/js/nivo-slider.js', array('jquery'), _CRYOUT_THEME_VERSION );
		}

  	}

	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
add_action('wp_enqueue_scripts', 'mantra_scripts_method');

/**
 *  Adding CSS3 PIE behavior to elements that need it
 */
function mantra_ie_pie() {
	ob_start();
	echo '<!--[if lte IE 8]>
		<style type="text/css" media="screen">
		 #access ul  li,
		.edit-link a ,
		 #footer-widget-area .widget-title, .entry-meta,.entry-meta .comments-link,
		.short-button-light, .short-button-dark ,.short-button-color ,blockquote  {
			 position:relative;
			 behavior: url('.get_template_directory_uri().'/resources/js/PIE/PIE.php);
		   }

		#access ul ul {
		-pie-box-shadow:0px 5px 5px #999;
		}

		#access  ul  li.current_page_item,  #access ul li.current-menu-item ,
		#access ul  li ,#access ul ul ,#access ul ul li, .commentlist li.comment	,.commentlist .avatar,
		 .nivo-caption, .theme-default .nivoSlider {
			 behavior: url('.get_template_directory_uri().'/resources/js/PIE/PIE.php);
		   }
		</style>
		<![endif]-->';
	echo preg_replace( "/[\n\r\t\s]+/", " ", ob_get_clean() );
}
add_action('wp_head', 'mantra_ie_pie', 10);

// FIN
