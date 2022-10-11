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
$posts = get_sub_field('item');
?>
<section class="section-layout section-features-text-list features-text-list <?php echo $section_classes; ?>" style="<?php echo $section_styles; ?>" <?php echo $section_datas; ?>>
<div class="features-text-list-wrapper">

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
                    <div class="features-text">
                        <ol class="features-text-nums">
                        <?php $i = 0; foreach( $posts as $post ): $i++ ?>
                            <?php 
                                $title = $post['title'];
                                $text = $post['text'];
                            ?>
                            <li class="col-marg <?php if ($i == 1){ echo 'features-text-nums-item-aclite'; } ?>">
                                <div class="features-text-nums-item">
                                    <div class="features-text-nums-item-title">
                                        <?php echo esc_html($title); ?>
                                    </div>
                                    <div class="features-text-nums-item-text">
                                        <?php echo $text; ?>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        </ol>
                    </div>
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

</div>
</section>