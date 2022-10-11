<?php
$cover = $args['cover'];
$cover_height_val = $args['cover_height'];
$cover_shade_color = $args['cover_shade_color_gradient'];
$logo = $args['logo'];
$logo_height_val = $args['logo_height'];
$link = $args['link'];
$video_button_text = $args['video_button_text'];
$video = $args['video'];

$cover_thumb = '';
$cover_height = '0';
$cover_thumb_data = '';

if ($cover){
    $cover_id = $cover['ID'];
    $cover_thumb_data = wp_get_attachment_image_src($cover_id, 'full');
    if ($cover_thumb_data){
        $cover_thumb = $cover_thumb_data['0'];
        $cover_height = $cover_thumb_data['2'];
    }

    if ($cover_height_val){
        $cover_height = $cover_height_val;
    }
}


?>
<section class="section-hero-promo">
    
    <?php if ($cover_thumb){ ?>
        <div class="hero-promo-cover-holder" style="min-height: <?php echo $cover_height; ?>px;">
            <div class="hero-promo-cover">
                <img src="<?php echo $cover_thumb; ?>">
            </div>
            <div class="hero-promo-shade" style="background: linear-gradient(179.08deg, <?php echo $cover_shade_color; ?> -2.87%, rgba(34, 3, 40, 0.205371) 51.2%, <?php echo $cover_shade_color; ?> 105.34%);"></div>
        </div>
    <?php } ?>

    <div class="hero-promo-container">
        <div class="wrapper">
            <div class="hero-promo-layout" flex layout="row" layout-align="center center" style="min-height: <?php echo $cover_height; ?>px;">
                
                <div class="hero-promo-inner" flex layout="column" layout-align="center center">
                    
                    <?php if($logo){ ?>
                        <div class="hero-promo-logo">
                            <?php
                                $logo_thumb = '';
                                $logo_height = '230';
                                $logo_image_id = $logo['ID'];
                                $logo_thumb_data = wp_get_attachment_image_src( $logo_image_id, 'full'); 
                                $logo_thumb = $logo_thumb_data['0'];
                                if ($logo_height_val){
                                    $logo_height = $logo_height_val;
                                }
                            ?>
                            <img src="<?php echo $logo_thumb; ?>" height="<?php echo $logo_height_val; ?>px" style="height: <?php echo $logo_height_val; ?>px;">
                        </div>
                    <?php } ?>
                    <div class="hero-promo-content" flex layout="row" layout-align="center center">

                        <?php if ($link){ ?>
                            <div class="hero-promo-action">
                                <?php 
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
                                    'class'      => 'button',
                                    'type'       => 'button',
                                    'name'       => '',
                                    'icon'       => false,
                                    'icon_class' => 'icon-arrow-right',
                                    'text'       => '',
                                    'disabled'   => 0,
                                    'data'       => '',
                                );
                                get_template_part('inc/elements/button', '', $button_params);
                                ?>  
                            </div>
                        <?php } ?>

                        <?php if ($video_button_text and $video){ ?>
                            <div class="hero-promo-action">
                                <?php 
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <?php
                                $button_params = array(
                                    'link'       => array(
                                        'url'    => $video,
                                        'title'  => $video_button_text,
                                        'target' => ''
                                    ),
                                    'custom'        => true,
                                    'class'         => 'button transparent',
                                    'type'          => 'link',
                                    'name'          => '',
                                    'icon'          => true,
                                    'icon_class'    => 'icon-triangle-right',
                                    'icon_position' => 'left',
                                    'text'          => '',
                                    'disabled'      => 0,
                                    'data'          => ' data-fancybox="promo-video" data-width="100%" data-height="100%"',
                                );
                                get_template_part('inc/elements/button', '', $button_params);
                                ?>  
                            </div>
                        <?php } ?>

                    </div>

                </div>

            </div>
        </div>
    </div>

</section>