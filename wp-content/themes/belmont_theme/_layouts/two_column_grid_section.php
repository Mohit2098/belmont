<section class="two-column-grid-section">
    <!-- new structure -->
    <div class="container">
    <div class="text-center">
            <?php $section_heading = get_sub_field('section_heading'); ?>
            <?php if (!empty($section_heading)):?>
                <h1> <?php echo $section_heading;?></h1>";
            <?php endif;?>
        </div>
        <div class="row">
        <?php if (have_rows('grid_content')) : ?>
                <?php while (have_rows('grid_content')) : the_row();
                    $image = get_sub_field('image');
                    $heading = get_sub_field('heading');
                    $description = get_sub_field('description');
                    $add_cta = get_sub_field('add_cta');
                ?>
            <div class="col-lg-6">
                <div class="d-flex flex-wrap">
                <?php if (!empty($image)): ?>
                                <img class="banner-back" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                            <?php endif;?>
                    <div class="content-wrapper">
                       <?php if (!empty($heading)) :?><h3><?php echo $heading;?><?php endif;?></h3>
                       <?php if (!empty($description)):?><div> <?php echo $description;?></div><?php endif?>
                               <?php if (!empty($add_cta)):?>
                                <?php 
                                $button_url = $add_cta['url'];
                                $button_title = $add_cta['title'];
                                $button_target = $add_cta['target'] ? $add_cta['target'] : '_self';
                                ?>
                                <a class="learn-more" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>">
                                    <?php echo $button_title; ?>
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
            <?php
            $button_url = $section_cta['url'];
            $button_title = $section_cta['title'];
            $button_target = $section_cta['target'] ? $section_cta['target'] : '_self'; ?>
            <a class="btn-custom" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>">
                <?php echo $button_title; ?>
            </a>
        <?php endif; ?>
            </div>
        </div>
    </div>
</section>