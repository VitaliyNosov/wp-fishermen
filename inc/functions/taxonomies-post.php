<?php
/**
 * Add Post Authors Taxonomy
 */
add_action( 'init', 'create_post_authors_taxonomies', 0 );

function create_post_authors_taxonomies() 
{
  $labels = array(
    'name' => _x( 'Authors', 'taxonomy general name' ),
    'singular_name' => _x( 'Author', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search' ),
    'all_items' => __( 'All' ),
    'parent_item' => __( 'Parent' ),
    'parent_item_colon' => __( 'Parent:' ),
    'edit_item' => __( 'Edit' ), 
    'update_item' => __( 'Update' ),
    'add_new_item' => __( 'Add new' ),
    'new_item_name' => __( 'Name' ),
    'menu_name' => __( 'Authors' ),
  ); 	

  register_taxonomy('authors',array('post'), array(
    'public' => false,
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
	'with_front' => false,
    'show_in_rest' => true,
  ));
}

/**
 * Add Post Services Taxonomy
 */
/*
add_action( 'init', 'create_post_services_taxonomies', 0 );

function create_post_services_taxonomies() 
{
  $labels = array(
    'name' => _x( 'Services', 'taxonomy general name' ),
    'singular_name' => _x( 'Service', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search' ),
    'all_items' => __( 'All' ),
    'parent_item' => __( 'Parent' ),
    'parent_item_colon' => __( 'Parent:' ),
    'edit_item' => __( 'Edit' ), 
    'update_item' => __( 'Update' ),
    'add_new_item' => __( 'Add new' ),
    'new_item_name' => __( 'Name' ),
    'menu_name' => __( 'Services' ),
  ); 	

  register_taxonomy('services',array('post'), array(
    'public' => false,
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
	'with_front' => false,
    'show_in_rest' => true,
  ));
}
*/

?>