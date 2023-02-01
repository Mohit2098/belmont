   <section class="banner-section">
      <div class=" container">
         <?php if( have_rows('slides') ):?>
            <div class="banner-slider">
               <?php while( have_rows('slides') ): the_row();
                     $banner_heading = get_sub_field('heading');
                     $banner_sub_heading = get_sub_field('sub_heading');
                     $banner_button_link = get_sub_field('button_link'); 
                     $banner_image = get_sub_field('image');
                  ?>
                  <div>
                     <?php if(!empty($banner_heading)){
                        echo "<h1>".$banner_heading."</h1>";
                     }?>

                     <?php if(!empty($banner_sub_heading)){ 
                        echo "<div>".$banner_sub_heading."</div>";
                     }?>

                     <?php if(!empty($banner_button_link)){ ?>
                     <?php $button_url = $banner_button_link['url'];
                     $button_title = $banner_button_link['title'];
                     $button_target = $banner_button_link['target']? $banner_button_link['target']:'_self';?>
                     <a class="button" href="<?php echo $button_url?>" target = "<?php echo $button_target?>">
                     <?php echo $button_title;?></a>
                     <?php } ?>

                     <?php if(!empty($banner_image)) {?>
                        <a href="#"><img src="<?php echo esc_url($banner_image['url']); ?>" 
                        alt="<?php echo esc_attr($banner_image['alt']); ?>"/></a>
                     <?php }?>
                  </div>
               <?php endwhile;?>
            </div>
         <?php endif;?>
      </div>
   </section>