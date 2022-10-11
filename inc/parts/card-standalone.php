<?php 
$title = $args['title'];
$text = $args['text'];
$link = $args['link'];

$bg = '';
if(array_key_exists('bg', $args)){
    $bg = $args['bg'];
}

$card_color = '';
if(array_key_exists('card_color', $args)){
    $card_color = $args['card_color'];
}
?>
<div class="content-width content-width-col card-standalone">
    <div class="card-holder col">
        <div class="card card-<?php echo $card_color; ?>" flex layout="column" layout-align="space-between stretch">
            <div class="card-top" flex layout="row" layout-s="column" layout-align="space-between start" layout-align-s="center center" layout-wrap>
                <?php if ($title){ ?>
                    <div class="card-title" flex="none">
                        <?php echo esc_html($title); ?>
                    </div>
                <?php } ?>
                <?php if ($text){ ?>
                    <div class="card-text semibold-1" flex="none">
                        <?php echo $text; ?>
                    </div>
                <?php } ?>
            </div>

            <?php if ($link){ ?>
                <div class="card-actions" flex="none" layout="row" layout-align="end start" layout-align-s="center center">
                    <?php
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <?php
                    $button_class = 'button';
                    if ($card_color  === 'dark'){
                        $button_class = 'button button-dark';   
                    }
                    $button_params = array(
                        'link'       => array(
                            'url'    => $link_url,
                            'title'  => $link_title,
                            'target' => $link_target
                        ),
                        'class'      => $button_class,
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