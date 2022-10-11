<?php
/** Register custom post type. */
add_action('init', 'makers_init');
function makers_init() 
{
  $labels = array(
    'name' => __('Makers'),
    'singular_name' => __('Maker'),
    'add_new' => __('Add new'),
    'add_new_item' => __('Add new maker'),
    'edit_item' => __('Edit maker'),
    'new_item' => __('New maker'),
    'view_item' => __('View maker'),
    'search_items' => __('Search'),
    'not_found' =>  __('Not found'),
    'not_found_in_trash' => __('Not found in trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Makers'
  );
  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => false,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' =>true,
    'menu_position' => null,
    'exclude_from_search' => true,
	'show_in_rest' => true,
    'supports' => array('title')
  ); 
  register_post_type('makers',$args);
}
?>