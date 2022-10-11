<?php
$block_class = '';

$width = get_sub_field('width');
$title = get_sub_field('title');
$description = get_sub_field('description');
$caption = get_sub_field('caption');

$media_type_field = get_sub_field('media_type');
$media_type = 'image';
if ($media_type_field){
    $media_type = $media_type_field;
}
$image = get_sub_field('image');
$video_data = get_sub_field('video');

$effects_val = 'none';
$effects = get_sub_field('effects');
if ($effects){
    $effects_val = $effects;
}
$block_class .= ' '.$effects_val;

$thumb = '';
if ($image){
    $image_id = $image['ID'];
    $thumb = wp_get_attachment_image($image_id, 'full');
}

$image_class = '';
if ($width == 'large'){
    $image_class = 'width-large';
} else if ($width == 'medium'){
    $image_class = 'width-medium';
} else if ($width == 'small'){
    $image_class = 'width-small';
}
?>
<div class="content-block content-block-image reveal-small_ <?php echo $block_class; ?>">
    <div class="wrapper">
        <div class="content-block-container col">

            <div class="content-block-inner <?php echo $image_class; ?>">
                <?php if ($title){ ?>
                    <div class="title image-element h3">
                        <?php echo $title; ?>
                    </div>
                <?php } ?>
                
                <?php if ($media_type == 'image'){ ?>
                    <?php if (!empty($thumb)){ ?>
                        <?php echo $thumb; ?>
                    <?php } ?>
                <?php } else if ($media_type == 'video') { ?>
                    <?php if($video_data){ ?>
                        <?php 
                        $poster = $video_data['poster'];
                        $file = $video_data['file'];
                        $poster_src = '';
                        if ($poster){
                            $poster_id = $poster['ID'];
                            $poster_src = wp_get_attachment_image_src($poster_id, 'full');
                            $poster_src = $poster_src['0'];
                        }
                        ?>
                        <?php if ($file){ ?>
                            <?php $url = $file['url']; ?>
                            <video src="<?php echo $url; ?>" autoplay muted loop playsinline poster="<?php echo $poster_src; ?>" style="pointer-events: none;">
                                Sorry, your browser doesn`t support embedded videos!
                            </video>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>

                <?php if ($caption){ ?>
                    <div class="caption width-small image-element body-2">
                        <?php echo $caption; ?>
                    </div>
                <?php } ?>

                <?php if ($description){ ?>
                    <div class="description image-element h5">
                        <?php echo $description; ?>
                    </div>
                <?php } ?>

            </div>

        </div>
    </div>
</div>