<?php $heading = get_sub_field('heading');
$description = get_sub_field('description');
$form_heading = get_sub_field('form_heading');
$form_shortcode = get_sub_field('add_form_shortcode');
?>
<section class="form-with-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="content-wrapper">
                    <?php if (!empty($heading)) : ?>
                        <h1 class="h2"><?php echo $heading; ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($description)) : ?>
                        <div><?php echo $description; ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- /col -->
            <div class="col-lg-5">
                <div class="form-wrapper">
                    <?php if (!empty($form_heading)) : ?>
                        <h2 class="h2"><?php echo $form_heading; ?></h2>
                    <?php endif; ?>
                    <?php if (!empty($form_shortcode)) : ?>
                        <?php echo do_shortcode($form_shortcode); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>