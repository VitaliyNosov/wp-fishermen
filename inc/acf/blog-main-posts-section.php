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
$posts = get_sub_field('posts');
?>
<section class="section-blog-main-posts blog-main-posts <?php echo $bg_class; ?>" data-bg="<?php echo $bg_class; ?>">

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

                <?php if( $posts ): ?>
                    <div class="main-posts-loop-layout" flex layout="row" layout-align="stretch start" layout-wrap>
                        <?php foreach( $posts as $post ): ?>
                            <?php 
                                $args = array();
                                get_template_part('inc/loop/main-post-loop-item', '', $args); 
                            ?>
                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
                
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

</section>