<?php
// General
require_once(get_template_directory() . "/admin/defaults.php");					// default options
require_once(get_template_directory() . "/includes/custom-styles.php");			// custom styling

// Admin side
if( is_admin() ) {
	require_once(get_template_directory() . "/admin/settings.php");				// theme settings
	require_once(get_template_directory() . "/admin/admin-functions.php");		// admin side functions
	require_once(get_template_directory() . "/admin/sanitize.php");				// settings sanitizers
}

// Getting the theme options and making sure defaults are used if no values are set
function mantra_get_theme_options() {
	global $mantra_defaults;
	$optionsMantra = get_option( 'ma_options', (array)$mantra_defaults );
	$optionsMantra = array_merge((array)$mantra_defaults, (array)$optionsMantra);
	return $optionsMantra;
}

//  Hooks/Filters
// add_action('admin_init', 'mantra_init_fn' ); // hooked by the settings plugin
add_action('admin_menu', 'mantra_add_page_fn');
add_action('init', 'mantra_init');

$mantra_options = mantra_get_theme_options();
extract( $mantra_options );

// Registering and enqueuing all scripts and styles for the init hook
function mantra_init() {
	//Loading Mantra text domain into the admin section
	load_theme_textdomain( 'mantra', get_template_directory_uri() . '/languages' );
}

// Creating the mantra subpage
function mantra_add_page_fn() {
	$page = add_theme_page('Mantra Settings', 'Mantra Settings', 'edit_theme_options', 'mantra-page', 'mantra_page_fn');
	add_action( 'admin_print_styles-'.$page, 'mantra_admin_styles' );
	add_action('admin_print_scripts-'.$page, 'mantra_admin_scripts');
}

// Adding the styles for the Mantra admin page used when mantra_add_page_fn() is launched
function mantra_admin_styles() {
	wp_enqueue_style( 'mantra-admin-style', get_template_directory_uri() . '/admin/css/admin.css', NULL, _CRYOUT_THEME_VERSION  );
	wp_enqueue_style( 'mantra-jqueryui-style', get_template_directory_uri() . '/resources/js/jqueryui/css/ui-lightness/jquery-ui-1.8.16.custom.css', NULL, _CRYOUT_THEME_VERSION );
}

// Adding the styles for the Mantra admin page used when mantra_add_page_fn() is launched
function mantra_admin_scripts() {
	// The farbtastic color selector already included in WP
	wp_enqueue_script("farbtastic");
	wp_enqueue_style( 'farbtastic' );

	//jQuery accordion and slider libraries already included in WP
    wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-ui-tooltip');

	// For backwards compatibility where Mantra is installed on older versions of WP where the ui accordion and slider are not included
	if (!wp_script_is('jquery-ui-accordion',$list='registered')) {
		wp_register_script('cryout_accordion',get_template_directory_uri() . '/admin/js/accordion-slider.js', array('jquery'), _CRYOUT_THEME_VERSION  );
		wp_enqueue_script('cryout_accordion');
		}

	// For the WP uploader
    if (function_exists('wp_enqueue_media')) {
        wp_enqueue_media();
    } else {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
    }

	// The JS used in the admin
	wp_enqueue_script( 'mantra-admin-js', get_template_directory_uri() . '/admin/js/admin.js', NULL, _CRYOUT_THEME_VERSION  );
}

