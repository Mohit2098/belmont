<?php
/* Template Name: Comparison Results
*
*/
get_header();
?>
<?php if (isset($_COOKIE['trailerCookies'])) :
    $trailerCookie = $_COOKIE['trailerCookies'];
    $cookieArr = explode(",", $trailerCookie);
    $rowcount = count($cookieArr);
?>
    <section class="in-compare-section bl-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-medium"><?php _e('Comparison results', 'btrailers-theme'); ?></h2>
                    <div class="table-wrap-comparison">
                        <table class="comparison-table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th> </th>
                                    <?php if (!empty($cookieArr)) {
                                        for ($i = 0; $i < count($cookieArr); $i++) :
                                            $cookieValue = base64_decode($cookieArr[$i]);
                                            $featured = get_field('trailer_featured_image', $cookieValue);
                                            $terms = get_the_terms($cookieValue, 'trailers');
                                            $termLink = '';
                                            $tabID = '';

                                            if ($terms[0]->parent != 0) {
                                                $termLink = get_term_link($terms[0]->parent);
                                                $tabID = $terms[0]->term_id;
                                            } else {
                                                $termLink = get_term_link($terms[1]->parent);
                                                $tabID = $terms[1]->term_id;
                                            }
                                            $postLink = $termLink;
                                            $activeClass = (isset($_COOKIE['tabCookie']) && base64_decode($_COOKIE['tabCookie'])) == $tabID ? 'active' : '';
                                            echo '<th class="img-head"><a href="' . $postLink . '" data-tabid="' .base64_encode($tabID) . '" class="tabContentCl' . $activeClass . '"> <img class="comp-trailer" width="150" height="100" src="' . esc_url($featured['url']) . '" alt="'.__($featured['alt']).'" /> <span>' . get_the_title($cookieValue) . '</span> </a> </th>';
                                    ?>
                                    <?php endfor;
                                    } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($rowcount)) : ?>
                                    <tr>
                                        <td class="yellow-bg-td" colspan="<?php echo $rowcount + 1; ?>"><div class="inner-td-wrap"> <?php _e('Trailers Specifications', 'btrailers-theme'); ?></div></td>
                                    </tr>
                                <?php endif; ?>

                                <!-- Trailer Attribute  -->
                                <?php if (!empty($rowcount)) : ?>
                                    <tr>
                                        <td class="gray-lt-bg-td" colspan="<?php echo $rowcount + 1; ?>"><div class="inner-td-wrap"> <?php _e('Trailer Attribute', 'btrailers-theme'); ?> </div></td>
                                    </tr>
                                <?php endif;

                                if (!empty($cookieArr)) {
                                    $titles = array();
                                    $details = array();

                                    for ($i = 0; $i < count($cookieArr); $i++) {
                                        $cookieValue = base64_decode($cookieArr[$i]);
                                        $add_attribute_rows = get_field('add_trailer_attribute', $cookieValue);

                                        foreach ($add_attribute_rows as $add_attribute_row) {
                                            $add_attribute_title = $add_attribute_row['add_attribute_title'];
                                            $add_attribute_detail = $add_attribute_row['add_attribute_detail'];

                                            if (!in_array($add_attribute_title, $titles)) {
                                                array_push($titles, $add_attribute_title);
                                            }

                                            $details[$i][$add_attribute_title] = $add_attribute_detail;
                                        }
                                    }
                                    foreach ($titles as $title) {
                                        echo '<tr>';
                                        echo '<td>' . __($title) . '</td>';

                                        for ($i = 0; $i < count($cookieArr); $i++) {
                                            $detail = isset($details[$i][$title]) ? $details[$i][$title] : '-';
                                            echo '<td>' . __($detail) . '</td>';
                                        }
                                        echo '</tr>';
                                    }
                                }
                                ?>

                                <!-- Standard features -->
                                <?php if (!empty($rowcount)) : ?>
                                    <tr>
                                        <td class="gray-lt-bg-td" colspan="<?php echo $rowcount + 1; ?>"> <div class="inner-td-wrap"> <?php _e('Standard Features', 'btrailers-theme'); ?></div></td>
                                    </tr>
                                <?php endif;

                                if (!empty($cookieArr)) {
                                    echo '<tr>';
                                    echo '<td>' . __('Standard Features', 'btrailers-theme') . '</td>';
                                    foreach ($cookieArr as $trailerId) {
                                        $cookieValue = base64_decode($trailerId);
                                        $features = get_field('add_standard_features',$cookieValue);
                                        $trailer_standard_features = array();
                                        foreach ($features as $feature) {
                                            array_push($trailer_standard_features, $feature['add_feature']);
                                        }
                                        echo '<td><ul>';
                                        foreach ($trailer_standard_features as $feature) {
                                            echo '<li>' . __($feature) . '</li>';
                                        }
                                        echo '</ul></td>';
                                    }
                                    echo '</tr>';
                                }
                                ?>

                                <!-- Aditional optional -->
                                <?php if (!empty($rowcount)) : ?>
                                    <tr>
                                        <td class="gray-lt-bg-td" colspan="<?php echo $rowcount + 1; ?>"> <div class="inner-td-wrap">  <?php _e('Additional Options', 'btrailers-theme'); ?></div></td>
                                    </tr>
                                <?php endif;

                                if (!empty($cookieArr)) {
                                    echo '<tr>';
                                    echo '<td>' . __('Additional Options', 'btrailers-theme') . '</td>';
                                    foreach ($cookieArr as $trailerId) {
                                        $cookieValue = base64_decode($trailerId);
                                        $options = get_field('add_additional_options', $cookieValue);
                                        $trailer_additional_options = array();
                                        foreach ($options as $option) {
                                            array_push($trailer_additional_options, $option['add_options']);
                                        }
                                        echo '<td><ul>';
                                        foreach ($trailer_additional_options as $option) {
                                            echo '<li>' . __($option) . '</li>';
                                        }
                                        echo '</ul></td>';
                                    }
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
endif; ?>
<?php get_footer(); ?>