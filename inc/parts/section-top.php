<?php
$data_array = $args['data'];
$settings_data_array = $args['settings_data'];
$classes = '';

$section_top_title_val = '';
if (array_key_exists('section_top_title', $args)){
    $section_top_title_val = $args['section_top_title'];
};

$section_top_class_val = '';
if (array_key_exists('section_top_class', $args)){
    $section_top_class_val = $args['section_top_class'];
    $classes .= ' '.$section_top_class_val;
};

$reveal = false;
if(array_key_exists('reveal', $args)){
    $reveal = $args['reveal'];
    if ($reveal == true){
        $classes .= ' reveal';
    }
}

$aligments = get_sub_field('aligments'); 
if ($aligments){
    if ($aligments == 'left'){
        $classes .= ' align-left';
    } else if ($aligments == 'center'){
        $classes .= ' align-center';
    } else if ($aligments == 'right'){
        $classes .= ' align-right';
    }
};

/**
 * Colors
 */
$page_id = get_the_ID();
$color_for_elements = 'none';

$settings_data_colors_for_colored_elements = '';
if (is_array($settings_data_array)){
    if (array_key_exists('colors_for_colored_elements', $settings_data_array)){
        $settings_data_colors_for_colored_elements = $settings_data_array['colors_for_colored_elements'];
    }
}

if ($settings_data_colors_for_colored_elements and $settings_data_colors_for_colored_elements != 'none'){
    $colors_for_colored_elements = $settings_data_colors_for_colored_elements;
} else {
    $colors_for_colored_elements = get_field('colors_for_colored_elements', $page_id);
}
if ($colors_for_colored_elements){
    $color_for_elements = $colors_for_colored_elements;
}
?>
<?php if (is_array($data_array)): ?>
    <div class="section-top <?php echo $classes; ?>" data-color-for-elements="<?php echo $color_for_elements; ?>">
        <div class="wrapper">

            <div class="section-top-inner col">
                <?php foreach($data_array as $data): ?>
                    <?php 
                        $layout_name = $data['acf_fc_layout'];
                    ?>

                    <?php
                    /**
                     * Main Title 
                     */
                    if ($layout_name == 'main_title'): ?>
                        <?php 
                            $title = $data['title'];
                            $tag = $data['tag'];
                            $class = 'section-top-title section-top-element';
                            if ($section_top_title_val != ''){
                                $class .= ' st1';
                                $tag = 'div';
                            }

                            $data_attrs = '';

                            $gaps_data = '';
                            if (key_exists('gaps', $data)){
                                $gaps_data = $data['gaps'];
                            }
                            if (is_array($gaps_data)){
                                if (key_exists('wide', $gaps_data)){
                                    $data_attrs .= ' data-gap-wide='.$gaps_data['wide'];
                                }
                                if (key_exists('tablet', $gaps_data)){
                                    $data_attrs .= ' data-gap-tablet='.$gaps_data['tablet'];
                                }
                                if (key_exists('mobile', $gaps_data)){
                                    $data_attrs .= ' data-gap-mobile='.$gaps_data['mobile'];
                                }
                            }

                            $weight_data = '';
                            if (key_exists('weight', $data)){
                                $weight_data = $data['weight'];
                            }
                            if (is_array($weight_data)){
                                if (key_exists('wide', $weight_data)){
                                    $data_attrs .= ' data-weight-wide='.$weight_data['wide'];
                                }
                                if (key_exists('tablet', $weight_data)){
                                    $data_attrs .= ' data-weight-tablet='.$weight_data['tablet'];
                                }
                                if (key_exists('mobile', $weight_data)){
                                    $data_attrs .= ' data-weight-mobile='.$weight_data['mobile'];
                                }
                            }
                        ?>
                        <?php if ($title){ ?>
                            <<?php echo esc_html($tag); ?> class="<?php echo $class; ?>" <?php echo $data_attrs; ?>>
                                <?php echo $title; ?>
                            </<?php echo esc_html($tag); ?>>
                        <?php } ?>
                    <?php endif; ?>

                    <?php
                    /**
                     * Small Title 
                     */
                    if ($layout_name == 'small_title'): ?>
                        <?php 
                            $title = $data['title'];
                            $tag = $data['tag'];

                            $data_attrs = '';

                            $gaps_data = '';
                            if (key_exists('gaps', $data)){
                                $gaps_data = $data['gaps'];
                            }
                            if (is_array($gaps_data)){
                                if (key_exists('wide', $gaps_data)){
                                    $data_attrs .= ' data-gap-wide='.$gaps_data['wide'];
                                }
                                if (key_exists('tablet', $gaps_data)){
                                    $data_attrs .= ' data-gap-tablet='.$gaps_data['tablet'];
                                }
                                if (key_exists('mobile', $gaps_data)){
                                    $data_attrs .= ' data-gap-mobile='.$gaps_data['mobile'];
                                }
                            }

                            $weight_data = '';
                            if (key_exists('weight', $data)){
                                $weight_data = $data['weight'];
                            }
                            if (is_array($weight_data)){
                                if (key_exists('wide', $weight_data)){
                                    $data_attrs .= ' data-weight-wide='.$weight_data['wide'];
                                }
                                if (key_exists('tablet', $weight_data)){
                                    $data_attrs .= ' data-weight-tablet='.$weight_data['tablet'];
                                }
                                if (key_exists('mobile', $weight_data)){
                                    $data_attrs .= ' data-weight-mobile='.$weight_data['mobile'];
                                }
                            }

                        ?>
                        <?php if ($title){ ?>
                            <?php if ($tag == 'semibold'){ ?>
                                <div class="section-top-small-title colored-element section-top-element semibold-1"  <?php echo $data_attrs; ?>>
                                    <?php echo $title; ?>
                                </div>
                            <?php } else { ?>
                                <<?php echo esc_html($tag); ?> class="section-top-small-title colored-element section-top-element"  <?php echo $data_attrs; ?>>
                                    <?php echo $title; ?>
                                </<?php echo esc_html($tag); ?>>
                            <?php } ?>
                        <?php } ?>
                    <?php endif; ?>

                    <?php
                    /**
                     * Text
                     */
                    if ($layout_name == 'description'): ?>
                        <?php 
                            $text = $data['text'];
                            $text_style = $data['text_style'];
                            $text_class = '';
                            if ($text_style == 'h6'){
                                $text_class = 'h6';
                            } else {
                                $text_class = 'semibold-2';
                            }
                        ?>
                        <?php if ($text){ ?>
                            <div class="section-top-text section-top-element <?php echo $text_class; ?>">
                                <?php echo $text; ?>
                            </div>
                        <?php } ?>
                    <?php endif; ?>

                <?php endforeach; ?>
            </div>

        </div>
    </div>
<?php endif; // check if $data is array and exists ?>