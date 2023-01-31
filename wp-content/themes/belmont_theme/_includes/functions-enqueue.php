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


// 1. Enqueue everything
function wp_nq_scripts() {
  wp_enqueue_style( 'style', get_stylesheet_uri(),null,1.0);
  wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri().'/_css/custom.css',null,1.0);
  wp_enqueue_style( 'layout-style', get_stylesheet_directory_uri().'/_css/layout.css',null,1.0);
  wp_enqueue_script ('wp-script', get_stylesheet_directory_uri() . '/_js/js.js', array('jquery'), 1.0, true);
}
add_action('wp_enqueue_scripts', 'wp_nq_scripts');
