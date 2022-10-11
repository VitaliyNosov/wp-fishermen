<?php 
$usage = 'default';
$usage_data = get_sub_field('usage');
if ($usage_data){
    $usage = $usage_data;
}

$page_id = get_the_ID();
$datas = '';
$colors_for_colored_elements = get_field('colors_for_colored_elements', $page_id);
if ($colors_for_colored_elements){
    $color_for_elements = $colors_for_colored_elements;
    $datas .= ' data-color-for-elements="'.$color_for_elements.'"';
}

/**
 * Get Next ID by default
 * Get First Case
 */
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
} 
wp_reset_postdata(); 

$first_work = end($works_array);

$prev_post = get_adjacent_post( true, '', true, 'page_type' ); 
$next_post = get_adjacent_post( true, '', false, 'page_type' ); 
if ( is_a( $next_post, 'WP_Post' ) ) {
    $next_id = $next_post->ID;
} else if ($next_post == ''){
    $next_id = $first_work;
}

/**
 * Default Vars
 */
$overhead_text = 'Next Case Study';
$title_text = get_the_title( $next_id ); 
$link_url = get_permalink( $next_id );
$link_title = 'View Case Study';
$link_target = '_self';

/**
 * Content Fields
 */
$custom = '';
$custom_data = get_sub_field('custom');
if ($custom_data){
    $overhead = $custom_data['overhead'];
    $title = $custom_data['title'];
    $link = $custom_data['link'];
}

if ($overhead){
    $overhead_text = $overhead;
}
if ($title){
    $title_text = $title;
}
if ($link){
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
}

?>


<div class="view-page" <?php echo $datas; ?>>
    <div class="wrapper">
        <div class="view-page-container col">

            <div class="view-page-layout" flex layout="row" layout-s="column" layout-align="space-between center">

                <div class="view-page-title" flex flex-s="none">
                    <div class="view-page-title-overhead body-1">
                        <?php echo $overhead_text; ?>
                    </div>
                    <div class="view-page-title-text h3">
                        <?php echo $title_text; ?>
                    </div>
                </div>

                <div class="view-page-link" flex="none">

                    <?php if ($link){ ?>
                        <div class="view-page-go-holder">
                            <a class="view-page-go link-object" href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>">
                                <span class="view-page-go-shape"></span>
                                <span class="view-page-go-layout" flex layout="row" layout-align="center center">
                                    <span class="view-page-go-icon" flex="none" layout="row" layout-align="center center">
                                        <span class="chevron right" flex="none"></span>
                                    </span>
                                    <span class="view-page-go-text" flex="none">
                                        <?php echo $link_title; ?>
                                    </span>
                                </span>
                            </a>
                        </div>
                    <?php } else { ?>
                        <a class="view-page-link-itself colored-element link-object link-arrow" href="<?php echo $link_url; ?>" flex layout="row" layout-align="center center" target="<?php echo $link_target; ?>">
                            <span class="link-arrow-text view-page-link-text" flex="none">
                                <?php echo $link_title; ?>
                            </span>
                            <span class="view-page-link-icon icon-arrow-right" flex="none"></span>
                        </a>
                    <?php } ?>

                </div>
            </div>	

        </div>
    </div>
</div>