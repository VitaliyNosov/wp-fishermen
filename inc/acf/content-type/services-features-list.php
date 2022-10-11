<?php 
if( have_rows('items') ): 
    
    while ( have_rows('items') ) : the_row();
        if( get_row_layout() == 'item' ): ?>

            <?php
            $title = get_sub_field('title');
            $text = get_sub_field('text');
            $additional_text = get_sub_field('additional_text');
            $image = get_sub_field('image');
            $video = get_sub_field('video');
            $media_type = get_sub_field('media_type');

            $image_data = '';
            $image_class = '';
            $thumb = '';

            $direction_field = get_sub_field('direction');
            $additional_margin_field = get_sub_field('additional_margin');
            $flip = get_sub_field('flip');
            $unset_max_width = get_sub_field('unset_max_width');
            $set_media_sizes = get_sub_field('set_media_sizes');
            $media_sizes = get_sub_field('media_sizes');

            $direction = 'ltr';
            if ($direction_field){
                $direction = $direction_field;
            };
            $additional_margin = '';
            if ($additional_margin_field){
                $additional_margin = trim($additional_margin_field);
            };
            
            $media_datas = '';
            $media_wide_style = '';
            $media_tablet_style = '';
            $media_mobile_style = '';

            $max_height_wide = '';
            $max_height_tablet = '';
            $max_height_mobile = '';

            $image_id = '';
            if ($image) {
                $image_id = $image['id'];
            }

            if ($set_media_sizes){
                if ($set_media_sizes === 'yes'){
                    if (is_array($media_sizes)){
                        if(array_key_exists('site_wide_max_height', $media_sizes)){
                            $max_height_wide = $media_sizes['site_wide_max_height'];
                            $media_wide_style .= '
                                #img-'.$image_id.' .services-feature-image-inner-item img {
                                    max-height: '.$max_height_wide.'px;
                                }
                            ';
                        }
                        if(array_key_exists('tablet_max_height', $media_sizes)){
                            $max_height_tablet = $media_sizes['tablet_max_height'];
                            $media_tablet_style .= '
                                #img-'.$image_id.' .services-feature-image-inner-item img {
                                    max-height: '.$max_height_tablet.'px;
                                }
                            ';
                        }
                        if(array_key_exists('mobile_max_height', $media_sizes)){
                            $max_height_mobile = $media_sizes['mobile_max_height'];
                            $media_mobile_style .= '
                                #img-'.$image_id.' .services-feature-image-inner-item img {
                                    max-height: '.$max_height_mobile.'px;
                                }
                            ';
                        }
                    }
                }
            };
        
            if ($flip){
                if ($flip === 'yes'){
                    $media_datas .= ' data-flip-tablet="true"'; 
                }
            };

            if ($unset_max_width){
                if ($unset_max_width === 'yes'){
                    $media_datas .= ' data-unset-max-width="true"'; 
                }
            }

            if ($additional_margin != ''){
                $media_wide_style .= ' #img-'.$image_id.' {width: calc(100% - 576px - '.$additional_margin.'px);}';   
            }

            $media_output = '';
            if ($media_type == 'image' and $image){
                $thumb = wp_get_attachment_image( $image['ID'], 'full', false, [
                    'class' => '', 
                    'loading' => 'eager'
                  ] );
                
                $images_class = 'r-left';
                $image_data = 'flex="none" layout="row" layout-align="end start" layout-align-m="end end"';
                if ($direction == 'ltr'){
                    $images_class = 'r-right';
                    $image_data = 'flex="none" layout="row" layout-align="start start" layout-align-m="end end"';
                }

                if ($unset_max_width){
                    if ($unset_max_width === 'yes'){
                        $image_data = 'flex="none" layout="row" layout-align="start start" layout-align-m="end end"';
                        if ($direction == 'ltr'){
                            $image_data = 'flex="none" layout="row" layout-align="end start" layout-align-m="end end"';
                        }
                    }
                }

                $media_output = '
                    <div id="img-'.$image_id.'" class="services-feature-image '.$images_class.'" '.$image_data.'>
                        <div class="services-feature-image-inner">
                            <div class="services-feature-image-inner-item" '.$media_datas.'>
                                '.$thumb.'
                            </div>
                        </div>
                    </div>
                    <style>
                    '.$media_wide_style.'
                      @media only screen and (max-width: 1024px) {
                        '.$media_tablet_style.'
                      }
                      @media only screen and (max-width: 600px) {
                        '.$media_mobile_style.'
                      }
                    </style>
                ';
            }
            if ($media_type == 'video' and $video){

                // poster="'.$image['url'].'";

                $url = $video['url'];
                $media_output = '
                    <div class="services-feature-video">
                        <div class="services-feature-video-inner">
                            <video src="'.$url.'" autoplay muted loop>
                                Sorry, your browser doesn`t support embedded videos!
                            </video>
                        </div>
                    </div>
                ';
            }
        ?>  

        <div class="services-feature-layout reveal col" flex layout="row" layout-align="space-between center" layout-m="column" layout-align-m="stretch start">

            <?php 
            $class = 'r-right';
            if ($direction == 'ltr'){
                $class = 'r-left';
            }
            ?>
            
            <?php if ($direction == 'ltr'){
                echo $media_output;
            } ?>

            <div class="services-feature-content <?php echo $class; ?>" flex>
                <?php if ($title){ ?>
                    <h2 class="services-feature-content-title">
                        <?php echo $title; ?>
                    </h2>
                <?php } ?>

                <?php if ($text){ ?>
                    <div class="services-feature-content-text h6">
                        <?php echo $text; ?>
                    </div>
                <?php } ?>
                
                <?php if ($additional_text){ ?>
                    <div class="services-feature-content-additional-text semibold-1">
                        <?php echo $additional_text; ?>
                    </div>
                <?php } ?>
            </div>

            <?php if ($direction == 'rtl'){
                echo $media_output;
            } ?>

        </div><!-- // services-feature-layout -->

        <?php
        endif;
    endwhile; 
else :
// Do something...
endif;
?>