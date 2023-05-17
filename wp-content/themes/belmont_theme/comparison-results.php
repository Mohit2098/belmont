<?php
/* Template Name: Comparison Results
*
*/

get_header();
?>
<?php if (isset($_COOKIE['trailerCookies'])) :
    $trailerCookie = $_COOKIE['trailerCookies'];
    $cookieArr = explode(",", $trailerCookie);
    $count = count($cookieArr);
?>
    <section class="in-compare-section bl-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-medium">Comparison results</h2>
                    <table class="comparison-table" cellspacing="0">
                        <thead>
                            <tr>
                                <th> <input type="checkbox" name="high"> Highlight Differences</th>
                                <?php for ($count = 0; $count < count($cookieArr); $count++) :
                                    $featured = get_field('trailer_featured_image', $cookieArr[$count]);
                                    $terms = get_the_terms($cookieArr[$count], 'trailers');
                                    $termLink = '';
                                    if ($terms[0]->parent != 0) {
                                        $termLink = get_term_link($terms[0]->parent);
                                    } else {
                                        $termLink = get_term_link($terms[1]->parent);
                                    }
                                ?>
                                    <th class="img-head"><a href="<?php echo $termLink; ?>"> <img class="comp-trailer" width="150" height="100" src="<?php echo $featured['url'] ?>" /> <span><?php echo get_the_title($cookieArr[$count]); ?></span> </a> </th>
                                <?php endfor; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="gray-bg-td" colspan="<?php echo $count + 1; ?>">Trailers Specifications</td>
                            </tr>

                            <!-- Trailer Attribute  -->

                            <tr>
                                <td class="gray-lt-bg-td" colspan="<?php echo $count + 1; ?>">Trailer Attribute</td>
                            </tr>
                            <?php
                            $titles = array();
                            $details = array();

                            for ($i = 0; $i < count($cookieArr); $i++) {
                                $add_attribute_rows = get_field('add_trailer_attribute', $cookieArr[$i]);

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
                                echo '<td>' . $title . '</td>';

                                for ($i = 0; $i < count($cookieArr); $i++) {
                                    $detail = isset($details[$i][$title]) ? $details[$i][$title] : '-';
                                    echo '<td>' . $detail . '</td>';
                                }
                                echo '</tr>';
                            }
                            ?>

                            <!-- Standard features -->

                            <tr>
                                <td class="gray-lt-bg-td" colspan="<?php echo $count + 1; ?>">Standard Features</td>
                            </tr>

                            <?php
                            echo '<tr>';
                            echo '<td>Standard Features</td>';
                            foreach ($cookieArr as $trailerId) {
                                $features = get_field('add_standard_features', $trailerId);
                                $trailer_standard_features = array();
                                foreach ($features as $feature) {
                                    array_push($trailer_standard_features, $feature['add_feature']);
                                }
                                echo '<td><ul>';
                                foreach ($trailer_standard_features as $feature) {
                                    echo '<li>' . $feature . '</li>';
                                }
                                echo '</ul></td>';
                            }
                            echo '</tr>';
                            ?>

                            <!-- Aditional optional -->

                            <tr>
                                <td class="gray-lt-bg-td" colspan="<?php echo $count + 1; ?>">Additional Options</td>
                            </tr>

                            <?php
                            echo '<tr>';
                            echo '<td>Additional Options</td>';
                            foreach ($cookieArr as $trailerId) {
                                $options = get_field('add_additional_options', $trailerId);
                                $trailer_additional_options = array();
                                foreach ($options as $option) {
                                    array_push($trailer_additional_options, $option['add_options']);
                                }
                                echo '<td><ul>';
                                foreach ($trailer_additional_options as $option) {
                                    echo '<li>' . $option . '</li>';
                                }
                                echo '</ul></td>';
                            }
                            echo '</tr>';
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?php
endif; ?>
<?php get_footer(); ?>