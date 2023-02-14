<section class="bl-section flattrak-testimonial">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 testimonial-slider">
                <?php if (have_rows('flattrak_testimonial_content')) : ?>
                    <?php
                    while (have_rows('flattrak_testimonial_content')) : the_row();
                        $flattrak_testimonial_logo = get_sub_field('flattrak_testimonial_logo');
                        $add_testimonial_content = get_sub_field('add_testimonial_content');
                        $author_name = get_sub_field('name');
                        $company_name = get_sub_field('company');
                        $location_name = get_sub_field('location');
                    ?>
                        <div class="items">
                            <div class="testi-content">
                                <?php if (!empty($flattrak_testimonial_logo)) : ?>
                                    <img class="quote-img" src="<?php echo esc_url($flattrak_testimonial_logo['url']); ?>" alt="<?php echo esc_attr($flattrak_testimonial_logo['alt']); ?>" />
                                <?php endif; ?>
                                <?php if (!empty($add_testimonial_content)) : ?><div><?php echo $add_testimonial_content; ?></div><?php endif; ?>
                                <?php if (!empty($author_name)) : ?><span class="author-name"><?php echo $author_name; ?></span><?php endif; ?>
                                <?php if (!empty($company_name)) : ?><span class="company-name"><?php echo $company_name; ?></span><?php endif; ?>
                                <?php if (!empty($location_name)) : ?><span class="location-name"><?php echo $location_name; ?></span><?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>