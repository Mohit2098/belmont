<section class="full-width-column">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 p-0">
                <?php $background_image = get_sub_field('background_image');
                if (!empty($background_image)) : ?>
                    <img class="col-img" src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt']); ?>" />
                <?php endif; ?>
            </div>
            <div class="col-lg-6 p-lg-0 py-5 py-lg-4 solid-bg-col">
                <?php
                if (have_rows('column_content')) :
                        while (have_rows('column_content')) : the_row();
                        $heading = get_sub_field('heading');
                        $description = get_sub_field('description'); ?>
                        <div>
                            <?php if (!empty($heading)) : ?><h3><?php echo $heading; ?></h3><?php endif;
                            if (!empty($description)) : ?><div><?php echo $description; ?></div><?php endif; ?>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>
</section>