// The settings sections. All the referenced functions are found in admin-functions.php
function mantra_init_fn(){

	register_setting('ma_options', 'ma_options', 'ma_options_validate' );

	/**************
	   sections
	**************/

	add_settings_section('layout_section', __('Layout Settings','mantra'), 'cryout_section_layout_fn', 'mantra-page');
	add_settings_section('header_section', __('Header Settings','mantra'), 'cryout_section_header_fn', 'mantra-page');
	add_settings_section('presentation_section', __('Presentation Page','mantra'), 'cryout_section_presentation_fn', 'mantra-page');
	add_settings_section('text_section', __('Text Settings','mantra'), 'cryout_section_text_fn', 'mantra-page');
	add_settings_section('appereance_section',__('Color Settings','mantra') , 'cryout_section_appereance_fn', 'mantra-page');
	add_settings_section('graphics_section', __('Graphics Settings','mantra') , 'cryout_section_graphics_fn', 'mantra-page');
	add_settings_section('post_section', __('Post Information Settings','mantra') , 'cryout_section_post_fn', 'mantra-page');
	add_settings_section('excerpt_section', __('Post Excerpt Settings','mantra') , 'cryout_section_excerpt_fn', 'mantra-page');
	add_settings_section('featured_section', __('Featured Image Settings','mantra') , 'cryout_section_featured_fn', 'mantra-page');
	add_settings_section('socials_section', __('Social Media Settings','mantra') , 'cryout_section_social_fn', 'mantra-page');
	add_settings_section('misc_section', __('Miscellaneous Settings','mantra') , 'cryout_section_misc_fn', 'mantra-page');

	/*** layout ***/
	add_settings_field('mantra_side', __('Main Layout','mantra') , 'cryout_setting_side_fn', 'mantra-page', 'layout_section');
	add_settings_field('mantra_sidewidth', __('Content / Sidebar Width','mantra') , 'cryout_setting_sidewidth_fn', 'mantra-page', 'layout_section');
	add_settings_field('mantra_magazinelayout', __('Magazine Layout','mantra') , 'cryout_setting_magazinelayout_fn', 'mantra-page', 'layout_section');
	add_settings_field('mantra_mobile', __('Responsiveness','mantra') , 'cryout_setting_mobile_fn', 'mantra-page', 'layout_section');

	/*** presentation ***/
	add_settings_field('mantra_frontpage', __('Enable Presentation Page','mantra') , 'cryout_setting_frontpage_fn', 'mantra-page', 'presentation_section');
	add_settings_field('mantra_frontposts', __('Show Posts on Presentation Page','mantra') , 'cryout_setting_frontposts_fn', 'mantra-page', 'presentation_section');
	add_settings_field('mantra_frontslider', __('Slider Settings','mantra') , 'cryout_setting_frontslider_fn', 'mantra-page', 'presentation_section');
	add_settings_field('mantra_frontslider2', __('Slides','mantra') , 'cryout_setting_frontslider2_fn', 'mantra-page', 'presentation_section');
	add_settings_field('mantra_frontcolumns', __('Presentation Page Columns','mantra') , 'cryout_setting_frontcolumns_fn', 'mantra-page', 'presentation_section');
	add_settings_field('mantra_fronttext', __('Extras','mantra') , 'cryout_setting_fronttext_fn', 'mantra-page', 'presentation_section');

	/*** header ***/
	add_settings_field('mantra_hheight', __('Header Height','mantra') , 'cryout_setting_hheight_fn', 'mantra-page', 'header_section');
	add_settings_field('mantra_himage', __('Header Image','mantra') , 'cryout_setting_himage_fn', 'mantra-page', 'header_section');
	add_settings_field('mantra_siteheader', __('Site Header','mantra') , 'cryout_setting_siteheader_fn', 'mantra-page', 'header_section');
	add_settings_field('mantra_logoupload', __('Custom Logo Upload','mantra') , 'cryout_setting_logoupload_fn', 'mantra-page', 'header_section');
	add_settings_field('mantra_headermargin', __('Header Spacing','mantra') , 'cryout_setting_headermargin_fn', 'mantra-page', 'header_section');
	add_settings_field('mantra_menualign', __('Main Menu Alignment','mantra') , 'cryout_setting_menualign_fn', 'mantra-page', 'header_section');
	add_settings_field('mantra_menurounded', __('Rounded Menu Corners','mantra') , 'cryout_setting_menurounded_fn', 'mantra-page', 'header_section');
	add_settings_field('mantra_favicon', __('FavIcon Upload','mantra') , 'cryout_setting_favicon_fn', 'mantra-page', 'header_section');
	
	/*** text ***/
	add_settings_field('mantra_fontfamily', __('General Font','mantra') , 'cryout_setting_fontfamily_fn', 'mantra-page', 'text_section');
	add_settings_field('mantra_fontsize', __('General Font Size','mantra') , 'cryout_setting_fontsize_fn', 'mantra-page', 'text_section');
	add_settings_field('mantra_fonttitle', __('Post Title Font ','mantra') , 'cryout_setting_fonttitle_fn', 'mantra-page', 'text_section');
	add_settings_field('mantra_headfontsize', __('Post Title Font Size','mantra') , 'cryout_setting_headfontsize_fn', 'mantra-page', 'text_section');
	add_settings_field('mantra_fontside', __('Sidebar Font','mantra') , 'cryout_setting_fontside_fn', 'mantra-page', 'text_section');
	add_settings_field('mantra_sidefontsize', __('SideBar Font Size','mantra') , 'cryout_setting_sidefontsize_fn', 'mantra-page', 'text_section');
	add_settings_field('mantra_fontsubheader', __('Headings Font','mantra') , 'cryout_setting_fontsubheader_fn', 'mantra-page', 'text_section');
	add_settings_field('mantra_textalign', __('Force Text Align','mantra') , 'cryout_setting_textalign_fn', 'mantra-page', 'text_section');
	add_settings_field('mantra_parmargin', __('Paragraph spacing','mantra') , 'cryout_setting_parmargin_fn', 'mantra-page', 'text_section');
	add_settings_field('mantra_parindent', __('Paragraph indent','mantra') , 'cryout_setting_parindent_fn', 'mantra-page', 'text_section');
	add_settings_field('mantra_headerindent', __('Header indent','mantra') , 'cryout_setting_headerindent_fn', 'mantra-page', 'text_section');
	add_settings_field('mantra_lineheight', __('Line Height','mantra') , 'cryout_setting_lineheight_fn', 'mantra-page', 'text_section');
	add_settings_field('mantra_wordspace', __('Word spacing','mantra') , 'cryout_setting_wordspace_fn', 'mantra-page', 'text_section');
	add_settings_field('mantra_letterspace', __('Letter spacing','mantra') , 'cryout_setting_letterspace_fn', 'mantra-page', 'text_section');
	
	/*** appearance ***/
	add_settings_field('mantra_sitebackground', __('Background Image','mantra') , 'cryout_setting_sitebackground_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_backcolor', __('Background Color','mantra') , 'cryout_setting_backcolor_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_headercolor', __('Header (Banner and Menu) Background Color','mantra') , 'cryout_setting_headercolor_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_contentbg', __('Content Background Color','mantra') , 'cryout_setting_contentbg_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_menubg', __('Menu Items Background Color','mantra') , 'cryout_setting_menubg_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_s1bg', __('First Sidebar Background Color','mantra') , 'cryout_setting_first_sidebar_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_s2bg', __('Second Sidebar Background Color','mantra') , 'cryout_setting_second_sidebar_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_titlecolor', __('Site Title Color','mantra') , 'cryout_setting_titlecolor_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_descriptioncolor', __('Site Description Color','mantra') , 'cryout_setting_descriptioncolor_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_contentcolor', __('Content Text Color','mantra') , 'cryout_setting_contentcolor_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_linkscolor', __('Links Color','mantra') , 'cryout_setting_linkscolor_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_hovercolor', __('Links Hover Color','mantra') , 'cryout_setting_hovercolor_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_headtextcolor',__( 'Post Title Color','mantra') , 'cryout_setting_headtextcolor_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_headtexthover', __('Post Title Hover Color','mantra') , 'cryout_setting_headtexthover_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_sideheadbackcolor', __('Sidebar Header Background Color','mantra') , 'cryout_setting_sideheadbackcolor_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_sideheadtextcolor', __('Sidebar Header Text Color','mantra') , 'cryout_setting_sideheadtextcolor_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_prefootercolor', __('Footer Widget Background Color','mantra') , 'cryout_setting_prefootercolor_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_footercolor', __('Footer Background Color','mantra') , 'cryout_setting_footercolor_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_footerheader', __('Footer Widget Header Text Color','mantra') , 'cryout_setting_footerheader_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_footertext', __('Footer Widget Link Color','mantra') , 'cryout_setting_footertext_fn', 'mantra-page', 'appereance_section');
	add_settings_field('mantra_footerhover', __('Footer Widget Hover Color','mantra') , 'cryout_setting_footerhover_fn', 'mantra-page', 'appereance_section');

	/*** graphics ***/
	add_settings_field('mantra_breadcrumbs', __('Breadcrumbs','mantra') , 'cryout_setting_breadcrumbs_fn', 'mantra-page', 'graphics_section');
	add_settings_field('mantra_pagination', __('Pagination','mantra') , 'cryout_setting_pagination_fn', 'mantra-page', 'graphics_section');
	add_settings_field('mantra_image', __('Post Images Border','mantra') , 'cryout_setting_image_fn', 'mantra-page', 'graphics_section');
	add_settings_field('mantra_caption', __('Caption Border','mantra') , 'cryout_setting_caption_fn', 'mantra-page', 'graphics_section');
	add_settings_field('mantra_pin', __('Caption Pin','mantra') , 'cryout_setting_pin_fn', 'mantra-page', 'graphics_section');
	add_settings_field('mantra_sidebullet', __('Sidebar Menu Bullets','mantra') , 'cryout_setting_sidebullet_fn', 'mantra-page', 'graphics_section');
	add_settings_field('mantra_metaback', __('Meta Area Background','mantra') , 'cryout_setting_metaback_fn', 'mantra-page', 'graphics_section');
	add_settings_field('mantra_postseparator', __('Post Separator','mantra') , 'cryout_setting_postseparator_fn', 'mantra-page', 'graphics_section');
	add_settings_field('mantra_contentlist', __('Content List Bullets','mantra') , 'cryout_setting_contentlist_fn', 'mantra-page', 'graphics_section');
	add_settings_field('mantra_pagetitle', __('Page Titles','mantra') , 'cryout_setting_pagetitle_fn', 'mantra-page', 'graphics_section');
	add_settings_field('mantra_categetitle', __('Category Page Titles','mantra') , 'cryout_setting_categtitle_fn', 'mantra-page', 'graphics_section');
	add_settings_field('mantra_tables', __('Hide Tables','mantra') , 'cryout_setting_tables_fn', 'mantra-page', 'graphics_section');
	add_settings_field('mantra_backtop', __('Back to Top button','mantra') , 'cryout_setting_backtop_fn', 'mantra-page', 'graphics_section');
	add_settings_field('mantra_comtext', __('Text Under Comments','mantra') , 'cryout_setting_comtext_fn', 'mantra-page', 'graphics_section');
	add_settings_field('mantra_comclosed', __('Comments are closed text','mantra') , 'cryout_setting_comclosed_fn', 'mantra-page', 'graphics_section');
	add_settings_field('mantra_comoff', __('Comments off','mantra') , 'cryout_setting_comoff_fn', 'mantra-page', 'graphics_section');

	/*** post metas ***/
	add_settings_field('mantra_postcomlink', __('Post Comments Link','mantra') , 'cryout_setting_postcomlink_fn', 'mantra-page', 'post_section');
	add_settings_field('mantra_postdate', __('Post Date','mantra') , 'cryout_setting_postdate_fn', 'mantra-page', 'post_section');
	add_settings_field('mantra_posttime', __('Post Time','mantra') , 'cryout_setting_posttime_fn', 'mantra-page', 'post_section');
	add_settings_field('mantra_postauthor', __('Post Author','mantra') , 'cryout_setting_postauthor_fn', 'mantra-page', 'post_section');
	add_settings_field('mantra_postcateg', __('Post Category','mantra') , 'cryout_setting_postcateg_fn', 'mantra-page', 'post_section');
	add_settings_field('mantra_postmetas', __('Meta Bar','mantra') , 'cryout_setting_postmetas_fn', 'mantra-page', 'post_section');
	add_settings_field('mantra_posttag', __('Post Tags','mantra') , 'cryout_setting_posttag_fn', 'mantra-page', 'post_section');
	add_settings_field('mantra_postbook', __('Post Permalink','mantra') , 'cryout_setting_postbook_fn', 'mantra-page', 'post_section');

	/*** post exceprts ***/
	add_settings_field('mantra_excerpthome', __('Post Excerpts on Home Page','mantra') , 'cryout_setting_excerpthome_fn', 'mantra-page', 'excerpt_section');
	add_settings_field('mantra_excerptsticky', __('Affect Sticky Posts','mantra') , 'cryout_setting_excerptsticky_fn', 'mantra-page', 'excerpt_section');
	add_settings_field('mantra_excerptarchive', __('Post Excerpts on Archive and Category Pages','mantra') , 'cryout_setting_excerptarchive_fn', 'mantra-page', 'excerpt_section');
	add_settings_field('mantra_excerptwords', __('Number of Words for Post Excerpts ','mantra') , 'cryout_setting_excerptwords_fn', 'mantra-page', 'excerpt_section');
	add_settings_field('mantra_excerptdots', __('Excerpt suffix','mantra') , 'cryout_setting_excerptdots_fn', 'mantra-page', 'excerpt_section');
	add_settings_field('mantra_excerptcont', __('Continue reading link text ','mantra') , 'cryout_setting_excerptcont_fn', 'mantra-page', 'excerpt_section');
	add_settings_field('mantra_excerpttags', __('HTML tags in Excerpts','mantra') , 'cryout_setting_excerpttags_fn', 'mantra-page', 'excerpt_section');

	/*** featured ***/
	add_settings_field('mantra_fpost', __('Featured Images as POST Thumbnails ','mantra') , 'cryout_setting_fpost_fn', 'mantra-page', 'featured_section');
	add_settings_field('mantra_fauto', __('Auto Select Images From Posts ','mantra') , 'cryout_setting_fauto_fn', 'mantra-page', 'featured_section');
	add_settings_field('mantra_falign', __('Thumbnails Alignment ','mantra') , 'cryout_setting_falign_fn', 'mantra-page', 'featured_section');
	add_settings_field('mantra_fsize', __('Thumbnails Size ','mantra') , 'cryout_setting_fsize_fn', 'mantra-page', 'featured_section');
	add_settings_field('mantra_fheader', __('Featured Images as HEADER Images ','mantra') , 'cryout_setting_fheader_fn', 'mantra-page', 'featured_section');

	/*** socials ***/
	add_settings_field('mantra_socials1', __('Link #1','mantra') , 'cryout_setting_socials1_fn', 'mantra-page', 'socials_section');
	add_settings_field('mantra_socials2', __('Link #2','mantra') , 'cryout_setting_socials2_fn', 'mantra-page', 'socials_section');
	add_settings_field('mantra_socials3', __('Link #3','mantra') , 'cryout_setting_socials3_fn', 'mantra-page', 'socials_section');
	add_settings_field('mantra_socials4', __('Link #4','mantra') , 'cryout_setting_socials4_fn', 'mantra-page', 'socials_section');
	add_settings_field('mantra_socials5', __('Link #5','mantra') , 'cryout_setting_socials5_fn', 'mantra-page', 'socials_section');
	add_settings_field('mantra_socialshow', __('Socials display','mantra') , 'cryout_setting_socialsdisplay_fn', 'mantra-page', 'socials_section');

	/*** misc ***/
	add_settings_field('mantra_copyright', __('Custom Footer Text','mantra') , 'cryout_setting_copyright_fn', 'mantra-page', 'misc_section');
	add_settings_field('mantra_customcss', __('Custom CSS','mantra') , 'cryout_setting_customcss_fn', 'mantra-page', 'misc_section');
	add_settings_field('mantra_customjs', __('Custom JavaScript','mantra') , 'cryout_setting_customjs_fn', 'mantra-page', 'misc_section');
	add_settings_field('mantra_editorstyle', __('Editor Styling','mantra') , 'cryout_setting_editorstyle_fn', 'mantra-page', 'misc_section');
}

