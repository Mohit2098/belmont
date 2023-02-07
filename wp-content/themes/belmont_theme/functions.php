<?php

/***************************************************************
WordPress Boilerplate functions.php
	TABLE OF CONTENTS
	1. Includes for Specific Purposes
		1a. Add All Custom Post Types, menus, sidebars
		1b. Enqueue all scripts and styles
		1c. Clean up backend and frontend
		1d. Pagination
		1e. Security
	2. Theme Setups
	3. Theme Supports
	4. Custom Code
***************************************************************/

// 1. Includes
//	Please use these files which are grouped by type before adding to main functions.php file

// 1a. Add All Custom Post Types, menus, sidebars
require_once( __DIR__ . '/_includes/functions-register.php');

// 1.b. Enqueue all scripts and styles
require_once( __DIR__ . '/_includes/functions-enqueue.php');

// 1c. Clean up backend and frontend. Generally do not edit
require_once( __DIR__ . '/_includes/functions-clean-up.php');

// 1.d. Pagination
require_once( __DIR__ . '/_includes/functions-pagination.php');

///* Register ACF Functions
require_once( __DIR__ . '/_includes/functions-acf-sync.php');


//1.e. Require Featured Image
// Required for valid structured data. Does not need to display on website frontend
add_theme_support('post-thumbnails'); // this needs to be defined before the following include
// 2. Theme setups
add_action('after_setup_theme', 'wpbp_theme_setup');
function wpbp_theme_setup(){
    // HTML5 Support
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	
}

// 3. Theme Supports
add_theme_support( "title-tag" );

// 4. Default Functions

// 5. Custom Code

//Current Year Shortcode
function current_year_shortcode() {
	$current_year = date('Y');
	return $current_year;
}
add_shortcode('year', 'current_year_shortcode');

?>
