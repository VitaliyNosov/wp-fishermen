<?php 
$title = get_sub_field('title');
$text = get_sub_field('text');
?>
<div class="column r-left" flex flex-m="none">
    
    <?php if ($title) { ?>
        <div class="title h4">
            <?php echo $title; ?>
        </div>
    <?php } ?>

    <?php if ($text) { ?>
        <div class="text body-1">
            <?php echo $text; ?>
        </div>
    <?php } ?>
    
</div>
