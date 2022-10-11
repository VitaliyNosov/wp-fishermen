<?php
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
    $section_datas .= ' data-onbg="bg-'.$bg.'"';
}

$card_color = $settings['card_color'];

$usage = get_sub_field('usage');

$title = '';
$text = '';
$link = array();

if ($usage == 'default'){

    $card = get_field('card', 'option');
    $title = $card['title'];
    $text = $card['text'];
    $link = $card['link'];
} else if ($usage == 'custom'){

    $card = get_sub_field('card_custom');
    $title = $card['title'];
    $text = $card['text'];
    $link = $card['link'];
}

?>
<section class="section-layout section-card <?php echo $section_classes; ?>" style="<?php echo $section_styles; ?>" <?php echo $section_datas; ?>>
    <div class="wrapper">

        <?php 
        $args = array(
            'title' => $title,
            'text' => $text,
            'link' => $link,
            'bg' => $bg,
            'card_color' => $card_color,
        );
        get_template_part('inc/parts/card-standalone', '', $args); 
        ?>

    </div>
</section>