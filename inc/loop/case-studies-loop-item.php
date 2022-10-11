<?php 
    $i = $args['counter_i'];    

    $item_class = '';
    $layout_align = 'start center';
    if ($i % 2 != 1){
        $item_class = 'case-studies-loop-item-right';
        $layout_align = 'end center';
    }

    $id = get_the_ID();
    $image_id = get_post_thumbnail_id($id);
    $image = wp_get_attachment_image($image_id,'full');
    $image_src = wp_get_attachment_image_src($image_id, 'full');
    if ($image_src){
        $image_src = $image_src['0'];
    }
    $title = get_the_title();
    $category = get_field( 'related_services', $id );
    $category_name = $category->post_title;

    $text_content = get_the_excerpt();
    $text = get_field('case_studies_section_description', $id);
    if ($text){
        $text_content = $text;
    }

    $oembed = get_field('oembed');

    $media_output = '';
    if ($oembed){
        $file = $oembed;
        $url = $file['url'];
        $media_output = '
        <div class="case-studies-loop-item-media oembed" flex="none">
            <div class="case-studies-loop-item-media-inner">
                
                <video src="'.$url.'" autoplay muted loop poster="'.$image_src.'">
                    Sorry, your browser doesn`t support embedded videos!
                </video>
            
            </div>
        </div>'; 
    } else {
        if ($image) {
            $media_output = '
            <div class="case-studies-loop-item-media" flex="none">
                <div class="case-studies-loop-item-media-inner">
                    '.$image.'
                </div>
            </div>';
        }
    }

?>
<div class="case-studies-loop-item col <?php echo $item_class; ?>" flex layout="row" layout-align="<?php echo $layout_align; ?>">
    <div class="case-studies-loop-item-inner reveal" lex layout="row" layout-m="column" layout-align="start center" layout-align-m="start start" layout-wrap>
 
        <?php if( !empty($oembed) and $i % 2 == 1 ) { ?>
            <?php echo $media_output; ?>
        <?php } else { ?>
            <?php if( !empty($image) and $i % 2 == 1 ) { ?>
                <?php echo $media_output; ?>
            <?php } ?>
        <?php } ?>

        <div class="case-studies-item-loop-content" flex>

            <?php if ($category_name){ ?>
                <div class="case-studies-loop-item-category colored-element semibold-2">
                    <?php echo $category_name; ?>
                </div>
            <?php } ?>

            <?php if ($title){ ?>
                <h3 class="case-studies-loop-item-title">
                    <?php echo $title; ?>
                </h3>
            <?php } ?>

            <?php if ($text_content){ ?>
                <div class="case-studies-loop-item-text body-2">
                    <?php echo $text_content; ?>
                </div>
            <?php } ?>

            <div class="case-studies-loop-item-link">
                <?php
                $link_url = get_permalink($id);
                $link_title = 'See Case Study';
                $link_target = '_self';

                $button_params = array(
                    'link'       => array(
                        'url'    => $link_url,
                        'title'  => $link_title,
                        'target' => $link_target,
                    ),
                    'class'      => 'button',
                    'type'       => 'button',
                    'name'       => '',
                    'icon'       => false,
                    'icon_class' => '',
                    'text'       => '',
                    'disabled'   => 0,
                    'data'       => '',
                );
                get_template_part('inc/elements/button', '', $button_params);
                ?>
            </div>

        </div>

        <?php if( !empty($oembed) and $i % 2 != 1 ) { ?>
            <?php echo $media_output; ?>
        <?php } else { ?>
            <?php if( !empty($image) and $i % 2 != 1 ) { ?>
                <?php echo $media_output; ?>
            <?php } ?>
        <?php } ?>

    </div>
</div>
                