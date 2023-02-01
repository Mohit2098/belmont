<section class="two-column-grid-section">
    <div class="container-fluid">
        <div class="text-center">
            <?php $title = get_sub_field('title'); ?>
            <?php if (!empty($title)) {
                echo "<h1>" . $title . "</h1>";
            } ?>
        </div>
        <?php if (have_rows('grid_content')) : ?>
            <div class="row">
                <?php while (have_rows('grid_content')) : the_row();
                    $image = get_sub_field('image');
                    $heading = get_sub_field('heading');
                    $heading_detail = get_sub_field('heading_detail');
                    $read_more_btn_link = get_sub_field('read_more_link');
                    if ($read_more_btn_link) {
                        $button_url = $read_more_btn_link['url'];
                        $button_title = $read_more_btn_link['title'];
                        $button_target = $read_more_btn_link['target'] ? $read_more_btn_link['target'] : '_self';
                    } ?>
                    <div class="col-lg-6 justify-content-center d-grid">
                        <a href="<?php echo $button_url; ?>">
                            <?php if (!empty($image)) { ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" style="width:100px" />
                            <?php } ?>

                            <?php if (!empty($heading)) {
                                echo "<h1 style='font-size:14px'>" . $heading . "</h1>";
                            } ?>

                            <?php if (!empty($heading_detail)) {
                                echo "<h2 style='font-size:14px'>" . $heading_detail . "</h2>";
                            } ?>
                            <?php if (!empty($read_more_btn_link)) { ?>
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
        <?php $btn_link = get_sub_field('button_link'); ?>
        <?php if (!empty($btn_link)) { ?>
            <?php
            $button_url = $btn_link['url'];
            $button_title = $btn_link['title'];
            $button_target = $btn_link['target'] ? $btn_link['target'] : '_self'; ?>
            <a class="button" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>">
                <?php echo $button_title; ?>
            </a>
        <?php } ?>
    </div>
    <div class="container mt-4 mb-4">
        <?php $sub_heading = get_sub_field('sub_heading'); ?>
        <?php if (!empty($sub_heading)) {
            echo "<h3 class='text-center'>" . $sub_heading . "<h3>";
        } ?>
        <?php $description = get_sub_field('description'); ?>
        <?php if (!empty($description)) {
            echo "<p>" . $description . "<p>";
        } ?>
    </div>
    </div>
</section>