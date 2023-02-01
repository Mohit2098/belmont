    <footer class="global-footer">
        <div class="footer-logo">
            <?php $site_logo = get_field('site_logo', 'option'); ?>
            <?php if (!empty($site_logo)) : ?>
                <a href="<?php echo home_url('/'); ?>" rel="home"><img src="<?php echo esc_url($site_logo['url']); ?>" alt="<?php echo esc_attr($site_logo['alt']); ?>" /></a>
            <?php endif; ?>
        </div>
        <nav aria-label="<?php _e('Footer Navigation', 'wpbp-theme'); ?>">
            <?php wp_nav_menu(array('container_class' => 'menu-footer', 'theme_location' => 'footer_menu')); ?>
        </nav>
        <?php $copyright_text = get_field('copyright_text', 'option'); ?>
        <div class="footer-copyright">
            <?php if (!empty($copyright_text)) {
                echo $copyright_text;
            };?>
        </div>
    </footer>
    <?php wp_footer(); ?>
    </body>

    </html>