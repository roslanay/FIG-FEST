<?php
/**
 * Template Name: All Post Types Sorted by Custom Field Date
 */

get_header(); ?>

<div class="container">

    <?php
    $custom_date_field = 'Date';

    $args = array(
        'post_type'      => get_post_types(array('public' => true)),
        'posts_per_page' => -1,
        'meta_key'       => $custom_date_field,
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_type'      => 'DATE',
    );

    $custom_posts = new WP_Query($args);

    if ($custom_posts->have_posts()) :
        while ($custom_posts->have_posts()) : $custom_posts->the_post(); 
        
                // Get the uploaded SVG file from ACF
                $svg_file = get_field('svg_icon'); // ACF File field

                if (!empty($svg_file) && isset($svg_file['url'])) {
                    $svg_path = esc_url($svg_file['url']); // Use uploaded file URL
                } else {
                    $svg_path = get_template_directory_uri() . '/assets/svg/default.svg'; // Fallback default
                }
    ?>
        
            <div class="post-item">
                <h2><?php the_title(); ?></h2>

                <!-- Display the uploaded SVG -->
                <img class="svg-title" src="<?php echo $svg_path; ?>" alt="Post Icon">

                <div class="custom-fields">
                    <?php
                

                    $date_opening = get_field('date_opening'); 
                    if ($date_opening) {
                        echo '<p>' . esc_html($date_opening) . '</p>';
                    }




                    $url_field = get_field('tickets'); // Field that contains raw HTML (including <a> tag)
                    if ($url_field) {
                        echo $url_field; // Output raw HTML directly
                    }



                    $custom_date = get_field($custom_date_field);
                    if ($custom_date) {
                        echo '<p class="date">' . esc_html($custom_date) . '</p>';
                    }

                    $fields = get_field_objects();
                    if ($fields) {
                        foreach ($fields as $field_name => $field) {
                            if ($field_name !== $custom_date_field) { 
                                if ($field['type'] === 'wysiwyg') {
                                    echo $field['value']; 
                                } else {
                                    echo esc_html($field['value']);
                                }
                                echo '</p>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        
        <?php endwhile;
    else : ?>
        <p>No posts found.</p>
    <?php endif;

    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>
