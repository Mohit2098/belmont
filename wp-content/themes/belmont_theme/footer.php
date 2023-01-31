    <footer class="global-footer">
    <?php $site_logo = get_field('site_logo', 'option'); ?>
        <?php if(!empty($site_logo)):?>
         <img src="<?php echo esc_url($site_logo['url']); ?>" alt="<?php echo esc_attr($site_logo['alt']); ?>"/>
      <?php endif;?>
        <nav aria-label="<?php _e( 'Footer Navigation', 'wpbp-theme' ); ?>">
            <?php wp_nav_menu( array( 'container_class' => 'menu-footer', 'theme_location' => 'footer_menu' ) ); ?>
        </nav>
        <?php $copyright_text = get_field('copyright_text', 'option');?>
        <?php echo $copyright_text;?>
        <?php get_search_form(); ?>
    </footer>
    <?php wp_footer(); ?>
    </body>
</html>
