<?php
/*
 * Theme setup functions. Theme initialization, theme support , widgets , navigation
 *
 * @package mantra
 * @subpackage Functions
 */

$mantra_totalSize = $mantra_sidebar + $mantra_sidewidth;

 /**

 *
 * @package Cryout Creations
 * @subpackage mantra
 * @since mantra 0.5
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = $mantra_sidewidth;

/** Tell WordPress to run mantra_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'mantra_setup' );

if ( ! function_exists( 'mantra_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override mantra_setup() in a child theme, add your own mantra_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since mantra 0.5
 */
function mantra_setup() {
	global $mantra_totalSize;
	global $mantra_options;
	extract( $mantra_options );
	
	// This theme styles the visual editor with editor-style.css to match the theme style.
	if ($mantra_editorstyle) add_editor_style( "resources/css/editor-style.css" );

	// Support title tag since WP 4.1
	add_theme_support( 'title-tag' );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions (cropped)

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status') );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'mantra', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in 3 locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'mantra' ),
		'top' => __( 'Top Navigation', 'mantra' ),
		'footer' => __( 'Footer Navigation', 'mantra' ),
	) );

	// This theme allows users to set a custom background
	add_theme_support( 'custom-background' );

	// Register image size for the theme's header area
	add_image_size( 'header', apply_filters( 'mantra_header_image_width', $mantra_totalSize ), apply_filters( 'mantra_header_image_height', intval($mantra_hheight) ), apply_filters( 'mantra_header_image_crop', true ) );
	
	// Register image size for presentation page slider
	add_image_size( 'slider', apply_filters( 'mantra_slider_image_width', $mantra_fpsliderwidth ), apply_filters( 'mantra_slider_image_height', $mantra_fpsliderheight ), true );
	
	// Register custom image size for use with post thumbnails
	add_image_size( 'custom', apply_filters( 'mantra_featured_image_width', $mantra_fwidth ), apply_filters( 'mantra_featured_image_height', $mantra_fheight ), !empty($mantra_fcrop) );

	$header_args = array(
		'height' => $mantra_hheight,
		'width' => $mantra_totalSize,
		'max-width' => 1920,
		'default-image' => '',
		// support flexible (no-crop) headers
		'flex-height' => true,
		'flex-width' => true,
	);
	add_theme_support( 'custom-header', $header_args );

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'mantra' => array(
			'url' => '%s/resources/images/headers/mantra.png',
			'thumbnail_url' => '%s/resources/images/headers/mantra-thumbnail.png',
			// translators: header image description
			'description' => __( 'mantra', 'mantra' )
		),
	) );
}
endif;

// Backwards compatibility for the title-tag
if ( ! function_exists( '_wp_render_title_tag' ) ) :
	add_action( 'wp_head', 'mantra_render_title' );
	add_filter( 'wp_title', 'mantra_filter_wp_title' );
	add_filter( 'wp_title_rss', 'mantra_filter_wp_title_rss');
endif;

function mantra_render_title() { 
	?><title><?php wp_title( '', true, 'right' ); ?></title><?php 
}

function mantra_filter_wp_title( $title ) {
    // Get the Site Name
    $site_name = get_bloginfo( 'name' );
    // Prepend name
    $filtered_title = ( ( ( strlen($site_name)>0 ) && ( strlen($title)>0) ) ? $title . ' - ' . $site_name : $title . $site_name );
	// Get the Site Description
 	$site_description = get_bloginfo( 'description' );
    // If site front page, append description
    if ( ( is_home() || is_front_page() ) && $site_description ) {
        // Append Site Description to title
        $filtered_title = ( ( strlen($site_name)>0 ) && ( strlen($site_description)>0 ) ) ? $site_name . " | " . $site_description : $site_name . $site_description;
    }
	// Add pagination if that's the case
	global $page, $paged;
	if ( $paged >= 2 || $page >= 2 )
	$filtered_title .=	 ' | ' . sprintf( __( 'Page %s', 'mantra' ), max( $paged, $page ) );

    // Return the modified title
    return $filtered_title;
}

