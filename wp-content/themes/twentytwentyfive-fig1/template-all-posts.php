<?php
/**
 * Template Name: All Post Types Sorted by Custom Field Date
 */

get_header(); ?>

<div class="container">

    <?php
    $custom_date_field = 'Date'; // Custom field for ordering

    $args = array(
        'post_type'      => get_post_types(array('public' => true)), // Query all public post types
        'posts_per_page' => -1, // Retrieve all posts (no limit)
        'meta_key'       => $custom_date_field, // Order by custom field ('Date')
        'orderby'        => 'meta_value', // Order by the value of the custom field
        'order'          => 'ASC', // Ascending order
        'meta_type'      => 'DATE', // Specify that the custom field is a date
    );

    $custom_posts = new WP_Query($args);

    if ($custom_posts->have_posts()) :
        $post_number = 1; // Initialize post counter
        while ($custom_posts->have_posts()) : $custom_posts->the_post(); ?>
        
            <div class="post-item">
                <div class="title">
                <?php
                
                // Get the SVG file from ACF
                $svg_file = get_field('svg_icon'); // ACF File field for SVG

                if (!empty($svg_file) && isset($svg_file['url'])) {
                    $svg_path = esc_url($svg_file['url']); // Get the uploaded file URL
                    echo '<img class="svg-title" src="' . $svg_path . '" alt="Post Icon"><svg class="hex-dash" width="100%" height="auto" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <polygon points="50 1 95 25 95 75 50 99 5 75 5 25" fill="#F1F0ED" 
                    stroke="#A2A059" stroke-width="1" stroke-linecap="round" stroke-dasharray="0.5,3""/>
                  </svg>';
                } else {
                    $svg_path = get_template_directory_uri() . '/assets/svg/default.svg'; // Fallback default SVG
                    echo '<img class="svg-title" src="' . $svg_path . '" alt="Default Icon"> ';
                }
                ?>

                <!-- Add the post number next to the SVG image -->
                <span class="post-number">(<?php echo $post_number; ?>)</span>


                <h2><?php the_title(); ?></h2>
                </div>


                <div class="custom-fields">
                    <?php
                    // Get all ACF fields for the post
                    $fields = get_field_objects();
                    if ($fields) {
                        // Define the order of fields as they appear in the ACF field group
                        $field_order = array(
                            'type_of_event', // Second field: Date opening
                            'Date', // Second field: Date opening
                            'Time', // Third field: Tickets URL
                            'date_closing', // You can add other fields here in the order you want
                            'location', // You can add other fields here in the order you want
                            'artists', // You can add other fields here in the order you want
                            'participants', // You can add other fields here in the order you want
                            'workshop_lead', // You can add other fields here in the order you want
                            'short_bio', // You can add other fields here in the order you want
                            'spaces_for_participants', // You can add other fields here in the order you want
                            'tickets', // You can add other fields here in the order you want
                            'additional_info', // You can add other fields here in the order you want
                            'facebook', // You can add other fields here in the order you want
                            // Add any other fields as needed
                        );

                        // Loop through the fields in the defined order
                        foreach ($field_order as $field_name) {
                            if (isset($fields[$field_name]) && !empty($fields[$field_name]['value'])) {
                                echo '<p><strong>' . esc_html($fields[$field_name]['label']) . ':</strong> ';

                                $field = $fields[$field_name];

                                switch ($field['type']) {
                                    case 'image':
                                        // Handle image fields
                                        if (!empty($field['value']['url'])) {
                                            echo '<img src="' . esc_url($field['value']['url']) . '" alt="' . esc_attr($field['value']['alt']) . '">';
                                        }
                                        break;

                                    case 'url':
                                        // Handle URL fields (including raw HTML with <a> tag)
                                        echo '<a href="' . esc_url($field['value']) . '" target="_blank">Link</a>';
                                        break;

                                    case 'wysiwyg':
                                        // Handle WYSIWYG (HTML content)
                                        echo $field['value'];
                                        break;

                                    case 'textarea':
                                    case 'text':
                                    case 'number':
                                    case 'email':
                                    case 'tel':
                                        // Handle simple text fields
                                        echo esc_html($field['value']);
                                        break;

                                    default:
                                        // Handle other field types (fallback for any unknown field types)
                                        echo esc_html($field['value']);
                                        break;
                                }

                                echo '</p>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>

        <?php
            $post_number++; // Increment post number
        endwhile;
    else : ?>
        <p>No posts found.</p>
    <?php endif;

    wp_reset_postdata();
    ?>
</div>

