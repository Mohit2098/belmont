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

add_action('init', 'belmont_cpt');
function belmont_cpt() {
  //Partners CPT Starts
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

  //Trailers CPT Starts
  register_post_type('trailers', array(
    'labels' => array(
      'name' => 'Trailers',
      'singular_name' => 'Trailer'
    ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    "menu_icon" => "dashicons-hammer",
    'rewrite' => array('slug' => 'trailers'),
    'supports' => array('title')
  )
);

//Trailers Type Taxonomy Starts
register_taxonomy('trailer_type',
array('trailers'),
array(
  'hierarchical' => true,
  'labels' => array(
    'name'              => 'Trailer Type',
    'singular_name'     => 'Trailer Type',
    'search_items'      => 'Search Trailer Type',
    'all_items'         => 'All Trailer Type',
    'parent_item'       => 'Parent Trailer Type',
    'parent_item_colon' => 'Parent Trailer Type',
    'edit_item'         => 'Edit Trailer Type',
    'update_item'       => 'Update Trailer Type',
    'add_new_item'      => 'Add New Trailer Type',
    'new_item_name'     => 'New Trailer Type',
    'menu_name'         => 'Trailer Type'
  ),
  'show_in_nav_menus' => true
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
