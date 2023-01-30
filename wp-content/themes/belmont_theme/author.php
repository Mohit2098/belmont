<?php get_header(); ?>
<main id="content" class="author-page" >
<?php  $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
		<header>
			<h1 class="entry-title"><?php _e( 'Content by', 'wpbp-theme' ); ?> <?php echo $curauth->nickname; ?></h1>
			<?php if ( get_the_author_meta( 'description' ) ) : ?>
				<?php the_author_meta( 'description' ); ?>
			<?php endif; ?>
		</header>
		<div class="entry-content">
      <ul>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <li id="post-<?php the_ID(); ?>" class="wp-a11y-card">
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <?php the_excerpt(); ?>
        </li>
        <?php endwhile; else: ?>
        <p><?php _e( 'No posts by this author', 'wpbp-theme' ); ?></p>
        <p><?php get_search_form(); ?></p>
      </ul>
      <?php endif; ?>
      </ul>
		</div>
	<footer>
		<?php wpbp_pagination($pages = '', $range = 2,"Posts"); ?>
	</footer>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
