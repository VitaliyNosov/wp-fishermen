<?php
    $title = get_sub_field('title');
    $tag = get_sub_field('tag');
    $link = get_sub_field('link');

    $title_tag = 'h5';
    if ($tag){
        $title_tag = $tag;
    }

    $bg_class = '';
    $bg = get_sub_field('background');
    if ($bg){
        if ($bg == 'dark'){
            $bg_class = 'bg-dark';
        }
    }
?>
<?php if ($title){ ?>
    <section class="section-url-title <?php echo $bg_class; ?>">
        <div class="wrapper">

            <<?php echo $title_tag; ?> class="url-title-layout" flex layout="row" layout-align="center start">
                <?php if ($link){ ?> 
                    <?php
                        $link_url = $link['url'];
                        //$link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" flex="none" layout="row" layout-align="start center">
                        <span flex="none">
                            <?php echo esc_html($title); ?>
                        </span>
                        <i flex="none" class="url-title-icon icon-arrow-right"></i>
                    </a>
                <?php } ?>
            </<?php echo $title_tag; ?>>

        </div>
    </section>
<?php } ?>