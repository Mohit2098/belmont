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
 
  //Styles

  wp_enqueue_style( 'style', get_stylesheet_uri(),null,1.0);
  wp_enqueue_style("slick-min-css","https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css");
  wp_enqueue_style("slick-theme-min-css","https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css");
  wp_enqueue_style("adobe-fonts","https://use.typekit.net/nvw8hhc.css");
  wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri().'/_css/custom.css',null,1.0);
  wp_enqueue_style( 'layout-style', get_stylesheet_directory_uri().'/_css/layout.css',null,1.0);

  //Scripts

  wp_enqueue_script("slick-min-js","https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js",array('jquery'), 1.8, true);
  wp_enqueue_script ('wp-script', get_stylesheet_directory_uri() . '/_js/js.js', array('jquery'), 1.0, true);
}
add_action('wp_enqueue_scripts', 'wp_nq_scripts');