function mantra_filter_wp_title_rss($title) {
	return ' ';
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since mantra 0.5
 */
function mantra_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'mantra_page_menu_args' );

/**
 * Create menus
 */

// TOP MENU
function mantra_top_menu() {
	if ( has_nav_menu( 'top' ) ) 
		wp_nav_menu( array( 
			'container' => 'nav', 
			'container_class' => 'topmenu', 
			'theme_location' => 'top', 
			'depth' => 1,
		) );
}
add_action( 'cryout_wrapper_hook', 'mantra_top_menu' );

// MAIN MENU
function mantra_main_menu() {
	?>
	<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'mantra' ); ?>"><?php _e( 'Skip to content', 'mantra' ); ?></a></div>
	<?php 
	/* Main navigation menu. If one isn't selected, wp_nav_menu falls back to wp_page_menu. */
	wp_nav_menu( array( 
		'container_class' => 'menu', 
		'menu_id' =>'prime_nav', 
		'theme_location' => 'primary' 
	) );
}
add_action( 'cryout_access_hook', 'mantra_main_menu' );

// FOOTER MENU
function mantra_footer_menu() {
	if ( has_nav_menu( 'footer' ) )
		wp_nav_menu( array( 
			'container' => 'nav',
			'container_class' => 'footermenu',
			'theme_location' => 'footer', 
			'depth' => 1 
		) );
}
add_action( 'cryout_footer_hook', 'mantra_footer_menu' );


/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override mantra_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since mantra 0.5
 * @uses register_sidebar
 */
function mantra_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area - Sidebar 1', 'mantra' ),
		'id' => 'primary-widget-area',
		'description' => __( 'Primary widget area - Sidebar 1', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area - Sidebar 1', 'mantra' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'Secondary widget area - Sidebar 1', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3 for the second sidebar. Empty be default
	register_sidebar( array(
		'name' => __( 'Third Widget Area - Sidebar 2', 'mantra' ),
		'id' => 'third-widget-area',
		'description' => __( 'Third widget area - Sidebar 2', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located below the Third Widget Area in the second sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Widget Area - Sidebar 2', 'mantra' ),
		'id' => 'fourth-widget-area',
		'description' => __( 'Fourth widget area  - Sidebar 2', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'mantra' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'First footer widget area', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'mantra' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'Second footer widget area', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 7, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'mantra' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 8, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'mantra' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 9, located above the content area. Empty by default.
	register_sidebar( array(
		'name' => __( 'Above content Widget Area', 'mantra' ),
		'id' => 'above-content-widget-area',
		'description' => __( 'Above content Widget Area', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 10, located below the content area. Empty by default.
	register_sidebar( array(
		'name' => __( 'Below Content Widget Area', 'mantra' ),
		'id' => 'below-content-widget-area',
		'description' => __( 'Below Content Widget Area', 'mantra' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running mantra_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'mantra_widgets_init' );


/**
 * Creates different class names for footer widgets depending on their number.
 * This way they can fit the footer area.
 */
function mantra_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'first-footer-widget-area' ) )
		$count++;

	if ( is_active_sidebar( 'second-footer-widget-area' ) )
		$count++;

	if ( is_active_sidebar( 'third-footer-widget-area' ) )
		$count++;

	if ( is_active_sidebar( 'fourth-footer-widget-area' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class )
		echo 'class="footer' . $class . '"';
}


function mantra_above_widget() {
	if ( is_active_sidebar( 'above-content-widget-area' )) { ?>
		<ul class="yoyo">
			<?php dynamic_sidebar( 'above-content-widget-area' ); ?>
		</ul>
	<?php }
}
add_action( 'cryout_before_content_hook', 'mantra_above_widget' );

function mantra_below_widget() {
	if ( is_active_sidebar( 'below-content-widget-area' )) { ?>
		<ul class="yoyo">
			<?php dynamic_sidebar( 'below-content-widget-area' ); ?>
		</ul>
	<?php } 
}
add_action( 'cryout_after_content_hook', 'mantra_below_widget' ); 

// FIN