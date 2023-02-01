   <section class="Hero-slider">
      <div class=" container">
         <?php $content_alginment = get_sub_field('content_alignment'); ?>
         <?php if (have_rows('slides')) : ?>
            <div class="hero-slider-cl">
               <?php while (have_rows('slides')) : the_row();
                  $hero_heading = get_sub_field('heading');
                  $hero_sub_heading = get_sub_field('sub_heading');
                  $hero_button = get_sub_field('button');
                  if ($hero_button) {
                     $button_url = $hero_button['url'];
                     $button_title = $hero_button['title'];
                     $button_target = $hero_button['target'] ? $hero_button['target'] : '_self';
                  }
                  $hero_image = get_sub_field('image');
               ?>
                  <div class="select-drop-down <?php $content_alginment == 'left' ? 'align-left' : 'align-right'; ?>">
                     <?php if (!empty($hero_heading)) {
                        echo "<h1>" . $hero_heading . "</h1>";
                     } ?>
                     <?php if (!empty($hero_sub_heading)) {
                        echo "<div>" . $hero_sub_heading . "</div>";
                     } ?>
                     <?php if (!empty($hero_button)) { ?>
                        <a class="button" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>">
                           <?php echo $button_title; ?>
                        </a>
                     <?php } ?>
                     <?php if (!empty($hero_image)) { ?>
                        <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>" />
                     <?php } ?>
                  </div>
               <?php endwhile; ?>
            </div>
         <?php endif; ?>
      </div>
   </section>