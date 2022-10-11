<?php 
$page_id = get_the_ID();
$datas = '';
$colors_for_colored_elements = get_field('colors_for_colored_elements', $page_id);
if ($colors_for_colored_elements){
    $color_for_elements = $colors_for_colored_elements;
    $datas .= ' data-color-for-elements="'.$color_for_elements.'"';
}
?>

<?php 
    $prev_post = get_adjacent_post( true, '', true, 'page_type' ); 
    $next_post = get_adjacent_post( true, '', false, 'page_type' ); 
?>
<?php /*
<?php if ( is_a( $prev_post, 'WP_Post' ) ) { ?>
<a href="<?php echo get_permalink( $prev_post->ID ); ?>">PREV <?php echo get_the_title( $prev_post->ID ); ?></a>
<?php }  ?>
<?php if ( is_a( $next_post, 'WP_Post' ) ) { ?>
<a href="<?php echo get_permalink( $next_post->ID ); ?>">NEXT <?php echo get_the_title( $next_post->ID ); ?></a>
<?php } ?>
*/ ?>

<?php
$works_array = array();
$works_args = array(
    'post_type' => 'page',
    'posts_per_page'=> -1,
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
    $id = get_the_ID();
    $works_array[] = $id;
} 
} wp_reset_postdata(); 
$first_work = end($works_array);
?>

<div class="view-page" <?php echo $datas; ?>>
    <div class="wrapper">
        <div class="view-page-container col">

            <div class="view-page-layout" flex layout="row" layout-s="column" layout-align="space-between center">
                <?php if ( is_a( $next_post, 'WP_Post' ) ) { ?>
                    <?php $next_id = $next_post->ID; ?>
                <?php } else if ($next_post == ''){ ?>
                    <?php $next_id = $first_work; ?>
                <?php } ?>
                <div class="view-page-title" flex flex-s="none">
                    <div class="view-page-title-overhead body-1">
                        Next Case Study
                    </div>
                    <div class="view-page-title-text h3">
                        <?php echo get_the_title( $next_id ); ?>
                    </div>
                </div>
                <div class="view-page-link" flex="none">
                    <a class="view-page-link-itself colored-element link-object link-arrow" href="<?php echo get_permalink( $next_id ); ?>" flex layout="row" layout-align="center center">
                        <span class="link-arrow-text view-page-link-text" flex="none">
                            View Case Study
                        </span>
                        <span class="view-page-link-icon icon-arrow-right" flex="none"></span>
                    </a>
                </div>
            </div>	

        </div>
    </div>
</div>