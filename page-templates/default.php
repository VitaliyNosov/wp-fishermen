<?php
/**
 * Template name: Default Text Page
 */
?>
<?php get_header(); ?>
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <div class="default-page-container">
            <?php 
                $page_id = get_the_ID();
                $go_back_data = '';
                $go_back = get_field('go_back', $page_id);
                if ($go_back){
                    $go_back_data = $go_back; 
                }
                //var_dump($go_back_data);
                if (is_array($go_back_data)){
                    if ($go_back_data['add_go_back'] === 'yes'){

                        $go_back_text = $go_back_data['text'];
                        $link = wp_get_post_parent_id($page_id);
                        if ($go_back_data['link'] === 'custom'){
                            $link = $go_back_data['custom_link'][0];
                        }

                        $args = array(
                            'back_page_id' => $link,
                            'text' => $go_back_text,
                            'section' => true,
                        );
                        get_template_part('inc/parts/go-back', '', $args);

                    }
                }
            ?>
            <?php get_template_part('inc/acf'); ?>
            <?php get_template_part('inc/content/content-default'); ?>
        </div>
    <?php endwhile; ?>
<?php get_footer(); ?>