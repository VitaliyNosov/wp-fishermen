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
$reveal_section_top = false;
$reveal_section_bottom = false;

/**
 * Section Fields
 */
$rows = get_sub_field('text_blocks');
?>

<section class="section-layout section-text-blocks text-blocks <?php echo $section_classes; ?>" style="<?php echo $section_styles; ?>" <?php echo $section_datas; ?>>

    <?php 
    $section_top_args = array(
        'data' => $tta_data,
        'settings_data' => $settings,
        'reveal' => $reveal_section_top,
    );
    get_template_part('inc/parts/section-top', '', $section_top_args); 
    ?>
    
    <?php if ($cta_content == true) : ?>
        <div class="section-cta-content">
            <div class="wrapper">

                <?php if ($rows): ?>
                    <?php foreach($rows as $row): ?>

                        <?php
                            $name = $row['acf_fc_layout'];
                        ?>
                        
                        <?php
                        /**
                         * Single Centered Text Block
                         */
                        if ($name == 'single_centered_text_block'){ ?>
                            <?php
                                $title = $row['title'];
                                $title_tag_str = 'h3';
                                if (array_key_exists('title_tag', $row)){
                                    $title_tag_str = $row['title_tag'];
                                }
                                $title_weight_str = 'normal';
                                if (array_key_exists('title_weight', $row)){
                                    $title_weight_str = $row['title_weight'];
                                }
                                $text = $row['text'];
                            ?>
                            <div class="text-block-container reveal-small col">
                                <div class="text-block-holder text-block-centered-single" flex layout="row" layout-align="center center">
                                    <div class="text-block-layout" flex layout="column" layout-m="column" layout-align="center center">
                                        <?php if ($title){ ?>
                                            <div class="text-block-title <?php echo $title_tag_str; ?> weight-<?php echo $title_weight_str; ?>" flex>
                                                <?php echo $title; ?>
                                            </div>
                                        <?php } ?>
                                        <?php if ($text){ ?>
                                            <div class="text-block-text body-1" flex="auto">
                                                <?php echo $text; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                        /**
                         * Columned Text Block
                         */
                        if ($name == 'columned_text_block'){ ?>
                            <?php
                                $title = $row['title'];
                                $text = $row['text'];
                            ?>
                            <div class="text-block-container reveal-small col">
                                <div class="text-block-holder text-block-centered-2-columns" flex layout="row" layout-align="center center">
                                    <div class="text-block-layout" flex layout="row" layout-m="column" layout-align="start start">
                                        <?php if ($title){ ?>
                                            <div class="text-block-title r-right h3" flex flex-m="none">
                                                <?php echo $title; ?>
                                            </div>
                                        <?php } ?>
                                        <?php if ($text){ ?>
                                            <div class="text-block-text r-left body-2" flex flex-m="none">
                                                <?php echo $text; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                        /**
                         * Features List
                         */
                        if ($name == 'features_list'){ ?>
                            <?php if (is_array($row['item'])){ ?>
   
                                <div class="features-text-container col">
                                    <div class="features-text reveal" flex layout="row" layout-align="stretch start">
                                        <ol class="features-text-nums" flex="none">
                                            <?php $i = 0; foreach( $row['item'] as $post ): $i++ ?>
                                                <?php 
                                                    $title = $post['title'];
                                                    $text = $post['text'];
                                                ?>
                                                <li class="features-text-nums-list-item <?php if ($i == 1){ echo 'active'; } ?>" data-elem="<?php echo $i; ?>">
                                                    <div class="features-text-nums-item">
                                                        <div class="features-text-nums-item-title">
                                                            <?php echo esc_html($title); ?>
                                                        </div>
                                                        <div class="features-text-nums-item-text">
                                                            <div class="features-text-nums-item-text-content body-2">
                                                                <?php 
                                                                    $feature_list_arr[] = $text;
                                                                    echo $text; 
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ol>
                                        <div class="features-text-content" flex></div>
                                    </div>
                                </div>
                            
                            <?php } ?>
                        <?php } ?>

                    <?php endforeach; // end foreach rows ?>
                <?php endif; // end if rows ?>
                
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