<?php

// add the css and js files
function bpenny_setup()
{
    wp_enqueue_style('style', get_stylesheet_uri(), NULL, 1.0);
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Lexend+Peta&display=swap');
    wp_enqueue_script('prefix-font-awesome', 'https://kit.fontawesome.com/4685121e43.js', NULL, 1.0 . true);
    wp_enqueue_script('main', get_theme_file_uri('/js/main.js'), NULL, 1.0, true);
}

add_action('wp_enqueue_scripts', 'bpenny_setup');

// add theme support
function bpenny_init()
{
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
function bpenny_post_types()
{

    // Portrait and caption post type - singular because limited to one custom post type
    register_post_type(
        'portrait_post',
        array(
            'rewrite' => array('slug' => 'portrait_post'),
            'labels' => array(
                'name' => 'Portrait Post',
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

/**
 * Custom code to hide UI to create >1 portrait_post posts
 */
function disable_new_posts()
{

    $global_settings = get_posts('post_type=portrait_post');

    // Get the post ids (even if more than one) from specified post type
    $all_post_ids = get_posts(array(
        'fields'          => 'ids',
        'posts_per_page'  => -1,
        'post_type' => 'portrait_post'
    ));

    // Check if post count is more than zero
    if (count($global_settings) != 0) {
        // Remove sidebar link
        global $submenu;
        unset($submenu['edit.php?post_type=portrait_post'][10]);

        // Hide Add new button with CSS
        if (isset($_GET['post_type']) && $_GET['post_type'] == 'portrait_post' || $_GET['post'] == $all_post_ids[0]) {
            echo '<style type="text/css">
          .page-title-action { display:none; }
          </style>';
        }
    }
}
add_action('admin_menu', 'disable_new_posts');

/**
 * Register meta boxes.
 */
function hcf_register_meta_boxes()
{
    add_meta_box('hcf-1', __('Add Date and Link to Show *(date required)', 'hcf'), 'hcf_display_callback', 'tour_date_post');
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
        'show_link',
        'show_date'
    ];

    foreach ($fields as $field) {
        if (array_key_exists($field, $_POST)) {

            // Check if date field - then format to unix timestamp
            if ($field == 'show_date') {
                update_post_meta($post_id, $field, strtotime(str_replace('-', '/', $_POST[$field])));
                // If not date - add other fields to post meta
            } else {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
}
add_action('save_post', 'hcf_save_meta_box');

// Remove extra p tags in posts
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');

add_action('admin_menu', 'remove_options');

// Remove unnecessary admin tabs
function remove_options()
{
    remove_menu_page('edit.php');
    remove_menu_page('edit.php?post_type=page');
    remove_menu_page('edit-comments.php');
}

// remove toolbar items
// https://digwp.com/2016/06/remove-toolbar-items/
function shapeSpace_remove_toolbar_node($wp_admin_bar)
{

    // replace 'updraft_admin_node' with your node id
    $wp_admin_bar->remove_node('new-content');
    $wp_admin_bar->remove_node('comments');
}
add_action('admin_bar_menu', 'shapeSpace_remove_toolbar_node', 999);

// Remove unwanted widgets from the admin dashboard
function remove_dashboard_meta()
{
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); //Removes the 'incoming links' widget
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); //Removes the 'plugins' widget
    remove_meta_box('dashboard_primary', 'dashboard', 'normal'); //Removes the 'WordPress News' widget
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); //Removes the secondary widget
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Removes the 'Quick Draft' widget
    // remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); //Removes the 'Recent Drafts' widget
    // remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); //Removes the 'Activity' widget
    // remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Removes the 'At a Glance' widget
    remove_meta_box('dashboard_activity', 'dashboard', 'normal'); //Removes the 'Activity' widget (since 3.8)
}
add_action('admin_init', 'remove_dashboard_meta');

/**
 * Add a custom widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
// function wpexplorer_add_dashboard_widgets()
// {
//     wp_add_dashboard_widget(
//         'wpexplorer_dashboard_widget', // Widget slug.
//         'My Custom Dashboard Widget', // Title.
//         'wpexplorer_dashboard_widget_function' // Display function.
//     );
// }
// add_action('wp_dashboard_setup', 'wpexplorer_add_dashboard_widgets');

/**
 * Create the function to output the contents of your Dashboard Widget.
 */
function wpexplorer_dashboard_widget_function()
{
    echo "Hello there, I'm a great Dashboard Widget. Edit me!";
}

/**
 * Removes media buttons from post types. - And customizes editor (updated)
 */
add_filter('wp_editor_settings', function ($settings) {
    $current_screen = get_current_screen();

    // Post types for which the media buttons should be removed.
    $post_types = array(
        'portrait_post',
        'tour_date_post'
    );

    // Bail out if media buttons should not be removed for the current post type.
    if (!$current_screen || !in_array($current_screen->post_type, $post_types, true)) {
        return $settings;
    }

    // Set up specified editor settings to return
    $settings = array(
        'textarea_rows' => 5,
        'media_buttons' => false,
        'teeny'         => true,
        'tinymce'       => true
    );

    return $settings;
});

// Customize 'excerpt' title block - currently for all excerpts (only one in this theme)
add_filter('gettext', 'wpse22764_gettext', 10, 2);

function wpse22764_gettext($translation, $original)
{
    if ('Excerpt' == $original) {
        return 'Photo Caption'; //Change here to what you want Excerpt box to be called
    } else {
        $pos = strpos($original, 'Excerpts are optional hand-crafted summaries of your');

        if ($pos !== false) {
            return  'Appears below the featured image'; //Change the default text you see below the box with link to learn more...
        }
    }
    return $translation;
}

/*
Add subtext after title - more info for user on backend - selected post types in 'post_types' array
*/
function my_prefix_after_title()
{
    $current_screen = get_current_screen();
    // Post types for which the media buttons should be removed.
    $post_types = array(
        'tour_date_post'
    );
    // Bail out if media buttons should not be removed for the current post type.
    if (!$current_screen || !in_array($current_screen->post_type, $post_types, true)) {
        return;
    }
    echo '<h1 style="background: skyblue; padding: 1.5em; font-size: 15px;">Put details for show <strong>venue and location, etc</strong> below. The post <strong>title</strong> (above) is for your reference and will not appear on the page</h1>';
};

add_action('edit_form_after_title', 'my_prefix_after_title');

// Add default content to the editor
add_filter('default_content', 'my_editor_content', 10, 2);

function my_editor_content($content, $post)
{
    switch ($post->post_type) {
        case 'portrait_post':
            $content = 'Write your bio etc here...or delete this and leave blank';
            break;
        case 'tour_date_post':
            $content = '';
            break;
        default:
            $content = 'your default content';
            break;
    }
    return $content;
}

// Custom Admin footer
function wpexplorer_remove_footer_admin () {
	echo '<span id="footer-thankyou">Built with love by <a href="http://www.wpexplorer.com/" target="_blank">Niko</a></span>';
}
add_filter( 'admin_footer_text', 'wpexplorer_remove_footer_admin' );

// Customize the login form/page
function wpexplorer_login_logo()
{ ?>
<style type="text/css">
    body.login div#login h1 a {
        background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/pixeld_fran_logo.png );
        /* padding-bottom: 30px; */
    }
</style>
<?php }
add_action('login_enqueue_scripts', 'wpexplorer_login_logo');

// Function to update the new login logo url
// function wpexplorer_login_logo_url()
// {
//     return esc_url(home_url('/'));
// }
// add_filter('login_headerurl', 'wpexplorer_login_logo_url');

// function wpexplorer_login_logo_url_title()
// {
//     return 'Your Site Name and Info';
// }
// add_filter('login_headertitle', 'wpexplorer_login_logo_url_title');
