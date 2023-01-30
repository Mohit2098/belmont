<?php
/***************************************************************
	Enqueue all scripts and styles.
	1. JS In the footer of course
  2. Load local versions of CSS, JS, and fonts rather than CDNs
  3. Do not use time-based cache busting for file versioning. Ever.
***************************************************************/

/**
	*    Table of Contents
	*1.  Enqueue everything
**/

global $wp_version;
$wp_version = '1.0';

// 1. Enqueue everything
function wp_nq_scripts() {
  global $wp_version;
  wp_enqueue_style( 'style', get_stylesheet_uri(),null,$wp_version);
  wp_enqueue_script ('wp-script', get_stylesheet_directory_uri() . '/_js/js.js', array('jquery'), $wp_version, true);
}
add_action('wp_enqueue_scripts', 'wp_nq_scripts');
