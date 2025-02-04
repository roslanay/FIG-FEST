<?php
/**
 * Template Name: All Post Types Sorted by Custom Field Date
 *     <h1><?php the_title(); ?></h1>
 */

get_header(); ?>

<div class="container">

    <?php
    // Set your custom field key (replace 'custom_date_field' with your ACF field key)
    $custom_date_field = 'Date';

    // Query all custom post types, sorting by the custom field date
    $args = array(
        'post_type'      => get_post_types(array('public' => true)), // Include all public post types
        'posts_per_page' => -1, // Retrieve all posts
        'meta_key'       => $custom_date_field, // The custom field to sort by
        'orderby'        => 'meta_value', // Order by the custom field value
        'order'          => 'ASC', // Ascending order
        'meta_type'      => 'DATE', // Specify the meta type as a date
    );

    $custom_posts = new WP_Query($args);

    if ($custom_posts->have_posts()) :
        while ($custom_posts->have_posts()) : $custom_posts->the_post(); ?>
        
            <div class="post-item">
                <h2><?php the_title(); ?></h2>
                

                <div class="custom-fields">
                    <?php

                    $date_opening = get_field('date_opening'); // Get the 'date_opening' field
                    if ($date_opening) {
                        // Output the date in your desired format
                        echo '<p> ' . esc_html($date_opening) . '</p>';
                    }
                    // Display the custom field date
                    $custom_date = get_field($custom_date_field);
                    if ($custom_date) {
                        echo '<p class="date"> ' . esc_html($custom_date) . '</p>';
                        
                    }

                    // Fetch and display all other custom fields rendering WYSIWYG raw
                    $fields = get_field_objects();
                    if ($fields) {
                        foreach ($fields as $field_name => $field) {
                            if ($field_name !== $custom_date_field) { // Skip the custom date field to avoid redundancy

                                // Check if the field is a WYSIWYG field
                                if ($field['type'] === 'wysiwyg') {
                                    // Output raw HTML content for WYSIWYG field without escaping
                                    echo $field['value']; // This will render the HTML content
                                } else {
                                    // For non-WYSIWYG fields, you can safely echo them directly if they don't contain HTML
                                    echo $field['value'];
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