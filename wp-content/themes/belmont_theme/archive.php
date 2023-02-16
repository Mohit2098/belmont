<?php get_header(); 
$current_term = get_queried_object();
$current_term_ID = $current_term->term_id;
$terms = get_terms([
	'taxonomy'    => 'trailers',
	'hide_empty'  => true,
	'parent'      => $current_term_ID,
	'order' => 'DESC'
]);
$current_child_term_ID = $terms[0]->term_id;
?>
<main id="content" class="category-page trailer-archive">
	<section class="bl-section single-trailers-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<h1 class="text-medium"> <?php echo $current_term->name; ?></h1>
					<?php
					$args=array(    
						'post_type' => 'btrailers',
						'tax_query' => array(
							array(
								'taxonomy' => 'trailers',
								'field'    => 'id',
								'terms'    => $current_child_term_ID,
							),
						   ),
						 );
						$wp_query = new WP_Query( $args );
						$count = $wp_query->post_count;
						if($count > 0):
						?>
						<strong class="h3">
						<?php if ( $wp_query->have_posts() ): $i=0;
							while($wp_query->have_posts()): $wp_query->the_post(); $i++; 
							$trailer_size = get_field('trailer_size');
							echo '<a href="#'.$wp_query->posts[$i-1]->post_name.'" class="link-trailer">'.$trailer_size.'</a>'; if($i != $count): echo ' | '; endif;
							endwhile; endif; wp_reset_postdata(); ?>
						</strong><?php endif; ?>
				</div>
				<!-- /col -->
				<div class="col-lg-6">
					<?php if( $terms && ! is_wp_error( $terms ) ): ?>
					<div class="tab-refresh">
						<?php $ii=0; foreach( $terms as $term ): $ii++; $activeTabClass = ($ii == 1)? "active": "";
								echo '<a data-tabid="'.$term->term_id.'" class="tabs-link tabs-link-detail '.$activeTabClass.'">' . $term->name . '</a>';
								if($ii == 1):$tab_term_name = $term->name; $tab_description = $term->description;
								$trailer_gallery = get_term_meta($term->term_id,'trailer_gallery', true); endif;
								
						endforeach; ?>
					</div><?php endif; ?> 
				</div>
				<!-- /col -->
			</div>
		</div>
		<div class="container pt-70">
			<div class="row">
				<div class="col-lg-6">
					<?php if(!empty($trailer_gallery)): ?>
					<div class="trailer-slide-wrap">
						<div class="slider-product">
							<?php foreach($trailer_gallery as $gallery_item): $image_alt = get_post_meta($gallery_item, '_wp_attachment_image_alt', TRUE); ?>
							<div class="items-product">
							   <img src="<?php echo wp_get_attachment_url( $gallery_item); ?>" alt="<?php echo $image_alt; ?>"> 
							</div>
							<?php endforeach; ?>
						</div>
						<!-- /upper slider -->
						<div class="products-nav">
						<?php foreach($trailer_gallery as $gallery_item_nav): $image_alt_nav = get_post_meta($gallery_item_nav, '_wp_attachment_image_alt', TRUE); ?>
							<div class="item-nav">
								<img src="<?php echo wp_get_attachment_url( $gallery_item_nav); ?>" alt="<?php echo $image_alt_nav; ?>"> 
							</div>
						<?php endforeach; ?>
						</div>
						<!-- slider lower -->
					</div>
					<?php endif; ?>
				</div>
				<!-- /col -->
				<div class="col-lg-6">
					<div class="description">
						<h2 class="text-medium"><?php echo $tab_term_name; ?></h2>
						<?php if($tab_description != ''): ?><p><?php echo $tab_description; ?></p><?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="details-section-trailer">
		<div class="container">
			<?php
			if ( $wp_query->have_posts() ): $kk=0;
			while($wp_query->have_posts()): $wp_query->the_post(); $kk++;
			$trailer_size = get_field('trailer_size');
			$trailer_featured_image = get_field('trailer_featured_image');
			?>
			<div class="detail-box" id="<?php echo $wp_query->posts[$kk-1]->post_name; ?>">
				<h2 class="text-medium"> <?php echo get_the_title(); ?></h2>
				<div class="row">
					<div class="col-lg-6">
					  <?php if(!empty($trailer_featured_image)): ?><img class="trailer-img-contain" src="<?php echo $trailer_featured_image['url']; ?>" alt="<?php echo $trailer_featured_image['alt']; ?>"><?php endif; ?> 	
					  <?php if( have_rows('add_trailer_attribute') ): $j=0;
							$count_attr = count(get_field('add_trailer_attribute')); ?>
					  	<div class="table-wrap">
							<?php while( have_rows('add_trailer_attribute') ) : the_row(); $j++;
							$add_attribute_title = get_sub_field('add_attribute_title');
							$add_attribute_detail = get_sub_field('add_attribute_detail'); ?>
							<?php if($j== 1): ?><div class="d-flex"><?php endif; ?>
								<div class="entity">
									<span class="head"><?php echo $add_attribute_title; ?></span>
									<span class="value"><?php echo $add_attribute_detail; ?></span>
								</div>
							<?php if($j==4): ?></div><?php $j=0; endif; endwhile; ?>
					  </div><?php endif; ?>
				</div>
			</div>
					<!-- /col -->
					<div class="col-lg-6">
						<div class="feature-list">
							<h3><?php _e('Standard Features', 'btrailers-theme' ); ?></h3>
							<?php
							$show_in_compare = get_post_meta(get_the_ID(),'show_in_compare', true); 
							$upload_trailer_pdf = get_post_meta(get_the_ID(),'upload_trailer_pdf', true);
							if($show_in_compare): ?><a href="#" class="btn-custom-small solid-yellow"><img src="<?php echo get_stylesheet_directory_uri() ?>/_images/check-icon.svg" alt=""><?php _e('IN COMPARE', 'btrailers-theme' ); ?></a><?php endif;
							if( $upload_trailer_pdf ): $url = wp_get_attachment_url( $upload_trailer_pdf ); ?>
								<a href="<?php echo esc_html($url); ?>" download class="btn-custom-small solid-yellow"><img src="<?php echo get_stylesheet_directory_uri() ?>/_images/donwload-icon.svg" alt=""><?php _e('Download PDF', 'btrailers-theme' ); ?></a><?php endif;
							if( have_rows('add_standard_features') ): $k=0;
							$count_standard_attr = count(get_field('add_standard_features')); ?>
							<ul>
							<?php while( have_rows('add_standard_features') ) : the_row(); $k++;
								$add_feature = get_sub_field('add_feature'); ?>
								<li><?php echo $add_feature; ?></li>
							<?php if($k == 10):?></ul><ul class="toggle-content"><?php $k=0; endif; ?>
							<?php endwhile; ?>
							</ul><?php endif;
							if($count_standard_attr > 10): ?><a href="javascript:void(0)" class="trigger-toggle"><span class="more"><?php _e('Show more', 'btrailers-theme' ); ?></span><span class="less"><?php _e('Show less', 'btrailers-theme' ); ?></span></a><?php endif; ?>
						</div>
					</div>
					<!-- /col -->
					<div class="col-12">
						<h3><a href="javascript:void(0)" class="option-toggle"><?php _e('Available Options', 'btrailers-theme' ); ?></a></h3>
						<?php if( have_rows('add_additional_options') ):
							$count_attr = count(get_field('add_additional_options')); ?>
						<div class="options-content">
							<ul>
								<?php while( have_rows('add_additional_options') ) : the_row();
								$add_options = get_sub_field('add_options');
								if($add_options != ''): ?><li><?php echo $add_options; ?></li><?php endif; endwhile; ?>
							</ul>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>			
			<?php endwhile; endif; wp_reset_postdata(); ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>
