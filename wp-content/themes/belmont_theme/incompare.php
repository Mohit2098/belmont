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
        </div>
<?php
    endfor;
} ?>
<?php get_footer(); ?>