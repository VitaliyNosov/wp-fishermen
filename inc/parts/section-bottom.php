<?php
$data_array = $args['data'];
$settings_data_array = $args['settings_data'];
$card_in_section = $settings_data_array['card_in_section'];

$bg = '';
if(array_key_exists('bg', $args)){
    $bg = $args['bg'];
}

$reveal = false;
if(array_key_exists('reveal', $args)){
    $reveal = $args['reveal'];
}

$card_color = '';
if(array_key_exists('card_color', $settings_data_array)){
    $card_color = $settings_data_array['card_color'];
}

$bottom_data_array = array();
if (is_array($data_array)){
    foreach($data_array as $data):
        $layout_name = $data['acf_fc_layout'];
        if ($layout_name == 'bottom_link'):
            $bottom_data_array[] = $data;
        endif;
    endforeach;
}

/**
 * Colors
 */
$page_id = get_the_ID();
$color_for_elements = 'none';

$settings_data_colors_for_colored_elements = '';
if (array_key_exists('colors_for_colored_elements', $settings_data_array)){
    $settings_data_colors_for_colored_elements = $settings_data_array['colors_for_colored_elements'];
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
<?php if (!empty($bottom_data_array) or $card_in_section == 'yes'): ?>
    <div class="section-bottom" data-color-for-elements="<?php echo $color_for_elements; ?>">
        <div class="wrapper">

            <?php if (!empty($bottom_data_array)){ ?>
                <div class="section-bottom-inner col">
                    <?php foreach($data_array as $data): ?>
                        <?php 
                            $layout_name = $data['acf_fc_layout'];
                        ?>
                        
                        <?php
                        /**
                         * Bottom Link 
                         */
                        if ($layout_name == 'bottom_link'): ?>
                            <?php 
                                $link = $data['link_bottom'];
                                $colored = 'no';
                                $class = '';
                                if (array_key_exists('colored', $data)){
                                    $colored = $data['colored'];
                                }
                                if ($colored != 'no'){
                                    $class .= ' colored-element';
                                }
                                if ($reveal == true){
                                    $class .= ' reveal';
                                }
                            ?>
                            <?php if ($link){ ?>
                            <div class="bottom-link-layout <?php echo $class; ?>" flex layout="row" layout-align="center start">
                                <?php
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <a class="bottom-link link-arrow" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" flex="none" layout="row" layout-align="start center">
                                    <span class="link-arrow-text" flex="none">
                                        <?php echo esc_html($link_title); ?>
                                    </span>
                                    <i flex="none" class="bottom-link-icon icon-arrow-right"></i>
                                </a>
                            </div>
                            <?php } ?>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </div>
            <?php } ?>

            <?php
            $card = get_field('card', 'option');
            $card_title = $card['title'];
            $card_text = $card['text'];
            $card_link = $card['link'];

            if ($card_in_section == 'yes'):
                $card_custom = $settings_data_array['card_custom'];
                if (!empty($card_custom['title'])){
                    $card_title = $card_custom['title'];   
                }
                if (!empty($card_custom['text'])){
                    $card_text = $card_custom['text'];   
                }
                if (!empty($card_custom['title'])){
                    $card_link = $card_custom['link'];   
                }
            ?>  
                <?php 
                $args = array(
                    'title' => $card_title,
                    'text' => $card_text,
                    'link' => $card_link,
                    'bg' => $bg,
                    'card_color' => $card_color,
                );
                get_template_part('inc/parts/card-standalone', '', $args); 
                ?>
            <?php endif; ?>

        </div>
    </div>
<?php endif; // check if $data is array and exists ?>