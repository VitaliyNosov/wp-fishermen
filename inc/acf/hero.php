<?php 
$logo_obj = get_sub_field('3d_logo');

$poster_image_id = '';
$poster = '';
$poster_attrs = '';
$poster_image = get_sub_field('poster_image');
if ($poster_image){
    $poster_image_id = $poster_image['id'];
    $poster_attrs = wp_get_attachment_image_src( $poster_image_id, 'full' );
}
if (is_array($poster_attrs)){
    $poster = $poster_attrs[0];
}

$contact_button = get_sub_field('show_btn');

$link = get_sub_field('cta');
if ($link){
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
}
?>

<section class="section-hero">
    <div class="wrapper">
        <div class="hero-layout col" flex layout="row" layout-align="space-between center" layout-m="column" layout-align-m="center center">

            <div class="hero-text" flex="none" flex-m="none">
                <h1>
                    <?php the_sub_field('title'); ?>
                </h1>
            </div>

            <?php if ($logo_obj){ ?>
                <div class="hero-logo" flex layout="row" layout-align="center center">

                    <div class="model-viewer-holder">
                        <div id="model-progress-bar" class="progress-bar">
                            <div id="model-progress-bar-inner" class="progress-bar-inner">
                                <div class="progress-bar-value"></div>
                            </div>
                        </div>
                        <model-viewer id="hero-logo" src="<?php echo get_template_directory_uri(); ?>/assets/3d/<?php echo $logo_obj; ?>" poster="<?php echo $poster; ?>" auto-rotate auto-rotate-delay="1000" loading="eager" camera-controls preload shadow-intensity="0" ar ar-modes="webxr scene-viewer quick-look" disable-zoom interaction-prompt="none"></model-viewer>
                        <script>
                            const heroLogo = document.getElementById('hero-logo');
                            const modelProgressBar = document.getElementById('model-progress-bar');
                            const modelProgressBarInner = document.getElementById('model-progress-bar-inner');

                            heroLogo.addEventListener('preload', e => {
                                modelProgressBar.style.display = 'block';
                            }, { once: true });

                            heroLogo.addEventListener('load', e => {
                                modelProgressBar.style.display = 'none';
                            }, { once: true });

                            heroLogo.addEventListener('progress', e => {
                                let w = e.detail.totalProgress
                                w = w * 100;
                                modelProgressBarInner.style.width = w+'%';
                            });
                        </script>
                    </div>

                </div>
            <?php } ?>

        </div>

        <?php if ($contact_button === true){ ?>
            <div id="hero-actions" class="hero-actions" flex layout="row" layout-align="end start">
                <div class="hero-actions-item">
                    <?php
                    $button_params = array(
                        'link'       => array(
                            'url'    => $link_url,
                            'title'  => $link_title,
                            'target' => $link_target
                        ),
                        'class'      => 'button',
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
            </div>
        <?php } ?>

    </div>
</section>