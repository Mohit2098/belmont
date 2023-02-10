<section class="flattrak-testimonial">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 testimonial-slider">
                <?php if (have_rows('flattrak_testimonial_content')) : ?>
                    <?php
                    while (have_rows('flattrak_testimonial_content')) : the_row();
                        $add_testimonial_content = get_sub_field('add_testimonial_content');
                        $author_name = get_sub_field('name');
                        $company_name = get_sub_field('company');
                        $location_name = get_sub_field('location');
                    ?>
                        <div class="testi-content">
                            <?php if (!empty($add_testimonial_content)) : ?><div><?php echo $add_testimonial_content; ?></div><?php endif; ?>
                            <?php if (!empty($author_name)) : ?><span class="author-name"><?php echo $author_name; ?></span><?php endif; ?>
                            <?php if (!empty($company_name)) : ?><span class="company-name"><?php echo $company_name; ?></span><?php endif; ?>
                            <?php if (!empty($location_name)) : ?><span class="location-name"><?php echo $location_name; ?></span><?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>