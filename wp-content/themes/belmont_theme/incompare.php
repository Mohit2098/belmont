<?php
/* Template Name: In compare Template
*
*/

get_header();
?>
<?php
if (isset($_COOKIE['trailerCookies'])) {
    $trailerCookie = $_COOKIE['trailerCookies'];
    $cookieArr = explode(",", $trailerCookie);
    array_pop($cookieArr);

    // Add counter variable
    $count = 0;
    echo ' <input type="checkbox" id="">';
    echo '<div class="row">';
    for ($count = 0; $count < count($cookieArr); $count++) : ?>

        <div class="container">
            <?php $featured = get_field('trailer_featured_image', $cookieArr[$count]); ?>
            <img src="<?php echo $featured['url'] ?>" style="height: 100px; width: 100px;">

            <div class="col-sm">
                <!-- additional features -->
                <h2>Additional Features </h2>
                <div class="additional-features">
                    <?php
                    if (have_rows('add_trailer_attribute', $cookieArr[$count])) : ?>
                        <div class="table-wrap d-flex w-100">
                            <?php while (have_rows('add_trailer_attribute', $cookieArr[$count])) : the_row();
                                $add_attribute_title = get_sub_field('add_attribute_title', $cookieArr[$count]);
                                $add_attribute_detail = get_sub_field('add_attribute_detail', $cookieArr[$count]); ?>

                                <div class="entity">
                                    <span class="head"> <?php echo $add_attribute_title; ?> </span>
                                    <span class="value"> <?php echo $add_attribute_detail; ?></span>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php
                    endif; ?>
                </div>
                <!-- additional features -->
            </div>
            <div class="col-md-4">

                <div class="feature-list">
                    <h3><?php _e('Standard Features', 'btrailers-theme'); ?></h3>
                    <?php
                    if (have_rows('add_standard_features', $cookieArr[$count])) :
                        $count_standard_attr = count(get_field('add_standard_features', $cookieArr[$count])); ?>
                        <ul>
                            <?php while (have_rows('add_standard_features', $cookieArr[$count])) : the_row();
                                $add_feature = get_sub_field('add_feature', $cookieArr[$count]); ?>
                                <li><?php echo $add_feature; ?></li>
                        <?php endwhile;
                        endif; ?>

                </div>

            </div>
        </div>
<?php
    endfor;
} ?>
<?php get_footer(); ?>