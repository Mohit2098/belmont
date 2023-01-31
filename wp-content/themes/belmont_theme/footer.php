    <footer class="global-footer">
    <?php $footer_logo = get_field('footer_logo', 'option'); ?>
        <?php if(!empty($footer_logo)):?>
         <img src="<?php echo esc_url($footer_logo['url']); ?>" alt="<?php echo esc_attr($footer_logo['alt']); ?>"/>
      <?php endif;?>
        <nav aria-label="<?php _e( 'Footer Navigation', 'wpbp-theme' ); ?>">
            <?php wp_nav_menu( array( 'container_class' => 'menu-footer', 'theme_location' => 'footer_menu' ) ); ?>
        </nav>
        <?php get_search_form(); ?>
    </footer>
    <?php wp_footer(); ?>
    </body>
</html>
