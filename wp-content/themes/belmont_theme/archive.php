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
	<div class="col-12" id="loading-container">
		<img class="loading-image" src="<?php echo get_template_directory_uri(); ?>/_images/spinner.svg" />
	</div>
	<section class="bl-section single-trailers-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<h1 class="text-medium"> <?php echo $current_term->name; ?></h1>
					<?php
					$args=array(    
						'post_type' => 'btrailers',
						'orderby' => 'date',
						'order' => 'ASC',
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
					<?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ): ?>
					<div class="tab-refresh">
						<?php $ii=0; foreach( $terms as $term ): $ii++;
						$activeTabClass = ($ii == 1)? "active": "";
						if($ii != 1): $tabs_link_detail = "tabs-link-detail "; else: $tabs_link_detail = "tab-no-link "; endif;
						$tab_custom_label = get_term_meta($term->term_id, 'tab_custom_label', true);
						if(!empty($tab_custom_label)): $tabLabel = $tab_custom_label; else: $tabLabel = $term->name; endif;
								echo '<a data-tabid="'.$term->term_id.'" class="tabs-link '. $tabs_link_detail .$activeTabClass.'">' . $tabLabel . '</a>';
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
			<?php if(!empty($trailer_gallery)): ?>
				<div class="col-lg-6">
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
				</div>
			<?php endif; ?>
				<!-- /col -->
			<?php if(!empty($trailer_gallery)): ?>
				<div class="col-lg-6">
			<?php else: ?><div class="col-lg-12"><?php endif; ?>
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
							$add_to_compare = get_post_meta(get_the_ID(),'add_to_compare', true);
							$upload_trailer_pdf = get_post_meta(get_the_ID(),'upload_trailer_pdf', true);?>
							<?php
							if($add_to_compare): ?><a href="javascript:void(0)" data-id=<?php echo get_the_ID();?> class="btn-custom-small solid-yellow addToCompare">
							<?php _e('ADD TO COMPARE', 'btrailers-theme' ); ?></a><?php endif;
							if( $upload_trailer_pdf ): $url = wp_get_attachment_url( $upload_trailer_pdf ); ?>
								<a href="<?php echo esc_html($url); ?>" download class="btn-custom-small solid-yellow"><img src="<?php echo get_stylesheet_directory_uri() ?>/_images/donwload-icon.svg" alt="download icon"><?php _e('Download PDF', 'btrailers-theme' ); ?></a><?php endif;
							if( have_rows('add_standard_features') ): $k=0;
							$count_standard_attr = count(get_field('add_standard_features')); ?>
							<ul>
							<?php while( have_rows('add_standard_features') ) : the_row(); $k++;
								$add_feature = get_sub_field('add_feature'); ?>
								<li><?php echo $add_feature; ?></li>
							<?php if($k == 10):?></ul><ul class="toggle-content"><?php $k=0; endif; ?>
							<?php endwhile; ?>
							</ul><?php endif;
							if($count_standard_attr > 10): ?><a href="javascript:void(0)" class="trigger-toggle"><span class="more"><?php _e('See more', 'btrailers-theme' ); ?></span><span class="less"><?php _e('See less', 'btrailers-theme' ); ?></span></a><?php endif; ?>
						</div>
					</div>
					<!-- /col -->
					<div class="col-12">
						<h3><a href="javascript:void(0)" class="option-toggle"><?php _e('Available Options', 'btrailers-theme' ); ?></a></h3>
						<?php if( have_rows('add_additional_options') ):
						 $count_attr = count(get_field('add_additional_options')); ?>
						<div class="options-content <?php if($count_attr == 1): echo "with-single-point"; endif;?>">
							<ul>
								<?php
								 while( have_rows('add_additional_options') ) : the_row();
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
	<div class="filter-stripe-wrap hidden-filter">
		<div class="wrapperCl">
		</div>
		<div class="action-wrap">
		<?php $set_incomparison_page = get_field('set_incomparison_page','option');?>
		<?php if (!empty($set_incomparison_page)) :
							$button_target = $set_incomparison_page['target'] ? $set_incomparison_page['target'] : '_self'; ?>
							<a class="compare-button btn-custom" data-redirect="<?php echo esc_url($set_incomparison_page['url']); ?>" target="<?php echo esc_attr($button_target); ?>">
								<?php echo esc_html__($set_incomparison_page['title']); ?>
							</a>
						<?php endif; ?>
			<button class="clear-button"><?php echo __('Clear All', 'btrailers-theme');?></button>
		</div>
	</div>
</main>
<?php get_footer(); ?>
