<!DOCTYPE html>
<html <?php language_attributes(); ?> >
  <head>
  	<meta charset="<?php bloginfo( 'charset' ); ?>" />
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
  	<?php wp_body_open(); ?>
  	<a class="screen-reader-text" href="#content"><?php _e( 'Skip to Main Content', 'wpbp-theme' ); ?></a>
  	<header class="global-header">
  		<a href="<?php echo home_url( '/' ); ?>" rel="home" ><?php bloginfo( 'name' ); ?></a>
		  <nav id="access" aria-label="<?php _e( 'Top Bar Navigation', 'wpbp-theme' ); ?>" >
  			<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'top_bar_menu' ) ); ?>
  		</nav>
  		<nav id="access" aria-label="<?php _e( 'Primary Navigation', 'wpbp-theme' ); ?>" >
  			<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary_menu' ) ); ?>
  		</nav>
  		<?php include_once('header-searchform.php'); ?>
  	</header>
