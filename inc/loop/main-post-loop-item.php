<?php
$id = get_the_ID();
$thumbnail_id = get_post_thumbnail_id();
$image = wp_get_attachment_image( $thumbnail_id, 'full' );
$title = get_the_title();
?>
<div class="main-post-loop-item col" flex="none" layout="row" layout-align="stretch start">
    <a class="main-post-loop-item-inner link-object" flex layout="column" layout-align="stretch start" href="<?php the_permalink(); ?>">

        <span class="main-post-loop-item-image" flex="none">
            <?php if( $image ): ?>
                <?php echo $image; ?>
            <?php endif; ?>
        </span>

        <span class="main-post-loop-item-content" flex layout="row" layout-align="start start">
            <span class="main-post-loop-item-content-inner">

                <?php if ($title){ ?>
                    <span class="main-post-loop-item-title">
                        <?php echo $title; ?>
                    </span>
                <?php } ?>
                
                <?php 
                    $author_terms = get_the_terms( $id, 'authors' );
                    $services_terms_args = array (
                        'exclude' => 1,
                        'fields' => 'names',
                        'taxonomy' => 'category',
                    );
                    $services_terms = get_terms($services_terms_args );
                ?>
                <?php if (is_array($author_terms) or is_array($services_terms)){ ?>
                    <span class="main-post-loop-item-terms colored-element">
                        <?php if (is_array($author_terms)){ ?>
                            <?php foreach( $author_terms as $author ){ ?>
                                <span class="main-post-loop-item-terms-item">
                                    <?php echo $author->name; ?>
                                </span>
                            <?php } ?>
                        <?php } ?>

                        <?php if (is_array($services_terms)){ ?>

                            <span class="main-post-loop-item-terms-separator">
                                &nbsp;&VerticalLine;&nbsp;
                            </span>

                            <?php foreach( $services_terms as $service ){ ?>
                                <span class="main-post-loop-item-terms-item">
                                    <?php echo $service; ?>
                                </span>
                            <?php } ?>
                        <?php } ?>
                    </span>
                <?php } ?>

            </span>
        </span><!-- /main-post-loop-item-content -->

    </a>
</div>