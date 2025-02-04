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

    // Define an array to map post IDs to SVG filenames
    $svg_map = [
        1 => '1.svg',
        2 => 'icon2.svg',
        3 => 'icon3.svg',
        // Add more mappings as needed
    ];

    if ($custom_posts->have_posts()) :
        while ($custom_posts->have_posts()) : $custom_posts->the_post(); 
        
            $post_id = get_the_ID(); 
            $svg_filename = isset($svg_map[$post_id]) ? $svg_map[$post_id] : 'default.svg'; // Use default if not found
        ?>
        
            <div class="post-item">
                <h2><?php the_title(); ?></h2>

                <!-- Display the assigned SVG -->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/svg/<?php echo esc_attr($svg_filename); ?>" alt="Post Icon">

                <div class="custom-fields">
                    <?php
                    $date_opening = get_field('date_opening'); 
                    if ($date_opening) {
                        echo '<p>' . esc_html($date_opening) . '</p>';
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
