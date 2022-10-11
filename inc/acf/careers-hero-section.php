<?php 
$title = get_sub_field('title');
$image = get_sub_field('image');

$classes = '';
$bg_class = 'bg-white';
$bg = get_sub_field('background');
if ($bg){
    if ($bg == 'dark'){
        $bg_class = 'bg-dark';
    }
}
?>

<section class="section-careers-hero careers-hero <?php echo $classes; ?> <?php echo $bg_class; ?>" data-bg="<?php echo $bg_class; ?>">

    <div class="wrapper">
        <div class="careers-hero-layout" flex layout="row" layout-m="column" layout-align="start center" layout-align-m="start start">

            <div class="careers-hero-content col" flex flex-m="none">
                <div class="careers-hero-global-name">
                    <?php the_title(); ?>
                </div>
                <?php if ($title){ ?>
                    <h2 class="careers-hero-title">
                        <?php echo $title; ?>
                    </h2>
                <?php } ?>
                
                <div class="careers-hero-actions">
                    <?php
                    $button_params = array(
                        'link'       => array(
                            'url'    => '#jobs',
                            'title'  => '',
                            'target' => ''
                        ),
                        'class'      => 'button button-dark',
                        'type'       => 'button',
                        'name'       => '',
                        'icon'       => true,
                        'icon_class' => 'icon-arrow-right',
                        'text'       => 'See Job Openings',
                        'disabled'   => 0,
                        'data'       => '',
                    );
                    get_template_part('inc/elements/button', '', $button_params);
                    ?>
                </div>
                
            </div>

            <?php if ($image){ ?>
                <?php 
                    $url = $image['url'];
                    $alt = $image['alt'];
                    $height = $image['height'];
                ?>
                <div class="careers-hero-image col-marg" flex="none" layout="row" layout-align="center center" layout-align-m="start start">
                    <img class="careers-hero-image-helper" src="" height="<?php echo $height; ?>" width="1" />
                    <img class="careers-hero-image-abs" src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>" />
                </div>
            <?php } ?>

        </div>
    </div>
</section>