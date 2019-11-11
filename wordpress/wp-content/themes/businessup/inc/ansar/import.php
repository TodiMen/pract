<?php function businessup_import_files() {
  return array(
    array(
      'import_file_name'           => 'Businessup',
      'import_file_url'            => get_template_directory_uri() . '/inc/ansar/import-data/businessup-wordpress.xml',
      'import_widget_file_url'     => get_template_directory_uri() . '/inc/ansar/import-data/businessup-lite-widgets.wie',
      'import_customizer_file_url' => get_template_directory_uri() . '/inc/ansar/import-data/businessup-export.dat',
      'import_notice'              => sprintf(__( 'Click IMPORT DEMO DATA button and install the <a href="https://themeansar.com/demo/wp/businessup/lite/">exact demo replica of the Businessup theme</a>', 'businessup' )),
			),
    	
    	
    	
	);
}
add_filter( 'pt-ocdi/import_files', 'businessup_import_files' );


function businessup_demo_import() {

	// Menus to assign after import.
	$main_menu   = get_term_by( 'name', 'primary-menu', 'nav_menu' );
	$social_menu = get_term_by( 'name', 'social', 'nav_menu');

	set_theme_mod( 'nav_menu_locations', array(
		'primary'   => $main_menu->term_id,
	));
	
	set_theme_mod( 'nav_menu_locations', array(
		'social'   => $social_menu->term_id,
	));
	
 // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );	
	
}
add_action( 'pt-ocdi/after_import', 'businessup_demo_import' );

function businessup_redirect_plugin_activation( $plugin ) {
	
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'one-click-demo-import/one-click-demo-import.php' ) ):
			$plugin_installed = get_option('businessup-plugin'); 
		if(!$plugin_installed){
				update_option('businessup-plugin','activated');
		 exit( wp_redirect( admin_url( 'themes.php?page=pt-one-click-demo-import' ) ) );
			}
	endif;
	
	
}
add_action( 'activated_plugin', 'businessup_redirect_plugin_activation' );


function businessup_redirect_plugin_deactivate() {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$pluginList = get_option( 'active_plugins' );
$plugin = 'one-click-demo-import/one-click-demo-import.php'; 
if ( in_array( $plugin , $pluginList ) ) {
	
		delete_option('businessup-plugin');
	
}		
	
}
add_action( 'deactivated_plugin', 'businessup_redirect_plugin_deactivate');