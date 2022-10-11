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
$posts = get_sub_field('case_studies_list');
$i = 1;
?>
<section class="section-layout section-case-studies case-studies <?php echo $section_classes; ?>" style="<?php echo $section_styles; ?>" <?php echo $section_datas; ?>>

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

                <?php if( $posts ): ?>
                    <?php foreach( $posts as $post ): ?>
                        <?php 
                            $args = array(
                                'counter_i' => $i,
                            );
                            get_template_part('inc/loop/case-studies-loop-item', '', $args); 
                            $i++;
                        ?>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
                
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

</section>