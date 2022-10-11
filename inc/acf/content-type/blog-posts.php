<?php
$display = get_sub_field('posts_display');
$categories = get_sub_field('categories');
?>
<?php if ($display['value'] == 'latest'){ ?>
    <?php
    if ($categories){
        $tax_query = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'id',
                'terms'    => $categories,
            ),
        );
    } else {
        $tax_query = array();
    }

    $blog_args = array(
        'post_type' => 'post',
        'order' => 'ASC',
        'orderby' => 'date',
        'posts_per_page'=> 3,
        'tax_query' => $tax_query
    );
    $blog_query = new WP_Query( $blog_args );
    if ( $blog_query->have_posts() ) { ?>
        
        <div class="swiper-blog-posts">
            <div class="swiper-wrapper blog-posts-layout" flex layout="row" layout-align="stretch start" layout-wrap layout-wrap-m="nowrap">
                <?php while ( $blog_query->have_posts() ) {  
                    $blog_query->the_post();
                ?>
                    <?php 
                    $args = array(
                        'class' => 'swiper-slide',
                    );   
                    get_template_part('inc/loop/blog-posts-loop-item', '', $args);  
                    ?>
                <?php } ?>
            </div>
            <div class="swiper-scrollbar swiper-scrollbar-blog-posts"></div>
        </div>

    <?php } ?>
    <?php wp_reset_postdata(); ?>

<?php } else if ($display['value'] == 'selected'){ ?>
        <?php $posts = get_sub_field('posts'); ?>

        <div class="swiper-blog-posts">
            <div class="blog-posts-layout swiper-wrapper" flex layout="row" layout-align="stretch start" layout-wrap layout-wrap-m="nowrap">
                <?php foreach($posts as $post){ ?>
                    <?php 
                    $args = array(
                        'class' => 'swiper-slide',
                    );   
                    get_template_part('inc/loop/blog-posts-loop-item', '', $args);  
                    ?>
                <?php } ?>
            </div>
            <div class="swiper-scrollbar swiper-scrollbar-blog-posts"></div>
        </div>

<?php } ?>