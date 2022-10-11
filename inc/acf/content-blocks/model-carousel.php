<?php 
$title = get_sub_field('title');
?>
<div class="content-block content-block-model-carouse">
    <div class="wrapper">
        <div class="content-block-container col">

            <div class="model-carousel-container width-large">
                <div class="model-carousel-title h3">
                    <?php echo $title; ?>
                </div>
                <div class="model-carousel-content">
                    
                    <div class="model-carousel-itself model-carousel-layout" flex layout="row" layout-align="start center">
                        <div class="model-carousel-media" flex>

                            <?php 
                            if( have_rows('items') ):
                                $i = 0; while ( have_rows('items') ) : the_row(); $i++;
                                    if( get_row_layout() == 'item' ):
                                        $media = '';
                                        $media_type = get_sub_field('media_type');
                                        $image = get_sub_field('image');
                                        $object = get_sub_field('object');
                                        if ($media_type == 'image'){
                                            $media = $image;
                                        } else if($media_type == 'object'){
                                            $media = $object;
                                        }

                                        $class = '';
                                        if ($i == 1){
                                            $class = 'active';
                                        }
                                    ?>

                                        <div data-id="id-<?php echo $i; ?>" class="media <?php echo $class; ?>">
                                            <div class="media-inner">

                                                <?php if ($media_type == 'image'){ ?>
                                                    <?php
                                                        $thumb_id = $media['ID'];
                                                        $thumb = wp_get_attachment_image($thumb_id, 'full');
                                                    ?>
                                                    <?php echo $thumb; ?>
                                                <?php } ?>

                                                <?php if ($media_type == 'object'){ ?>
                                                    <?php
                                                        $poster = $media['poster'];
                                                        $poster_id = $poster['ID'];
                                                        $poster_data = wp_get_attachment_image_src($poster_id, 'full');
                                                        $poster_thumb = $poster_data['0'];
                                                        $filename = $media['filename'];
                                                    ?>
                                                    <?php if($filename){ ?>
                                                        <?php 
                                                        $args = array(
                                                            'filename' => $filename,
                                                            'poster' => $poster_thumb,
                                                        );
                                                        get_template_part('inc/parts/model-viewer', '', $args);
                                                        ?>
                                                    <?php } ?>
                                                <?php } ?>

                                            </div>
                                        </div>

                                    <?php 
                                    endif;
                                endwhile;
                            endif;
                            ?>

                        </div>

                        <div class="model-carousel-names" flex="none">

                            <?php 
                            if( have_rows('items') ):
                                $i = 0; while ( have_rows('items') ) : the_row(); $i++;
                                    if( get_row_layout() == 'item' ):
                                        $name = get_sub_field('title'); 
                                        $class = '';
                                        if ($i == 1){
                                            $class = 'active';
                                        }
                                    ?>

                                    <div data-id="id-<?php echo $i; ?>" class="name <?php echo $class; ?>">
                                        <div class="name-layout" flex layout="row" layout-align="start center">
                                            <div class="name-shape" flex="none"></div>
                                            <div class="name-title">
                                                <?php echo $name; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                    endif;
                                endwhile;
                            endif;
                            ?>

                        </div>
                    </div>


                </div>
            </div>

        
        </div>
    </div>
</div>