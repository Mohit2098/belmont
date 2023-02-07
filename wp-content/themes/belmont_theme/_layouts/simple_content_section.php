<?php
$section_heading = get_sub_field('section_heading');
$select_heading_type = get_sub_field('select_heading_type');
$section_content = get_sub_field('section_content');
$select_section_width = get_sub_field('select_section_width');
$upload_logo = get_sub_field('upload_logo');
?>
<section class="simple-content-section pt-70 pb-70 <?php echo $select_section_width; ?> <?php echo $select_heading_type; ?>">
    <div class="container">
        <div class="content-inner">
            <?php if($section_heading != ''): ?><h2 class="h3"><?php echo $section_heading; ?></h2><?php endif; ?>
            <?php if($upload_logo != ''): ?><img src="<?php echo $upload_logo['url']; ?>" alt="<?php echo $upload_logo['alt']; ?>" /><?php endif; ?>
            <?php if($section_content):?><?php echo $section_content; ?><?php endif; ?>
        </div>
    </div>
</section>