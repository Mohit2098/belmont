<?php
$section_heading = get_sub_field('section_heading');
$select_heading_type = get_sub_field('select_heading_type');
$section_content = get_sub_field('section_content');
$select_section_width = get_sub_field('select_section_width');
$upload_logo = get_sub_field('upload_logo');
$additional_section_id = get_sub_field('additional_section_id');
?>
<section class="simple-content-section pt-70 pb-70 <?php echo $select_section_width; ?><?php echo ($select_heading_type != 'text-medium')? ' '.$select_heading_type: ''; ?><?php echo (!empty($upload_logo))? ' simple-content-w-logo' : ''; ?>" id="<?php echo ($additional_section_id != '')? $additional_section_id : ''; ?>">
    <div class="container">
        <div class="content-inner">
            <div class="heading-logo-wrap">
            <?php if($section_heading != '' && $select_heading_type == "main-heading"): ?><h1><?php echo $section_heading; ?></h1>
            <?php elseif($section_heading != '' && $select_heading_type == "small-heading"): ?><h2 class="h3"><?php echo $section_heading; ?></h2>
            <?php elseif($section_heading != '' && $select_heading_type == "text-medium"): ?><h2 class="h3 <?php echo $select_heading_type; ?>"><?php echo $section_heading; ?></h2><?php endif; ?>
            <?php if(!empty($upload_logo)): ?><img src="<?php echo $upload_logo['url']; ?>" alt="<?php echo $upload_logo['alt']; ?>" /><?php endif; ?>
            </div>
            <?php if($section_content):?><div class="para-content"><?php echo $section_content; ?></div><?php endif; ?>
        </div>
    </div>
</section>