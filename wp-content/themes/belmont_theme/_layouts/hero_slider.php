<?php if (have_rows('add_slides')) : ?>
   <section class="hero-slider">
      <div class="hero-slider-bl">
         <?php
         $i = 0;
         while (have_rows('add_slides')) : the_row();
            $i++;
            $slide_heading = get_sub_field('heading');
            $slide_description = get_sub_field('description');
            $slide_cta = get_sub_field('add_cta');
            $content_alignment = get_sub_field('content_alignment');
            $text_color = get_sub_field('text_color');
            $slide_desktop_image = get_sub_field('slide_desktop_image');
            $slide_mobile_image = get_sub_field('slide_mobile_image');
         ?>
            <div class="items-hero <?php echo esc_attr($text_color) ?> <?php if ($i != 1) : ?>
            <?php echo $content_alignment; ?><?php endif; ?>">
               <?php if (!empty($slide_desktop_image)) : ?>
                  <img class="banner-back" src="<?php echo esc_url($slide_desktop_image['url']); ?>" alt="<?php echo esc_attr($slide_desktop_image['alt']); ?>" />
               <?php endif; ?>
               <?php if (!empty($slide_mobile_image)) : ?>
                  <img class="banner-back-mobile" src="<?php echo esc_url($slide_mobile_image['url']); ?>" alt="<?php echo esc_attr($slide_mobile_image['alt']); ?>" />
               <?php endif; ?>
               <div class="container">
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="caption-wrap">
                           <?php if (!empty($slide_heading)) : ?><h1><?php echo $slide_heading; ?></h1><?php endif; ?>
                           <?php if (!empty($slide_description)) : ?><div><?php echo $slide_description; ?></div><?php endif; ?>
                           <?php if (!empty($slide_cta)) :
                              $button_target = $slide_cta['target'] ? $slide_cta['target'] : '_self'; ?>
                              <a class="btn-custom outline-yellow" href="<?php echo $slide_cta['url']; ?>" target="<?php echo $button_target; ?>">
                                 <?php echo $slide_cta['title']; ?>
                              </a>
                           <?php endif; ?>
                        </div>
                     </div>
                     <!-- /col -->
                     <div class="col-lg-6">
                        <?php if (!empty($column_image)) : ?>
                           <img src="<?php echo esc_url($column_image['url']); ?>" alt="<?php echo esc_attr($column_image['alt']); ?>" />
                        <?php endif; ?>
                     </div>
                     <!-- /col -->
                  </div>
               </div>
               <!-- /container -->
            </div>
            <!-- /items-hero -->
         <?php endwhile; ?>
      </div>
   </section>
<?php endif; ?>