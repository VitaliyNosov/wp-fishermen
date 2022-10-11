<?php 

/**
 * Titles Set
 */
$title = get_sub_field('title');
$title_tag = get_sub_field('title_tag');
$overhead = get_sub_field('overhead');
$overhead_tag = get_sub_field('overhead_tag');
$titles_align = get_sub_field('titles_align');
$title_description = get_sub_field('title_description');

/**
 * Bottom Url Title
 */
$bottom_url_title = get_sub_field('bottom_url_title');
$bottom_url_title_tag = get_sub_field('bottom_url_title_tag');

/**
 * Settings
 */
$bg_class = 'bg-white';
$bg = get_sub_field('background');
if ($bg){
    if ($bg == 'dark'){
        $bg_class = 'bg-dark';
    }
}
/**
 * CTA
 */
$cta_content = get_sub_field('cta_content');

/**
 * Section Fields
 */
$id = get_the_ID();
$posts_display = get_sub_field('posts_display');
$posts_settings = get_sub_field('posts_settings');

$posts_not_in = [];
$fields = get_fields($id);
if( $fields ): 
    $fields = $fields['content'];
    foreach($fields as $f){
        if ($f['acf_fc_layout'] == 'blog_main_posts_section'){
            $f_posts = $f['posts'];
            if ($f_posts){
                foreach($f_posts as $f_post){
                    $posts_not_in[] = $f_post->ID;
                }
            }
            wp_reset_postdata();
        }
    }
endif;
$posts_not_in_str = implode(',', $posts_not_in);
$posts_not_in_arr = explode(',', $posts_not_in_str);
?>
<section class="section-other-posts other-posts <?php echo $bg_class; ?>" data-bg="<?php echo $bg_class; ?>">
<div class="other-posts-wrapper">

    <?php 
    $section_title_args = array(
        'title' => $title,
        'title_tag' => $title_tag,
        'overhead' => $overhead,
        'overhead_tag' => $overhead_tag,
        'titles_align' => $titles_align,
        'title_description' => $title_description,
    );
    get_template_part('inc/parts/section-title', '', $section_title_args); 
    ?>

    <?php if ($cta_content == true) : ?>
        <div class="section-cta-content">
            <div class="wrapper">

                <?php if ($posts_display == 'blog'){ ?>

                    <?php
                    $order = 'ASC';
                    if ($posts_settings) {
                        $order = $posts_settings['order'];
                        if ($order == 'asc'){
                            $order = 'ASC';
                        } else if ($order == 'desc'){
                            $order = 'DESC';
                        }
                    }
                    $blog_args = array(
                        'post_type' => 'post',
                        'posts_per_page'=> -1,
                        'orderby' => 'title',
                        'order' => $order,
                        'post__not_in' => $posts_not_in_arr,
                        /*
                        'tax_query' => array(
                            array(
                                'taxonomy' => '',
                                'field'    => '',
                                'terms'    => '',
                            ),
                        ),
                        */
                    );
                    $blog_query = new WP_Query( $blog_args );
                    if ( $blog_query->have_posts() ) {
                    ?>
                        <div class="other-posts-loop-layout" flex layout="column" layout-align="start start">
                            <?php while ( $blog_query->have_posts() ) {  
                                $blog_query->the_post();
                            ?>
                                <?php 
                                    $args = array();
                                    get_template_part('inc/loop/other-post-loop-item', '', $args); 
                                ?>
                            <?php } ?>
                        </div>
                    <?php } wp_reset_postdata(); ?>

                
                <?php } else if ($posts_display == 'selection'){ ?>
                    <?php
                        $posts = get_sub_field('posts');
                    ?>
                    <?php if( $posts ): ?>
                        <div class="other-posts-loop-layout" flex layout="column" layout-align="start start">
                            <?php foreach( $posts as $post ): ?>
                                <?php 
                                    $args = array();
                                    get_template_part('inc/loop/other-post-loop-item', '', $args); 
                                ?>
                            <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>
                <?php } ?>
                
            </div>
        </div>
    <?php endif; /* endif cta_content */ ?>

    <?php 
    $section_url_title_args = array(
        'title' => $bottom_url_title,
        'title_tag' => $bottom_url_title_tag,
    );
    get_template_part('inc/parts/section-url-title', '', $section_url_title_args); 
    ?>

</div>
</section>