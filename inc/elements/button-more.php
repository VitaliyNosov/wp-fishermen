<?php
$text = $args['text'];
$class = $args['class'];
$id = $args['id'];
?>
<button id="<?php echo $id; ?>" type="button" name="" class="button-more button-element <?php echo $class; ?>" data-init-text="<?php echo $text; ?>">
    <span class="shape"></span>
    <span class="layout" flex layout="row" layout-align="start center">
        <span class="text" flex="none">
            <?php echo $text; ?>
        </span>
        <span class="icon" flex="none" layout="row" layout-align="center center">
            <span class="chevron bottom" flex="none"></span>
        </span>
    </span>
</button>