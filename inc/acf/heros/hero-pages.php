<?php
/**
 * Fields
 */
$classes = '';

$overhead = $args['overhead']; 
$title =  $args['title'];
$title_style_tag =  $args['title_style_tag'];
$description =  $args['description'];
$add_additional_description =  $args['add_additional_description'];
$additional_description =  $args['additional_description'];
$action_button_link =  $args['action_button_link'];
$action_button =  $args['action_button'];

$media_type =  $args['media_type'];
$media_style =  $args['media_style'];
$initial_image_max_height =  $args['initial_image_max_height'];
$pad_for_content =  $args['pad_for_content'];

$image =  $args['image'];
$obj_filename_val = $args['3d_object_filename'];
$in_phone_file =  $args['in_phone'];
$video = $args['video'];

$valign =  $args['vertical_aligment'];
//$full_height =  $args['full_height'];

/**
 * Settings
 */
$section_datas = '';
$settings =  get_sub_field('settings_group');

/**
 * Colors
 */
$page_id = get_the_ID();
$color_for_elements = 'none';
$settings_data_colors_for_colored_elements = 'none';

if (is_array($settings)){
    $settings_data_colors_for_colored_elements = $settings['colors_for_colored_elements'];
}

if ($settings_data_colors_for_colored_elements and $settings_data_colors_for_colored_elements != 'none'){
    $colors_for_colored_elements = $settings_data_colors_for_colored_elements;
} else {
    $colors_for_colored_elements = get_field('colors_for_colored_elements', $page_id);
}
if ($colors_for_colored_elements){
    $color_for_elements = $colors_for_colored_elements;
    $section_datas .= ' data-color-for-elements="'.$color_for_elements.'"';
}
$section_datas .= ' data-onbg=""';

/**
 * Vars
 */
/*
if ($full_height == 'yes'){
    $classes .= 'full-height';
}
*/
$classes .= 'full-height';

$layout = 'flex layout="row" layout-align="start start" layout-m="column"';
if ($valign == 'center'){
    $layout = 'flex layout="row" layout-align="center center" layout-m="column"';
}

if ($media_type == 'image'){
    $classes .= ' media-image';
}

