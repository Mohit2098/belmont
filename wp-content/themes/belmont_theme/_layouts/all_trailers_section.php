<?php
$ids_to_exclude = array();
$get_terms_to_exclude =  get_terms(
    array(
        'fields'  => 'ids',
        'slug'    => array('custom-builds'),
        'taxonomy' => 'trailers',
    )
);
if( !is_wp_error( $get_terms_to_exclude ) && count($get_terms_to_exclude) > 0){
    $ids_to_exclude = $get_terms_to_exclude; 
}
$trailer_type = get_terms([
'taxonomy' => 'trailers',
'hide_empty' => false,
'parent' => 0,
'orderby'    => 'ID',
'order'      => 'ASC',
'exclude' => $ids_to_exclude
]);
if ( !empty($trailer_type) ) : ?>
<section class="bl-section all-trailers-sec">
<div class="container">
<div class="row">
<?php foreach( $trailer_type as $trailer ):
    $trailer_featured_img = get_field( 'trailer_type_featured_image', $trailer->taxonomy . '_' . $trailer->term_id );
    $trailer_icon = get_field( 'trailer_icon', $trailer->taxonomy . '_' . $trailer->term_id );
    ?>
    <div class="col-lg-6">
        <div class="inner-white-box d-flex">
        <?php if(!empty($trailer_featured_img)): ?>
            <img class="trailer-bg" src="<?php echo $trailer_featured_img['url']; ?>" alt="<?php echo $trailer_featured_img['alt']; ?>">
        <?php endif; ?>
        <div class="caption">
            <h3><?php echo $trailer->name; ?></h3>
            <a href="<?php echo get_term_link($trailer->term_id); ?>" class="btn-custom-small outline-yellow">SEE TRAILER SPECS <span>»</span></a>
        </div>
        <?php if(!empty($trailer_icon)): ?>
            <div class="img-box"><img class="trailer-img" src="<?php echo $trailer_icon['url']; ?>" alt="<?php echo $trailer_icon['alt']; ?>" /></div>
        <?php endif;  ?>

            
            
            
            
        </div>
    </div>
<?php endforeach; ?>

    
    

</div>
</div>
</section>
<?php endif; ?>