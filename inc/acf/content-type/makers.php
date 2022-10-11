<?php 
    $makers_positions = 0;
    $container_height = '';
    $makers_option = get_option('makers_option'); 
    if(!empty($makers_option)){
        $makers_container_height = $makers_option['makers_container_height'];
        $makers_container_height_tablet = $makers_option['makers_container_height_tablet'];
        $makers_container_height_mobile = $makers_option['makers_container_height_mobile'];
        if(!empty($makers_container_height)){
            echo '<textarea id="makers-container-height" hidden readonly>'.$makers_container_height.'</textarea>';
            $container_height = $makers_container_height;
        }
        if(!empty($makers_container_height_tablet)){
            echo '<textarea id="makers-container-height-tablet" hidden readonly>'.$makers_container_height_tablet.'</textarea>';
        }
        if(!empty($makers_container_height_mobile)){
            echo '<textarea id="makers-container-height-mobile" hidden readonly>'.$makers_container_height_mobile.'</textarea>';
        }

        $makers_initial = $makers_option['makers_position_number'];
        $makers_tablet = $makers_option['makers_tablet_positions'];
        $makers_mobile = $makers_option['makers_mobile_positions'];
        if(!empty($makers_initial)){
            echo '<textarea id="makers-initial" hidden readonly>'.$makers_initial.'</textarea>';
        }
        if(!empty($makers_tablet)){
            echo '<textarea id="makers-tablet" hidden readonly>'.$makers_tablet.'</textarea>';
        }
        if(!empty($makers_mobile)){
            echo '<textarea id="makers-mobile" hidden readonly>'.$makers_mobile.'</textarea>';
        }
    }
?>

<div id="makers-container" class="makers-container" style="height: <?php echo $container_height; ?>px;">
    <?php
    $makers_query_args = array(
        'post_type' => 'makers',
        'order' => 'ASC',
        'orderby' => 'date',
        'posts_per_page'=> -1,
    );
    $makers_query = new WP_Query( $makers_query_args );
    if ( $makers_query->have_posts() ) { ?>
        <?php while ( $makers_query->have_posts() ) {  $makers_query->the_post(); ?>

            <?php 
            $image = get_field('image');
            $description = get_field('description');

            $sizes_wide = '';
            $width_wide = '';   
            $height_wide = '';
            $sizes = get_field('sizes');
            if (is_array($sizes)){
                $sizes_wide = $sizes['site_wide'];
                $width_wide = $sizes_wide['width'];
                $height_wide = $sizes_wide['height'];
            }

            $image_id = '';
            $thumb_data = '';

            $w = $width_wide;
            $h = $height_wide;
            
            $img_src = '';
            if ($image){
                $image_id = $image['ID'];
                $thumb_data = wp_get_attachment_image_src($image_id, 'full');
                $img_src = $thumb_data['0'];
            }
            ?>

            <div id="maker-<?php echo get_the_ID(); ?>" class="maker" data-height="<?php echo $h; ?>" data-width="<?php echo $w; ?>">
                <div class="maker-inner">
                    <div class="maker-layout" flex layout="row" layout-align="start center">
                        <div class="maker-desc" flex>
                            <div class="maker-name"><?php the_title(); ?></div>
                            <div class="maker-text"><?php echo $description; ?></div>
                        </div>
                        <div class="maker-thumb" flex="none" style="height: <?php echo $h; ?>px; width: <?php echo $w; ?>px;">
                            <img src="<?php echo $img_src; ?>">
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    <?php } ?>
    <?php wp_reset_postdata(); ?>
</div>