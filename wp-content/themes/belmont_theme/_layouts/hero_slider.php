   <section class="Hero-slider">
      <div class="container">
         <?php $content_alignment = get_sub_field('content_alignment'); ?>
         <?php if (have_rows('add_slides')) : ?>
            <div class="hero-slider-cl">
               <?php while (have_rows('add_slides')) : the_row();
                  $slide_heading = get_sub_field('heading');
                  $slide_description = get_sub_field('description');
                  $slide_cta = get_sub_field('add_cta');
                  if ($slide_cta) {
                     $button_url = $slide_cta['url'];
                     $button_title = $slide_cta['title'];
                     $button_target = $slide_cta['target'] ? $slide_cta['target'] : '_self';
                  }
                  $column_image = get_sub_field('upload_column_image');
                  $slide_background_image = get_sub_field('slide_background_image');
               ?>
                  <div class="wrapper">
                     <div>
                     <?php if (!empty($slide_background_image )) { ?>
                        <img src="<?php echo esc_url($slide_background_image ['url']); ?>" alt="<?php echo esc_attr($slide_background_image ['alt']); ?>" />
                     <?php } ?>
                     </div>
                  <div class="select-drop-down <?php $content_alignment == 'left' ? 'align-left' : 'align-right'; ?>">
                     <?php if (!empty($slide_heading)) {
                        echo "<h1>" . $slide_heading . "</h1>";
                     } ?>
                     <?php if (!empty($slide_description)) {
                        echo "<div>" . $slide_description . "</div>";
                     } ?>
                     <?php if (!empty($slide_cta)) { ?>
                        <a class="slide-button" href="<?php echo $button_url;?>" target="<?php echo $button_target; ?>">
                           <?php echo $button_title; ?>
                        </a>
                     <?php } ?>
                     <?php if (!empty($column_image)) { ?>
                        <img src="<?php echo esc_url($column_image['url']); ?>" alt="<?php echo esc_attr($column_image['alt']); ?>" />
                     <?php } ?>
                  </div>
                  </div>
                  
               <?php endwhile; ?>
            </div>
         <?php endif; ?>
      </div>
   </section>