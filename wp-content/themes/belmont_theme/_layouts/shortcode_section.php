<?php $section_heading = get_sub_field('section_heading');
$add_shortcode = get_sub_field('add_shortcode'); ?>
<section class="shortcode-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
            <?php if (!empty($section_heading)) : ?><h2 class="text-medium text-center"><?php echo $section_heading; ?></h2><?php endif;
            if( !empty($add_shortcode) ): echo do_shortcode($add_shortcode); endif; ?>
            </div>
        </div>
    </div>
</section>