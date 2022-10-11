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
$section_id = '';

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
 * Colors
 */
$page_id = get_the_ID();
$color_for_elements = 'none';

$settings_data_colors_for_colored_elements = $settings['colors_for_colored_elements'];

if ($settings_data_colors_for_colored_elements and $settings_data_colors_for_colored_elements != 'none'){
    $colors_for_colored_elements = $settings_data_colors_for_colored_elements;
} else {
    $colors_for_colored_elements = get_field('colors_for_colored_elements', $page_id);
}
if ($colors_for_colored_elements){
    $color_for_elements = $colors_for_colored_elements;
    $section_datas .= ' data-color-for-elements="'.$color_for_elements.'"';
}

/**
 * CTA
 */
$cta_content = get_sub_field('cta_content');
$content_type = get_sub_field('content_type');

$add_wrapper = true;
$reveal = false;
$reveal_section_top = false;
$reveal_section_bottom = false;
$section_top_title = '';
$section_top_class = '';

$i = 1;
if( have_rows('content_type') ):
    while ( have_rows('content_type') ) : the_row();

        if( get_row_layout() == 'clients' ):
            $section_classes .= ' section-logos logos';
            $add_wrapper = false;

        elseif( get_row_layout() == 'case_studies' ): 
            $section_classes .= ' section-case-studies case-studies';
            $reveal_section_bottom = true;

        elseif( get_row_layout() == 'services_cards' ): 
            $section_classes .= ' section-services-cards services-cards';

        elseif( get_row_layout() == 'blog_posts' ): 
            $section_classes .= ' section-blog-posts blog-posts';
            $reveal = true;
            $section_top_class = 'posts-top-section';
            $section_top_title = 'st1';

        elseif( get_row_layout() == 'services_features_list' ): 
            $section_classes .= ' section-services-feateures-list services-feateures-list';
            $reveal = false;
            $reveal_section_bottom = true;

        elseif( get_row_layout() == 'featured_projects' ): 
            $section_classes .= ' section-featured-projects featured-projects';
            $reveal = true;
            $section_top_class = 'posts-top-section';
            $section_top_title = 'st1';

        elseif( get_row_layout() == 'our_works' ): 
            $section_classes .= ' section-works-list works-list';

        elseif( get_row_layout() == 'job_openings' ): 
            $section_classes .= ' section-job-openings job-openings';
            $section_id = 'jobs';
            $reveal_section_top = true;

        elseif( get_row_layout() == 'contact_us' ): 
            $section_classes .= ' section-contact-us cobtact-us';

        elseif( get_row_layout() == 'makers' ): 
            $section_classes .= ' section-makers makers';

        endif;

    endwhile;
else :
// Do something...
endif;
?>
<section id="<?php echo $section_id; ?>" class="section-layout <?php echo $section_classes; ?>" style="<?php echo $section_styles; ?>" <?php echo $section_datas; ?>>

    <?php echo $reveal_section_top; ?>

    <?php if ($reveal == true) {echo '<div class="reveal">'; } ?>

    <?php 
    $section_top_args = array(
        'data' => $tta_data,
        'settings_data' => $settings,
        'section_top_class' => $section_top_class,
        'section_top_title' => $section_top_title,
        'reveal' => $reveal_section_top,
    );
    get_template_part('inc/parts/section-top', '', $section_top_args); 
    ?>
    
    <?php if ($cta_content == true) : ?>
        <div class="section-cta-content">
            <?php if ($add_wrapper == true) { echo '<div class="wrapper">'; } ?>

                <?php
                    if( have_rows('content_type') ):
                        while ( have_rows('content_type') ) : the_row();

                            if( get_row_layout() == 'clients' ):
                                get_template_part('inc/acf/content-type/clients');

                            elseif( get_row_layout() == 'case_studies' ): 
                                get_template_part('inc/acf/content-type/case-studies');

                            elseif( get_row_layout() == 'services_cards' ): 
                                get_template_part('inc/acf/content-type/services-cards');

                            elseif( get_row_layout() == 'blog_posts' ): 
                                get_template_part('inc/acf/content-type/blog-posts');
                            
                            elseif( get_row_layout() == 'services_features_list' ): 
                                $args = array();
                                get_template_part('inc/acf/content-type/services-features-list', '', $args);

                            elseif( get_row_layout() == 'featured_projects' ): 
                                get_template_part('inc/acf/content-type/featured-projects');

                            elseif( get_row_layout() == 'our_works' ): 
                                get_template_part('inc/acf/content-type/our-works');

                            elseif( get_row_layout() == 'job_openings' ): 
                                get_template_part('inc/acf/content-type/job-openings');

                            elseif( get_row_layout() == 'contact_us' ): 
                                get_template_part('inc/acf/content-type/contact-us');

                            elseif( get_row_layout() == 'makers' ): 
                                get_template_part('inc/acf/content-type/makers');

                            endif;

                        endwhile;
                    else :
                    // Do something...
                    endif;
                ?>
                
            <?php if ($add_wrapper == true) { echo '</div>'; } ?>
        </div>
    <?php endif; /* endif cta_content */ ?>

    <?php 
    $section_bottom_args = array(
        'data' => $tta_data,
        'settings_data' => $settings,
        'reveal' => $reveal_section_bottom,
    );
    get_template_part('inc/parts/section-bottom', '', $section_bottom_args); 
    ?>

    <?php if ($reveal == true) {echo '</div>'; } ?>

</section>