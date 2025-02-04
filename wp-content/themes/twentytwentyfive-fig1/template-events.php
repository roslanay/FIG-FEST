<?php
/**
 * Template Name: Events Listing
 */

get_header(); ?>

<div class="container">
    <h1><?php the_title(); ?></h1>

    <?php
    // Set your custom field key for the date (replace 'event_date' with your field name)
    $event_date_field = 'Date';

    // Query for the 'events' post type, sorted by the custom date field
    $args = array(
        'post_type'      => 'events', // Specify the post type slug for Events
        'posts_per_page' => -1, // Retrieve all posts
        'meta_key'       => $event_date_field, // The custom field to sort by
        'orderby'        => 'meta_value', // Order by the custom field value
        'order'          => 'ASC', // Ascending order
        'meta_type'      => 'DATE', // Treat the meta key as a date
    );

    $events = new WP_Query($args);

    if ($events->have_posts()) : ?>
        <div class="events-list">
            <?php
            while ($events->have_posts()) : $events->the_post(); ?>

                <div class="event-item">
                    <h2><?php the_title(); ?></h2>
                    
                    <div class="event-details">
                        <?php
                        // Display the event date
                        $event_date = get_field($event_date_field);
                        if ($event_date) {
                            echo '<p><strong>Date:</strong> ' . esc_html($event_date) . '</p>';
                        }

                        // Display other custom fields if needed
                        $fields = get_field_objects();
                        if ($fields) {
                            foreach ($fields as $field_name => $field) {
                                if ($field_name !== $event_date_field) { // Skip the date field to avoid redundancy
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
        <p>No events found.</p>
    <?php endif;

    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>
