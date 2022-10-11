<?php
    $title = $args['title'];
    $tag = $args['title_tag'];

    $title_tag = 'h5';
    if ($tag){
        $title_tag = $tag;
    }
?>
<?php if ($title){ ?>
    <div class="url-title">
        <div class="wrapper">

            <<?php echo $title_tag; ?> class="url-title-layout" flex layout="row" layout-align="center start">
                <?php
                    $link = $title;
                    $link_url = $title['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" flex="none" layout="row" layout-align="start center">
                    <span flex="none">
                        <?php echo esc_html($link_title); ?>
                    </span>
                    <i flex="none" class="url-title-icon icon-arrow-right"></i>
                </a>
            </<?php echo $title_tag; ?>>

        </div>
    </div>
<?php } ?>