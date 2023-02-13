<?php get_header(); 
$current_term_ID = get_queried_object()->term_id;

$terms = get_terms([
	'taxonomy'    => 'trailers',
	'hide_empty'  => true,
	'parent'      => $current_term_ID,
	'order' => 'DESC'
]);

// $terms = wp_get_post_terms( $current_term_ID, 'trailers', array( 'order' => 'DESC') ); print_r($terms); ?>
<main id="content" class="category-page trailer-archive">
	<section class="bl-section single-trailers-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<h1 class="text-medium">Single Axle Utility Trailers</h1>
					<strong class="h3">
					<?php
					$args=array(    
						'post_type' => 'btrailers',
						'tax_query' => array(
							array(
								'taxonomy' => 'trailers',
								'field'    => 'id',
								'terms'    => $current_term_ID,
							),
						   ),
						 );
						$wp_query = new WP_Query( $args );
						$count = $wp_query->post_count;
						if ( $wp_query->have_posts() ): $i=0;
							while($wp_query->have_posts()): $wp_query->the_post(); $i++;
							$trailer_size = get_field('trailer_size');
							echo $trailer_size; if($i != $count): echo ' | '; endif;
							endwhile; endif; wp_reset_postdata(); ?>
				</strong>
				</div>
				<!-- /col -->
				<div class="col-lg-6">
					<div class="tab-refresh">
						<?php
						if( $terms && ! is_wp_error( $terms ) ){
							foreach( $terms as $term ) {
									echo '<a href="' . get_term_link( $term ) . '" class="tabs-link">' . $term->name . '</a>';
							}
						}
						?>
					</div>
				</div>
				<!-- /col -->
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="trailer-slide-wrap">
						<div class="slider-product">
							<div class="items-product">
							   <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/dummy.png" alt=""> 
							</div>
							<!-- /item -->
							<div class="items-product">
							   <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/trailer.png" alt=""> 
							</div>
							<!-- /item -->
							<div class="items-product">
							   <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/dummy.png" alt=""> 
							</div>
							<!-- /item -->
							<div class="items-product">
							   <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/dummy.png" alt=""> 
							</div>
							<!-- /item -->
							<div class="items-product">
							   <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/dummy.png" alt=""> 
							</div>
							<!-- /item -->
							<div class="items-product">
							   <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/dummy.png" alt=""> 
							</div>
							<!-- /item -->
						</div>
						<!-- /upper slider -->
						<div class="products-nav">
							<div class="item-nav">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/_images/trailer.png" alt=""> 
							</div>
							<!-- /item -->
							<div class="item-nav">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/_images/trailer.png" alt=""> 
							</div>
							<!-- /item -->
							<div class="item-nav">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/_images/dummy.png" alt=""> 
							</div>
							<!-- /item -->
							<div class="item-nav">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/_images/trailer.png" alt=""> 
							</div>
							<!-- /item -->
							<div class="item-nav">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/_images/trailer.png" alt=""> 
							</div>
							<!-- /item -->
							<div class="item-nav">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/_images/trailer.png" alt=""> 
							</div>
							<!-- /item -->
						</div>
						<!-- slider lower -->
					</div>
				</div>
				<!-- /col -->
				<div class="col-lg-6">
					<div class="description">
						<h2 class="text-medium">Tube Top Utility Trailers</h2>
						<p>If you’re seeking a rugged, high-quality utility trailer, look no further. Built for daily use, this trailer is great for hauling around your ATV, commercial mower, or the host of other things that come up. This model series has been a bestseller for years and continues to be admired for a host of features and benefits not easily found elsewhere.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="details-section-trailer">
		<div class="container">
			<?php
			if ( $wp_query->have_posts() ):
			while($wp_query->have_posts()): $wp_query->the_post();
			$trailer_size = get_field('trailer_size');
			?>
			<div class="detail-box">
				<h2 class="text-medium"><?php echo get_the_title(); ?></h2>
				<div class="row">
					<div class="col-lg-6">
					  <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/trailer.png" alt=""> 	
					  <div class="table-wrap">
						<?php if( have_rows('add_trailer_attribute') ): $j=0;
							$count_attr = count(get_field('add_trailer_attribute'));
							while( have_rows('add_trailer_attribute') ) : the_row(); $j++;
							$add_attribute_title = get_sub_field('add_attribute_title');
							$add_attribute_detail = get_sub_field('add_attribute_detail'); ?>
							<?php if($j== 1): ?><div class="d-flex"><?php endif; ?>
								<div class="entity">
									<span class="head"><?php echo $add_attribute_title; ?></span>
									<span class="value"><?php echo $add_attribute_detail; ?></span>
								</div>
							<?php if($j==4): ?></div><?php $j=0; endif; endwhile; ?>
						<?php endif; ?>
					  </div>
				</div>
			</div>
					<!-- /col -->
					<div class="col-lg-6">
						<div class="feature-list">
							<h3>Standard Features</h3>
							<?php
							$show_in_compare = get_post_meta(get_the_ID(),'show_in_compare', true); 
							$upload_trailer_pdf = get_post_meta(get_the_ID(),'upload_trailer_pdf', true);
							?>
							<?php if($show_in_compare): ?><a href="#" class="btn-custom-small solid-yellow">IN COMPARE</a><?php endif; ?>
							<?php if( $upload_trailer_pdf ):
								$url = wp_get_attachment_url( $upload_trailer_pdf ); ?>
								<a href="<?php echo esc_html($url); ?>" class="btn-custom-small solid-yellow" >Download PDF</a>
							<?php endif; ?>
							<?php if( have_rows('add_standard_features') ): $k=0;
							$count_standard_attr = count(get_field('add_standard_features'));
							?>
							<ul>
							<?php while( have_rows('add_standard_features') ) : the_row(); $k++;
									$add_feature = get_sub_field('add_feature'); ?>
								<li><?php echo $add_feature. $k; ?></li>
							<?php  if($k == 10):?>
							</ul><ul class="toggle-content"><?php $k=0; endif; ?>
							<?php endwhile;?>
							    
							<?php endif; ?>
							</ul> <a href="javascript:void(0)" class="trigger-toggle"><span class="more">Show more</span><span class="less">Show less</span>  </a>
						</div>
					</div>
					<!-- /col -->
					<div class="col-12">
						<h3><a href="javascript:void(0)" class="option-toggle">Available Options</a></h3>
						<div class="options-content">
							<ul>
								<li>Hot Dipped Galvanized Finish • A-Frame Toolbox</li>
								<li>Hot Dipped Galvanized Finish • A-Frame Toolbox</li>
								<li>Hot Dipped Galvanized Finish • A-Frame Toolbox</li>
								<li>Hot Dipped Galvanized Finish • A-Frame Toolbox</li>
								<li>Hot Dipped Galvanized Finish • A-Frame Toolbox</li>
								<li>Hot Dipped Galvanized Finish • A-Frame Toolbox</li>
								<li>Hot Dipped Galvanized Finish • A-Frame Toolbox</li>
								<li>Hot Dipped Galvanized Finish • A-Frame Toolbox</li>
								<li>Hot Dipped Galvanized Finish • A-Frame Toolbox</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		
							
			<?php endwhile; endif; ?>
		</div>
	</section>
		
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
