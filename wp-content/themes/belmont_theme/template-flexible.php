<?php

/*Template Name: Flexible Content*/

get_header();
if (have_rows('content')) :
    $block_count = 1;
    while (have_rows('content')) : the_row();
        ACF_Layout::render(get_row_layout(), $block_count);
        $block_count++;
    endwhile;
endif;
get_footer();?>