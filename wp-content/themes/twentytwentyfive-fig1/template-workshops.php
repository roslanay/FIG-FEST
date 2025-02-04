<?php
/**
 * Template Name: Workshops Listing
 */

get_header(); ?>

<div class="container">
    <h1><?php the_title(); ?></h1>

    <?php
    // Set your custom field key for the date (replace 'workshop_date' with your actual field name)
    $workshop_date_field = 'Date';

    // Query for the 'workshops' post type, sorted by the custom date field
    $args = array(
        'post_type'      => 'workshops', // Specify the post type slug for Workshops
        'posts_per_page' => -1, // Retrieve all posts
        'meta_key'       => $workshop_date_field, // The custom field to sort by
        'orderby'        => 'meta_value', // Order by the custom field value
        'order'          => 'ASC', // Ascending order
        'meta_type'      => 'DATE', // Treat the meta key as a date
    );

    $workshops = new WP_Query($args);

    if ($workshops->have_posts()) : ?>
        <div class="workshops-list">
            <?php
            while ($workshops->have_posts()) : $workshops->the_post(); ?>

                <div class="workshop-item">
                    <h2><?php the_title(); ?></h2>
                    
                    <div class="workshop-details">
                        <?php
                        // Display the workshop date
                        $workshop_date = get_field($workshop_date_field);
                        if ($workshop_date) {
                            echo '<p><strong>Date:</strong> ' . esc_html($workshop_date) . '</p>';
                        }

                        // Display other custom fields if needed
                        $fields = get_field_objects();
                        if ($fields) {
                            foreach ($fields as $field_name => $field) {
                                if ($field_name !== $workshop_date_field) { // Skip the date field to avoid redundancy
                                    echo '<p><strong>' . esc_html($field['label']) . ':</strong> ';
                                    echo esc_html($field['value']) . '</p>';
                                }
                            }
                        }
                        ?>
                    </div>
                </div>

            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p>No workshops found.</p>
    <?php endif;

    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>
