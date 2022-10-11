<?php 
$images = get_sub_field('images'); 
if (is_array($images)){
    $gallery_class = '';
    $images_count = count($images);
    if($images_count == 1){
        $gallery_class = ' content-block-gallery-single-image';
    }
}
?>
<div class="content-block reveal-small_ content-block-gallery <?php echo $gallery_class; ?>">
    <div class="wrapper">
        <div class="content-block-container col">

            <?php if (is_array($images)){ ?>
                <div class="gallery">
                    <?php foreach( $images as $image ): ?>
                        <?php
                        $image_id = $image['ID'];
                        $thumb = wp_get_attachment_image($image_id, 'full');
                        ?>
                        <div class="gallery-item">
                            <?php echo $thumb; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php } ?>

        </div>
    </div>
</div>