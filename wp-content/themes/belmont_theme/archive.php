<?php get_header(); ?>
<main id="content" class="category-page trailer-archive">
		<header>
			<h1 class="entry-title"><?php single_post_title();; ?></h1>
		</header>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" class="wp-a11y-card">
			<header>
				<h2>
					<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
				</h2>
			</header>
			<?php the_excerpt(); ?>
    </article>
		<?php endwhile; ?>
		<footer>
			<?php wpbp_pagination($pages = '', $range = 2,"Posts"); ?>
		</footer>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
