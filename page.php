<?php
/**
 * Default Page Template (page.php)
 * @package WordPress
 * @subpackage fishermen
 */
get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<?php if( has_term('job-openings', 'page_type') ){ ?>
		<?php get_template_part('inc/content/job'); ?>
	<?php } ?>

	<?php get_template_part('inc/acf'); ?>

<?php endwhile; ?>

<?php get_footer(); ?>