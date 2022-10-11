<?php
$back_page_id = $args['back_page_id'];
$text = $args['text'];
$section = false;
if (key_exists('section', $args)){
    $section = $args['section'];
}
?>
<?php if ($section == true){ ?>
    <section class="section-layout section-go-back">
        <div class="wrapper">
            <div class="go-back-content col">
<?php } ?>

            <div class="go-back" flex="none" layout="row" layout-align="start start">
                <a href="<?php echo the_permalink($back_page_id);?>" class="go-back-layout" flex="none" layout="row" layout-align="start center">
                    <span class="go-back-icon" flex="none">
                        <span class="icon-arrow-right"></span>
                    </span>
                    <span class="go-back-text" flex="none">
                        <?php echo $text; ?>
                    </span>
                </a>
            </div>

<?php if ($section == true){ ?>
            </div>
        </div>
    </section>
<?php } ?>