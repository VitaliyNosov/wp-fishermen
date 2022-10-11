<?php
/**
 * Settings
 */
$section_styles = '';
$section_classes = '';
$section_datas = '';
$bg = 'none';

/*
$settings = get_sub_field('settings_group');
if ($settings['background'] == 'custom'){
    $bg = $settings['background_custom'];
    if ($settings['background_custom'] == 'colorpicker'){
        $bg_colorpicker = $settings['background_custom_colorpicker'];
        $fonts_colors = $settings['fonts_colors'];
        $section_styles .= 'background-color: '.$bg_colorpicker.''; 
        $section_classes .= ' fonts-color-bg-'.$fonts_colors.'';
    }

    $section_classes .= ' bg-'.$bg.'';
    if ($settings['background_custom'] == 'colorpicker'){
        $section_datas .= ' data-onbg="bg-'.$fonts_colors.'"';
    } else {
        $section_datas .= ' data-onbg="bg-'.$bg.'"';
    }
}
*/

$counter = '0';
$holder_class = 'single-blocks';
?>
<?php if( have_rows('content_blocks') ): ?>

    <?php while ( have_rows('content_blocks') ) : the_row(); $counter++; endwhile; ?>

    <?php 
    if($counter > 1){
        $holder_class = 'multiple-blocks-in';
    }
    ?>

    <div class="content-blocks-holder <?php echo $holder_class; ?>">
        <?php while ( have_rows('content_blocks') ) : the_row(); ?>

            <?php if(get_row_layout() == 'section'): ?>
                <section class="section-layout section-content-blocks content-blocks <?php echo $section_classes; ?>" style="<?php echo $section_styles; ?>" <?php echo $section_datas; ?>>
                    <?php 
                    if( have_rows('block') ):
                        while ( have_rows('block') ) : the_row();

                            if( get_row_layout() == 'single_text' ):
                                get_template_part('inc/acf/content-blocks/single-text');

                            elseif( get_row_layout() == 'columns_text' ): 
                                get_template_part('inc/acf/content-blocks/columns');
            
                            elseif( get_row_layout() == 'previews' ): 
                                get_template_part('inc/acf/content-blocks/previews');
            
                            elseif( get_row_layout() == 'image' ): 
                                get_template_part('inc/acf/content-blocks/image');
            
                            elseif( get_row_layout() == '3d_model' ): 
                                get_template_part('inc/acf/content-blocks/3d-model');
            
                            elseif( get_row_layout() == 'plated_images' ): 
                                get_template_part('inc/acf/content-blocks/plated-images');
            
                            elseif( get_row_layout() == 'promo_video' ): 
                                get_template_part('inc/acf/content-blocks/promo-video');
            
                            elseif( get_row_layout() == 'gallery' ): 
                                get_template_part('inc/acf/content-blocks/gallery');

                            elseif( get_row_layout() == 'model_carousel' ): 
                                get_template_part('inc/acf/content-blocks/model-carousel');
            
                            elseif( get_row_layout() == 'view_page' ): 
                                get_template_part('inc/acf/content-blocks/view-page');
                                
                            endif;
                            
                        endwhile;
                    endif; 
                    ?>
                </section>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
<?php endif; ?>