<?php 
$title = get_sub_field('title');
$text = get_sub_field('text');
$img = get_sub_field('image');

$classes = '';
$bg_class = 'bg-white';
$bg = get_sub_field('background');
if ($bg){
    if ($bg == 'dark'){
        $bg_class = 'bg-dark';
    }
}
?>

<section class="section-services-hero services-hero <?php echo $classes; ?> <?php echo $bg_class; ?>" data-bg="<?php echo $bg_class; ?>">

    <div class="wrapper">
        <div class="services-hero-layout" flex layout="row" layout-m="column" layout-align="start center" layout-align-m="start start" layout-wrap>

            <div class="services-hero-content col" flex="none">
                <div class="services-hero-global-name color-purple">
                    <?php the_title(); ?>
                </div>
                <?php if ($title){ ?>
                    <h1 class="services-hero-title">
                        <?php echo $title; ?>
                    </h1>
                <?php } ?>
                <?php if ($text){ ?>
                    <div class="services-hero-text">
                        <?php echo $text; ?>
                    </div>
                <?php } ?>
            </div>

            <?php if ($img){ ?>
                <div class="services-hero-image col" flex layout="row" layout-align="center center">
                    <img src="<?php echo $img; ?>" alt="">
                </div>
            <?php } ?>

        </div>
    </div>
</section>