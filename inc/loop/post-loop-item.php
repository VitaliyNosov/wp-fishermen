<?php
$id = get_the_ID();
$image = get_the_post_thumbnail( $id, 'full' );

$title = get_the_title();
$text = apply_filters( 'the_content', get_the_content(null, false, $id));
?>
<div class="post-loop-item col" flex="none" layout="column" layout-m="row" layout-s="column" layout-align="stretch start" layout-align-m="start center">

    <div class="post-loop-item-image" flex="none" flex-m="init" flex-s="none">
        <?php if( $image ): ?>
            <?php echo $image; ?>
        <?php endif; ?>
    </div>

    <div class="post-loop-item-content" flex layout="row" layout-align="start start">
        <div class="post-loop-item-content-inner">

            <?php if ($title){ ?>
                <div class="post-loop-item-title">
                    <?php echo $title; ?>
                </div>
            <?php } ?>

            <?php if ($text){ ?>
                <div class="post-loop-item-text">
                    <?php echo $text; ?>
                </div>
            <?php } ?>

        </div>
    </div>

</div>