    <footer class="global-footer bl-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-logo">
                        <?php $site_logo = get_field('site_logo', 'option'); ?>
                        <?php if (!empty($site_logo)) : ?>
                            <a href="<?php echo home_url('/'); ?>" rel="home"><img src="<?php echo esc_url($site_logo['url']); ?>" alt="<?php echo esc_attr($site_logo['alt']); ?>" /></a>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- /col -->
                <div class="col-lg-8">
                    <nav aria-label="<?php _e('Footer Navigation', 'btrailers-theme'); ?>">
                        <?php wp_nav_menu(array('container_class' => 'menu-footer', 'theme_location' => 'footer_menu')); ?>
                    </nav>
                </div>
                <!-- /col -->
                <div class="col-12">
                    <?php $copyright_text = get_field('copyright_text', 'option'); ?>
                    <div class="footer-copyright">
                        <?php if (!empty($copyright_text)) : ?><?php echo $copyright_text; ?><?php endif; ?>
                    </div>
                </div>
                <!-- /col -->
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
    </body>

    </html>