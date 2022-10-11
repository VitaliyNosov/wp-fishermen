<?php
/**
 * Template name: Contact
 */
?>
<?php get_header(); ?>
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <?php get_template_part('inc/acf'); ?>
    <?php endwhile; ?>
<?php get_footer(); ?>