// Display the admin options page
function mantra_page_fn() {
	// Load the import form page if the import button has been pressed
	if (isset($_POST['mantra_import'])) {
		mantra_import_form();
		return;
	}
	// Load the import form  page after upload button has been pressed
	if (isset($_POST['mantra_import_confirmed'])) {
		mantra_import_file();
		return;
	}

	if (!current_user_can('edit_theme_options'))  {
		wp_die( __('Sorry, but you do not have sufficient permissions to access this page.','mantra') );
	} ?>


<div class="wrap cryout-admin"><!-- Admin wrap page -->
<h2 id="empty-placeholder-heading-for-wp441-notice-forced-move"></h2>

<div id="lefty"><!-- Left side of page - the options area -->
	<div>
<div id="admin_header"><img src="<?php echo get_template_directory_uri() . '/admin/images/mantra-logo.png' ?>" /> </div>

<div id="admin_links">
	<a target="_blank" href="http://www.cryoutcreations.eu/wordpress-themes/mantra">Mantra Homepage</a>
	<a target="_blank" href="http://www.cryoutcreations.eu/forum">Support</a>
	<a target="_blank" href="http://www.cryoutcreations.eu">Cryout Creations</a>
</div>
	<div style="clear: both;"></div>
</div>

<?php if ( isset( $_GET['settings-updated'] ) ) {
    echo "<div class='updated fade' style='clear:left;'><p>";
	echo _e('Mantra settings updated successfully.','mantra');
	echo "</p></div>";
} ?>

<div id="jsAlert" class=""><b>Checking jQuery functionality...</b><br/><em>If this message remains visible after the page has loaded then there is a problem with your WordPress jQuery library. This can have several causes, including incompatible plugins.
The Settings page cannot function without jQuery.</em></div>

	<div id="main-options">
		<?php
		mantra_theme_settings_placeholder();
		$mantra_theme_data = get_transient( 'mantra_theme_info');  ?>
		<span id="version">
		Mantra v<?php echo _CRYOUT_THEME_VERSION; ?> by <a href="http://www.cryoutcreations.eu" target="_blank">Cryout Creations</a>
		</span>
	</div><!-- main-options -->
</div><!--lefty -->


<div id="righty" ><!-- Right side of page - Coffee, RSS tips and others -->

	<?php do_action('mantra_before_righty') ?>

	<div class="postbox donate">
		<h3 class="hndle"> Coffee Break </h3>
		<div class="inside"><?php echo "<p>Here at Cryout Creations (the developers of yours truly Mantra Theme), we spend night after night improving the Mantra Theme. We fix a lot of bugs (that we previously created); we add more and more customization options while also trying to keep things as simple as possible; then... we might play a game or two but rest assured that we return to read and (in most cases) reply to your late night emails and comments, take notes and draw dashboards of things to implement in future versions.</p>
			<p>So you might ask yourselves: <i>How do they do it? How can they keep so fresh after all that hard labor for that darned theme? </i> Well folks, it's simple. We drink coffee. Industrial quantities of hot boiling coffee. We love it! So if you want to help with the further development of the Mantra Theme...</p>"; ?>
			<div style="display:block;float:none;margin:0 auto;text-align:center;">

			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
				<input type="hidden" name="cmd" value="_donations">
				<input type="hidden" name="business" value="KYL26KAN4PJC8">
				<input type="hidden" name="item_name" value="Cryout Creations / Mantra Theme donation">
				<input type="hidden" name="currency_code" value="EUR">
				<input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_SM.gif:NonHosted">
				<input type="image" src="<?php echo get_template_directory_uri() . '/admin/images/coffee.png' ?>" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>

			</div>
			<p>Or socially smother, caress and embrace us:</p>
			<div class="social-buttons">
				<a href="https://www.facebook.com/cryoutcreations" target="_blank" title="Follow us on Facebook">
					<img src="<?php echo get_template_directory_uri() . '/admin/images/icon-facebook.png' ?>" alt="Facebook">
				</a>
				<a href="https://twitter.com/cryoutcreations" target="_blank" title="Follow us on Twitter">
					<img src="<?php echo get_template_directory_uri() . '/admin/images/icon-twitter.png' ?>" alt="Twitter">
				</a>
				<a href="https://plus.google.com/106863427325889416242" target="_blank" title="Follow us on Google+">
					<img src="<?php echo get_template_directory_uri() . '/admin/images/icon-googleplus.png' ?>" alt="Google+">
				</a>
			</div>
		</div><!-- inside -->
	</div><!-- donate -->

    <div class="postbox export non-essential-option" style="overflow:hidden;">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
           	<h3 class="hndle"><?php _e( 'Import/Export Settings', 'mantra' ); ?></h3>
        </div><!-- head-wrap -->
        <div class="panel-wrap inside">
				<form action="" method="post">
                	<?php wp_nonce_field('mantra-export', 'mantra-export'); ?>
                    <input type="hidden" name="mantra_export" value="true" />
                    <input type="submit" class="button" value="<?php _e('Export Theme options', 'mantra'); ?>" />
                </form>
                <form action="" method="post">
                    <input type="hidden" name="mantra_import" value="true" />
                    <input type="submit" class="button" value="<?php _e('Import Theme options', 'mantra'); ?>" />
                </form>
		</div><!-- inside -->
	</div><!-- export -->


    <div class="postbox news" >
            <div>
        		<h3 class="hndle"><?php _e( 'Mantra Latest News', 'mantra' ); ?></h3>
            </div>
            <div class="panel-wrap inside" style="height:200px;overflow:auto;">
                <?php
				$mantra_news = fetch_feed( array( 'http://www.cryoutcreations.eu/cat/wordpress-themes/mantra/feed') );
				$maxitems = 0;
				if ( ! is_wp_error( $mantra_news ) ) {
					$maxitems = $mantra_news->get_item_quantity( 10 );
					$news_items = $mantra_news->get_items( 0, (int)$maxitems );
				}
				?>
                <ul class="news-list">
                	<?php if ( $maxitems == 0 ) : echo '<li>' . __( 'No news items.', 'mantra' ) . '</li>'; else :
                	foreach( $news_items as $news_item ) : ?>
                    	<li>
                        	<a class="news-header" href='<?php echo esc_url( $news_item->get_permalink() ); ?>'><?php echo esc_html( $news_item->get_title() ); ?></a><br />
                   <span class="news-item-date"><?php _e('Posted on','mantra');echo $news_item->get_date(' j F Y'); ?></span><br />
                           <a class="news-read" href='<?php echo esc_url( $news_item->get_permalink() ); ?>'>Read more &raquo;</a>
                        </li>
                    <?php endforeach; endif; ?>
                </ul>
            </div><!-- inside -->
    </div><!-- news -->


</div><!--  righty -->
</div><!--  wrap -->

<script>
var mantra_tooltip_icon_url = '<?php echo get_template_directory_uri(); ?>/resources/images/icon-tooltip.png'
</script>

<?php } // mantra_page_fn()

// FIN