<?php
/*
 * Functions file
 * Calls all other required files
 * PLEASE DO NOT EDIT THEME FILES - CREATE A CHILD THEME
 *
 * @package mantra
 */

// theme specifics
define ('_CRYOUT_THEME_NAME','mantra');
define ('_CRYOUT_THEME_VERSION','3.2.0');

require_once(get_template_directory() . "/admin/main.php"); 	// Load necessary admin files

//Loading include fiels
require_once(get_template_directory() . "/includes/theme-setup.php"); 	  // Setup and init theme
require_once(get_template_directory() . "/includes/theme-styles.php"); 	  // Register and enqueue css styles and scripts
require_once(get_template_directory() . "/includes/theme-loop.php"); 	  // Loop related fiels
require_once(get_template_directory() . "/includes/theme-frontpage.php"); // Frontpage generation
require_once(get_template_directory() . "/includes/theme-comments.php");  // Theme comment functions
require_once(get_template_directory() . "/includes/theme-functions.php"); // Theme misc functions
require_once(get_template_directory() . "/includes/theme-hooks.php");     // Theme hooks
require_once(get_template_directory() . "/includes/tgm.php");     		  // TGM-PA

// FIN
