<?php $form_heading = get_sub_field('form_heading'); ?>
<?php $form_subheading = get_sub_field('form_subheading'); ?>
<?php $form_shortcode = get_sub_field('add_form_shortcode'); ?>

<section class="form-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="form-box">
                    <?php if (!empty($form_heading)) : ?><h2 class="text-medium text-center"><?php echo $form_heading; ?></h2><?php endif; ?>
                    <?php if (!empty($form_subheading)) : ?><div class="text-center narrow-text"><?php echo $form_subheading; ?></div><?php endif; ?>
                    <?php if (!empty($form_shortcode)) : ?>
                        <?php echo do_shortcode($form_shortcode); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>