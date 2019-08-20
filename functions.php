<?php 

// add the css and js files
function bpenny_setup() {
    wp_enqueue_style('style', get_stylesheet_uri(), NULL, 1.0);
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Lexend+Peta&display=swap');
    // wp_enqueue_script('main', get_theme_file_uri('/js/main.js'));
    wp_enqueue_script('prefix-font-awesome', 'https://kit.fontawesome.com/4685121e43.js', NULL, 1.0. true);
}

add_action('wp_enqueue_scripts', 'bpenny_setup');