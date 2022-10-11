<?php
$block_class = '';

$width = get_sub_field('width');
$title = get_sub_field('title');
$description = get_sub_field('description');
$caption = get_sub_field('caption');
$image = get_sub_field('poster');
$obj_model = get_sub_field('filename');

$standalone_val = 'flow';
$standalone = get_sub_field('standalone');
if ($standalone == 'yes'){
    $standalone_val = 'standalone';
}
$block_class .= ' '.$standalone_val;

$thumb = '';
if ($image){
    $image_id = $image['ID'];
    $thumb = wp_get_attachment_image_src($image_id, 'full');
    $thumb = $thumb['0'];
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
                
                <?php if($obj_model){ ?>
                    <?php 
                    $args = array(
                        'filename' => $obj_model,
                        'poster' => $thumb,
                    );
                    get_template_part('inc/parts/model-viewer', '', $args);
                    ?>
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