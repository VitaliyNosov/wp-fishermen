<?php
$class = '';

$title = get_sub_field('title');

$title_align_class = '';
$title_align = get_sub_field('title_align');
if ($title_align){
    if ($title_align == 'center'){
        $title_align_class = 'align-center';
    }
}

$text = get_sub_field('text');

$indent = false;
$add_indent = get_sub_field('add_indent_to_text');
if ($add_indent == 'yes'){
    $indent = true;
}
if ($indent == true){
    $class .= ' has-indent';
}


$link = get_sub_field('link_button');
$link_theme_color = 'white';
$link_theme = get_sub_field('link_button_theme');
?>
<div class="content-block reveal-small_ content-block-single-text <?php echo $class; ?>">
    <div class="wrapper">
        <div class="content-block-container col">

            <div class="content-block-inner width-small">
                <?php if ($title){ ?>
                    <div class="title h4 <?php echo $title_align_class; ?>" flex="none">
                        <?php echo $title; ?>
                    </div>
                <?php } ?>

                <?php if ($text){ ?>
                    <div class="text body-1" flex="none">
                        <?php echo $text; ?>
                    </div>
                <?php } ?>

                <?php if ($link){ ?>
                    <div class="button-link">
                        <?php
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';

                        $class = 'button';
                        if ($link_theme){
                            $link_theme_color = $link_theme;
                        }
                        if ($link_theme_color == 'dark'){
                            $class .= 'button-dark';
                        }


                        $button_params = array(
                            'link'       => array(
                                'url'    => $link_url,
                                'title'  => $link_title,
                                'target' => $link_target
                            ),
                            'class'      => $class,
                            'type'       => 'button',
                            'name'       => '',
                            'icon'       => true,
                            'icon_class' => 'icon-arrow-right',
                            'text'       => '',
                            'disabled'   => 0,
                            'data'       => '',
                        );
                        get_template_part('inc/elements/button', '', $button_params);
                        ?>
                    </div>
                <?php } ?>
            </div>


        </div>
    </div>
</div>