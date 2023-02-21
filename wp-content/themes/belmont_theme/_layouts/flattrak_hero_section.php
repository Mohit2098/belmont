<?php
$hero_background_image = get_sub_field('hero_background_image');
$hero_cta = get_sub_field('hero_cta');
?>
<section class="flattrak-hero-section">
        <?php if (!empty($hero_background_image)) : ?>
            <div class="hero-img">
            <img src="<?php echo esc_url($hero_background_image['url']); ?>" alt="<?php echo esc_attr($hero_background_image['alt']); ?>" />
             </div>
        <?php endif;
        if (!empty($hero_cta)) :
            $button_target = $hero_cta['target'] ? $hero_cta['target'] : '_self'; ?>
            <a href="<?php echo esc_url($hero_cta['url']); ?>" class="btn-custom" target="<?php echo $button_target; ?>">
                <?php echo $hero_cta['title']; ?>
            </a>
        <?php endif; ?>
</section>