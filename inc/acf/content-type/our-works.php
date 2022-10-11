<?php
$order = get_sub_field('order');
$orderby = get_sub_field('orderby');
?>
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
    <div class="works-filter-holder">
        <?php /* layout-wrap-m="nowrap" layout-align-m="start start" */ ?>
        <div id="works-filter" class="works-filter" flex="none" layout="row" layout-align="center center" layout-wrap>
                <div class="works-filter-button works-filter-button-active" data-filter="*">
                    <span class="works-filter-button-text">
                        All Types
                    </span>
                </div>
                <?php while ( $works_filter_query->have_posts() ) {  
                    $works_filter_query->the_post();
                    $id = get_the_ID();
                    
                    $child_args = array(
                        'post_parent' => $id, // The parent id.
                        'post_type'   => 'page',
                        'post_status' => 'publish'
                    );
                    $children = get_children( $child_args );
                ?>
                <?php if (!empty($children)){ ?>
                    <div class="works-filter-button" data-filter=".filter-<?php echo $id; ?>">
                        <span class="works-filter-button-text">
                            <?php the_title(); ?>
                        </span>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
<?php } wp_reset_postdata(); ?>

<div id="works-grid" class="works-loop-layout" flex layout="row" layout-align="stretch start" layout-wrap>
    
    <?php
    $works_args = array(
        'post_type' => 'page',
        'posts_per_page'=> -1,
        'orderby' => $orderby['value'],
        'order' => strtoupper($order['value']),
        'tax_query' => array(
            array(
                'taxonomy' => 'page_type',
                'field'    => 'slug',
                'terms'    => 'cases',
            ),
        ),
    );
    $works_query = new WP_Query( $works_args );
    if ( $works_query->have_posts() ) {
        while ( $works_query->have_posts() ) {  
            $works_query->the_post();
            $args = array(
                'remove_category' => false,
                'remove_bottom_link' => false,
            );
            get_template_part('inc/loop/works-list-loop-item', '', $args); 

        } 
    } wp_reset_postdata(); 
    ?>

</div>