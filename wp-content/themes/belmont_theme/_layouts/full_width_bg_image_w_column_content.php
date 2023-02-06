<section class="full-width-column">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 p-0">
                <?php $background_image = get_sub_field('background_image'); ?>
                <?php if (!empty($background_image)) : ?>
                    <img class="col-img" src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt']); ?>" />
                <?php endif; ?>
            </div>
            <div class="col-lg-6 p-0 solid-bg-col">
                <?php if (have_rows('column_content')) : ?>
                    <?php while (have_rows('column_content')) : the_row();
                        $heading = get_sub_field('heading');
                        $description = get_sub_field('description');
                    ?>
                        <div>
                            <?php if (!empty($heading)) : ?><h3><?php echo $heading; ?></h3>;<?php endif; ?>
                                <?php if (!empty($description)) : ?><div><?php echo $description; ?></div><?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        </div>
            </div>
        </div>
</section>