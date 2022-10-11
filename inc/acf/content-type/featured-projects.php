<?php
$posts = get_sub_field('projects_list');

$posts_class = '';
$posts_count = '';
if (is_array($posts)){
    $posts_count = count($posts);
    if ($posts_count > 3){
        $posts_class .= ' posts-count-more';
    }
};

?>
<?php if( $posts ): ?>
    <div class="swiper-featured-projects">
        <div class="swiper-wrapper featured-projects-loop-layout <?php echo $posts_class; ?>" flex layout="row" layout-align="stretch start" layout-wrap layout-wrap layout-wrap-m="nowrap">
            <?php foreach( $posts as $post ): ?>
                <?php 
                    $args = array(
                        'remove_category' => true,
                        'remove_bottom_link' => true,
                        'class' => 'swiper-slide',
                    );
                    get_template_part('inc/loop/featured-projects-loop-item', '', $args); 
                ?>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        <div class="swiper-scrollbar swiper-scrollbar-featured-project"></div>
    </div>
<?php endif; ?>