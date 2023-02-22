<?php get_header(); ?>
<main id="content">
	<article id="post-0" class="bl-section post error404 not-found text-center">
		<!--Display specific message for 410 error code: -->
		<?php if( http_response_code() == 410 ) : ?>
		<h1><?php _e( "This page has been removed.", 'btrailers-theme' ); ?></h1>
		<p><?php _e( "Please try searching below.", 'btrailers-theme' );?></p>
		<?php else: ?>
		<!--Display specific message for 404 error code: -->
		<h1 class="text-medium text-center"><span>404</span> <?php esc_html_e( "Page Not Found", 'btrailers-theme' );?></h1>
		<p><?php esc_html_e( "We're sorry, that page cannot be found.", 'btrailers-theme' );?></p>
		<p><a href="/" class="btn-custom"><?php esc_html_e("Back to home", "btrailers-theme") ?></a></p>
		<?php endif ?>
	</article>
</main>
<?php get_footer(); ?>
