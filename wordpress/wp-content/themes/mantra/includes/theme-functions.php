<?php
/**
 * Misc functions breadcrumbs / pagination / transient data /back to top button
 *
 * @package mantra
 * @subpackage Functions
 */


/**
* Loads necessary scripts
* Adds HTML5 tags for IE8
* Used in header.php
*/
function mantra_header_scripts() {
	?><!--[if lt IE 9]> 
	<script>
	document.createElement('header');
	document.createElement('nav');
	document.createElement('section');
	document.createElement('article');
	document.createElement('aside');
	document.createElement('footer');
	document.createElement('hgroup');
	</script>
	<![endif]--> <?php
}
add_action( 'wp_head', 'mantra_header_scripts', 100 );

 /**
 * Adds title and description to heaer
 * Used in header.php
*/
function mantra_title_and_description() {
	global $mantra_options;
	global $mantra_totalSize;
	extract( $mantra_options );

	// Header styling and image loading
	// Check if this is a post or page, if it has a thumbnail, and if it's a big one

	global $post;

	if (get_header_image() != '') { $header_image = get_header_image(); }
	if ( is_singular() && has_post_thumbnail( $post->ID ) && ($mantra_fheader == "Enable") && ($image = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'header' ) ) && (intval($image[1]) >= $mantra_totalSize) ):
		$header_image = $image[0];
	endif;

	if (isset($header_image) && ($header_image != '')) {
		printf( '<img id="bg_image" alt="%1$s" title="" src="%2$s" />', esc_attr( get_bloginfo( 'name', 'display' ) ), $header_image );
	}
	?>
	
	<div id="header-container">
	
	<?php
	switch ($mantra_siteheader) {

		case 'Site Title and Description': 
			$heading_tag = ( ( is_home() || is_front_page() ) && !is_page() ) ? 'h1' : 'div'; ?>
			<div>
				<<?php echo $heading_tag ?> id="site-title">
					<span> <a href="<?php echo esc_url( home_url( '/' ) ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ) ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'name' ) ) ?></a> </span>
				</<?php echo $heading_tag ?>>
				<div id="site-description" ><?php echo esc_attr( get_bloginfo( 'description' ) ) ?></div>
			</div> <?php
		break;

		case 'Clickable header image': ?>
			<a href="<?php echo esc_url( home_url( '/' ) ) ?>" id="linky"></a>
			<?php
		break;

		case 'Custom Logo' :
			if (!empty($mantra_logoupload)) { ?>
			<div>
				<a id="logo" href="<?php echo esc_url( home_url( '/' ) ) ?>"> <img title="" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ) ?>" src="<?php echo $mantra_logoupload ?>" /> </a>
			</div> 
			<?php }
		break;

		case 'Empty' :
			// nothing to do here
		break;
	}

	if ($mantra_socialsdisplay0): mantra_header_socials(); endif;
	?>
	</div> <!-- #header-container -->
	<?php

} // mantra_title_and_description()
add_action( 'cryout_branding_hook', 'mantra_title_and_description' );

/**
* Add social icons in header / undermneu left / undermenu right / footer
* Used in header.php and footer.php
*/
function mantra_header_socials() {
	mantra_set_social_icons('sheader');
}

function mantra_smenul_socials() {
	mantra_set_social_icons('smenul');
}

function mantra_smenur_socials() {
	mantra_set_social_icons('smenur');
}

function mantra_footer_socials() {
	mantra_set_social_icons('sfooter');
}

//if ($mantra_socialsdisplay0) add_action( 'cryout_branding_hook', 'mantra_header_socials' );
if ($mantra_socialsdisplay1) add_action( 'cryout_forbottom_hook', 'mantra_smenul_socials' );
if ($mantra_socialsdisplay2) add_action( 'cryout_forbottom_hook', 'mantra_smenur_socials' );
if ($mantra_socialsdisplay3) add_action( 'cryout_footer_hook', 'mantra_footer_socials', 13 );


/**
 * Social icons function
 */
