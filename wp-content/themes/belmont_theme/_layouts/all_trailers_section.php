<?php
$trailer_type = get_terms([
'taxonomy' => 'trailers',
'hide_empty' => false,
'parent' => 0,
'orderby'    => 'ID',
'order'      => 'ASC',
]);
$count_trailer_type = count($trailer_type);
if ( ! empty( $trailer_type ) && ! is_wp_error( $trailer_type ) ):
    $j=0; foreach( $trailer_type as $trailer ): $j++; if($trailer->slug == 'custom-builds'){ unset($trailer_type[$j-1]); $trailer_type[$count_trailer_type] = $trailer; } endforeach;
?>
<section class="bl-section all-trailers-sec">
<div class="container">
<div class="row">
<?php 
    $i=0; foreach( $trailer_type as $trailer ): $i++;
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