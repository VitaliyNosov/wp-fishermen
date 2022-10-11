<?php
$image = get_sub_field('image');
$video_str = get_sub_field('video_string');

$thumb = '';
$image_id = '';
if ($image){
    $image_id = $image['ID'];
    $thumb = wp_get_attachment_image($image_id, 'full');
}

?>
<div class="content-block content-block-promo-video">
    <div class="wrapper">
        <div class="content-block-container col">

            <div class="content-block-inner width-large">

                <div class="image">
                    <div class="shade"></div>

                    <?php if ($video_str){ ?>
                        <div class="play">
                            <a data-fancybox="promo-video" data-width="100%" data-height="100%" class="play-button" href="<?php echo $video_str; ?>">
                                <span class="button-shape" flex layout="row" layout-align="center center">
                                    <span class="button-text">
                                        Play Promo
                                    </span>
                                </span>
                            </a>
                        </div>
                    <?php } ?>

                    <?php echo $thumb; ?>
                </div>

            </div>
        
        </div>
    </div>
</div>
