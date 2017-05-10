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

// Theme plugin that adds an image upload field to taxonomies
require_once(get_template_directory().'/assets/functions/taxonomy-term-image.php');

// Adds support for multiple languages
require_once(get_template_directory().'/assets/translation/translation.php');

add_action( 'init', 'wg_custom_taxonomy', 0 );
add_action( 'init','wg_create_post_type' );
add_filter( 'rwmb_meta_boxes', 'wg_meta_boxes' );

add_filter( 'taxonomy-term-image-taxonomy', 'wg_set_sermon_series_image_taxonomy' );
add_filter( 'taxonomy-term-image-labels', 'wg_sermon_series_term_image_labels' );
add_filter( 'taxonomy-term-image-meta-key', 'wg_sermon_series_image_meta_key' );
add_filter( 'taxonomy-term-image-js-dir-url', 'wg_sermon_series_image_js_dir_url' );

// Register Sermon Custom Post Type
function wg_create_post_type() {
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

// Register Sermon Series Custom Taxonomy
function wg_custom_taxonomy() {

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

// Add meta boxes using the Register Meta Boxes Plugin
function wg_meta_boxes( $meta_boxes ) {
    $prefix = 'wg_';

    // Get the current post ID
    if ( isset( $_GET['post'] ) ) {
      $post_id = intval( $_GET['post'] );
    } elseif ( isset( $_POST['post_ID'] ) ) {
      $post_id = intval( $_POST['post_ID'] );
    } else {
      $post_id = false;
    }

    $post_id = (int) $post_id;

    // Only display the following metaboxes on the frontpage (id = 29)
    if ( $post_id == 29 || ! is_admin() ) {
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
                  'size' => '40',
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
                  'size' => '40',
                  'std'  => 'http://westgatechurch.com/',
              ),
          ),
      );
    }

    $meta_boxes[] = array(
        'id'         => 'wg_sermon_image_override',
        'title'      => __( 'Override Series Featured Image', 'wg_wp' ),
        'post_types' => 'wg_sermon',
        'context'    => 'side',
        'priority'   => 'low',
        'fields'     => array(
            array(
                'name' => __( 'Sidebar Image', 'wg_wp' ),
                'id'   => "{$prefix}override_series_img",
                'desc' => __( 'Checking this box will use the featured image for this sermon instead of the series featured image.', 'wg_wp' ),
                'type' => 'checkbox',
                'std'  => 0,
            ),
        ),
    );

    return $meta_boxes;
}

// Adds an image upload meta field to the Sermon Series Custom Taxonomy
function wg_set_sermon_series_image_taxonomy( $taxonomy ) {
  return 'series';
}

// Change the field & button text for the Sermon Series Custom Taxonomy image uploader
function wg_sermon_series_term_image_labels( $labels ) {
  $labels['fieldTitle']       = __( 'Series Featured Image', 'wg_wp' );
  $labels['fieldDescription'] = __( 'Select or upload an image to represent this series.', 'wg_wp' );
  $labels['modalTitle']       = __( 'Select or upload an image for this series', 'wg_wp' );
  $labels['adminColumnTitle'] = __( 'Featured Image', 'wg_wp' );

  return $labels;
}

// Sets the meta key used to save the image ID in the Sermon Series meta data
function wg_sermon_series_image_meta_key( $term_meta_key ) {
  return 'series_featured_image';
}

// Points to the location of the required js file for the Sermon Series image uploader
function wg_sermon_series_image_js_dir_url( $file_path ) {
  return get_template_directory_uri() . '/assets/js';
}

/**
 * Get the first term attached to a sermon
 *
 * @param string $taxonomy
 * @param string/int $field, pass false to return object
 * @param int $post_id
 * @return string/object
 */
function wg_first_term( $taxonomy = 'category', $field = 'name', $post_id = false ) {

	$post_id = $post_id ? $post_id : get_the_ID();
	$term = false;

	// Use WP SEO Primary Term
	// from https://github.com/Yoast/wordpress-seo/issues/4038
	if( class_exists( 'WPSEO_Primary_Term' ) ) {
		$term = get_term( ( new WPSEO_Primary_Term( $taxonomy,  $post_id ) )->get_primary_term(), $taxonomy );
	}

	// Fallback on term with highest post count
	if( ! $term || is_wp_error( $term ) ) {

		$terms = get_the_terms( $post_id, $taxonomy );

		if( empty( $terms ) || is_wp_error( $terms ) )
			return false;

		// If there's only one term, use that
		if( 1 == count( $terms ) ) {
			$term = array_shift( $terms );

		// If there's more than one...
		} else {

			// Sort by term order if available
			// @uses WP Term Order plugin
			if( isset( $terms[0]->order ) ) {
				$list = array();
				foreach( $terms as $term )
					$list[$term->order] = $term;
				ksort( $list, SORT_NUMERIC );

			// Or sort by post count
			} else {
				$list = array();
				foreach( $terms as $term )
					$list[$term->count] = $term;
				ksort( $list, SORT_NUMERIC );
				$list = array_reverse( $list );
			}

			$term = array_shift( $list );
		}
	}

	// Output
	if( $field && isset( $term->$field ) )
		return $term->$field;

	else
		return $term;
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
