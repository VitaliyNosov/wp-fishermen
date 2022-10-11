<?php
/**
 * Add Excerpt for Pages
 */
add_post_type_support( 'page', 'excerpt' );

/**
 * Gallery Styling Remove
 */
add_filter( 'use_default_gallery_style', '__return_false' );
add_filter( 'the_content', 'remove_br_gallery', 11, 2);
function remove_br_gallery($output) {
    return preg_replace('/<br style=(.*)>/mi', '', $output);
}

/**
 * Add Custom class to nav menu item
 */
function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

/*
function add_menuclass($ulclass) {
	return preg_replace('/<a /', '<a data-swup-preload ', $ulclass);
 }
 add_filter('wp_nav_menu','add_menuclass');
 */
?>