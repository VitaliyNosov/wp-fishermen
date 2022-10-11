<?php
$direction = get_sub_field('direction');
$title = get_sub_field('title');
$description = get_sub_field('description');
$link = get_sub_field('link');

$video = get_sub_field('video');
$poster = get_sub_field('poster');

$content_class = 'r-left';

$direction_val = 'ltr';
if ($direction){
    $direction_val = $direction;
};


$poster_thumb = '';
$poster_data = '';
if ($poster){
    $poster_id = $poster['ID'];

    $poster_src = wp_get_attachment_image_src($poster_id, 'full');
    $poster_src = $poster_src['0'];
    $poster_thumb = wp_get_attachment_image($poster_id, 'full');
}

$link_theme_color = 'white';
$link_theme = get_sub_field('link_button_theme');


$media_content = '';

if($video){
    $url = $video['url'];
    $media_content = '
        <video src="'.$url.'" autoplay muted loop playsinline poster="'.$poster_src.'" style="pointer-events: none;">
            Sorry, your browser doesn`t support embedded videos!
        </video>';
}
if(!$video and $poster){
    $media_content = $poster_thumb;
}

$media_output = '
<div class="thumb r-top" flex="none">
    <div class="thumb-inner">
        <div class="thumb-inner-media">
            '.$media_content.'  
        </div>
    </div>
</div>';

if ($direction_val == 'rtl'){
    $content_class = 'r-right';
}

?>
<div class="preview-container reveal_ width-large direction-<?php echo $direction_val; ?>">
    <div class="preview-layout" flex layout="row" layout-align="space-between center" layout-s="column">

        <?php if ($direction_val == 'ltr'){ echo $media_output; } ?>

        <div class="content <?php echo $content_class; ?>" flex flex-s="none">
            <?php if ($title){ ?>
                <div class="title h3">
                    <?php echo $title; ?>
                </div>
            <?php } ?>

            <?php if ($description){ ?>
                <div class="description body-2">
                    <?php echo $description; ?>
                </div>
            <?php } ?>

            <?php if ($link){ ?>
                <div class="button-link">
                    <?php
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';

                    $class = 'button';
                    if ($link_theme){
                        $link_theme_color = $link_theme;
                    }
                    if ($link_theme_color == 'dark'){
                        $class .= 'button-dark';
                    }

                    $button_params = array(
                        'link'       => array(
                            'url'    => $link_url,
                            'title'  => $link_title,
                            'target' => $link_target
                        ),
                        'class'      => $class,
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
        </div>

        <?php if ($direction_val == 'rtl'){ echo $media_output; } ?>

    </div>
</div>