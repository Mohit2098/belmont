<?php get_header(); ?>
<main id="content">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<section class="bl-section bl-default-template">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header>
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</article>
				</div>
			</div>
		</div>
	</section>
	<?php endwhile; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>