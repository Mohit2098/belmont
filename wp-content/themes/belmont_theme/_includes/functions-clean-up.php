<?php
//1. Remove admin styles
function wp_admin_styles() {
	echo '<style>
     		#toplevel_page_wpengine-common, li#toplevel_page_wpmudev
			{
				display:none !important;
			}
     	</style>';
}
add_action('admin_head', 'wp_admin_styles');

//2. Remove emoji styles
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