if ($pad_for_content == 'yes'){
    $classes .= ' pad-for-content';
}
?>
<section class="global-hero" <?php echo $section_datas; ?>>
    <div class="global-hero-inner <?php echo $classes; ?>">
        <div class="wrapper">
            <div class="global-hero-layout col">

                <!-- global-hero-col -->
                <div class="global-hero-col" flex layout="column" layout-align="start stretch"> 
                    <div class="global-hero-col-top" flex="none">
                        <?php if( has_term('cases', 'page_type') ){ ?>
                            <?php 
                                $page_id = get_the_ID();
                                $go_back_data = '';
                                $go_back = get_field('go_back', $page_id);
                                if ($go_back){
                                    $go_back_data = $go_back; 
                                }
                                if (is_array($go_back_data)){
                                    if(key_exists('add_go_back', $go_back_data)){
                                        if ($go_back_data['add_go_back'] === 'yes'){

                                            $go_back_text = $go_back_data['text'];
                                            $link = wp_get_post_parent_id($page_id);
                                            if ($go_back_data['link'] === 'custom'){
                                                $link = $go_back_data['custom_link'][0];
                                            }

                                            $args = array(
                                                'back_page_id' => $link,
                                                'text' => $go_back_text,
                                                'section' => false,
                                            );
                                            get_template_part('inc/parts/go-back', '', $args);

                                        }
                                    }
                                }
                            ?>
                        <?php } ?>
                    </div>
                    
                    <!-- global-hero-col-bottom -->
                    <div class="global-hero-col-bottom" flex layout="row" layout-align="center center">
                        <div class="global-hero-layout-item" <?php echo $layout; ?>>
                            <?php if ($title or $overhead or $description or $additional_description){ ?>
                                <div class="global-hero-content" flex>

                                    <?php if ($overhead){ ?>
                                        <div class="global-hero-content-item global-hero-overhead colored-element semibold-1">
                                            <?php echo $overhead; ?>
                                        </div>
                                    <?php } ?>

                                    <?php if ($title){ ?>
                                        <?php
                                        $title_style = 'h1';
                                        if ($title_style_tag){
                                            $title_style = $title_style_tag;
                                        }
                                        ?>
                                        <h1 class="global-hero-content-item global-hero-title <?php echo $title_style; ?>">
                                            <?php echo $title; ?>
                                        </h1>
                                    <?php } ?>

                                    <?php if ($description){ ?>
                                        <div class="global-hero-content-item global-hero-description h6">
                                            <?php echo $description; ?>
                                        </div>
                                    <?php } ?>

                                    <?php if ($add_additional_description == 'yes' and $additional_description){ ?>
                                        <div class="global-hero-content-item global-hero-additional-description h6">
                                            <?php echo $additional_description; ?>
                                        </div>
                                    <?php } ?>

                                    <?php if ($action_button_link === 'show' and $action_button){ ?>
                                        <div class="global-hero-content-item global-hero-action-link">
                                            <?php 
                                                $link = $action_button;
                                                $link_url = $link['url'];
                                                $link_title = $link['title'];
                                                $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                            <?php
                                                $button_params = array(
                                                    'link'       => array(
                                                        'url'    => $link_url,
                                                        'title'  => $link_title,
                                                        'target' => $link_target
                                                    ),
                                                    'class'      => 'button button-dark',
                                                    'type'       => 'button',
                                                    'name'       => '',
                                                    'icon'       => true,
                                                    'icon_class' => 'icon-arrow-right',
                                                    'text'       => '',
                                                    'disabled'   => 0,
                                                    'data'       => '',
                                                );
                                                get_template_part('inc/elements/button', '', $button_params);
                                            ?>
                                        </div>
                                    <?php } ?>
                                
                                </div>
                            <?php } ?>

                            <?php if ($media_type){ ?>

                                <?php if($media_type == 'image'){ ?>
                                    <?php 
                                        $media_style_value = '';
                                        if ($media_style){
                                            $media_style_value = $media_style;
                                        }
                                    ?>
                                    <div class="global-hero-media <?php echo $media_style_value; ?>" flex flex-m="none">
                                        
                                        <?php if ($image){ ?>
                                            <div class="global-hero-image" flex="" layout="row" layout-align="end start">
                                                <?php 
                                                    $thumb_attributes = wp_get_attachment_image_src($image['ID'], 'full');
                                                    $thumb_height = $thumb_attributes['2'];

                                                    $height = $thumb_height / 2;
                                                    if ($initial_image_max_height){
                                                        $height = $initial_image_max_height;
                                                    }
                                                    $thumb = wp_get_attachment_image( $image['ID'], 'full', false, array('style'=> 'max-height: '.trim($height).'px;') ); 
                                                ?>
                                                <?php echo $thumb; ?>
                                            </div>
                                        <?php } ?>

                                    </div>
                                <?php } ?>

                                <?php if($media_type == 'in_phone'){ ?>

                                    <?php if ($in_phone_file){ ?>
                                        <?php $url = $in_phone_file['url']; ?>
                                        <div class="phone-holder" flex layout="row" layout-align="center center">
                                            <div class="ribbon-holder">
                                                <div class="ribbon"></div>
                                            </div>
                                            <div class="phone">
                                                <div class="phone-video">
                                                <video src="<?php echo $url; ?>" autoplay muted loop poster="">
                                                    Sorry, your browser doesn`t support embedded videos!
                                                </video>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                <?php } ?>

                                <?php if($media_type == '3d_obj'){ ?>
                                    <?php $model_filename = $obj_filename_val; ?>
                                    <?php if($model_filename){ ?>
                                        <?php 
                                        $args = array(
                                            'filename' => $model_filename,
                                        );
                                        get_template_part('inc/parts/model-viewer', '', $args);
                                        ?>
                                    <?php } ?>
                                <?php } ?>

                                <?php if($media_type == 'video'){ ?>
                                    <?php if (is_array($video)){ ?>
                                        <?php 
                                            $video_poster = '';
                                            $video_play_text = '';
                                            $video_url = '';

                                            $video_poster_id = '';
                                            $video_poster_thumb = '';

                                            if (key_exists('poster', $video)){
                                                $video_poster = $video['poster'];
                                                $video_poster_id = $video_poster['ID'];
                                                $video_poster_thumb = wp_get_attachment_image($video_poster_id, 'full');
                                                
                                            }
                                            if (key_exists('play_text', $video)){
                                                $video_play_text = $video['play_text'];
                                            }
                                            if (key_exists('video_url', $video)){
                                                $video_url = $video['video_url'];
                                            }
                                        ?>
                                        <div class="global-hero-media" flex flex-m="none">
                                        <div class="global-hero-video-container" flex="" layout="row" layout-align="end start">

                                            <div class="global-hero-video-holder">

                                                <?php if ($video_url){ ?>
                                                    <div class="play">
                                                        <a data-fancybox="hero-video" data-width="100%" data-height="100%" class="play-button" href="<?php echo $video_url; ?>">
                                                            <span class="button-shape" flex layout="row" layout-align="center center">
                                                                <span class="button-text">
                                                                    <?php echo $video_play_text; ?>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                <?php } ?>

                                                <?php echo $video_poster_thumb; ?>
                                            </div>

                                        </div>
                                        </div>
                                    
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>

                    </div>
                    <!-- /global-hero-col-bottom -->
                    
                </div>
                <!-- /global-hero-col -->

            </div>                   
        </div>
    </div>
</section>