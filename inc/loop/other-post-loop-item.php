<?php
$id = get_the_ID();
$image = get_the_post_thumbnail( $id, 'full' );
$title = get_the_title();
?>
<div class="other-post-loop-item" flex="none" layout="row" layout-align="stretch start">
    <a class="other-post-loop-item-inner link-object" flex layout="row" layout-align="center center" href="<?php the_permalink(); ?>">

        <span class="other-post-loop-item-image" flex="none">
            <?php if( $image ): ?>
                <?php echo $image; ?>
            <?php endif; ?>
        </span>

        <span class="other-post-loop-item-content" flex layout="row" layout-align="start start">
            <span class="other-post-loop-item-content-inner">

                <?php if ($title){ ?>
                    <span class="other-post-loop-item-title">
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
                    <span class="other-post-loop-item-terms colored-element">
                        <?php if (is_array($author_terms)){ ?>
                            <?php foreach( $author_terms as $author ){ ?>
                                <span class="other-post-loop-item-terms-item">
                                    <?php echo $author->name; ?>
                                </span>
                            <?php } ?>
                        <?php } ?>

                        <?php if (is_array($services_terms)){ ?>

                            <span class="other-post-loop-item-terms-separator">
                                &nbsp;&VerticalLine;&nbsp;
                            </span>

                            <?php foreach( $services_terms as $service ){ ?>
                                <span class="other-post-loop-item-terms-item">
                                    <?php echo $service; ?>
                                </span>
                            <?php } ?>
                        <?php } ?>
                    </span>
                <?php } ?>

            </span>
        </span><!-- /other-post-loop-item-content -->

    </a>
</div>