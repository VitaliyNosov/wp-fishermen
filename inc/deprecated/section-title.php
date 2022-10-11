<?php
$title = $args['title'];
$title_tag = $args['title_tag'];
$overhead = $args['overhead'];
$overhead_tag = $args['overhead_tag'];
$align = $args['titles_align'];
$description = $args['title_description'];

$position = 'align-left';
if ($align === 'right'){
    $position = 'align-right';
} else if ($align === 'center'){
    $position = 'align-center';
};
?>

<?php if (isset($title)){ ?>
    <div class="title-set">
        <div class="wrapper">

            <div class="top-titles col">

                <div class="title-set-group <?php echo $position; ?>">
                    <?php if (isset($overhead)){ ?>
                        <<?php echo esc_html($overhead_tag); ?> class="title-set-overhead">
                            <?php echo esc_html($overhead); ?>
                        </<?php echo esc_html($overhead_tag); ?>>
                    <?php } ?>
                
                    <<?php echo esc_html($title_tag); ?>>
                        <?php echo $title; ?>
                    </<?php echo esc_html($title_tag); ?>>
                </div>

                <?php if (isset($description)){ ?>
                    <div class="title-set-description <?php echo $position; ?>">
                        <?php echo $description; ?>
                    </div>
                <?php } ?>

            </div>
    
        </div>
    </div>
<?php } ?>