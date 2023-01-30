<?php

// Started from:
// https://kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
// Updated for accessibility
// use wpbp_pagination(); to display


/**
  * How to use this function

  * For default wordpress loop you can add the pagination function as
  * wpbp_pagination($pages = '', $range = 2,"Posts"); // Posts is title aria label pagination as   * * required e.g. "aria-label=Pagination for Posts"
  * For Custom wordpress loop You will need to pass the query object as
  * wpbp_pagination($additional_loop->max_num_pages, $range = 2,"Custpm Post Type");
*/

function wpbp_pagination($pages = '', $range = 2, $cpt_title)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo '<nav class="wpbp_pagination" aria-labelledby="wpbp_pagination_title"><h2 id="wpbp_pagination_title" class="screen-reader-text">Pagination for '.$cpt_title.'</h2><ul><li><span>Page '.$paged.' of '.$pages.'</span></li>';
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."' aria-label='Go back to the first page'>&laquo; First</a></a>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."' aria-label='Go back to the previous page'>&lsaquo;</a></li>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><span class='current' aria-label='Current page, page ".$i."' aria-current='true'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' aria-label='Goto Page ".$i."' >".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."' aria-label='Next Page'>&rsaquo;</a></li>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."' aria-label='Go to to the last page'>Last &raquo; </a></li>";
         echo "</ul></nav>\n";
     }
}
