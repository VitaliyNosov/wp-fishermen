<?php 
/**
 * Titles Text Action Data
 */
$tta_data = get_sub_field('titles_text_actions');

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
$posts = get_sub_field('works_list');
?>
<section class="section-works-list works-list <?php echo $bg_class; ?>" data-bg="<?php echo $bg_class; ?>">

    <?php   
    $section_top_args = array(
        'data' => $tta_data,
    );
    get_template_part('inc/parts/section-top', '', $section_top_args); 
    ?>

    <?php if ($cta_content == true) : ?>
        <div class="section-cta-content">
            <div class="wrapper">

                <?php if( $posts ): ?>

                    <?php
                    $works_filter_args = array(
                        'post_type' => 'page',
                        'posts_per_page'=> -1,
                        'orderby' => 'title',
                        'order' => 'ASC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'page_type',
                                'field'    => 'slug',
                                'terms'    => 'services',
                            ),
                        ),
                    );
                    $works_filter_query = new WP_Query( $works_filter_args );
                    if ( $works_filter_query->have_posts() ) {
                    ?>
                        <div class="works-filter-holder col">
                            <div id="works-filter" class="works-filter" flex="none" layout="row" layout-align="center center" layout-wrap layout-wrap-m="nowrap" layout-align-m="start start">
                                    <div class="works-filter-button works-filter-button-active" data-filter="*">
                                        <span class="works-filter-button-text">
                                            All Types
                                        </span>
                                    </div>
                                <?php while ( $works_filter_query->have_posts() ) {  
                                    $works_filter_query->the_post();
                                    $id = get_the_ID();
                                ?>
                                    <div class="works-filter-button" data-filter=".filter-<?php echo $id; ?>">
                                        <span class="works-filter-button-text">
                                            <?php the_title(); ?>
                                        </span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } wp_reset_postdata(); ?>

                    <div id="works-grid" class="works-loop-layout" flex layout="row" layout-align="stretch start" layout-wrap>
                        <?php foreach( $posts as $post ): ?>
                            <?php 
                                $args = array(
                                );
                                get_template_part('inc/loop/works-list-loop-item', '', $args); 
                            ?>
                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
    <?php endif; /* endif cta_content */ ?>

    <?php 
    $section_bottom_args = array(
        'data' => $tta_data,
    );
    get_template_part('inc/parts/section-bottom', '', $section_bottom_args); 
    ?>

</section>