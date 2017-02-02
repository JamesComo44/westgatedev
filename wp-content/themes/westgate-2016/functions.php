<?php
// Theme support options
require_once(get_template_directory().'/assets/functions/theme-support.php');

// WP Head and other cleanup functions
require_once(get_template_directory().'/assets/functions/cleanup.php');

// Register scripts and stylesheets
require_once(get_template_directory().'/assets/functions/enqueue-scripts.php');

// Register custom menus and menu walkers
require_once(get_template_directory().'/assets/functions/menu.php');

// Register sidebars/widget areas
require_once(get_template_directory().'/assets/functions/sidebar.php');

// Makes WordPress comments suck less
require_once(get_template_directory().'/assets/functions/comments.php');

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/assets/functions/page-navi.php');

// Adds support for multiple languages
require_once(get_template_directory().'/assets/translation/translation.php');

add_action( 'init', 'custom_taxonomy', 0 );
add_action( 'init','create_post_type' );
add_filter( 'rwmb_meta_boxes', 'wg_meta_boxes' );


function create_post_type() {
  $labels = array(
    'name' => 'Sermons',
    'singular_name' => 'Sermon',
    'add_new' => 'Add New',
    'all_items' => 'All Sermons',
    'add_new_item' => 'Add New Sermon',
    'edit_item' => 'Edit Sermon',
    'new_item' => 'New Sermon',
    'view_item' => 'View Sermon',
    'search_items' => 'Search Sermons',
    'not_found' =>  'No Sermons found',
    'not_found_in_trash' => 'No Sermons found in trash',
    'parent_item_colon' => '',
    'menu_name' => 'Sermons'
  );

  $args = array(
    'labels' => $labels,
    'description' => "",
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_nav_menus' => true,
    'show_in_menu' => true,
    'show_in_admin_bar' => true,
    'menu_position' => 5,
    'menu_icon' => null,
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array('title','editor','thumbnail'),
    'has_archive' => true,
    'rewrite' => array(
        'slug' => 'sermons'
        ),
    'query_var' => true,
    'can_export' => true
  );
  register_post_type('wg_sermon',$args);
}

// Register Custom Taxonomy
function custom_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Sermon Series', 'Series', 'wg_wp' ),
    'singular_name'              => _x( 'Series', 'Series', 'wg_wp' ),
    'menu_name'                  => __( 'Sermon Series', 'wg_wp' ),
    'all_items'                  => __( 'All Series', 'wg_wp' ),
    'parent_item'                => __( 'Parent Series', 'wg_wp' ),
    'parent_item_colon'          => __( 'Parent Series:', 'wg_wp' ),
    'new_item_name'              => __( 'New Series Name', 'wg_wp' ),
    'add_new_item'               => __( 'Add New Series', 'wg_wp' ),
    'edit_item'                  => __( 'Edit Series', 'wg_wp' ),
    'update_item'                => __( 'Update Series', 'wg_wp' ),
    'view_item'                  => __( 'View Series', 'wg_wp' ),
    'separate_items_with_commas' => __( 'Separate series with commas', 'wg_wp' ),
    'add_or_remove_items'        => __( 'Add or remove series', 'wg_wp' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'wg_wp' ),
    'popular_items'              => __( 'Popular Series', 'wg_wp' ),
    'search_items'               => __( 'Search Series', 'wg_wp' ),
    'not_found'                  => __( 'Not Found', 'wg_wp' ),
    'no_terms'                   => __( 'No series', 'wg_wp' ),
    'items_list'                 => __( 'Series list', 'wg_wp' ),
    'items_list_navigation'      => __( 'Series list navigation', 'wg_wp' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => false,
  );
  register_taxonomy( 'series', array( 'wg_sermon' ), $args );

}


function wg_meta_boxes( $meta_boxes ) {
    $prefix = 'wg_';

    $meta_boxes[] = array(
        'id'         => 'wg_feat_1',
        'title'      => __( 'Feature Spot 1 (far left)', 'wg_wp' ),
        'post_types' => 'page',
        'fields'     => array(
            array(
                'name'             => __( 'Image Advanced Upload', 'wg_feat_1_' ),
                'id'               => "{$prefix}img1",
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            ),
            array(
                'name' => __( 'URL', 'wg_feat_1_' ),
                'id'   => "{$prefix}url1",
                'type' => 'text',
                'size' => '50',
                'std'  => 'http://westgatechurch.com/',
            ),
        ),
    );


    $meta_boxes[] = array(
        'id'         => 'wg_feat_2',
        'title'      => __( 'Feature Spot 2 (far right)', 'wg_wp' ),
        'post_types' => 'page',
        'fields'     => array(
            array(
                'name'             => __( 'Image Advanced Upload', 'wg_feat_2_' ),
                'id'               => "{$prefix}img2",
                'type'             => 'image_advanced',
                'max_file_uploads' => 1,
            ),
            array(
                'name' => __( 'URL', 'wg_feat_2_' ),
                'id'   => "{$prefix}url2",
                'type' => 'text',
                'size' => '50',
                'std'  => 'http://westgatechurch.com/',
            ),
        ),
    );

    return $meta_boxes;
}



// Remove 4.2 Emoji Support
// require_once(get_template_directory().'/assets/functions/disable-emoji.php');

// Adds site styles to the WordPress editor
//require_once(get_template_directory().'/assets/functions/editor-styles.php');

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/assets/functions/related-posts.php');

// Use this as a template for custom post types
// require_once(get_template_directory().'/assets/functions/custom-post-type.php');

// Customize the WordPress login menu
// require_once(get_template_directory().'/assets/functions/login.php');

// Customize the WordPress admin
// require_once(get_template_directory().'/assets/functions/admin.php');
