<?php
/**
 * Template Name: All Post Types with Fields
 */

get_header(); ?>

<div class="container">
    <h1><?php the_title(); ?></h1>

    <?php
    // Fetch all custom post types
    $args = array(
        'post_type' => get_post_types(array('public' => true, '_builtin' => false)), // Fetch only custom post types
        'posts_per_page' => -1, // Retrieve all posts
    );
    $custom_posts = new WP_Query($args);

    if ($custom_posts->have_posts()) :
        while ($custom_posts->have_posts()) : $custom_posts->the_post(); ?>
        
            <div class="post-item">
                <h2><?php the_title(); ?></h2>
                
                <div class="custom-fields">
                    <?php
                    // Fetch all custom fields for the current post
                    $fields = get_field_objects();
                    if ($fields) {
                        foreach ($fields as $field_name => $field) {
                            echo '<p><strong>' . esc_html($field['label']) . ':</strong> ';
                            echo esc_html($field['value']) . '</p>';
                        }
                    } else {
                        echo '<p>No custom fields available for this post.</p>';
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
