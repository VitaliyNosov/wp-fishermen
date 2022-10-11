<?php
/**
 * Pre Get Posts
 */
function params_home($query) {
    if ( !is_admin() && $query->is_home() && $query->is_main_query() ) {
        $id = get_option('page_for_posts');
        $posts_per_page = get_field('posts_per_page', $id);
        $first_posts_show = get_field('first_posts_show', $id);

        $args = array(
            'numberposts' => $first_posts_show,
            'fields' => 'ids'
        );
        $latest_posts = get_posts( $args );
        
        $query->set( 'posts_per_page', $posts_per_page );
        $query->set( 'post__not_in', $latest_posts );

    }
}
add_action( 'pre_get_posts', 'params_home' );

/**
 * Enqueue Scripts
 */
function load_more_scripts() {

	global $wp_query; 

	wp_register_script( 'loadmore', get_template_directory_uri().'/build/js/04_loadmore.js');
	wp_localize_script( 'loadmore', 'loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
 
 	wp_enqueue_script( 'loadmore' );
}
add_action( 'wp_enqueue_scripts', 'load_more_scripts' );

/**
 * Ajax Handler
 */
function loadmore_ajax_handler(){
 
	$args = json_decode( stripslashes( $_POST['query'] ), true );

	if ($args['pagename'] != 'blog'){ ?>

		<?php 
		$id = get_option('page_for_posts');
        $posts_per_page = get_field('posts_per_page', $id);
        $first_posts_show = get_field('first_posts_show', $id);

        $args = array(
            'numberposts' => $first_posts_show,
            'fields' => 'ids'
        );
        $latest_posts = get_posts( $args );

		$paged = $_POST['page'] + 1;
		?>

		<?php 
		$blog_args = array(
			'post_type' => 'post',
			'posts_per_page' => $posts_per_page,
			'post__not_in' => $latest_posts,
			'paged' => $paged,
		);
		$blog_query = new WP_Query( $blog_args );
		if ( $blog_query->have_posts() ) { ?>

			<?php 
			ob_start();
				while ( $blog_query->have_posts() ) { 
					$blog_query->the_post(); 
					get_template_part( 'inc/loop/other-post-loop-item' );
				} 
			wp_send_json_success(ob_get_clean());
			?>

		<?php } else { wp_send_json_error('No more posts!', 'noPosts'); } ?>
		<?php wp_reset_postdata(); ?>

	<?php } else {
		$args['paged'] = $_POST['page'] + 1;
		$args['post_status'] = 'publish';
	
		query_posts( $args );
		if( have_posts() ) {
			ob_start();
				while( have_posts() ): the_post();
					get_template_part( 'inc/loop/other-post-loop-item' );
				endwhile;
			wp_send_json_success(ob_get_clean());
		} else {
			wp_send_json_error('No more posts!', 'noPosts');
		}
	}
	die;
}
add_action('wp_ajax_loadmore', 'loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'loadmore_ajax_handler'); // wp_ajax_nopriv_{action}
?>