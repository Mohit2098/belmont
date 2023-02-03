<section class="hero-slider">
         <?php if (have_rows('add_slides')) : ?>
            <div class="hero-slider-cl">
               <?php while (have_rows('add_slides')) : the_row();
                  $slide_heading = get_sub_field('heading');
                  $slide_description = get_sub_field('description');
                  $slide_cta = get_sub_field('add_cta');
                  $content_alignment = get_sub_field('content_alignment');
                  $content_background_color = get_sub_field('content_background_color');
                  $column_image = get_sub_field('upload_column_image');
                  $slide_background_image = get_sub_field('slide_background_image');
               ?>
                  <div class="hero_wrapper">
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
                     <?php if (!empty($slide_cta)) {
                        $button_url = $slide_cta['url'];
                        $button_title = $slide_cta['title'];
                        $button_target = $slide_cta['target'] ? $slide_cta['target'] : '_self';
                     ?>
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


   <div class="hero-slider-bl">
      <div class="items-hero">
          <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/dummy.png" class="banner-back" alt="">    
          <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <div class="caption-wrap">
                        <h1>proven performance</h1>
                        <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form</p>
                        <a href="#" class="btn-custom outline-yellow">All trailer models</a>
                  </div>
               </div>
               <!-- /col -->
               <div class="col-lg-6">
                  <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/trailer.png" alt="">   
               </div>
               <!-- /col -->
            </div>
          </div>        
      </div>
      <!-- /items -->
      <div class="items-hero">
          <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/dummy.png" class="banner-back" alt="">    
          <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <div class="caption-wrap">
                        <h1>proven performance</h1>
                        <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form</p>
                        <a href="#" class="btn-custom outline-yellow">All trailer models</a>
                  </div>
               </div>
               <!-- /col -->
               <div class="col-lg-6">
                  <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/trailer.png" alt="">   
               </div>
               <!-- /col -->
            </div>
          </div>        
      </div>
      <!-- /items -->
      <div class="items-hero">
          <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/dummy.png" class="banner-back" alt="">    
          <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <div class="caption-wrap">
                        <h1>proven performance</h1>
                        <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form</p>
                        <a href="#" class="btn-custom outline-yellow">All trailer models</a>
                  </div>
               </div>
               <!-- /col -->
               <div class="col-lg-6">
                  <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/trailer.png" alt="">   
               </div>
               <!-- /col -->
            </div>
          </div>        
      </div>
      <!-- /items -->
      <div class="items-hero">
          <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/dummy.png" class="banner-back" alt="">    
          <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <div class="caption-wrap">
                        <h1>proven performance</h1>
                        <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form</p>
                        <a href="#" class="btn-custom outline-yellow">All trailer models</a>
                  </div>
               </div>
               <!-- /col -->
               <div class="col-lg-6">
                  <img src="<?php echo get_stylesheet_directory_uri() ?>/_images/trailer.png" alt="">   
               </div>
               <!-- /col -->
            </div>
          </div>        
      </div>
      <!-- /items -->
   </div>

   </section>