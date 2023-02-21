<?php if (have_rows('flattrak_three_up_content')) : ?>
    <section class="flattrak-three-up-section">
        <div class="container">
            <div class="row">
                <?php while (have_rows('flattrak_three_up_content')) : the_row();
                    $heading_bold = get_sub_field('heading_bold');
                    $heading = get_sub_field('heading'); ?>
                    <div class="col-lg-4 outer-box">
                        <div class="inner-box">
                            <?php if (!(empty($heading_bold)) && !(empty($heading))) : ?>
                                <h3><strong><?php echo $heading_bold; ?></strong><?php echo $heading; ?></h3>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>