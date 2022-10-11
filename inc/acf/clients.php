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
$logos = get_field('logos', 'option');

$i = 0;
?>

<section class="section-layout section-logos logos <?php echo $section_classes; ?>" style="<?php echo $section_styles; ?>" <?php echo $section_datas; ?>>

    <?php 
    $section_top_args = array(
        'data' => $tta_data,
        'settings_data' => $settings,
    );
    get_template_part('inc/parts/section-top', '', $section_top_args); 
    ?>
    
    <?php if ($cta_content == true) : ?>
        <div class="section-cta-content">
            <?php if (is_array($logos)){ ?>
                <?php foreach($logos as $l){ $i++; ?>
                    <?php
                        $layout = 'flex layout="row" layout-align="center center"';
                        $gallery = 'logos-slider-inner-ltr';
                        $gallery = $l['gallery'];

                        $slider_inner_class = 'logos-slider-inner-ltr';
                        if ($i % 2 == 0){
                            $slider_inner_class = 'logos-slider-inner-rtl';
                        }

                        $gallery_length = count($gallery);
                        $to_fit_number = '15';
                        $for_loop_number = ceil($to_fit_number / $gallery_length);
                        $width = 'calc(200px * 2 * '.$for_loop_number.' * '.$gallery_length.')';
                        $width_half = 'calc(200px * '.$for_loop_number.' * '.$gallery_length.')';
                    ?>
                    
                    <?php if (is_array($gallery)){ ?>
                        <div id="logos-slider-<?php echo $i; ?>" class="logos-slider" style="width: 100%;">

                            <div class="logos-slider-inner <?php echo $slider_inner_class; ?>" style="width: <?php echo $width; ?>" flex layout="row" layout-align="space-between center">

                            <?php 
                            $anim = '
                                0% {transform: translate(0px, 0px) rotateZ(0.001deg);}
                                50% {transform: translate(calc(-1 *'.$width_half.'), 0px) rotateZ(0.001deg);}
                                100% {transform: translate(0px, 0px) rotateZ(0.001deg);}
                            ';
                            if ($i % 2 == 0){
                                $anim = '
                                    0% {transform: translate(0px, 0px) rotateZ(0.001deg);}
                                    50% {transform: translate(calc(1 *'.$width_half.'), 0px) rotateZ(0.001deg);}
                                    100% {transform: translate(0px, 0px) rotateZ(0.001deg);}
                                ';
                            }
                            echo '
                            <style>
                                @keyframes logos-slide-anim-'.$i.' {
                                    '.$anim.'
                                }
                                
                                #logos-slider-'.$i.' .logos-slider-inner {
                                    animation-name: logos-slide-anim-'.$i.';
                                }
                            </style>
                            '; ?>

                                <?php for($k = 1; $k <= $for_loop_number; $k++ ){ ?>
                                    <?php foreach($gallery as $logo){ ?>
                                        <?php 
                                            $args = array(
                                                'id' => $logo['id'],
                                            );
                                            get_template_part('inc/loop/clients-logo', '', $args); 
                                        ?>
                                    <?php } ?>
                                <?php } ?>    
                                <?php for($k = 1; $k <= $for_loop_number; $k++ ){ ?>
                                    <?php foreach($gallery as $logo){ ?>
                                        <?php 
                                            $args = array(
                                                'id' => $logo['id'],
                                            );
                                            get_template_part('inc/loop/clients-logo', '', $args); 
                                        ?>
                                    <?php } ?>
                                <?php } ?> 
                                
                                
                            </div>
    
                        </div><!-- /logos-slider -->
                    <?php } ?>

               <?php } ?>
            <?php } ?>
                
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