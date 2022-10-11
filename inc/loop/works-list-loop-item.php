<?php
$remove_category = $args['remove_category'];
$remove_bottom_link = $args['remove_bottom_link'];

$id = get_the_ID();
$image = get_the_post_thumbnail( $id, 'full' );

$thumb_bg = get_field('thumbnail_bg_color');
$thumb = get_field('thumbnail');
if ($thumb){
    $image = wp_get_attachment_image( $thumb['ID'], 'full' );
}

$title = get_the_title();
$text = get_the_excerpt($id);

$service_page_name = '';
$service_page = get_field('related_services', $id);
if (isset($service_page)){
    $service_page_name = $service_page->post_title;
    $filter_id = $service_page->ID;
};

$item_img_bg = '';
if ($thumb_bg){
    $item_img_bg .= 'background: '.$thumb_bg.'';
}
?>
<span class="works-loop-item col filter-<?php echo $filter_id; ?>" flex="none" layout="row" layout-align="stretch start">
    <a class="works-loop-item-inner link-object" flex layout="column" layout-align="stretch start" href="<?php the_permalink(); ?>">

        <span class="works-loop-item-image" style="<?php echo $item_img_bg; ?>" flex="none">
            <?php if( $image ): ?>
                <?php echo $image; ?>
            <?php endif; ?>
        </span>

        <span class="works-loop-item-content" flex layout="row" layout-align="start start">
            <span class="works-loop-item-content-inner">
                
                <?php if ($service_page_name and $remove_category != true){ ?>
                    <span class="works-loop-item-service" flex layout="row" layout-align="start start">
                    <span class="works-loop-item-service-name" flex="none">
                            <?php echo $service_page_name; ?>
                        </span> 
                    </span>
                <?php } ?>

                <?php if ($title){ ?>
                    <span class="works-loop-item-title h4">
                        <?php echo $title; ?>
                    </span>
                <?php } ?>

                <?php if ($text){ ?>
                    <span class="works-loop-item-text">
                        <?php echo $text; ?>
                    </span>
                <?php } ?>
                
                <?php if ($remove_bottom_link != true){ ?>
                    <span class="works-loop-item-view link-arrow colored-element" flex="none">
                        <span class="works-loop-item-view-layout" flex layout="row" layout-align="start center">
                            <span class="works-loop-item-view-title link-arrow-text" flex="none">
                                View Case Study
                            </span>
                            <i class="works-loop-item-view-icon icon-arrow-right" flex="none"></i>
                        </span>
                    </span>
                <?php } ?>

            </span>
        </span><!-- /works-loop-item-content -->

    </a>
</span><!-- /works-loop-item -->