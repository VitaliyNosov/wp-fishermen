<?php 
$title = $args['title'];
$text = $args['text'];
$link = $args['link'];
$bg_class = 'bg-white';
?>
<div class="section-card bg-white">
<div class="card color-block-white" flex>
    <div class="card-inner col" flex layout="row" layout-s="column" layout-align="start start" layout-align-s="center center" layout-wrap>

        <?php if ($title){ ?>
            <div class="card-title" flex>
                <h3><?php echo esc_html($title); ?>
            </div>
        <?php } ?>

        <?php if ($text){ ?>
            <div class="card-text" flex>
                <?php echo $text; ?>
            </div>
        <?php } ?>

    </div>

    <?php if ($link){ ?>
        <div class="card-actions col" flex layout="row" layout-align="end start" layout-align-s="center center">
            <?php
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <?php
            $button_class = 'button';
            if ($bg_class == 'bg-dark'){
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

</div><!-- /card -->
</div>