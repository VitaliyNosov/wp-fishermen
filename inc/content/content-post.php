<?php
$id = get_the_ID();
$blog_page_id = get_option('page_for_posts');
$image_id = get_post_thumbnail_id( $id );
$image = wp_get_attachment_image_src($image_id, 'full');

// Fields
$custom_title = '';
$card_usage = '';
$card_title = '';
$card_text = '';
$card_link = array();

$post_content = get_field('post_content', $id);
if (is_array($post_content)){
    $custom_title = $post_content['custom_title'];

    $card_usage = $post_content['card_usage'];
    $card_title = $post_content['card_title'];
    $card_text = $post_content['card_text'];
    $card_link = $post_content['card_link'];
}


if ($card_usage == 'default'){
    $card = get_field('card', 'option');
    $card_title = $card['title'];
    $card_text = $card['text'];
    $card_link = $card['link'];

} else if ($card_usage == 'for_posts'){
    $card = get_field('card_for_posts', 'option');
    $card_title = $card['title'];
    $card_text = $card['text'];
    $card_link = $card['link'];

}


/**
 * Colors
 */
$color_for_elements = 'none';
$section_datas = '';

$colors_for_colored_elements = get_field('colors_for_colored_elements', $blog_page_id);
if ($colors_for_colored_elements){
    $color_for_elements = $colors_for_colored_elements;
    $section_datas .= ' data-color-for-elements="'.$color_for_elements.'"';
}

?>
<section class="section-layout section-post-single" <?php echo $section_datas; ?>>
    <article id="post-<?php the_ID(); ?>" <?php post_class('post-single'); ?>>

        <header class="post-header">
            <div class="wrapper">
                <div class="post-header-inner col">

                    <?php
                        $args = array(
                            'back_page_id' => get_option('page_for_posts'),
                            'text' => 'Back to Our Blog',
                        );
                        get_template_part('inc/parts/go-back', '', $args);
                    ?>

                    <div class="post-header-layout" flex layout="row" layout-align="start start" layout-m="column">

                        <div class="post-header-content" flex="none">
                            
                            <h1 class="post-header-title h2">
                                <?php if ($custom_title){ ?>
                                    <?php echo $custom_title; ?>
                                <?php } else { ?>
                                    <?php the_title(); ?>
                                <?php } ?>
                            </h1>
            
                            <?php 
                                $author_terms = get_the_terms( $id, 'authors' );
                                $services_terms = wp_get_post_categories($id, array( 'fields' => 'all' ));
                            ?>
                            <?php if (is_array($author_terms) or is_array($services_terms)){ ?>
                                <span class="blog-posts-loop-item-terms colored-element body-2">
                                    <?php if (is_array($author_terms)){ ?>
                                        <?php foreach( $author_terms as $author ){ ?>
                                            <span class="blog-posts-loop-item-terms-item">
                                                <?php echo $author->name; ?>
                                            </span>
                                        <?php } ?>
                                    <?php } ?>

                                    <?php if (is_array($services_terms)){ ?>

                                        <span class="blog-posts-loop-item-terms-separator">
                                            &nbsp;&VerticalLine;&nbsp;
                                        </span>

                                        <?php foreach( $services_terms as $service ){ ?>
                                            <?php if ($service->term_id != '1'){ ?>
                                                <span class="blog-posts-loop-item-terms-item">
                                                    <?php echo $service->name; ?>
                                                </span>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </span>
                            <?php } ?>

                        </div>

                        <?php 
                        if ($image){ ?>
                            <?php 
                                $url = $image['0'];
                                $height = $image['2'];
                            ?>
                            <div class="post-header-image" flex layout="row" layout-align="center center" layout-align-m="start start" flex-m="none">
                                <div class="post-header-image-inner" style="background:url(<?php echo esc_url($url); ?>);">
                                    <div class="post-header-image-shade"></div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                
                </div>
            </div>
        </header>


        <div class="wrapper">
            <div class="post-content-holder col">
                <div class="post-content styled">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        
        <div class="card-in-post">
            <?php 
            $args = array(
                'title' => $card_title,
                'text' => $card_text,
                'link' => $card_link,
                'card_color' => 'white',
            );
            get_template_part('inc/parts/card-standalone', '', $args); 
            ?>
        </div>

        
        <?php 
        $cats_in = array();
        if (is_array($services_terms)){
            foreach($services_terms as $st){
                $cats_in[] = $st->term_id;
            }
        }
        ?>

        <?php
        $blog_args = array(
            'post_type' => 'post',
            'posts_per_page' => '3',
            'post__not_in' => array($id),
            'category__in' => $cats_in,
            'orderby' => 'rand',
        );
        $blog_query = new WP_Query( $blog_args );
        if ( $blog_query->have_posts() ) { ?>
            <div class="other-posts">
                <div class="wrapper">
                    <div class="other-posts-container col">
                        <div class="other-posts-inner">

                            <div class="other-posts-top">
                                <h3 class="other-posts-title">
                                    Other Posts
                                </h3>
                            </div>

                            <div id="other-posts-loop-layout" class="other-posts-loop-layout" flex layout="column" layout-align="start start">
                                <?php while ( $blog_query->have_posts() ) {  
                                    $blog_query->the_post();
                                ?>
                                    <?php get_template_part('inc/loop/other-post-loop-item');  ?>
                                <?php } ?>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>           
        <?php } ?>
        <?php wp_reset_postdata(); ?>

           

    </article>
</section>