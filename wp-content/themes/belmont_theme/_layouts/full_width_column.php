<section class="full-width-column">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <?php $image = get_sub_field('image'); ?>
                <?php if (!empty($image)) { ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php } ?>
            </div>
            <div class="col-lg-6" style="background-color:#F1AC21;">
                <?php if (have_rows('column_content')) : ?>
                    <?php while (have_rows('column_content')) : the_row();
                        $heading = get_sub_field('heading');
                        $description = get_sub_field('description');
                    ?>
                        <div>
                            <?php if (!empty($heading)) {
                                echo "<h1>" . $heading . "</h1>";
                            } ?>
                            <?php if (!empty($description)) {
                                echo "<div>" . $description . "</div>";
                            } ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>