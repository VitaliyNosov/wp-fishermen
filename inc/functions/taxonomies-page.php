<?php
/**
 * add page taxonomy
 */
add_action( 'init', 'create_page_taxonomies', 0 );

function create_page_taxonomies() 
{
  $labels = array(
    'name' => _x( 'Page type', 'taxonomy general name' ),
    'singular_name' => _x( 'Page type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search' ),
    'all_items' => __( 'All' ),
    'parent_item' => __( 'Parent' ),
    'parent_item_colon' => __( 'Parent:' ),
    'edit_item' => __( 'Edit' ), 
    'update_item' => __( 'Update' ),
    'add_new_item' => __( 'Add new' ),
    'new_item_name' => __( 'Name' ),
    'menu_name' => __( 'Page type' ),
  ); 	

  register_taxonomy('page_type',array('page'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
	'with_front' => false,
  ));
}
?>