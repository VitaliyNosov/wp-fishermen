<?php 
/**
 * Titles Text Action Data
 */
$tta_data = get_sub_field('titles_text_actions');

/**
 * Settings
 */
$section_styles = '';
$section_classes = '';
$section_datas = '';
$bg = 'none';

$settings = get_sub_field('settings_group');
if ($settings['background'] == 'custom'){
    $bg = $settings['background_custom'];
    if ($settings['background_custom'] == 'colorpicker'){
        $bg_colorpicker = $settings['background_custom_colorpicker'];
        $fonts_colors = $settings['fonts_colors'];
        $section_styles .= 'background-color: '.$bg_colorpicker.''; 
        $section_classes .= ' fonts-color-bg-'.$fonts_colors.'';
    }

    $section_classes .= ' bg-'.$bg.'';
    if ($settings['background_custom'] == 'colorpicker'){
        $section_datas .= ' data-onbg="bg-'.$fonts_colors.'"';
    } else {
        $section_datas .= ' data-onbg="bg-'.$bg.'"';
    }
}

/**
 * CTA
 */
$cta_content = get_sub_field('cta_content');

/**
 * Section Fields
 */
$display = get_sub_field('posts_display');
$categories = get_sub_field('categories');
?>
<section class="section-layout section-blog-posts blog-posts <?php echo $section_classes; ?>" style="<?php echo $section_styles; ?>" <?php echo $section_datas; ?>>

    <div class="reveal">

    <?php 
    $section_top_args = array(
        'data' => $tta_data,
        'settings_data' => $settings,
    );
    get_template_part('inc/parts/section-top', '', $section_top_args); 
    ?>

    <?php if ($cta_content == true) : ?>
        <div class="section-cta-content">
            <div class="wrapper">

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
                    <div class="blog-posts-layout" flex layout="row" layout-align="stretch start" layout-wrap layout-wrap-m="nowrap">
                        <?php while ( $blog_query->have_posts() ) {  
                            $blog_query->the_post();
                        ?>
                            <?php get_template_part('inc/loop/blog-posts-loop-item');  ?>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?php wp_reset_postdata(); ?>
            
            <?php } else if ($display['value'] == 'selected'){ ?>
                <?php 
                    $posts = get_sub_field('posts');
                ?>

                <div class="blog-posts-layout" flex layout="row" layout-align="stretch start" layout-wrap layout-wrap-m="nowrap">
                    <?php foreach($posts as $post){ ?>
                        <?php get_template_part('inc/loop/blog-posts-loop-item');  ?>
                    <?php } ?>
                </div>

            <?php } ?>
            

            </div>
        </div>
    <?php endif; /* endif cta_content */ ?>

    <?php 
    $section_bottom_args = array(
        'data' => $tta_data,
        'settings_data' => $settings,
    );
    get_template_part('inc/parts/section-bottom', '', $section_bottom_args); 
    ?>

    </div>

</section>