<?php
$id = get_the_ID();
$thumbnail_id = get_post_thumbnail_id();
$image = wp_get_attachment_image( $thumbnail_id, 'full' );
$title = get_the_title();
$class = $args['class'];
?>
<div class="blog-posts-loop-item <?php echo $class; ?> col" flex="none" layout="row" layout-align="stretch start">
    <a class="blog-posts-loop-item-inner link-object" flex layout="column" layout-align="stretch start" layout-m="row" layout-align-m="center center" layout-s="column" layout-align-s="start start" href="<?php the_permalink(); ?>">

        <span class="blog-posts-loop-item-image" flex="none">
            <?php if( $image ): ?>
                <?php echo $image; ?>
            <?php endif; ?>
        </span>

        <span class="blog-posts-loop-item-content" flex layout="row" layout-align="start start">
            <span class="blog-posts-loop-item-content-inner">

                <?php if ($title){ ?>
                    <span class="blog-posts-loop-item-title body-1">
                        <?php echo $title; ?>
                    </span>
                <?php } ?>
                
                <?php 
                    $author_terms = get_the_terms( $id, 'authors' );
                    $services_terms = wp_get_post_categories($id, array( 'fields' => 'all' ));
                ?>
                <?php if (is_array($author_terms) or is_array($services_terms)){ ?>
                    <span class="blog-posts-loop-item-terms colored-element body-2">
                        <?php if (is_array($author_terms)){ ?>
                            <?php foreach( $author_terms as $author ){ ?>
                                <span class="blog-posts-loop-item-terms-item">
                                    <?php echo $author->name; ?>
                                </span>
                            <?php } ?>
                        <?php } ?>

                        <?php if (is_array($services_terms)){ ?>

                            <span class="blog-posts-loop-item-terms-separator">
                                &nbsp;&VerticalLine;&nbsp;
                            </span>

                            <?php foreach( $services_terms as $service ){ ?>
                                <?php if ($service->term_id != '1'){ ?>
                                    <span class="blog-posts-loop-item-terms-item">
                                        <?php echo $service->name; ?>
                                    </span>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </span>
                <?php } ?>

            </span>
        </span><!-- /blog-posts-loop-item-content -->

    </a>
</div>