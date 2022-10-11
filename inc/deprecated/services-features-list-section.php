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
$rows = get_sub_field('item');

?>
<section class="section-layout section-services-feateures-list services-feateures-list <?php echo $section_classes; ?>" style="<?php echo $section_styles; ?>" <?php echo $section_datas; ?>>

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

                <?php if ($rows): $i = 1; ?>
                    <?php foreach($rows as $row): $i++; ?>

                        <?php
                            $title = $row['title'];
                            $text = $row['text'];
                            $image = $row['image'];
                            $video = $row['video'];
                            $media_type = $row['media_type'];

                            $media_output = '';
                            if ($media_type == 'image' and $image){
                                $thumb = wp_get_attachment_image( $image['ID'], 'full' );
                                $image_data = 'flex layout="row" layout-align="center center" layout-align-m="end end"';
                                $media_output = '
                                    <div class="services-feature-image col" '.$image_data.'>
                                        <div class="services-feature-image-inner reveal">
                                            '.$thumb.'
                                        </div>
                                    </div>
                                ';
                            }
                            if ($media_type == 'video' and $image){
                                $url = $video['url'];
                                $media_output = '
                                    <div class="services-feature-video col">
                                        <div class="services-feature-video-inner reveal">
                                            <video src="'.$url.'" autoplay muted loop poster="'.$image['url'].'">
                                                Sorry, your browser doesn`t support embedded videos!
                                            </video>
                                        </div>
                                    </div>
                                ';
                            }
                        ?>

                        <div class="services-feature-layout" flex layout="row" layout-m="column" layout-align="space-between center" layout-align-m="stretch start">

                            <?php 
                            $class = 'reveal fromLeft';
                            if ($i % 2 == 0){
                                $class = 'reveal fromRight';
                            }
                            ?>
                            
                            <?php if ($i % 2 == 0){
                                echo $media_output;
                            } ?>

                            <div class="services-feature-content <?php echo $class; ?> col" flex="none">
                                <?php if ($title){ ?>
                                    <h2 class="services-feature-content-title">
                                        <?php echo $title; ?>
                                    </h2>
                                <?php } ?>

                                <?php if ($text){ ?>
                                    <div class="services-feature-content-text">
                                        <?php echo $text; ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <?php if ($i % 2 != 0){
                                echo $media_output;
                            } ?>

                        </div><!-- // services-feature-layout -->

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