<?php
$trailer_type = get_terms([
'taxonomy' => 'trailers',
'hide_empty' => false,
'parent' => 0,
'orderby'    => 'ID',
'order'      => 'ASC',
]);
if ( !empty($trailer_type) ) : ?>
<section class="gallery-slider-section">
<div class="slider-wrapper container-fluid">
<div class="row">
    <div class="col-12 p-0">
        <div class="slick-slider gallery-slider">
        <?php foreach( $trailer_type as $trailer ):
                $trailer_featured_img = get_field( 'trailer_type_featured_image', $trailer->taxonomy . '_' . $trailer->term_id ); ?>
            <div class="items">
                <?php if(!empty($trailer_featured_img)): ?><img src="<?php echo $trailer_featured_img['url']; ?>" alt="<?php echo $trailer_featured_img['alt']; ?>"><?php else: ?>
                <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/dummy.png" alt="default image">    
                <?php endif; ?>
                <div class="text-box">
                    <h3><?php echo $trailer->name; ?></h3>
                    <a href="<?php echo get_term_link($trailer->term_id); ?>" class="btn-custom-small"> See Models </a>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
</section>
<?php endif; ?>