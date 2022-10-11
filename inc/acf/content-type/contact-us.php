<?php
$shortcode = get_sub_field('shortcode');
?>

<div class="contact-form col">
    <div class="contact-form-inner">
        <?php echo do_shortcode(trim($shortcode)); ?>
    </div>
</div>

<div id="message-dialog" style="display: none;">
    <div class="message-dialog">
        <div class="dialog-title">
            <div class="dialog-title-layout" flex layout="row" layout-align="center center">
                <div class="dialog-title-shape" flex="none" layout="row" layout-align="center center">
                    <div class="dialog-title-shape-icon"></div>
                </div>
                <div id="dialog-title-text" class="dialog-title-text h5" flex="none">Title</div>
            </div>
        </div>
        <div id="dialog-text" class="dialog-text body-1">Text</div>
    </div>
</div>