<?php
$class = $args['class'];
?>
<div class="services-cards-loop-item <?php echo $class; ?>" flex="none" layout="row" layout-align="stretch start">
    <?php 
        $id = get_the_ID();
        $title = get_the_title();
        $text = get_the_excerpt();
    ?>
    <a class="services-cards-loop-item-inner link-object" href="<?php the_permalink(); ?>" flex layout="column" layout-align="stretch start">
        <?php if ($title){ ?>
            <span class="services-cards-loop-item-title"><?php echo $title; ?></span>
        <?php } ?>
        <?php if ($text){ ?>
            <span class="services-cards-loop-item-text"><?php echo $text; ?></span>
        <?php } ?>
        <span class="services-cards-loop-item-icon" flex layout="row" layout-align="end end">
            <i flex="none" class="icon-arrow-right"></i>
        </span>
    </a>
</div> 