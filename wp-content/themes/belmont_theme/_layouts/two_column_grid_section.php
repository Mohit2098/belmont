<section class="two-column-grid-section">
    <div class="container-fluid">
        <div class="text-center">
            <?php $section_heading = get_sub_field('section_heading'); ?>
            <?php if (!empty($section_heading)) {
                echo "<h1>" . $section_heading . "</h1>";
            } ?>
        </div>
        <?php if (have_rows('grid_content')) : ?>
            <div class="row">
                <?php while (have_rows('grid_content')) : the_row();
                    $image = get_sub_field('image');
                    $heading = get_sub_field('heading');
                    $description = get_sub_field('description');
                    $add_cta = get_sub_field('add_cta');
                ?>
                    <div class="col-lg-6 justify-content-center d-grid">
                        <a href="<?php echo $button_url; ?>">
                            <?php if (!empty($image)) { ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" style="width:100px" />
                            <?php } ?>

                            <?php if (!empty($heading)) {
                                echo "<h1 style='font-size:14px'>" . $heading . "</h1>";
                            } ?>

                            <?php if (!empty($description)) {
                                echo "<h2 style='font-size:14px'>" . $description . "</h2>";
                            } ?>
                            <?php if (!empty($add_cta)) {
                                $button_url = $add_cta['url'];
                                $button_title = $add_cta['title'];
                                $button_target = $add_cta['target'] ? $add_cta['target'] : '_self';
                            ?>
                                <a class="button" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>">
                                    <?php echo $button_title; ?>
                                </a>
                        </a>
                    <?php } ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
</section>
<section class="content-section">
    <div class="text-center mt-4 mb-4">
        <?php $section_cta = get_sub_field('section_cta'); ?>
        <?php if (!empty($section_cta)) { ?>
            <?php
            $button_url = $section_cta['url'];
            $button_title = $section_cta['title'];
            $button_target = $section_cta['target'] ? $section_cta['target'] : '_self'; ?>
            <a class="button" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>">
                <?php echo $button_title; ?>
            </a>
        <?php } ?>
    </div>
    </div>


    <!-- new structure -->
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="d-flex flex-wrap">
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/Warranty.svg" class="banner-back" alt="">
                    <div class="content-wrapper">
                        <h3>Belmont Warranty</h3>
                        <p>One of the best in the industry.</p>
                        <a href="#" class="learn-more">READ MORE</a>
                    </div>
                </div>
            </div>
            <!-- /col -->
            <div class="col-lg-6">
                <div class="d-flex flex-wrap">
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/Warranty.svg" class="banner-back" alt="">
                    <div class="content-wrapper">
                        <h3>Belmont Warranty</h3>
                        <p>One of the best in the industry.</p>
                        <a href="#" class="learn-more">READ MORE</a>
                    </div>
                </div>
            </div>
            <!-- /col -->
            <div class="col-lg-6">
                <div class="d-flex flex-wrap">
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/Warranty.svg" class="banner-back" alt="">
                    <div class="content-wrapper">
                        <h3>Belmont Warranty</h3>
                        <p>One of the best in the industry.</p>
                        <a href="#" class="learn-more">READ MORE</a>
                    </div>
                </div>
            </div>
            <!-- /col -->
            <div class="col-lg-6">
                <div class="d-flex flex-wrap">
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/Warranty.svg" class="banner-back" alt="">
                    <div class="content-wrapper">
                        <h3>Belmont Warranty</h3>
                        <p>One of the best in the industry.</p>
                        <a href="#" class="learn-more">READ MORE</a>
                    </div>
                </div>
            </div>
            <!-- /col -->
            <div class="col-12 text-center">
                <a href="#" class="btn-custom">See Trailer Models</a>
            </div>
        </div>
    </div>
</section>