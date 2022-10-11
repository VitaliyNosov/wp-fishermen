<div class="slider-pages-item col-marg color-block-white" flex layout="column" layout-align="stretch start">
    <?php 
        $id = get_the_ID();
        $title = get_the_title();
        $text = apply_filters( 'the_content', get_the_content(null, false, $id));
    ?>

    <?php if ($title){ ?>
        <div class="slider-pages-item-title"><?php echo $title; ?></div>
    <?php } ?>

    <?php if ($text){ ?>
        <div class="slider-pages-item-text"><?php echo $text; ?></div>
    <?php } ?>

    <div class="slider-pages-item-link" flex layout="row" layout-align="end end">
        <a href="<?php the_permalink(); ?>">
            <i flex="none" class="icon-arrow-right"></i>
        </a>
    </div>
    
</div> 