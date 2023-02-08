<?php
$add_testimonial_content = get_sub_field('add_testimonial_content');
$author_name = get_sub_field('name');
$company_name = get_sub_field('company');
$location_name = get_sub_field('location');
?>
<section class="flattrak-testimonial-section">
    <div class="container">
        <?php if (!empty($add_testimonial_content)) : ?><h1><?php echo $add_testimonial_content; ?></h1><?php endif; ?>
        <?php if (!empty($author_name)) : ?><span class="author-name"><?php echo $author_name; ?></span><?php endif; ?>
        <?php if (!empty($company_name)) : ?><span class="company-name"><?php echo $company_name; ?></span><?php endif; ?>
        <?php if (!empty($location_name)) : ?><span class="location-name"><?php echo $location_name; ?></span><?php endif; ?>
    </div>
</section>