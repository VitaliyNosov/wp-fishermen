<?php
/**
 * Single Template (single.php)
 * @package WordPress
 * @subpackage fishermen
 */
get_header(); ?>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php get_template_part('inc/content/content-post'); ?>
	<?php endwhile; ?>
<?php get_footer(); ?>
