<?php function businessup_scripts() {

	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');

	wp_enqueue_style( 'businessup-style', get_stylesheet_uri() );

	wp_enqueue_style('businessup-default', get_template_directory_uri() . '/css/colors/default.css');
	
	wp_enqueue_style('smartmenus',get_template_directory_uri().'/css/jquery.smartmenus.bootstrap.css');	

	wp_enqueue_style('carousel',get_template_directory_uri().'/css/owl.carousel.css');

	wp_enqueue_style('owl_transitions',get_template_directory_uri().'/css/owl.transitions.css');

	wp_enqueue_style('font-awesome',get_template_directory_uri().'/css/font-awesome.css');

	wp_enqueue_style('animate',get_template_directory_uri().'/css/animate.css');
	/* Js script */

  wp_enqueue_script( 'businessup-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'));

  wp_enqueue_script('businessup_bootstrap_script', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));

  wp_enqueue_script('businessup_smartmenus', get_template_directory_uri() . '/js/jquery.smartmenus.js' , array('jquery'));
  
  wp_enqueue_script('businessup_slider', get_template_directory_uri() . '/js/slider.js' , array('jquery'));

  wp_enqueue_script('businessup_smartmenus_bootstrap', get_template_directory_uri() . '/js/jquery.smartmenus.bootstrap.js' , array('jquery'));
  
  wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'));

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'businessup_scripts');


//Custom Color
function businessup_text_custom_color() {
    
    businessup_custom_color();
	wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/custom.js' , array('jquery'));	
    
}
add_action('wp_footer','businessup_text_custom_color');
?>