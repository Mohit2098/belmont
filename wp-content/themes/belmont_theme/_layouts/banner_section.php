<section class="banner-section">
    <div class=" container">
        <?php if( have_rows('slides') ):?>
         <div class="banner-slider">
        <?php while( have_rows('slides') ): the_row();
                  $content_heading = get_sub_field('heading');
                  $content_description = get_sub_field('sub_heading');
                  $content_image = get_sub_field('image');
                  $button_link = get_sub_field('button_link'); 
               ?>
               <div>
                     <?php
                     if(!empty($content_heading)){
                        echo "<h1>".$content_heading."</h1>";
                     }?>
                  <?php if(!empty($content_image)) {?>
                     <a href="#"><img src="<?php echo esc_url($content_image['url']); ?>" alt="<?php echo esc_attr($content_image['alt']); ?>"/></a>
                     <?php }?>
                <?php
               if(!empty($content_description)){ 
                  echo "<div>".$content_description."</div>";
               }
               ?>
             </div>
        <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>