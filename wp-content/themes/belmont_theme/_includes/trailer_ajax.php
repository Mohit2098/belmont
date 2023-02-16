<?php
// Added the functionailty for the ProRodeo Concert Page Ajax
add_action("wp_ajax_load_trailer_tab", "load_trailer_tab");
add_action("wp_ajax_nopriv_load_trailer_tab", "load_trailer_tab");

function load_trailer_tab(){
  if($_POST){
    extract($_POST);
  }

$current_child_term_ID = $tab_ID;
$parentTerm = get_term($current_child_term_ID, 'trailers');
$terms = get_terms([
	'taxonomy'    => 'trailers',
	'hide_empty'  => true,
	'parent'      => $parentTerm->parent,
	'order' => 'DESC'
]);
$html.='<section class="bl-section single-trailers-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<h1 class="text-medium">'.get_the_category_by_ID($parentTerm->parent).'</h1>';
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
						$html.='<strong class="h3">';
						if ( $wp_query->have_posts() ): $i=0;
							while($wp_query->have_posts()): $wp_query->the_post(); $i++;
							$trailer_size = get_field('trailer_size');
							$html.= '<a href="#'.$wp_query->posts[$i-1]->post_name.'" class="link-trailer" >'.$trailer_size.'</a>'; if($i != $count): $html.= ' | '; endif;
							endwhile; endif; wp_reset_postdata();
						$html.='</strong>';
                        endif;
				$html.='</div>
				<div class="col-lg-6">';
					if( $terms && ! is_wp_error( $terms ) ):
					$html.='<div class="tab-refresh">';
					$ii=0; foreach( $terms as $term ): $ii++; $activeTabCLass = ($term->term_id == $tab_ID)? "active": "";
								$html.='<a data-tabid="'.$term->term_id.'" class="tabs-link tabs-link-detail '.$activeTabCLass.'">' . $term->name . '</a>';
								if($term->term_id == $tab_ID):$tab_term_name = $term->name; $tab_description = $term->description;
								$trailer_gallery = get_term_meta($tab_ID,'trailer_gallery', true); endif;
								
						endforeach;
					$html.='</div>'; endif;
				$html.='</div>
			</div>
		</div>
		<div class="container pt-70">
			<div class="row">
				<div class="col-lg-6">';
					if(!empty($trailer_gallery)):
					$html.='<div class="trailer-slide-wrap">
						<div class="slider-product">';
							foreach($trailer_gallery as $gallery_item): $image_alt = get_post_meta($gallery_item, '_wp_attachment_image_alt', TRUE);
							$html.='<div class="items-product">';
							$html.='<img src="'. wp_get_attachment_url( $gallery_item).'" alt="'.$image_alt.'"></div>';
							endforeach;
						$html.='</div>
						<div class="products-nav">';
						foreach($trailer_gallery as $gallery_item_nav): $image_alt_nav = get_post_meta($gallery_item_nav, '_wp_attachment_image_alt', TRUE);
							$html.='<div class="item-nav">
								<img src="'. wp_get_attachment_url( $gallery_item_nav).'" alt="'.$image_alt_nav.'"> 
							</div>';
						endforeach;
						$html.='</div>
					</div>';
					endif;
				$html.='</div>
				<div class="col-lg-6">
					<div class="description">
						<h2 class="text-medium">'. $tab_term_name.'</h2>';
						if($tab_description !=''): $html.='<p>'.$tab_description.'</p>'; endif;
					$html.= '</div>
				</div>
			</div>
		</div>
	</section>
    <section class="details-section-trailer">
		<div class="container">';
			if ( $wp_query->have_posts() ): $q=0;
			while($wp_query->have_posts()): $wp_query->the_post(); $q++;
			$trailer_size = get_field('trailer_size');
			$trailer_featured_image = get_field('trailer_featured_image');
			$html.='<div class="detail-box" id="'.$wp_query->posts[$q-1]->post_name.'">
				<h2 class="text-medium">'.get_the_title($wp_query->ID).'</h2>
				<div class="row">
					<div class="col-lg-6">';
					if(!empty($trailer_featured_image)):
                        $html.='<img src="'.$trailer_featured_image['url'].'" alt="'.$trailer_featured_image['alt'].'"/>';
                    endif;	
					if( have_rows('add_trailer_attribute') ): $j=0;
						$count_attr = count(get_field('add_trailer_attribute'));
					  	$html.= '<div class="table-wrap">';
							while( have_rows('add_trailer_attribute') ) : the_row(); $j++;
							$add_attribute_title = get_sub_field('add_attribute_title');
							$add_attribute_detail = get_sub_field('add_attribute_detail');
							if($j== 1): $html.='<div class="d-flex">'; endif;
								$html.= '<div class="entity">
									<span class="head">'.$add_attribute_title.'</span>
									<span class="value">'.$add_attribute_detail.'</span>
								</div>';
							if($j==4): $html.='</div>'; $j=0; endif; endwhile;
					  $html.='</div>'; endif;
				$html.= '</div>
			</div>
					<div class="col-lg-6">
						<div class="feature-list">
							<h3>'.__('Standard Features', 'btrailers-theme').'</h3>';
							$show_in_compare = get_post_meta(get_the_ID(),'show_in_compare', true); 
							$upload_trailer_pdf = get_post_meta(get_the_ID(),'upload_trailer_pdf', true);
							if($show_in_compare):
                                $html.='<a href="#" class="btn-custom-small solid-yellow">'.__('IN COMPARE','btrailers-theme').'</a>';
                            endif;
							if( $upload_trailer_pdf ): $url = wp_get_attachment_url( $upload_trailer_pdf );
								$html.='<a href="'. esc_html($url).'" download class="btn-custom-small solid-yellow">'.__('Download PDF', 'btrailers-theme' ).'</a>'; endif;
							if( have_rows('add_standard_features') ): $k=0;
							$count_standard_attr = count(get_field('add_standard_features'));
							$html.='<ul>';
							while( have_rows('add_standard_features') ) : the_row(); $k++;
								$add_feature = get_sub_field('add_feature');
								$html.='<li>'.$add_feature.'</li>';
							if($k == 10): $html.= '</ul><ul class="toggle-content">'; $k=0; endif;
							endwhile;
							$html.='</ul>'; endif;
							if($count_standard_attr > 10):
                                $html.='<a href="javascript:void(0)" class="trigger-toggle"><span class="more">'.__('Show more', 'btrailers-theme' ).'</span><span class="less">'.__('Show less', 'btrailers-theme').'</span></a>'; endif;
						$html.= '</div>
					</div>
					<div class="col-12">
						<h3><a href="javascript:void(0)" class="option-toggle">'.__('Available Options', 'btrailers-theme').'</a></h3>';
						if( have_rows('add_additional_options') ):
							$count_attr = count(get_field('add_additional_options'));
						$html.= '<div class="options-content">
							<ul>';
								while( have_rows('add_additional_options') ) : the_row();
								$add_options = get_sub_field('add_options');
								if($add_options != ''): $html.= '<li>'.$add_options.'</li>'; endif; endwhile;
							$html.='</ul>
						</div>';
						endif;
					$html.='</div>
				</div>
			</div>';		
			endwhile; endif; wp_reset_postdata();
		$html.='</div>
	</section>';


echo $html;
wp_die();
}
