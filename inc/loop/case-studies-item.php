<?php 
    $i = $args['counter_i'];    

    $item_class = '';
    $layout_align = 'start center';
    if ($i % 2 != 1){
        $item_class = 'case-studies-item-right';
        $layout_align = 'end center';
    }

    $id = get_the_ID();
    $image_id = get_post_thumbnail_id($id);
    $image = wp_get_attachment_image($image_id,'full');
    $title = get_the_title();
    $category = get_field( 'related_services', $id );
    $category_name = $category->post_title;
    $text = apply_filters( 'the_content', get_the_content(null, false, $id));

?>
<div class="case-studies-item <?php echo $item_class; ?>" flex layout="row" layout-align="<?php echo $layout_align; ?>">
    <div class="case-studies-item-inner" lex layout="row" layout-m="column" layout-align="start center" layout-align-m="start start" layout-wrap>
 
        <?php if( !empty( $image and $i % 2 == 1 ) ): ?>
            <div class="case-studies-item-image col" flex>
                <?php echo $image; ?>
            </div>
        <?php endif; ?>

        <div class="case-studies-item-content col" flex>

            <?php if ($category_name){ ?>
                <div class="case-studies-item-category">
                    <?php echo $category_name; ?>
                </div>
            <?php } ?>

            <?php if ($title){ ?>
                <h3 class="case-studies-item-title">
                    <?php echo $title; ?>
                </h3>
            <?php } ?>

            <?php if ($text){ ?>
                <div class="case-studies-item-text">
                    <?php echo $text; ?>
                </div>
            <?php } ?>

            <div class="case-studies-item-link">
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

        <?php if( !empty( $image and $i % 2 != 1 ) ): ?>
            <div class="case-studies-item-image col" flex>
                <?php echo $image; ?>
            </div>
        <?php endif; ?>

    </div>
</div>
                