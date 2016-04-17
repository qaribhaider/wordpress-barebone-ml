<?php

/**
 * People CPT
 * 
 * If it is required to have more than one category filter
 * for the current post then create a taxanomy
 *  
 * http://codex.wordpress.org/Taxonomies
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function people_init() {
    // Create a new taxonomy - solutions
    register_taxonomy(
            'people_location', 'people', array(
        'hierarchical' => true,
        'show_ui' => true,
        'label' => __('Location'),
        'rewrite' => array('slug' => 'peoplelocation')
            )
    );
}

add_action('init', 'people_init');

$people = array();
$people['posttypeid'] = "people";
$people['posttypeid_singular'] = "people";
$people['title_singular'] = "People";
$people['title_plural'] = "People";

/**
 * Creating Custom Post Type
 */
function sqhr_people() {
    // Retrive outside variable
    global $people;

    // Set labels
    $labels = array(
        'name' => _x($people['title_plural'], 'post type general name'),
        'singular_name' => _x($people['posttypeid_singular'], 'post type singular name'),
        'add_new' => _x('Add New', $people['title_singular']),
        'add_new_item' => __('Add New ' . $people['title_singular']),
        'edit_item' => __('Edit ' . $people['title_singular']),
        'new_item' => __('New ' . $people['title_singular']),
        'all_items' => __('All ' . $people['title_plural']),
        'view_item' => __('View ' . $people['title_singular']),
        'search_items' => __('Search ' . $people['title_plural']),
        'not_found' => __('No ' . $people['title_plural'] . ' found'),
        'not_found_in_trash' => __('No ' . $people['title_plural'] . ' found in the Trash'),
        'parent_item_colon' => '',
        'people_name' => $people['title_plural']
    );

    // Setup parameters
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-admin-users', // https://developer.wordpress.org/resource/dashicons/#share-alt
        'description' => 'Holds Addons and Addon specific data',
        'public' => true,
        'menu_position' => 5,
        'supports' => array('title', 'thumbnail'),
        'has_archive' => false,
        'taxonomies' => array(), //[category/post_tag]
        'rewrite' => array("slug" => $people['posttypeid']), // Permalinks format
    );

    // Finally, register the post type
    register_post_type($people['posttypeid'], $args);
}

add_action('init', 'sqhr_people');
