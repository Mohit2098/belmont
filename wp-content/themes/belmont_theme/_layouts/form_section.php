<?php
$form_heading = get_sub_field('form_heading');
$form_subheading = get_sub_field('form_subheading');
$form_shortcode = get_sub_field('add_form_shortcode');
?>
<section class="form-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="form-box">
                    <?php if (!empty($form_heading)) : ?><h2 class="text-medium text-center"><?php echo $form_heading; ?></h2><?php endif;
                    if (!empty($form_subheading)) : ?><div class="text-center narrow-text"><?php echo $form_subheading; ?></div><?php endif;
                    if (!empty($form_shortcode)) : echo do_shortcode($form_shortcode); endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>