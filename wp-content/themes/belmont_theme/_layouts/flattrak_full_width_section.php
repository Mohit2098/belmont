<?php
$logo = get_sub_field('logo');
$add_cta = get_sub_field('add_cta');
?>
<section class="flattrak-full-width-section">
    <div class="container">
        <?php if (!empty($logo)) : ?>
            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
        <?php endif; ?>
        <?php if (!empty($add_cta)) :
            $button_target = $add_cta['target'] ? $add_cta['target'] : '_self'; ?>
            <a href="<?php echo $add_cta['url']; ?>" target="<?php echo $button_target; ?>">
                <?php echo $add_cta['title']; ?>
            </a>
        <?php endif; ?>
    </div>
</section>