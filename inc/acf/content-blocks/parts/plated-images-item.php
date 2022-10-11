<?php
$type = get_sub_field('type'); 
$settings = get_sub_field('settings');
$images = get_sub_field('images');

$class = '';
$style = '';

$type_val = '';
if ($type){
    $type_val = $type;
    $class .= ' '.$type_val;
}

$settings_val = '';
if ($settings){
    $settings_val = $settings;
    if ($type_val != 'single'){
        $class .= ' size-'.$settings;
        $style = ' width:'.$settings.'%; min-width:'.$settings.'%';
    }
}

?>
<?php if( have_rows('images') ): ?>
    <div class="gallery reveal-small_ <?php echo $class; ?>" flex layout="row" layout-align="stretch start">
        <?php $i = 1; while ( have_rows('images') ) : the_row(); ?>
            <?php if( get_row_layout() == 'content' ): ?>

                <?php
                    $image = get_sub_field('image');
                    $thumb = '';
                    if ($image){
                        $image_id = $image['ID'];
                        $thumb = wp_get_attachment_image($image_id, 'full');
                    }
                ?>
                <?php if (!empty($thumb)){ ?>
                    <div class="gallery-item" flex style="<?php if ($i == 1){ echo $style; }; ?>">
                        <div class="thumb">
                            <?php echo $thumb; ?>
                        </div>
                    </div>
                <?php } ?>

            <?php endif; ?>
        <?php $i++; endwhile; ?>
    </div>
<?php else : endif; ?>