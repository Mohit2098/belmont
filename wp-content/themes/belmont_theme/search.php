<?php get_header(); ?>
<main id="content" class="search-page">
  <?php if ( have_posts() ) { ?>
	<header>
		<h1><?php echo $wp_query->found_posts; ?> <?php _e( 'search results found for', 'btrailers-theme' ); ?> "<?php the_search_query(); ?>"</h1>
	</header>
	<ul>
	<?php while ( have_posts() ) { the_post(); ?>
		<li id="post-<?php the_ID(); ?>" class="wp-a11y-card">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php the_excerpt(); ?>
		</li>
	<?php } ?>
	</ul>
	<footer>
		<?php wpbp_pagination($pages = '', $range = 2,"Posts"); ?>
	</footer>
	<?php ;} else { ?>
	<article>
		<header>
			<h1><?php _e( 'Sorry, No results found for', 'btrailers-theme' ); ?> "<?php echo get_search_query(); ?>"</h1>
		</header>
		<p>Try searching again:</p>
		<p><?php get_search_form(); ?></p>
	</article>
	<?php ;} ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
