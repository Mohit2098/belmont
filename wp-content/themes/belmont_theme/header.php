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

  	<header class="site-header">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-12">
					<nav id="access" class="top-utility-menu" aria-label="<?php _e( 'Top Bar Navigation', 'wpbp-theme' ); ?>" >
				    <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'top_bar_menu' ) ); ?>
			</nav>
				</div>
				<div class="col-lg-3">
					<div class="site-branding">
						<?php $site_logo = get_field('site_logo', 'option'); ?>
						<?php if(!empty($site_logo)):?>
							<a href="<?php echo home_url( '/' ); ?>" rel="home" ><img src="<?php echo esc_url($site_logo['url']); ?>" alt="<?php echo esc_attr($site_logo['alt']); ?>"/></a>
							<?php endif;?>
				    </div>
				</div>
				<div class="col-lg-9">
					<button class="menu-toggle rt-menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="Open Menu">
						<span></span><span></span><span></span>
					</button>
					<nav id="site-navigation" class="main-navigation bl-navigation" aria-label="<?php _e( 'Primary Navigation', 'wpbp-theme' ); ?>" >
					<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary_menu' ) ); ?>
			</nav>
				</div>
			</div>
		</div>
  	</header>

