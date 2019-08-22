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