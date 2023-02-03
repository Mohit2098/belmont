<?php
$section_heading = get_sub_field('section_heading');
$select_heading_type = get_sub_field('select_heading_type');
$section_content = get_sub_field('section_content');
$select_section_width = get_sub_field('select_section_width');
$upload_logo = get_sub_field('upload_logo');
?>
<div class="simple-content-section <?php echo $select_section_width; ?> <?php echo $select_heading_type; ?>">
<?php if($section_heading != '' || $upload_logo != '' ): ?><div class="heading-logo-wrap"><?php endif; ?>
    <?php if($section_heading != ''): ?><h2><?php echo $section_heading; ?></h2><?php endif; ?>
    <?php if($upload_logo != ''): ?><img src="<?php echo $upload_logo['url']; ?>" alt="<?php echo $upload_logo['alt']; ?>" /><?php endif; ?>
<?php if($section_heading != '' || $upload_logo != '' ): ?></div><?php endif; ?>
<?php if($section_content):?><div class="content-wrapper"><?php echo $section_content; ?></div><?php endif; ?>
</div>

<section class="simple-content-section">
    <div class="container">
        <div class="content-inner">
            <h2 class="h3">PROVEN PERFORMANCE </h2>
            <p>For over 15 years, the trailers made by Belmont have been tried and proven on highways, country roads, and wherever else they have gone to get the job done. we Also stand behind our product with one of the best warranties in the industry. For over 15 years, the trailers made by Belmont have been tried and proven on highways, country roads, and wherever else they have gone to get the job done. we Also stand behind our product with one of the best warranties in the industry. For over 15 years, the trailers made by Belmont have been tried and proven on highways, country roads, and wherever else they have gone to get the job done. we Also stand behind our product with one of the best warranties in the industry.</p>
        </div>
    </div>
</section>