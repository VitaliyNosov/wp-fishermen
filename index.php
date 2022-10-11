<?php
/**
 * Main Page (index.php)
 * @package WordPress
 * @subpackage fishermen
 */
get_header(); ?> 

<?php 
$id = get_option('page_for_posts');

$published_posts = wp_count_posts()->publish;
$posts_per_page = get_field('posts_per_page', $id);
$first_posts_show = get_field('first_posts_show', $id);

$overhead = get_field('overhead', $id);
$title = get_field('title', $id);
$description = get_field('description', $id);


/**
 * Colors
 */
$page_id = $id;
$color_for_elements = 'none';
$section_datas = '';

$colors_for_colored_elements = get_field('colors_for_colored_elements', $page_id);
if ($colors_for_colored_elements){
    $color_for_elements = $colors_for_colored_elements;
    $section_datas .= ' data-color-for-elements="'.$color_for_elements.'"';
}
?>
<section class="section-layout section-blog-index blog-index" <?php echo $section_datas; ?>>

	<div class="blog-top">
		<div class="wrapper">
			<div class="blog-top-holder col">
				<?php if ($overhead){ ?>
					<div class="blog-top-overhead blog-top-element semibold-1 colored-element">
						<?php echo $overhead; ?>
					</div>
				<?php } ?>
				<?php if ($title){ ?>
					<h1 class="blog-top-title blog-top-element">
						<?php echo $title; ?>
					</h1>
				<?php } ?>
				<?php if ($description){ ?>
					<div class="blog-top-description blog-top-element h6">
						<?php echo $description; ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<?php
	$blog_args = array(
		'post_type' => 'post',
		'posts_per_page' => $first_posts_show,
	);
	$blog_query = new WP_Query( $blog_args );
	if ( $blog_query->have_posts() ) { ?>
		<div class="blog-main-posts">
			<div class="wrapper">
				<div class="main-posts-loop-layout" flex layout="row" layout-align="stretch start" layout-wrap>
					<?php while ( $blog_query->have_posts() ) {  
						$blog_query->the_post();
					?>
						<?php get_template_part('inc/loop/main-post-loop-item');  ?>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php wp_reset_postdata(); ?>
	
	<?php if ( have_posts() ) { ?>
		<div id="other-posts" class="other-posts">
			<div class="wrapper">
				<div class="other-posts-container col">
					<div class="other-posts-inner">

						<div class="other-posts-top">
							<h3 class="other-posts-title">
								Other Posts
							</h3>
						</div>

						<div id="other-posts-loop-layout" class="other-posts-loop-layout" flex layout="column" layout-align="start start">
							<?php while ( have_posts() ) { the_post(); ?>
								<?php get_template_part('inc/loop/other-post-loop-item');  ?>
							<?php } ?>
						</div>

						<div id="loaded-posts" class="other-posts-loop-layout" flex layout="column" layout-align="start start"></div>

						<div id="show-toggle-button-more" class="show-more-button-holder" flex layout="row" layout-align="center center">
							<?php 
							$args = array(
								'text' => 'Show more',
								'class' => 'show-more',
								'id' => 'show-more',
							);
							get_template_part('inc/elements/button-more', '', $args);
							?>
						</div>

						<div id="show-toggle-button-less" class="show-toggle-button" flex layout="row" layout-align="center center">
							<?php 
							$args = array(
								'text' => 'Show less',
								'class' => 'show-less',
								'id' => 'show-less',
							);
							get_template_part('inc/elements/button-more', '', $args);
							?>
						</div>
						<div id="show-toggle-button-all" class="show-toggle-button" flex layout="row" layout-align="center center">
							<?php 
							$args = array(
								'text' => 'Show all',
								'class' => 'show-all',
								'id' => 'show-all',
							);
							get_template_part('inc/elements/button-more', '', $args);
							?>
						</div>
					
					</div>
				</div>
			</div>
		</div>

		<?php //pagination(); ?>

	<?php } else { ?>
		<?php if ($published_posts > 0){ ?>
		<?php } else { ?>
			<div class="wrapper">
				<div class="col" layout="row" layout-align="center center">
					<h2>No posts, sorry :(</h2>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
	
</section>
<?php get_footer(); ?>