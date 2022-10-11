<?php
/**
 * Functions Template (function.php)
 * @package WordPress
 * @subpackage fishermen
 */

add_theme_support('title-tag');

register_nav_menus(array(
	'top' => 'Top',
	'bottom' => 'Bottom',
	'main' => 'Main'
));

add_theme_support('post-thumbnails');
set_post_thumbnail_size(250, 150);
add_image_size('big-thumb', 400, 400, true);
add_image_size('mobile', 600, 9999, true);
add_image_size('content-1200', 1200, 9999, true);

register_sidebar(array(
	'name' => 'Sidebar',
	'id' => "sidebar",
	'description' => 'Simple Sidebar',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => "</div>\n",
	'before_title' => '<span class="widgettitle">',
	'after_title' => "</span>\n",
));



if (!function_exists('pagination')) {
	function pagination() {
		global $wp_query;
		$big = 999999999;
		$links = paginate_links(array(
			'base' => str_replace($big,'%#%',esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'type' => 'array',
			'prev_text'    => 'Назад',
	    	'next_text'    => 'Вперед',
			'total' => $wp_query->max_num_pages,
			'show_all'     => false,
			'end_size'     => 15,
			'mid_size'     => 15,
			'add_args'     => false,
			'add_fragment' => '',
			'before_page_number' => '',
			'after_page_number' => ''
		));
	 	if( is_array( $links ) ) {
		    echo '<ul class="pagination">';
		    foreach ( $links as $link ) {
		    	if ( strpos( $link, 'current' ) !== false ) echo "<li class='active'>$link</li>";
		        else echo "<li>$link</li>"; 
		    }
		   	echo '</ul>';
		 }
	}
}

// Add Inline High Priority Inline Styles
add_action( 'wp_enqueue_scripts', 'wp_enqueue_my_inline_styles' );
function wp_enqueue_my_inline_styles(){
	$styles = '
		@media screen and (min-width: 1024px) {
			body {cursor: none;} 
			*:hover, 
			*:link  {cursor: none;} 
			#cursor {display: block !important;} 
		}
		.site {
			opacity: 0;
		}
	';

	$key = 'my-styles';
	wp_register_style( $key, false, array(), true, true );
	wp_add_inline_style( $key, $styles );
	wp_enqueue_style( $key );
}
// Header load scripts
function header_my_load() {
	wp_enqueue_script('gsap-min', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js', '' ,'3.10.4', false);
	wp_enqueue_script('gsap-ScrollTrigger', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/ScrollTrigger.min.js', '' ,'3.10.4', false);

	wp_enqueue_script('loader-screen', get_template_directory_uri().'/build/js/loader-screen.js', '' ,'1.0', false);
}
add_action( 'wp_enqueue_scripts', 'header_my_load' );

function my_enqueue() {
	wp_enqueue_script('gsap-min', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js', '' ,'3.10.4', true);
    wp_enqueue_script('gsap-draggable', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.11.0/Draggable.min.js', '', '1.1', true);
	wp_enqueue_script('my-custom-admin-js', get_template_directory_uri().'/assets/js/admin.js', '', '1.11', true);
	wp_enqueue_style('my-custom-admin-style', get_template_directory_uri().'/assets/css/admin.css');
}
add_action('admin_enqueue_scripts', 'my_enqueue');

function my_enqueue_styles() {
	wp_enqueue_style('my-custom-admin-style', get_template_directory_uri().'/assets/css/admin.css');
}
add_action('admin_enqueue_styles', 'my_enqueue_styles');


add_action('wp_footer', 'add_scripts');
if (!function_exists('add_scripts')) {
	function add_scripts() {

	    if(is_admin()) return false;
		
		wp_deregister_script('jquery');
		wp_enqueue_script('jquery','//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js','','2.0',true);
		
		wp_enqueue_script('3d-model-viewer', '//unpkg.com/@google/model-viewer@1.12.0/dist/model-viewer.min.js', '', '1.0', true);
		wp_enqueue_script('fancybox', '//cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js', '', '1.0', true);
		wp_enqueue_script('swiper','//cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js','','', true);
		wp_enqueue_script('isotope','//unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js','','1.0',true);
		//wp_enqueue_script('select-2', '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', '', '1.0', true);

		wp_enqueue_script('main-js', get_template_directory_uri().'/assets/js/main.min.js','','1.1',true);
	}
}

add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);
function add_type_attribute($tag, $handle, $src) {
    if ( '3d-model-viewer' == $handle ) {
        $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    }
    return $tag;
}

add_action('wp_print_styles', 'add_styles');
if (!function_exists('add_styles')) {
	function add_styles() {
	    if(is_admin()) return false;
		wp_enqueue_style( 'icons-font', get_template_directory_uri().'/assets/fonts/icons-font/style.css' );
	    wp_enqueue_style( 'main', get_template_directory_uri().'/assets/css/main.min.css' );
		wp_enqueue_style( 'main-theme', get_template_directory_uri().'/style.css' );
		wp_enqueue_style( 'fancybox', '//cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css');
		wp_enqueue_style( 'swiper', '//unpkg.com/swiper@8/swiper-bundle.min.css');
	}
}

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

/**
 * Registers an editor stylesheet for the theme.
 */
add_action('admin_enqueue_scripts', function(){
	if(is_admin()){
		$currentScreen = get_current_screen();
		if ($currentScreen->post_type === 'post' or $currentScreen->post_type === 'page'){
			add_editor_style(get_template_directory_uri().'/editor-style.css?ver=1.073');
		}
	}
});

/**
 * Page Transition
 */
require get_template_directory() . '/inc/functions/page-transition.php';

/**
 * Custom Functions
 */
require get_template_directory() . '/inc/functions/custom-functions.php';

/**
 * Taxonomies
 */
require get_template_directory() . '/inc/functions/taxonomies-page.php';
require get_template_directory() . '/inc/functions/taxonomies-post.php';

/**
 * Custom Posts
 */
require get_template_directory() . '/inc/functions/custom-posts.php';

/**
 * Makers Option Page
 */
require get_template_directory() . '/inc/functions/makers-option-page.php';

/**
 * Main Query Params
 */
require get_template_directory() . '/inc/functions/main-query.php';
?>