if ( ! function_exists( 'mantra_set_social_icons' ) ) :
function mantra_set_social_icons($location){
	$cryout_special_keys = array('Mail', 'Skype');
	global $mantra_options;
	extract( $mantra_options ); ?>
	<div class="socials" id="<?php echo $location ?>"> 
	<?php
	for ($i=1; $i<=9; $i+=2) {
		$j=$i+1;
		if ( ${"mantra_social$j"} ) {
			if ( in_array(${"mantra_social$i"}, $cryout_special_keys) ) :
				$cryout_current_social = esc_html( ${"mantra_social$j"} );
			else :
				$cryout_current_social = esc_url( ${"mantra_social$j"} );
			endif;	?>

			<a target="_blank" rel="nofollow" href="<?php echo $cryout_current_social; ?>" class="socialicons social-<?php echo esc_attr(${"mantra_social$i"}); ?>" title="<?php echo esc_attr(${"mantra_social$i"}); ?>">
				<img alt="<?php echo esc_attr(${"mantra_social$i"}); ?>" src="<?php echo get_template_directory_uri().'/resources/images/socials/'.${"mantra_social$i"}.'.png'; ?>" />
			</a>
            <?php
		} // $j
	} // $i
	?>
	</div>
	<?php
}
endif;


/**
 * Mantra back to top button
 * Creates div for js
*/
function mantra_back_top() { 
	?>
    <div id="toTop"><i class="crycon-back2top"></i> </div>
	<?php
}
if ($mantra_backtop=="Enable") add_action( 'cryout_body_hook', 'mantra_back_top' );


 /**
 * Creates breadcrumns with page sublevels and category sublevels.
 */
function mantra_breadcrumbs() {
	global $mantra_options; 
	global $post;
	
	echo '<div class="breadcrumbs">';
	if (is_page() && !is_front_page() || is_single() || is_category() || is_archive()) {
		echo '<a href="'.esc_url( home_url() ) .'">' . esc_attr( get_bloginfo('name') ).'</a> &raquo; ';

		if (is_page()) {
			$ancestors = get_post_ancestors($post);
			if (!empty($ancestors)) {
				$ancestors = array_reverse($ancestors);
				foreach ($ancestors as $crumb) {
					echo '<a href="' . esc_url( get_permalink($crumb) ) . '">' . esc_attr( get_the_title($crumb) ) . ' </a> &raquo; ';
				}
			}
		}

		if (is_single() && has_category()) { 
			$category = get_the_category();
			echo '<a href="' . get_category_link($category[0]->cat_ID) . '">' . $category[0]->cat_name . '</a> &raquo; ';
		}

		if (is_category()) {
			$category = get_the_category();
			echo $category[0]->cat_name;
		}

		if (is_tag()) {
			echo __('Tag','mantra') . ' &raquo; ' . single_tag_title('', false);
		}

		// Current page
		if (is_page() || is_single()) {
			echo get_the_title();
		}
		echo '';
	} elseif (is_home() && $mantra_options['mantra_frontpage']!="Enable" ) {
		// Front page
		echo '';
		echo '<a href="' . esc_url( home_url() ) .'">' . esc_attr( get_bloginfo('name') ).'</a> &raquo; ' . __('Home Page','mantra');
		echo '';
	}
	echo '</div>';
}
if ($mantra_breadcrumbs=="Enable")  add_action( 'cryout_before_content_hook', 'mantra_breadcrumbs', 0 );


/**
 * Creates pagination for blog pages.
 */
if ( ! function_exists( 'mantra_pagination' ) ) :
function mantra_pagination($pages = '', $range = 2, $prefix ='') {
    $showitems = ($range * 2)+1;

    global $paged;
    if(empty($paged)) $paged = 1;

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
		echo "<div class='pagination_container'><nav class='pagination'>";
		if ($prefix) echo "<span id='paginationPrefix'>$prefix </span>";
		if ($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
		if ($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

		for ($i=1; $i <= $pages; $i++) {
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
				echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
			}
		}

		if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
		echo "</nav></div>\n";
    }
}
endif;

