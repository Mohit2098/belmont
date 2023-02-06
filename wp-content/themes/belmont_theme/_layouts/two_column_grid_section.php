<section class="bl-section two-column-grid-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pb-50">
                <?php $section_heading = get_sub_field('section_heading'); ?>
                <?php if (!empty($section_heading)) : ?>
                    <h2><?php echo $section_heading; ?></h2>
                <?php endif; ?>
            </div>
            <?php if (have_rows('grid_content')) : ?>
                <?php while (have_rows('grid_content')) : the_row();
                    $image = get_sub_field('image');
                    $heading = get_sub_field('heading');
                    $description = get_sub_field('description');
                    $add_cta = get_sub_field('add_cta');
                ?>
                    <div class="col-lg-6">
                        <div class="d-flex col-wrap">
                            <?php if (!empty($image)) : ?>
                                <img class="logo-left" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <?php endif; ?>
                            <div class="content-wrapper">
                                <?php if (!empty($heading)) : ?><h3><?php echo $heading; ?></h3><?php endif; ?>
                                <?php if (!empty($description)) : ?><div><?php echo $description; ?></div><?php endif; ?>
<<<<<<< HEAD
                                <?php if (!empty($add_cta)) : 
                                    $add_cta_target = $add_cta['target'] ? $add_cta['target'] : '_self';
                                ?>
                                    <a class="learn-more" href="<?php echo $add_cta['url']; ?>" target="<?php echo $add_cta_target; ?>">
                                        <?php echo $add_cta['title']; ?>
=======
                                <?php if (!empty($add_cta)) : ?>
                                    <?php
                                    $button_url = $add_cta['url'];
                                    $button_title = $add_cta['title'];
                                    $button_target = $add_cta['target'] ? $add_cta['target'] : '_self';
                                    ?>
                                    <a class="learn-more" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>">
                                        <?php echo $button_title; ?> <span>»</span>
>>>>>>> df99ddc9f2ec1537f697298200d29cf984a84a20
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
            <!-- /col -->
            <div class="col-12 text-center">
                <?php $section_cta = get_sub_field('section_cta'); ?>
                <?php if (!empty($section_cta)) : ?>
                    <?php $section_cta_target = $section_cta['target'] ? $section_cta['target'] : '_self'; ?>
                    <a class="btn-custom" href="<?php echo $section_cta['url']; ?>" target="<?php echo $section_cta_target; ?>">
                        <?php echo $section_cta['title']; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>