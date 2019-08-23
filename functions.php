<?php 

// add the css and js files
function bpenny_setup() {
    wp_enqueue_style('style', get_stylesheet_uri(), NULL, 1.0);
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Lexend+Peta&display=swap');
    // wp_enqueue_script('main', get_theme_file_uri('/js/main.js'));
    wp_enqueue_script('prefix-font-awesome', 'https://kit.fontawesome.com/4685121e43.js', NULL, 1.0. true);
}

add_action('wp_enqueue_scripts', 'bpenny_setup');

// add theme support
function bpenny_init() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support(
        'html5',
        array('comment-list', 'comment-form', 'search-form')
    );
}

// add action
add_action('after_setup_theme', 'bpenny_init');

// Custom post types
function bpenny_post_types() {

    // Portrait and caption post type
    register_post_type(
        'portrait_post',
        array(
            'rewrite' => array('slug' => 'portrait_post'),
            'labels' => array(
                'name' => 'Portrait Posts',
                'singular_name' => 'Portrait Post',
                'add_new_item' => 'Add New Portrait Post',
                'edit_item' => 'Edit Portrait Post'
            ),
            'menu_icon' => 'dashicons-format-image',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail'
            )
        )
    );

    // Tour date post type
    register_post_type(
        'tour_date_post',
        array(
            'rewrite' => array('slug' => 'tour_date_post'),
            'labels' => array(
                'name' => 'Tour Date Posts',
                'singular_name' => 'Tour Date Post',
                'add_new_item' => 'Add New Tour Date Post',
                'edit_item' => 'Edit Tour Date Post'
            ),
            'menu_icon' => 'dashicons-playlist-audio',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'editor'
            )
        )
    );

}

// add action 
add_action('init', 'bpenny_post_types');

// function add_placeholder_event($html)
// {
//     $screen = get_current_screen();
//     $post_type = $screen->post_type;

//     if ($post_type == 'tour_date_post') {
//         $html = preg_replace('/<textarea/', '<textarea placeholder="John Doe" ', $html);
//     }
//     return $html;
// }
// add_filter('the_editor', 'add_placeholder_event');


// $content   = 'Placeholder text!';
// $editor_id = 'tour_date_post';

// wp_editor( $content, $editor_id );

/**
 * Register meta boxes.
 */
function hcf_register_meta_boxes()
{
    add_meta_box('hcf-1', __('Add Link to Show', 'hcf'), 'hcf_display_callback', 'tour_date_post');
}
add_action('add_meta_boxes', 'hcf_register_meta_boxes');

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function hcf_display_callback($post)
{
    // echo "Hello Custom Field";
    include plugin_dir_path(__FILE__) . './form.php';
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function hcf_save_meta_box($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if ($parent_id = wp_is_post_revision($post_id)) {
        $post_id = $parent_id;
    }
    $fields = [
        'show_link'
    ];
    foreach ($fields as $field) {
        if (array_key_exists($field, $_POST)) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'hcf_save_meta_box');

// Remove extra p tags in posts
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );
