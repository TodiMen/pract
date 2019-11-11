<?php
/**
 * businessup functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package businessup
 */


	$businessup_theme_path = get_template_directory() . '/inc/ansar/';

	require( $businessup_theme_path . '/businessup-custom-navwalker.php' );
	require( $businessup_theme_path . '/widget/businessup-slider.php');
	require( $businessup_theme_path . '/widget/businessup-service.php');
	require( $businessup_theme_path . '/icon-functions.php');
	require( $businessup_theme_path . '/font/font.php');
	/* custom-color file. */
	require( get_template_directory() . '/css/colors/custom-color.php');
	
	

	/*-----------------------------------------------------------------------------------*/
	/*	Enqueue scripts and styles.
	/*-----------------------------------------------------------------------------------*/
	require( $businessup_theme_path .'/enqueue.php');
	/* ----------------------------------------------------------------------------------- */
	/* Customizer */
	/* ----------------------------------------------------------------------------------- */
	
	require( $businessup_theme_path . '/customize/ta_customize_copyright.php');
	require( $businessup_theme_path  . '/customize/ta_customize_header.php');
	require( $businessup_theme_path . '/customize/ta_customize_homepage.php');
	require( $businessup_theme_path . '/customize/class-alpha-color-control/class-alpha-color-control.php');
	require( $businessup_theme_path .'/import.php');
	
	/*
	 * Load customize pro
	*/
	require_once( trailingslashit( get_template_directory() ) . 'inc/ansar/customize/customize-pro/class-customize.php' );
	
	/* Calling in the admin area for the Welcome Page */
	if ( is_admin() ) {
		require get_template_directory() . '/inc/ansar/themeinfo/themeinfo-detail.php';
	}
	
	

if ( ! function_exists( 'businessup_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function businessup_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on businessup, use a find and replace
	 * to change 'businessup' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'businessup', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary menu', 'businessup' ),
        'top' => __( 'Top Menu', 'businessup' ),
        'social' => __( 'Social Links Menu', 'businessup' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'businessup_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

    // Set up the woocommerce feature.
    add_theme_support( 'woocommerce');
	
	//Custom logo
	
	//Custom logo
	add_theme_support( 'custom-logo');
	
	// custom header Support
			$args = array(
			'default-image'		=>  get_template_directory_uri() .'/images/sub-header.jpg',
			'width'			=> '1600',
			'height'		=> '600',
			'flex-height'		=> false,
			'flex-width'		=> false,
			'header-text'		=> true,
			'default-text-color'	=> '#143745'
		);
		add_theme_support( 'custom-header', $args );
	

}
endif;
add_action( 'after_setup_theme', 'businessup_setup' );


	function businessup_the_custom_logo() {
	
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}

	}

	add_filter('get_custom_logo','businessup_logo_class');


	function businessup_logo_class($html)
	{
	$html = str_replace('custom-logo-link', 'navbar-brand', $html);
	return $html;
	}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function businessup_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'businessup_content_width', 640 );
}
add_action( 'after_setup_theme', 'businessup_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function businessup_widgets_init() {
	
	$businessup_footer_column_layout = get_theme_mod('businessup_footer_column_layout',3);
	
	$businessup_footer_column_layout = 12 / $businessup_footer_column_layout;
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Widget Area', 'businessup' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="businessup-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'businessup' ),
		'id'            => 'footer_widget_area',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="col-md-'.$businessup_footer_column_layout.' col-sm-6 rotateInDownLeft animated businessup-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Service Widget Area', 'businessup' ),
		'id'            => 'servicehome_widget_area',
		'description'   => '',
		'before_widget' => '<div class="item">',
		'after_widget'  => '</div>',
	) );
}
add_action( 'widgets_init', 'businessup_widgets_init' );


function businessup_register_widgets() {    

    register_widget('businessup_slider_widget');
    register_widget('businessup_service_widget');
    
	$businessup_sidebars = array ( 'sidebar-slider' => 'sidebar-slider');
	
	/* Register sidebars */
	foreach ( $businessup_sidebars as $businessup_sidebar ):
		
		if( $businessup_sidebar == 'sidebar-slider' ):
        
            $businessup_name = __('Slider Widgets Area', 'businessup');

		else:
		
			$businessup_name = $businessup_sidebar;
			
		endif;
		
        register_sidebar(
            array (
                'name'          => $businessup_name,
                'id'            => $businessup_sidebar,
                'before_widget' => '<div id="%1$s" class="businessup-widget %2$s">',
                'after_widget'  => '</div>'
            )
        );
		
    endforeach;
	
}
add_action('widgets_init', 'businessup_register_widgets');
/*-----------------------------------------------------------------------------------*/
/*  customizer-controls
/*-----------------------------------------------------------------------------------*/
/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

//Editor Styling 
add_editor_style( array( 'css/editor-style.css') );

//Read more Button on slider & Post
function businessup_read_more() {
	
	global $post;
	
	$readbtnurl = '<br><a class="btn btn-theme post-btn" href="' . get_permalink() . '">'.__('Read More','businessup').'</a>';
	
    return $readbtnurl;
}
add_filter( 'the_content_more_link', 'businessup_read_more' );


function businessup_excerpt_more_button( $more ) {
	return '<br><a class="btn btn-theme post-btn" href="' . get_permalink() . '">'.__('Read More','businessup').'</a>';
}
add_filter( 'excerpt_more', 'businessup_excerpt_more_button', 20 );


function businessup_import_data_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf( esc_html__( 'To Set Exact Replica of Businessup Theme Install %sDemo Import%s.', 'businessup' ), '<a href="' . esc_url( admin_url( 'themes.php?page=businessup-welcome&tab=import_dummy_data' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=businessup-welcome&tab=import_dummy_data' ) ); ?>" class="button-primary" style="text-decoration: none;"><?php _e( 'Get started with Demo Import Businessup Theme','businessup'); ?></a></p>
			</div>
		<?php
	}
	
add_action('admin_notices', 'businessup_import_data_notice');

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 *
	 * @since Twenty Nineteen 1.4
	 */
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 *
		 * @since Twenty Nineteen 1.4
		 */
		do_action( 'wp_body_open' );
	}
endif;
?>