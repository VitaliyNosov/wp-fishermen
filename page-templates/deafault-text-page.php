<?php
/**
 * Template name: Default Text Page
 */
?>
<?php get_header(); ?>
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <?php get_template_part('inc/acf'); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('post-single'); ?>>
            <div class="wrapper">
                <div class="content-width content-width-col">
                    <div class="post-content col">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
<?php get_footer(); ?>