<?php if (have_rows('add_slides')) : ?>
   <section class="hero-slider">
      <div class="hero-slider-bl">
         <?php while (have_rows('add_slides')) : the_row();
            $slide_heading = get_sub_field('heading');
            $slide_description = get_sub_field('description');
            $slide_cta = get_sub_field('add_cta');
            $content_alignment = get_sub_field('content_alignment');
            $content_background_color = get_sub_field('content_background_color');
            $column_image = get_sub_field('upload_column_image');
            $slide_background_image = get_sub_field('slide_background_image');
         ?>
            <div class="items-hero <?php echo esc_attr($content_background_color); ?> <?php echo $content_alignment == 'left' ? 'align-left' : 'align-right'; ?>">
               <?php if (!empty($slide_background_image)) : ?>
                  <img class="banner-back" src="<?php echo esc_url($slide_background_image['url']); ?>" alt="<?php echo esc_attr($slide_background_image['alt']); ?>" />
               <?php endif; ?>
               <div class="container">
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="caption-wrap">
                           <?php if (!empty($slide_heading)) : ?><h1><?php echo $slide_heading; ?></h1><?php endif; ?>
                           <?php if (!empty($slide_description)) : ?><div><?php echo $slide_description; ?></div><?php endif; ?>
                           <?php if (!empty($slide_cta)) : ?>
                              <?php
                              $button_url = $slide_cta['url'];
                              $button_title = $slide_cta['title'];
                              $button_target = $slide_cta['target'] ? $slide_cta['target'] : '_self';
                              ?>
                              <a class="btn-custom outline-yellow" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>">
                                 <?php echo $button_title; ?>
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