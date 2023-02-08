<section class="flattrak-three-up-section">
    <div class="container">
        <?php if (have_rows('flattrak_three_up_content')) : ?>
            <?php
            while (have_rows('flattrak_three_up_content')) : the_row();
                $heading_bold = get_sub_field('heading_bold');
                $description = get_sub_field('description');
            ?>
                <?php if (!empty($heading_bold)) : ?><h1><?php echo $heading_bold; ?></h1><?php endif; ?>
                <?php if (!empty($description)) : ?><h2><?php echo $description; ?></h2><?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>