function mantra_nextpage_links($defaults) {
    $args = array(
    'link_before'      => '<em>',
    'link_after'       => '</em>',
    );
    $r = wp_parse_args($args, $defaults);
    return $r;
}
add_filter( 'wp_link_pages_args', 'mantra_nextpage_links' );


/**
 * Site info
 */
function mantra_site_info() { ?>
<div style="text-align:center;clear:both;padding-top:4px;" >
	<a href="<?php echo esc_url( home_url( '/' ) ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		<?php bloginfo( 'name' ); ?></a> | <?php _e('Powered by','mantra')?> <a target="_blank" href="<?php echo 'http://www.cryoutcreations.eu/mantra';?>" title="<?php echo 'Mantra Theme by '.
		'Cryout Creations';?>"><?php echo 'Mantra' ?></a> &amp; <a target="_blank" href="<?php echo esc_url('http://wordpress.org/' ); ?>"
		title="<?php esc_attr_e('Semantic Personal Publishing Platform', 'mantra'); ?>"> <?php printf(' %s.', 'WordPress' ); ?>
	</a>
</div><!-- #site-info --> <?php 
}
add_action( 'cryout_footer_hook', 'mantra_site_info', 12 );


/**
 * Copyright text
 */
function mantra_copyright() {
	global $mantra_options; ?>
	<div id="site-copyright"> 
		<?php echo wp_kses_post( do_shortcode( $mantra_options['mantra_copyright'] ) ) ?>
	</div>
	<?php
}
if (!empty($mantra_copyright)) add_action( 'cryout_footer_hook', 'mantra_copyright', 11 );


/**
* Retrieves the IDs for images in a gallery.
* @since mantra 2.1.1
* @return array List of image IDs from the post gallery.
*/
function mantra_get_gallery_images() {
       $images = array();

       if ( function_exists( 'get_post_galleries' ) ) {
               $galleries = get_post_galleries( get_the_ID(), false );
               if ( isset( $galleries[0]['ids'] ) )
                       $images = explode( ',', $galleries[0]['ids'] );
       } else {
               $pattern = get_shortcode_regex();
               preg_match( "/$pattern/s", get_the_content(), $match );
               $atts = shortcode_parse_atts( $match[3] );
               if ( isset( $atts['ids'] ) )
                       $images = explode( ',', $atts['ids'] );
       }

       if ( ! $images ) {
               $images = get_posts( array(
                       'fields'         => 'ids',
                       'numberposts'    => 999,
                       'order'          => 'ASC',
                       'orderby'        => 'menu_order',
                       'post_mime_type' => 'image',
                       'post_parent'    => get_the_ID(),
                       'post_type'      => 'attachment',
               ) );
       }

       return $images;
} // mantra_get_gallery_images()


/**
* Checks the browser agent string for mobile ids and adds "mobile" class to body if true
* @since mantra 2.2.3
* @return array list of classes.
*/
function mantra_mobile_body_class($classes){
	global $mantra_options;
	if ($mantra_options['mantra_mobile']=="Enable") {
		$browser = $_SERVER['HTTP_USER_AGENT'];
		if ( preg_match("/(mobile|android|mobi|tablet|ipad|opera mini|series 60|s60|blackberry)/i", $browser) ) $classes[] = 'mobile'; // mobile browser detected
	}
	return $classes;
}
add_filter('body_class', 'mantra_mobile_body_class');


// Favicon
function mantra_fav_icon() {
	global $mantra_options;
	echo '<link rel="shortcut icon" href="'.esc_url($mantra_options['mantra_favicon']).'" />';
	echo '<link rel="apple-touch-icon" href="'.esc_url($mantra_options['mantra_favicon']).'" />';
}

if ($mantra_options['mantra_favicon']) add_action( 'cryout_header_hook', 'mantra_fav_icon' );

/**
* WordPress 5.2+ wp_body_open() support
*/
function mantra_wp_body_open() {
	do_action( 'wp_body_open' );
}
add_action( 'cryout_body_hook', 'mantra_wp_body_open', 5 );

// FIN