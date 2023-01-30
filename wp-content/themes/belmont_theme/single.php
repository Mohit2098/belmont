<?php get_header(); ?>
<main id="content">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
			<h1><?php the_title(); ?></h1>
			<time><?php the_date(); ?></time> | <?php the_author_posts_link(); ?>
		</header>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<nav class="single-pagination" aria-label="<?php esc_html_e( 'Additional posts', 'wpbp-theme' ); ?>">
			<?php next_post_link( '%link', 'Next post', TRUE ); ?>
			<?php previous_post_link('%link', 'Previous post', TRUE); ?>
		</nav>
	</article>
	<?php endwhile; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
