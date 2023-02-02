<?php
/***************************************************************
Menus, Custom Post Types, Sidebars, etc...
    1. Menus
    2. Custom Posts Types
    3. Sidebars
***************************************************************/

// 1.  Menus
add_action( 'after_setup_theme', 'wpbp_register_menus' );
function wpbp_register_menus() {
	register_nav_menus( array(
		'primary_menu' => 'Primary Menu',
		'footer_menu' => 'Footer Menu',
    'top_bar_menu' => 'Top Bar Menu',
	) );
}
// 2. Register Custom Post Types
//Vendors CPT Starts
add_action('init', 'belmont_cpt');
function belmont_cpt() {
  register_post_type('partners', array(
      'labels' => array(
        'name' => 'Partners',
        'singular_name' => 'Partner'
      ),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      "menu_icon" => "dashicons-businessman",
      'rewrite' => array('slug' => 'partners'),
      'supports' => array('title')
    )
  );
}

// 3. Sidebars

// 4. ACF Options

if( function_exists('acf_add_options_page') && current_user_can( 'manage_options' ) ) {
	$parent = acf_add_options_page(array(
		'page_title' 	=> 'Options',
		'menu_title' 	=> 'Options',
		'redirect' 		=> false
	));

}
