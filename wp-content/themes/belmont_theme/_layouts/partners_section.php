<?php
$section_heading = get_sub_field('section_heading');
$select_partners = get_sub_field('select_partners');
?>
<div class="bl-section partners-section">
    <?php if($section_heading != ''): ?><h2><?php echo $section_heading; ?></h2><?php endif;
    if( $select_partners ): ?>
        <div class="partners-wrapper">
        <?php foreach( $select_partners as $partner ):
            setup_postdata($partner);
            $partner_logo = get_field('partner_logo', $partner->ID); ?>
            <div class="partner-item">
                <a href="<?php echo get_field('partner_link', $partner->ID) ?>" target="_blank"><img src="<?php echo $partner_logo['url'] ?>" alt="<?php echo $partner_logo['alt'] ?>" /></a>
        </div>
        <?php endforeach; ?>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</div>