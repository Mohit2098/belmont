<?php
$trailer_type = get_terms([
'taxonomy' => 'trailers',
'hide_empty' => false,
'parent' => 0,
'orderby'    => 'ID',
'order'      => 'ASC',
]);
if ( !empty($trailer_type) ) : ?>
<section class="all-trailers-sec">
<div class="container">
    <div class="row">
    <?php foreach( $trailer_type as $trailer ):
        $trailer_featured_img = get_field( 'trailer_type_featured_image', $trailer->taxonomy . '_' . $trailer->term_id );
        $trailer_icon = get_field( 'trailer_icon', $trailer->taxonomy . '_' . $trailer->term_id );
        ?>
        <div class="col-lg-6">
            <div class="inner-white-box d-flex flex-wrap">
            <?php  if(!empty($trailer_icon)): ?>
                        <img class="trailer-bg" src="<?php echo $trailer_icon['url']; ?>" alt="<?php echo $trailer_icon['alt']; ?>" />
                    <?php endif;  ?>
                <div class="caption">
                    <h3><?php echo $trailer->name; ?></h3>
                    <a href="<?php echo get_term_link($trailer->term_id); ?>" class="btn-custom-small">SEE TRAILER SPECS</a>
                    
                </div>
                <?php if(!empty($trailer_featured_img)): ?>
                    <div class="img-box"><img class="trailer-img" src="<?php echo $trailer_featured_img['url']; ?>" alt="<?php echo $trailer_featured_img['alt']; ?>"></div>
                <?php else: ?>
                    <div class="img-box"><img class="trailer-img" src="<?php echo get_stylesheet_directory_uri() ?>/_images/dummy.png" alt="default image"></div>
                <?php endif; ?>
            </div>
        </div>
<?php endforeach; ?>

        
        

    </div>
</div>
</section>
<?php endif; ?>