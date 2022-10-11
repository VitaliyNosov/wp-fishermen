<?php
    $title = get_sub_field('title_text');
    $title_tag = get_sub_field('title_text_tag');
    $subtitle = get_sub_field('subtitle');
    $subtitle_tag = get_sub_field('subtitle_tag');
    $align = get_sub_field('align');

    $position = 'align-left';
    if ($align === 'right'){
        $position = 'align-right';
    } else if ($align === 'center'){
        $position = 'align-center';
    };

    $bg_class = '';
    $bg = get_sub_field('background');
    if ($bg){
        if ($bg == 'dark'){
            $bg_class = 'bg-dark';
        }
    }
?>

<?php if ($title){ ?>
<section class="section-title <?php echo $bg_class; ?>">
    <div class="wrapper container">
        <div layout>
            <div class="title-set <?php echo $position; ?>">

                <?php if ($subtitle){ ?>
                    <<?php echo esc_html($subtitle_tag); ?> class="title-set-subtitle">
                        <?php echo esc_html($subtitle); ?>
                    </<?php echo esc_html($subtitle_tag); ?>>
                <?php } ?>

                <?php if ($title){ ?>
                    <<?php echo esc_html($title_tag); ?>>
                        <?php echo esc_html($title); ?>
                    </<?php echo esc_html($title_tag); ?>>
                <?php } ?>

            </div>
        </div>
    </div>
</section>
<?php } ?>