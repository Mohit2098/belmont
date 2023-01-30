    <footer class="global-footer">
        <nav aria-label="<?php _e( 'Footer Navigation', 'wpbp-theme' ); ?>">
            <?php wp_nav_menu( array( 'container_class' => 'menu-footer', 'theme_location' => 'footer_menu' ) ); ?>
        </nav>
        <?php get_search_form(); ?>
    </footer>
    <?php wp_footer(); ?>
    </body>
</html>
